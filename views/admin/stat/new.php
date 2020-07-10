<?php

use App\Auth;
use App\Hydrator;
use App\HTML\Form;
use App\Connection;
use App\Entity\Stat;
use App\Table\CityTable;
use App\Table\DiseaseTable;
use App\Validators\StatValidator;
use App\Table\StatTable;

Auth::check();
$pdo = Connection::getPDO();
$errors = [];
/** @var Stat */
$stat = new Stat();

$cities = (new CityTable($pdo))->list();
$diseases = (new DiseaseTable($pdo))->list();

if(!empty($_POST)) {
    $table = new StatTable($pdo);
    $data = $_POST;
    $v = new StatValidator($data, $cities, $diseases);
    Hydrator::hydrate($stat, $data, ['cases', 'deaths', 'recoveries', 'city_id', 'disease_id']);
    if ($v->validate()) {
        $pdo->beginTransaction();
        $table->createStat($stat);
        $pdo->commit();
        header('Location: ' . $router->url('admin_stats') . '?created=1') ;
        exit();
    } else {
        $errors = $v->errors();
    }
}
$form = new Form($stat, $errors);

?>
<?php if(!empty($errors)): ?>
    <div class="alert alert-danger">
        Les données n'ont pas été enregistrées, corrigez les erreurs
    </div>
<?php endif ?>

<h1>Ajouter des données</h1>
<?php require('_form.php'); ?>