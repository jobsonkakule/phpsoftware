<?php

use App\Connection;
use App\Table\CategoryTable;
use App\Table\PostTable;

$id = (int)$params['id'];
$slug = $params['slug'];

$pdo = Connection::getPDO();
$post = (new PostTable($pdo))->find($id);

(new CategoryTable($pdo))->hydratePosts([$post]);

if ($post->getSlug() !== $slug) {
    $url = $router->url('post', ['slug' => $post->getSlug(), 'id' => $id]);
    http_response_code(301);
    header('Location: ' . $url);
}
?>
<div class="container container-top">
    <h1><?= e($post->getName()) ?></h1>
    <p class="text-muted">
        <?=$post->getCreatedAt()->format('d F Y à H:i') ?>
    </p>
    <?php foreach($post->getCategories() as $k => $category):
        if ($k > 0): 
            echo ', ' ;
        endif;
        $categoryUrl = $router->url('category', ['id' => $category->getId(), 'slug' => $category->getSlug()]);
        ?><a href="<?=$categoryUrl ?>"><?=e($category->getName()) ?></a><?php 
    endforeach ?>
    <?php if($post->getImage()): ?>
        <img src="<?= $post->getImageURL('large') ?>" alt="" style="width: 100%;" class="mt-3">
    <?php endif ?>
    <p><?=$post->getFormattedContent() ?></p>
</div>