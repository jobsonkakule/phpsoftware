<?php

use App\Connection;
use App\Table\DiseaseTable;
use App\Table\PostTable;

$pdo = Connection::getPDO();

$postTable = new PostTable($pdo);
$diseaseTable = new DiseaseTable($pdo);
$posts = $postTable->all(3);
$diseases = $diseaseTable->all(4);

$link = $router->url('home');
?>

    <main role="main">
    
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1 class="display-3 text-light">Un Congo sain et sauf</h1>
        <p class=" text-light">This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
        <br>
        <p><a class="btn btn-danger btn-lg" href="<?=$router->url('posts_index') ?>" role="button">Plus d'infos &raquo;</a></p>
      </div>
    </div>
  
    <div class="container">
      <div class="d-flex justify-content-between">
        <h2 class="text-danger">A la une...</h2>
        <p class="mb-0"><a class="btn btn-danger btn-lg" href="#" role="button">Poser une question &raquo;</a></p>
      </div>
      <div class="row mt-2">
        <?php foreach ($posts as $post): ?>
            <div class="col-md-4">
                <?php require 'post/card.php' ?>
            </div>
        <?php endforeach ?>
      </div>
      <hr>
      <h2 class="text-danger">Aperçu</h2>
      
      <div class="row">
        <?php foreach ($diseases as $disease): ?>
            <div class="col-md-3">
                <?php require 'disease/card.php' ?>
            </div>
        <?php endforeach ?>
      </div>
      <div class="d-flex flex-row-reverse">
        <a class="btn btn-danger btn-lg" href="<?=$router->url('diseases_index')?>" role="button">Toutes les épidémies &raquo;</a>
      </div>
    </div> <!-- /container -->
    <br>
    <div class="container marketing">
      <h2 class="text-danger">Ensemble, luttons contre la Covid-19</h2>
      <br>
      
      <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item h-auto active">
            <div class="row featurette">
              <div class="col-md-7">
                <h2 class="featurette-heading">Tous nous sommes concernés. - <span class="text-muted font-italic">Jack Dorsey</span></h2>
              </div>
              <div class="col-md-5">
                <img class="featurette-image img-fluid mx-auto" src="images/feat.jpg" alt="Generic placeholder image">
              </div>
            </div>
          </div>
          <div class="carousel-item h-auto">
            <div class="row featurette">
              <div class="col-md-7">
                <h2 class="featurette-heading">Tous nous sommes concernés. <span class="text-muted">Jack Dorsey</span></h2>
              </div>
              <div class="col-md-5">
                <img class="featurette-image img-fluid mx-auto" src="images/feat.jpg" alt="Generic placeholder image">
              </div>
            </div>
          
          </div>
          <div class="carousel-item h-auto">
            <div class="row featurette">
              <div class="col-md-7">
                <h2 class="featurette-heading">Tous nous sommes concernés. <span class="text-muted">Jack Dorsey</span></h2>
              </div>
              <div class="col-md-5">
                <img class="featurette-image img-fluid mx-auto" src="images/feat.jpg" alt="Generic placeholder image">
              </div>
            </div>
          
          </div>
        </div>
      </div>
    </div>
  </main>