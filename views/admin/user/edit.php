<?php

use App\Auth;
use App\Hydrator;
use App\HTML\Form;
use App\Connection;
use App\Entity\User;
use App\Table\UserTable;
use App\Validators\UserValidator;

Auth::check();
Auth::restrict();

$pdo = Connection::getPDO();
$userTable = new UserTable($pdo);
/** @var User */
$user = $userTable->find($params['id']);
$success = false;
$errors = [];

if(!empty($_POST)) {
    $data = array_merge($_POST);
    $v = new UserValidator($data, $userTable, $user->getId(), ['user', 'editor', 'admin']);
    Hydrator::hydrate($user, $data, ['role']);
    if ($v->validate()) {
        $pdo->beginTransaction();
        $userTable->grantUser($user);
        $pdo->commit();
        $success = true;
    } else {
        $errors = $v->errors();
    }
}
$form = new Form($user, $errors);

?>
<?php if($success): ?>
    <div class="alert alert-success">
        L'utilisateur a bien été modifié
    </div>
<?php endif ?>
<?php if(isset($_GET['created'])): ?>
    <div class="alert alert-success">
        L'utilisateur a bien été créé
    </div>
<?php endif ?>
<?php if(!empty($errors)): ?>
    <div class="alert alert-danger">
        L'utilisateur n'a pas été modifié, corrigez les erreurs
    </div>
<?php endif ?>

<h1 class="text-center">Modifier le rôle de l'utilisateur <span class="font-weight-bold"><?= $user->getPseudo() ?></span></h1>
<hr>
<?php require('_form.php'); ?>