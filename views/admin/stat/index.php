<?php

use App\Auth;
use App\Connection;
use App\Table\CityTable;
use App\Table\DiseaseTable;
use App\Table\StatTable;

Auth::check();
$router->layout = "admin/layouts/default";

$pdo = Connection::getPDO();
$disease = new DiseaseTable($pdo);
$city = new CityTable($pdo);

$table = new StatTable($pdo);
$stats = $table->all();
?>
<?php if (isset($_GET['delete'])): ?>
    <div class="alert alert-success">
        L'enregistrement  a été supprimé avec succès
    </div>
<?php endif ?>
<?php if(isset($_GET['created'])): ?>
    <div class="alert alert-success">
        L'entrée a bien été ajoutée
    </div>
<?php endif ?>
<h1 cla>Gérer les statistiques <span class="text-right text-muted">(<?= $table->count() ?>)</span></h1>
<div class="d-flex justify-content-between my-3">
    <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Entrer un mot-clé" aria-label="Entrer un mot-clé">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">Recherche</button>
    </form>
    <a class="btn btn-primary" href="<?= $router->url('admin_stat_new') ?>">+ Ajouter</a>
</div>
<table class="table table-striped">
    <thead>
        <th>#ID</th>
        <th>Epidémie</th>
        <th>Ville</th>
        <th>Nouveaux cas</th>
        <th class="text-right">Actions</th>
    </thead>
    <tbody>
        <?php foreach($stats as $stat): ?>
            <tr>
                <td>
                    #<?= e($stat->getId()) ?>
                </td>
                <td>
                    <?= $disease->find($stat->getDiseaseId())->getName() ?>
                </td>
                <td>
                    <?= $city->find($stat->getCityId())->getTitle() ?>
                </td>
                <td>
                    <?= $stat->getCases() ?>
                </td>
                <td class="text-right">
                    <a href="<?= $router->url('admin_stat', ['id' => $stat->getId()]) ?>" class="btn btn-primary">Editer</a>
                    <form action="<?= $router->url('admin_stat_delete', ['id' => $stat->getId()]) ?>" method="post"
                        onsubmit="return confirm('Voulez vous vraiment effectuer cette action ?')" style="display: inline;">
                        <button class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>