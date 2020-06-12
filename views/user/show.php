<?php

use App\Connection;
use App\Entity\User;
use App\Table\UserTable;

$id = (int)$params['id'];

$pdo = Connection::getPDO();
/**
 * @var User
 */
$user = (new UserTable($pdo))->find($id);

?>
<div class="container container-top">
    <div class="text-center">
        <?php if (isset($_GET['forbidden'])): ?>
            <div class="alert alert-danger">
                Vous n'avez pas les permissions nécessaire pour accéder à cette page...
            </div>
        <?php endif ?>
        <?php if (isset($_GET['connected'])): ?>
            <div class="alert alert-success">
                Vous vous êtes bien connecté
            </div>
        <?php endif ?>
        <?php if (isset($_GET['updated'])): ?>
            <div class="alert alert-success">
                Vous avez modifié votre compte avec succès
            </div>
        <?php endif ?>
        <div class="d-flex justify-content-between">
            <h1>
                <?= !empty($user->getPseudo()) ? e($user->getPseudo()) :  e($user->getUsername()) ?>
            </h1>
            <div>
                <?php if (isset($_SESSION['auth']) && $_SESSION['auth'] === $id): ?>
                    <a href="<?= $router->url('user_update') ?>" class="btn btn-primary">
                        Mettre à jour
                    </a>
                <?php endif ?>
            </div>
        </div>
        <hr>
        <div>
            <p class="text-muted">
                Inscrit depuis le <span class="font-weight-bold"><?=$user->getCreatedAt()->format('d F Y') ?></span>
            </p>
            <?php if($user->getImage()): ?>
                <img src="<?= $user->getImageURL('large') ?>" alt="" class="mb-4">
            <?php endif ?>
            <?php if ($user->getDescription()): ?>
                <p class="font-weight-bold">A propos...</p>
                <p><?=$user->getDescription() ?></p>
            <?php endif ?>
        </div>
    </div>
</div>

