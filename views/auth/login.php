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
            if (password_verify($_POST['password'], $u->getHashPassword())) {
                // session_start();
                $_SESSION['auth'] = $u->getId();
                $_SESSION['role'] = $u->getRole();
                if ($u->getImage()) {
                    $_SESSION['avatar'] = $u->getImageURL('thumb');
                }
                header('Location: ' . $router->url('user', ['id' => $u->getId()]) . '?connected=1');
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
    <?php if(!empty($errors)): ?>
        <div class="alert alert-danger">
            Erreur de cnnexion, veuillez entrer les bonnes informations...
        </div>
    <?php endif ?>
    <?php if (isset($_GET['forbidden'])): ?>
        <div class="alert alert-danger">
            Vous ne pouvez pas accéder à cette page, veuillez vous connecter
        </div>
    <?php endif ?>
    <?php if (isset($_GET['created'])): ?>
        <div class="alert alert-success">
            Votre compte a été créé avec succès, veuillez vous connecter
        </div>
    <?php endif ?>
    <?php if (isset($_GET['disconnect'])): ?>
        <div class="alert alert-success">
            Vous avez modifié votre mot de passe avec succès, veuillez vous connecter de nouveau...
        </div>
    <?php endif ?>
    <form action="<?= $router->url('login') ?>" method="POST">
        <?= $form->input('username', "Nom d'utilisateur") ?>
        <?= $form->input('password', "Mot de passe", "password") ?>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
</div>