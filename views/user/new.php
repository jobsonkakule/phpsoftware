<?php

use App\Hydrator;
use App\HTML\Form;
use App\Connection;
use App\Entity\User;
use App\Table\UserTable;
use App\Validators\UserValidator;

$pdo = Connection::getPDO();
$errors = [];
/** @var User */
$user = new User();
// $user->setCreatedAt(date('Y-m-d H:i:s'));

if(!empty($_POST)) {
    $userTable = new UserTable($pdo);
    $data = $_POST;
    $v = new UserValidator($data, $userTable, $user->getId());
    Hydrator::hydrate($user, $data, ['username']);
    if ($v->validate()) {
        Hydrator::hydrate($user, $data, ['password']);
        $pdo->beginTransaction();
        $userTable->createUser($user);
        $pdo->commit();
        header('Location: ' . $router->url('login') . '?created=1');
        exit();
    } else {
        $errors = $v->errors();
    }
}
$form = new Form($user, $errors);

?>
<?php if(!empty($errors)): ?>
    <div class="alert alert-danger">
        Votre compte n'a pas été enregistré, corrigez les erreurs...
    </div>
<?php endif ?>
<div class="container container-top">
    <h1 class="text-center">Créer un compte</h1>
    <hr>
    <form action="" method="POST">
        <?= $form->input('username', 'Nom d\'utilisateur') ?>
        <?= $form->input('password', 'Mot de passe', 'password') ?>
        <?= $form->input('confirm', 'Confirmer le mot de passe', 'password') ?>
        <button class="btn btn-primary">
            S'inscrire
        </button>
    </form>
</div>