<?php

use App\Connection;
use App\Table\CategoryTable;
use App\Table\PostTable;

$id = (int)$params['id'];
$slug = $params['slug'];

$pdo = Connection::getPDO();

$category = (new CategoryTable($pdo))->find($id);

if ($category->getSlug() !== $slug) {
    $url = $router->url('category', ['slug' => $category->getSlug(), 'id' => $id]);
    http_response_code(301);
    header('Location: ' . $url);
}
$title = $category->getName() . ' | Sanitas';

[$posts, $paginatedQuery] = (new PostTable($pdo))->findPaginatedForCategory($category->getId());
$link = $router->url('category', ['id' => $category->getId(), 'slug' => $category->getSlug()])
?>
<h1>Catégorie : <?=e($category->getName()) ?></h1>
<div class="row">
    <?php foreach($posts as $post): ?>
        <div class="col-md-3">
            <?php require dirname(__DIR__) . '/post/card.php'; ?>
        </div>
    <?php endforeach ?>
</div>
<div class="d-flex justify-content-between my-4">
    <?= $paginatedQuery->previousLink($link) ?>
    <?= $paginatedQuery->nextLink($link) ?>
</div>