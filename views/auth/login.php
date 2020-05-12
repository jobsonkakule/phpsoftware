<?php

use App\Connection;
use App\Entity\User;
use App\HTML\Form;
use App\Table\Exception\NotFoundException;
use App\Table\UserTable;

$errors = [];
$user = new User();

if (!empty($_POST)) {
    $user->setUsername($_POST['username']);
    $errors['password'] = 'Identifiant ou mot de passe incorrect';

    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $pdo = Connection::getPDO();
        $table = new UserTable($pdo);
        try {
            $u = $table->findByUsername($_POST['username']);
            if (password_verify($_POST['password'], $u->getPassword())) {
                session_start();
                $_SESSION['auth'] = $u->getId();
                header('Location: ' . $router->url('admin_posts'));
                exit();
            }
        } catch (NotFoundException $e) {

        }
    }
}

$form = new Form($user, $errors);
?>
<div class="container container-top">
    <h1>Se connecter</h1>
    <?php if (isset($_GET['forbidden'])): ?>
        <div class="alert alert-danger">
            Vous ne pouvez pas accéder à cette page
        </div>
    <?php endif ?>
    <form action="<?= $router->url('login') ?>" method="POST">
        <?= $form->input('username', "Nom d'utilisateur") ?>
        <?= $form->input('password', "Mot de passe", "password") ?>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
</div>