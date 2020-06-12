<?php

use App\Auth;
use App\Hydrator;
use App\HTML\Form;
use App\Connection;
use App\Entity\User;
use App\Table\UserTable;
use App\Attachment\EntityAttachment;
use App\Validators\UserUpdateValidator;

Auth::checkUser();
$pdo = Connection::getPDO();
$userTable = new UserTable($pdo);

/** @var User */
$user = $userTable->find($_SESSION['auth']);

$errors = [];
$success = false;

// $user->setCreatedAt(date('Y-m-d H:i:s'));

if(!empty($_POST)) {
    $disconnect = false;
    $data = array_merge($_POST, $_FILES);
    $v = new UserUpdateValidator($data, $userTable, $user->getId());
    Hydrator::hydrate($user, $data, ['username', 'email', 'pseudo', 'description', 'image']);
    if ($v->validate()) {
        if (!empty($data['password'])) {
            Hydrator::hydrate($user, $data, ['password']);
            $disconnect = true;
        }
        $pdo->beginTransaction();
        EntityAttachment::upload($user, [225, 480], true);
        $userTable->updateUser($user);
        $pdo->commit();
        if ($user->getImage()) {
            $_SESSION['avatar'] = $user->getImageURL('thumb');
        }
        if ($disconnect) {
            header('Location: ' . $router->url('logout') . '?disconnect=1');
            exit();
        } else {
            header('Location: ' . $router->url('user', ['id' => $_SESSION['auth']]) . '?updated=1');
            exit();
        }
    } else {
        $errors = $v->errors();
    }
}
$form = new Form($user, $errors);

?>
<div class="container container-top">
    <?php if(!empty($errors)): ?>
        <div class="alert alert-danger">
            Votre compte n'a pas été modifié, corrigez les erreurs...
        </div>
    <?php endif ?>
    <h1 class="text-center">Mettre à jour votre compte</h1>
    <hr>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <?= $form->input('username', 'Nom d\'utilisateur') ?>
                <?= $form->input('email', 'Email', 'email', false) ?>
            </div>
            <div class="col-md-6">
                <?= $form->input('pseudo', 'Votre nom', 'text', false) ?>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->file('image', 'Avatar') ?>
                    </div>
                    <div class="col-md-6">
                        <?php if($user->getImage()): ?>
                            <img src="<?= $user->getImageURL('thumb') ?>" alt="" style="width: 100%;">
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
        <?= $form->textarea('description', 'Description', false) ?>
        <br>
        <h4 class="font-weight-normal">Veuillez laisser vide les champs ci-dessous si vons ne voulez pas changer vos informations...</h4>
        <br>
        <div class="row">
            <div class="col-md-6">
                <?= $form->input('password', 'Mot de passe', 'password', false) ?>
            </div>
            <div class="col-md-6">
                <?= $form->input('confirm', 'Confirmer le mot de passe', 'password', false) ?>
            </div>
        </div>
        <button class="btn btn-primary">
            S'inscrire
        </button>
    </form>
</div>