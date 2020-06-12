<?php

use App\Auth;
use App\Connection;
use App\Table\CategoryTable;
use App\Table\DiseaseTable;
use App\Table\PostTable;
use App\Table\QuoteTable;
use App\Table\UserTable;

Auth::check();
$pdo = Connection::getPDO(); 
$post = new PostTable($pdo);
$category = new CategoryTable($pdo);
$disease = new DiseaseTable($pdo);
$user = new UserTable($pdo);
$quote = new QuoteTable($pdo);

?>

<div class="container">
    <h1 class="font-weight-bold">Dashboard</h1>
    <hr>
    <div class="row justify-content-center text-center">
        <div class="col-md-3">
            <div class="card mt-2">
                <span>Total</span>
                <span style="font-size: 7rem;" class="font-weight-bold"><?= $post->count() ?></span>
                <a href="<?= $router->url('admin_posts') ?>" class="btn btn-primary">Gérer les articles</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mt-2">
                <span>Total</span>
                <span style="font-size: 7rem;" class="font-weight-bold"><?= $disease->count() ?></span>
                <a href="<?= $router->url('admin_posts') ?>" class="btn btn-primary">Gérer les épidémies</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mt-2">
                <span>Total</span>
                <span style="font-size: 7rem;" class="font-weight-bold"><?= $quote->count() ?></span>
                <a href="<?= $router->url('admin_quotes') ?>" class="btn btn-primary">Gérer les citations</a>
            </div>
        </div>
        <?php if(isset($_SESSION['auth']) && ($_SESSION['role'] === 'Administrateur')): ?>
            <div class="col-md-3">
                <div class="card mt-2">
                    <span>Total</span>
                    <span style="font-size: 7rem;" class="font-weight-bold"><?= $category->count() ?></span>
                    <a href="<?= $router->url('admin_posts') ?>" class="btn btn-primary">Gérer les catégories</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mt-2">
                    <span>Total</span>
                    <span style="font-size: 7rem;" class="font-weight-bold"><?= $user->count() ?></span>
                    <a href="<?= $router->url('admin_posts') ?>" class="btn btn-primary">Gérer les utilisateurs</a>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>