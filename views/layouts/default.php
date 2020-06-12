<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title><?= e($title ?? 'Sanitas | Accueil') ?></title>

    <!-- Bootstrap core CSS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/css/style.css">
    <link href="/css/fontawesome/css/all.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-danger pb-0 pt-0">
      <a class="navbar-brand" href="<?=$router->url('home')?>">
        <img src="/images/logo.png" alt="" width="60">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item dropdown active">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acutalités</a><span class="sr-only">(current)</span></a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Forum</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Statistiques</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">A propos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
        <div class="social">
          <a href=""><i class="fab fa-facebook-f"></i></a>
          <a href="" class="pl-3"><i class="fab fa-twitter"></i></a>
          <a href="" class="pl-3"><i class="fab fa-youtube"></i></a>
        </div>
        <?php if (isset($_SESSION['auth'])):?>
          <a href="<?=$router->url('user', ['id' => $_SESSION['auth']]) ?>" title="Mon compe">
            <?php if(isset($_SESSION['avatar'])): ?>
              <img src="<?= $_SESSION['avatar'] ?>" alt="<?="Amet" ?>" width="50" class="my-0 ml-3 avatar">
            <?php else: ?>
              <img src="/images/user.jpg" alt="<?="Amet" ?>" width="50" class="my-0 ml-3 avatar">
            <?php endif ?>
          </a>
        <?php endif ?>
        <!--<form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
        </form>-->
      </div>
    </nav>
    <?= $content ?>
    
    <?php if(defined('DEBUG_TIME')): ?>
        Page générée en <?= round(1000 * (microtime(true) - DEBUG_TIME)) ?>ms</div>
    <?php endif ?>

    <footer class="blog-footer mt-4 bg-dark">
        <div class="container">
            <div class="row">
            <div class="col-12 col-md">
                <div class="mb-4">
                    <img src="/images/logo.png" alt="" width="100">
                </div>
                <div>
                  
                  <?php if (isset($_SESSION['auth'])):?>
                    <form action="<?= $router->url('logout') ?>" method="post" style="display: inline;">
                        <button type="submit" class="btn btn-danger">Se déconnecter</button>
                    </form>
                    <?php if($_SESSION['role'] === 'Administrateur' || $_SESSION['role'] === 'Editeur'): ?>
                      <div style="display: inline;">
                          <a href="<?= $router->url('admin') ?>" class="btn btn-secondary">Administration</a>
                      </div>
                    <?php endif ?>
                  <?php else: ?>
                      <a href="<?=$router->url('login') ?>" class="btn btn-secondary">Se connecter</a>
                      <a href="<?=$router->url('signup') ?>" class="btn btn-danger">S'inscrire</a>
                  <?php endif ?>
                </div>
            </div>
            <div class="col-12 col-md">
                <h5>A propos</h5>
                <ul class="list-unstyled text-small">
                <li><a class="text-muted" href="#">Cool stuff</a></li>
                <li><a class="text-muted" href="#">Random feature</a></li>
                <li><a class="text-muted" href="#">Team feature</a></li>
                <li><a class="text-muted" href="#">Stuff for developers</a></li>
                <li><a class="text-muted" href="#">Another one</a></li>
                <li><a class="text-muted" href="#">Last time</a></li>
                </ul>
            </div>
            <div class="col-12 col-md">
                <h5>Contacts</h5>
                <ul class="list-unstyled text-small">
                <li><a class="text-muted" href="#">Resource</a></li>
                <li><a class="text-muted" href="#">Resource name</a></li>
                <li><a class="text-muted" href="#">Another resource</a></li>
                <li><a class="text-muted" href="#">Final resource</a></li>
                </ul>
            </div>
            </div>
        </div>
        <br>
        <p class="text-center">
            <small class="d-block mb-3 text-muted">Sanitas, &copy; 2017-2018</small>
        </p>
    </footer>  
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <!-- <script src="/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/timeago.js/3.0.2/timeago.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/timeago.js/3.0.2/timeago.locales.min.js"></script>
    <script>
        timeago().render(document.querySelectorAll('.timeago'), 'fr')
    </script>
</body>
</html>

