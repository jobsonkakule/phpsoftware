<?php

use App\Auth;
use App\Hydrator;
use App\HTML\Form;
use App\Connection;
use App\Entity\Disease;
use App\Table\DiseaseTable;
use App\Validators\DiseaseValidator;
use App\Attachment\EntityAttachment;

Auth::check();
$pdo = Connection::getPDO();
$errors = [];
/** @var Disease */
$disease = new Disease();
// $disease->setCreatedAt(date('Y-m-d H:i:s'));

if(!empty($_POST)) {
    $states = ['En cours', 'Passé', 'En attente'];
    $flags = ['Minimal', 'Moyen', 'Maximal'];
    $diseaseTable = new DiseaseTable($pdo);
    $data = array_merge($_POST, $_FILES);
    $v = new DiseaseValidator($data, $diseaseTable, $disease->getId(), $states, $flags);
    Hydrator::hydrate($disease, $data, ['name', 'state', 'flag', 'description', 'first_at', 'image']);
    if ($v->validate()) {
        $pdo->beginTransaction();
        EntityAttachment::upload($disease);
        $diseaseTable->createDisease($disease);
        $pdo->commit();
        header('Location: ' . $router->url('admin_diseases') . '?created=1') ;
        exit();
    } else {
        $errors = $v->errors();
    }
}
$form = new Form($disease, $errors);

?>
<?php if(!empty($errors)): ?>
    <div class="alert alert-danger">
        L'article n'a pas été enregistré, corrigez les erreurs
    </div>
<?php endif ?>

<h1>Créer un article</h1>
<?php require('_form.php'); ?>