<?php

use App\Auth;
use App\Hydrator;
use App\HTML\Form;
use App\Connection;
use App\Entity\Quote;
use App\Table\QuoteTable;
use App\Table\CategoryTable;
use App\Validators\QuoteValidator;
use App\Attachment\EntityAttachment;

Auth::check();
$pdo = Connection::getPDO();
$errors = [];
/** @var Quote */
$quote = new Quote();
// $quote->setCreatedAt(date('Y-m-d H:i:s'));

if(!empty($_POST)) {
    $quoteTable = new QuoteTable($pdo);
    $data = array_merge($_POST, $_FILES);
    $v = new QuoteValidator($data, $quoteTable, $quote->getId());
    Hydrator::hydrate($quote, $data, ['name', 'content', 'image']);
    if ($v->validate()) {
        $pdo->beginTransaction();
        EntityAttachment::upload($quote,  [450, 960]);
        $quoteTable->createQuote($quote);
        $pdo->commit();
        header('Location: ' . $router->url('admin_quote', ['id' => $quote->getId()]) . '?created=1') ;
        exit();
    } else {
        $errors = $v->errors();
    }
}
$form = new Form($quote, $errors);

?>
<?php if(!empty($errors)): ?>
    <div class="alert alert-danger">
        La citation n'a pas été enregistrée, corrigez les erreurs
    </div>
<?php endif ?>

<h1>Créer une citation</h1>
<?php require('_form.php'); ?>