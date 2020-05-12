<?php

use App\Connection;
use App\Table\PostTable;

$title = 'Le Blog | Sanitas';

$pdo = Connection::getPDO();

$table = new PostTable($pdo);
$posts = $table->all(3);

$link = $router->url('home');
?>

    <main role="main">
    
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1 class="display-3 text-light">Un Congo sain et sauf</h1>
        <p class=" text-light">This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
        <br>
        <p><a class="btn btn-danger btn-lg" href="#" role="button">Aller plus loin &raquo;</a></p>
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
      <h2 class="text-danger">Catégories</h2>
      
      <div class="row">
        <div class="col-md-3">
          <div class="card mb-4 box-shadow">
            <div class="card-header">
              <h4 class="my-0 font-weight-normal">Urgent</h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title">Covid-19 <small class="text-muted"></small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>Depuis 7 mois</li>
                <li>1 120 cas confirmés dont 720 morts</li>
                <li>5 provinces touchées</li>
                <li>Alerte rouge</li>
              </ul>
              <button type="button" class="btn btn-lg btn-block btn-danger">Plus d'infos</button>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card mb-4 box-shadow">
            <div class="card-header">
              <h4 class="my-0 font-weight-normal">Urgent</h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title">Covid-19 <small class="text-muted"></small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>Depuis 7 mois</li>
                <li>1 120 cas confirmés dont 720 morts</li>
                <li>5 provinces touchées</li>
                <li>Alerte rouge</li>
              </ul>
              <button type="button" class="btn btn-lg btn-block btn-outline-danger">Plus d'infos</button>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card mb-4 box-shadow">
            <div class="card-header">
              <h4 class="my-0 font-weight-normal">Urgent</h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title">Covid-19 <small class="text-muted"></small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>Depuis 7 mois</li>
                <li>1 120 cas confirmés dont 720 morts</li>
                <li>5 provinces touchées</li>
                <li>Alerte rouge</li>
              </ul>
              <button type="button" class="btn btn-lg btn-block btn-outline-danger">Plus d'infos</button>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card mb-4 box-shadow">
            <div class="card-header">
              <h4 class="my-0 font-weight-normal">Urgent</h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title">Covid-19 <small class="text-muted"></small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>Depuis 7 mois</li>
                <li>1 120 cas confirmés dont 720 morts</li>
                <li>5 provinces touchées</li>
                <li>Alerte rouge</li>
              </ul>
              <button type="button" class="btn btn-lg btn-block btn-outline-danger">Plus d'infos</button>
            </div>
          </div>
        </div>
      </div>

      
  
    </div> <!-- /container -->
    <div class="container marketing">
      <h2 class="text-danger">Ensemble, luttons contre le Covid-19</h2>
      <br>
      
      <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item h-auto active">
            <div class="row featurette">
              <div class="col-md-7">
                <h2 class="featurette-heading">Tous nous sommes concernés. <span class="text-muted">Jack Dorsey</span></h2>
                <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
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
                <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
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
                <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
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