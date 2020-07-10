<?php

use App\Auth;
use App\Hydrator;
use App\HTML\Form;
use App\Connection;
use App\Entity\Stat;
use App\Table\CityTable;
use App\Table\StatTable;
use App\Table\DiseaseTable;
use App\Validators\StatValidator;

Auth::check();

Auth::check();
$pdo = Connection::getPDO();
/** @var StatTable */
$table = new StatTable($pdo);
$stat = $table->find($params['id']);

$cities = (new CityTable($pdo))->list();
$diseases = (new DiseaseTable($pdo))->list();
$errors = [];
$success = false;

if(!empty($_POST)) {
    $data = $_POST;
    $v = new StatValidator($data, $cities, $diseases);
    Hydrator::hydrate($stat, $data, ['cases', 'deaths', 'recoveries', 'city_id', 'disease_id']);
    if ($v->validate()) {
        $pdo->beginTransaction();
        $table->updateStat($stat);
        $pdo->commit();
        $success = true;
        header('Location: ' . $router->url('admin_stats') . '?created=1') ;
        exit();
    } else {
        $errors = $v->errors();
    }
}
$form = new Form($stat, $errors);

?>
<?php if($success): ?>
    <div class="alert alert-success">
        L'enregistrement a bien été modifié
    </div>
<?php endif ?>
<?php if(isset($_GET['created'])): ?>
    <div class="alert alert-success">
        L'enregistrement a bien été ajouté
    </div>
<?php endif ?>
<?php if(!empty($errors)): ?>
    <div class="alert alert-danger">
        L'enregistrement n'a pas été modifié, corrigez les erreurs
    </div>
<?php endif ?>

<h1>Editer l'enregistrement #<?= $params['id'] ?></h1>
<?php require('_form.php'); ?>