<?php

use App\Auth;
use App\Connection;
use App\Table\PostTable;

Auth::check();
$router->layout = "admin/layouts/default";
$title = 'Administration | Sanitas';

$pdo = Connection::getPDO();

$table = new PostTable($pdo);
[$posts, $pagination] = $table->findPaginated();

$link = $router->url('admin_posts');
?>
<?php if (isset($_GET['delete'])): ?>
    <div class="alert alert-success">
        L'enregistrement  a été supprimé avec succès
    </div>
<?php endif ?>
<h1>Administration des articles</h1>
<table class="table table-striped">
    <thead>
        <th>#ID</th>
        <th>Titre</th>
        <th>
            <a class="btn btn-primary" href="<?= $router->url('admin_post_new') ?>">+ Ajouter</a>
        </th>
    </thead>
    <tbody>
        <?php foreach($posts as $post): ?>
            <tr>
                <td>
                    <a href="<?= $router->url('post', ['id' => $post->getId(), 'slug' => $post->getSlug()]) ?>">#<?= e($post->getId()) ?></a>
                </td>
                <td>
                    <?= e($post->getName()) ?>
                </td>
                <td>
                    <a href="<?= $router->url('admin_post', ['id' => $post->getId()]) ?>" class="btn btn-primary">Editer</a>
                    <form action="<?= $router->url('admin_post_delete', ['id' => $post->getId()]) ?>" method="POST"
                        onsubmit="return confirm('Voulez vous vraiment effectuer cette action ?')" style="display: inline;">
                        <button class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<div class="d-flex justify-content-between my-4">
    <?= $pagination->previousLink($link) ?>
    <?= $pagination->nextLink($link) ?>
</div>