<?php

use App\Auth;
use App\Connection;
use App\Table\DiseaseTable;

Auth::check();
$router->layout = "admin/layouts/default";
$title = 'Administration | Sanitas';

$pdo = Connection::getPDO();

$table = new DiseaseTable($pdo);
$diseases = $table->all();
?>
<?php if (isset($_GET['delete'])): ?>
    <div class="alert alert-success">
        L'enregistrement  a été supprimé avec succès
    </div>
<?php endif ?>
<?php if(isset($_GET['created'])): ?>
    <div class="alert alert-success">
        L'épidémie a bien été créée
    </div>
<?php endif ?>
<h1 cla>Gérer les épdémies <span class="text-right text-muted">(6)</span></h1>
<div class="d-flex justify-content-between my-3">
    <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Entrer un mot-clé" aria-label="Entrer un mot-clé">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">Recherche</button>
    </form>
    <a class="btn btn-primary" href="<?= $router->url('admin_disease_new') ?>">+ Ajouter</a>
</div>
<table class="table table-striped">
    <thead>
        <th>#ID</th>
        <th>Nom</th>
        <th>Status</th>
        <th>Niveau d'alerte</th>
        <th class="text-right">Actions</th>
    </thead>
    <tbody>
        <?php foreach($diseases as $disease): ?>
            <tr>
                <td>
                    <a href="<?= $router->url('disease', ['id' => $disease->getId(), 'slug' => $disease->getSlug()]) ?>">#<?= e($disease->getId()) ?></a>
                </td>
                <td>
                    <?= e($disease->getName()) ?>
                </td>
                <td>
                    <?= e($disease->getState()) ?>
                </td>
                <td>
                    <?= e($disease->getFlag()) ?>
                </td>
                <td class="text-right">
                    <a href="<?= $router->url('admin_disease', ['id' => $disease->getId()]) ?>" class="btn btn-primary">Editer</a>
                    <form action="<?= $router->url('admin_disease_delete', ['id' => $disease->getId()]) ?>" method="post"
                        onsubmit="return confirm('Voulez vous vraiment effectuer cette action ?')" style="display: inline;">
                        <button class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>