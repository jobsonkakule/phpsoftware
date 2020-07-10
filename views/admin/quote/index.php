<?php

use App\Auth;
use App\Connection;
use App\Table\QuoteTable;

Auth::check();
$router->layout = "admin/layouts/default";
$title = 'Administration | Sanitas';

$pdo = Connection::getPDO();

$table = new QuoteTable($pdo);
[$quotes, $pagination] = $table->findPaginated();

$link = $router->url('admin_quotes');
?>
<?php if (isset($_GET['delete'])): ?>
    <div class="alert alert-success">
        L'enregistrement a été supprimé avec succès
    </div>
<?php endif ?>
<h1 cla>Gérer les citatons <span class="text-right text-muted">
    (<?= $table->count() ?>)
</span></h1>
<div class="d-flex justify-content-between my-3">
    <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Entrer un mot-clé" aria-label="Entrer un mot-clé">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">Recherche</button>
    </form>
    <a class="btn btn-primary" href="<?= $router->url('admin_quote_new') ?>">+ Ajouter</a>
</div>
<table class="table table-striped">
    <thead>
        <th>#ID</th>
        <th>Auteur</th>
        <th>Date de création</th>
        <th class="text-right">Actions</th>
    </thead>
    <tbody>
        <?php foreach($quotes as $quote): ?>
            <tr>
                <td>
                    #<?= e($quote->getId()) ?>
                </td>
                <td>
                    <?= e($quote->getName()) ?>
                </td>
                <td>
                    <?=$quote->getCreatedAt()->format('d F Y') ?>
                </td>
                <td class="text-right">
                    <a href="<?= $router->url('admin_quote', ['id' => $quote->getId()]) ?>" class="btn btn-primary">Editer</a>
                    <form action="<?= $router->url('admin_quote_delete', ['id' => $quote->getId()]) ?>" method="post"
                        onsubmit="return confirm('Voulez vous vraiment effectuer cette action ?')" style="display: inline;">
                        <button class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<div class="d-flex justify-content-center my-4">
    <?= $pagination->previousLink($link) ?>
    <?= $pagination->nextLink($link) ?>
</div>