<?php

use App\Attachment\EntityAttachment;
use App\Auth;
use App\Hydrator;
use App\HTML\Form;
use App\Connection;
use App\Entity\Quote;
use App\Table\QuoteTable;
use App\Validators\QuoteValidator;

Auth::check();

$pdo = Connection::getPDO();
$table = new QuoteTable($pdo);
/** @var Quote */
$quote = $table->find($params['id']);
$success = false;
$errors = [];

if(!empty($_POST)) {
    $data = array_merge($_POST, $_FILES);
    $v = new QuoteValidator($data, $table, $quote->getId());
    Hydrator::hydrate($quote, $data, ['name', 'content', 'image']);
    if ($v->validate()) {
        $pdo->beginTransaction();
        EntityAttachment::upload($quote, [450, 960]);
        $table->updateQuote($quote);
        $pdo->commit();
        $success = true;
    } else {
        $errors = $v->errors();
    }
}
$form = new Form($quote, $errors);

?>
<?php if($success): ?>
    <div class="alert alert-success">
        La citation a bien été modifiée
    </div>
<?php endif ?>
<?php if(isset($_GET['created'])): ?>
    <div class="alert alert-success">
        La citation a bien été créée
    </div>
<?php endif ?>
<?php if(!empty($errors)): ?>
    <div class="alert alert-danger">
        La citation n'a pas été modifiée, corrigez les erreurs
    </div>
<?php endif ?>

<h1>Editer la citation <?= $params['id'] ?></h1>
<?php require('_form.php'); ?>