<?php

use App\Connection;
use App\Table\DiseaseTable;

$title = 'Les épidémies | Sanitas';

$pdo = Connection::getPDO();

$table = new DiseaseTable($pdo);
$diseases = $table->all();

?>
<div class="container container-top">
    <h1 class="text-center">Toutes les épidémies</h1>
    <hr>
    <div class="row">
        <?php foreach($diseases as $disease): ?>
            <div class="col-md-3">
                <?php require 'card.php'; ?>
            </div>
        <?php endforeach ?>
    </div>
</div>