<?php

use App\Connection;
use App\Table\PostTable;

$title = 'Le Blog | Sanitas';

$pdo = Connection::getPDO();

$table = new PostTable($pdo);
[$posts, $pagination] = $table->findPaginated();

$link = $router->url('home');
?>
<div class="container container-top">
    <h1 class="text-center">Le Blog</h1>
    <hr>
    <div class="row">
        <?php foreach($posts as $post): ?>
            <div class="col-md-3">
                <?php require 'card.php'; ?>
            </div>
        <?php endforeach ?>
    </div>
    <div class="d-flex justify-content-center my-4">
        <?= $pagination->previousLink($link) ?>
        <?= $pagination->nextLink($link) ?>
    </div>
</div>