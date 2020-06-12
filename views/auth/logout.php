<?php
// session_start();
session_destroy();
if (isset($_GET['disconnect'])) {
    header('Location: ' . $router->url('login') . '?disconnect=1');
    exit();
}
header('Location: ' . $router->url('home'));
exit();