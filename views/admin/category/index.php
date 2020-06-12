<?php

use App\Auth;
use App\Connection;
use App\Entity\Category;
use App\Table\CategoryTable;

Auth::check();
Auth::restrict();
$router->layout = "admin/layouts/default";
$title = 'Administration | Sanitas';

$pdo = Connection::getPDO();

/** @var Category[] */
$items = (new CategoryTable($pdo))->all();

$link = $router->url('admin_categories');
?>
<?php if (isset($_GET['delete'])): ?>
    <div class="alert alert-success">
        L'enregistrement  a été supprimé avec succès
    </div>
<?php endif ?>
<h1>Gérer les catégories</h1>
<table class="table table-striped">
    <thead>
        <th>#ID</th>
        <th>Titre</th>
        <th class="text-right">
            <a class="btn btn-primary" href="<?= $router->url('admin_category_new') ?>">+ Ajouter</a>
        </th>
    </thead>
    <tbody>
        <?php foreach($items as $item): ?>
            <tr>
                <td>
                    <a href="<?= $router->url('category', ['id' => $item->getId(), 'slug' => $item->getSlug()]) ?>">#<?= e($item->getId()) ?></a>
                </td>
                <td>
                    <?= e($item->getName()) ?>
                </td>
                <td class="text-right">
                    <a href="<?= $router->url('admin_category', ['id' => $item->getId()]) ?>" class="btn btn-primary">Editer</a>
                    <form action="<?= $router->url('admin_category_delete', ['id' => $item->getId()]) ?>" method="POST"
                        onsubmit="return confirm('Voulez vous vraiment effectuer cette action ?')" style="display: inline;">
                        <button class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>