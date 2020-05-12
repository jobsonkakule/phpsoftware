<?php

use App\Auth;
use App\Connection;
use App\Entity\Category;
use App\HTML\Form;
use App\Hydrator;
use App\Table\CategoryTable;
use App\Validators\CategoryValidator;

Auth::check();
$pdo = Connection::getPDO();
$table = new CategoryTable($pdo);
/** @var Category */
$item = $table->find($params['id']);
$success = false;
$errors = [];
$fields = ['name', 'slug'];

if(!empty($_POST)) {
    $v = new CategoryValidator($_POST, $table, $item->getId());
    Hydrator::hydrate($item, $_POST, $fields);
    if ($v->validate()) {
        $table->update([
            'name' => $item->getName(),
            'slug' => $item->getSlug()
        ], $item->getId());
        $success = true;
    } else {
        $errors = $v->errors();
    }
}
$form = new Form($item, $errors);

?>
<?php if($success): ?>
    <div class="alert alert-success">
        La catégorie a bien été modifiée
    </div>
<?php endif ?>
<?php if(isset($_GET['created'])): ?>
    <div class="alert alert-success">
        La catégorie a bien été créée
    </div>
<?php endif ?>
<?php if(!empty($errors)): ?>
    <div class="alert alert-danger">
        La catégorie n'a pas été modifiée, corrigez les erreurs
    </div>
<?php endif ?>

<h1>Editer la catégorie <?= e($item->getName()) ?></h1>
<?php require('_form.php'); ?>