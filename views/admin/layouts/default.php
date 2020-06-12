<!DOCTYPE html>
<html lang="fr" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title ?? 'Sanitas | Accueil') ?></title>
    <link rel="stylesheet" href="/css/style.css">
    <link href="/css/fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.5.7/flatpickr.css">
</head>
<body class="d-flex flex-column h-100">
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
            <a class ="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acutalités</a><span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a href="<?= $router->url('admin_posts') ?>" class="nav-link">Articles</a>
          </li>
          <li class="nav-item">
            <a href="<?= $router->url('admin_quotes') ?>" class="nav-link">Citations</a>
          </li>
          <?php if(isset($_SESSION['auth']) && ($_SESSION['role'] === 'Administrateur')): ?>
            <li class="nav-item">
              <a href="<?= $router->url('admin_users') ?>" class="nav-link">Utilisateurs</a>
            </li>
            <li class="nav-item">
              <a href="<?= $router->url('admin_users') ?>" class="nav-link">Catégories</a>
            </li>
          <?php endif ?>
          <li class="nav-item">
            <a href="<?= $router->url('admin_diseases') ?>" class="nav-link">Epidémies</a>
          </li>
        </ul>
        <?php if (isset($_SESSION['auth'])):?>
          <a href="<?=$router->url('user', ['id' => $_SESSION['auth']]) ?>" title="Mon compe">
            <?php if(isset($_SESSION['avatar'])): ?>
              <img src="<?= $_SESSION['avatar'] ?>" alt="<?="Amet" ?>" width="50" class="my-0 ml-3 avatar">
            <?php else: ?>
              <img src="/images/user.jpg" alt="<?="Amet" ?>" width="50" class="my-0 ml-3 avatar">
            <?php endif ?>
          </a>
        <?php endif ?>
      </div>
    </nav>
    <div class="container container-top">
        <?= $content ?>
    </div>
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
                    <?php if($_SESSION['role'] === 'Administrateur' || $_SESSION['role'] === 'editor'): ?>
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
    <script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.5.7/flatpickr.js"></script>
    <script>
      flatpickr('.datepicker', {
        enableTime: true,
        altInput: true,
        altFormat: 'j F Y, H:i',
        dateFormat: 'Y-m-d H:i:S'
      })
    </script>
</body>
</html>
