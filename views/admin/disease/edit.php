<?php

use App\Auth;
use App\Hydrator;
use App\HTML\Form;
use App\Connection;
use App\Entity\Disease;
use App\Table\DiseaseTable;
use App\Attachment\EntityAttachment;
use App\Validators\DiseaseValidator;

Auth::check();

$pdo = Connection::getPDO();
$diseaseTable = new DiseaseTable($pdo);
/** @var Disease */
$disease = $diseaseTable->find($params['id']);
$success = false;
$errors = [];

if(!empty($_POST)) {
    $states = ['En cours', 'Passé', 'En attente'];
    $flags = ['Minimal', 'Moyen', 'Maximal'];
    $data = array_merge($_POST, $_FILES);
    $v = new DiseaseValidator($data, $diseaseTable, $disease->getId(), $states, $flags);
    Hydrator::hydrate($disease, $data, ['name', 'state', 'flag', 'description', 'first_at', 'image']);
    if ($v->validate()) {
        $pdo->beginTransaction();
        EntityAttachment::upload($disease);
        $diseaseTable->updateDisease($disease);
        $pdo->commit();
        $success = true;
        header('Location: ' . $router->url('admin_diseases') . '?created=1') ;
        exit();
    } else {
        $errors = $v->errors();
    }
}
$form = new Form($disease, $errors);

?>
<?php if($success): ?>
    <div class="alert alert-success">
        L'épidémie a bien été modifié
    </div>
<?php endif ?>
<?php if(isset($_GET['created'])): ?>
    <div class="alert alert-success">
        L'épidémie a bien été créé
    </div>
<?php endif ?>
<?php if(!empty($errors)): ?>
    <div class="alert alert-danger">
        L'épidémie n'a pas été modifié, corrigez les erreurs
    </div>
<?php endif ?>

<h1>Editer l'épidémie <?= $params['id'] ?></h1>
<?php require('_form.php'); ?>