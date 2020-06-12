<?php

use App\Auth;
use App\Router;
use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;

require '../vendor/autoload.php';

define ('DEBUG_TIME', microtime(true));

$whoops = new Run;
$whoops->pushHandler(new PrettyPageHandler);
$whoops->register();

define('UPLOAD_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'uploads');


if (isset($_GET['page']) && $_GET['page'] === '1') {
    // header('Location: ' . $router->url('home'));
    // http_response_code(301);
    // exit();
    $uri = explode('?', $_SERVER['REQUEST_URI'])[0];
    $get = $_GET;
    unset($get['page']);
    $query = http_build_query($get);
    if (!empty($query)) {
        $uri = $uri . '?' . $query;
    }
    http_response_code(301);
    header('Location: ' . $uri);
    exit();

}

$router = new Router(dirname(__DIR__) . '/views');
Auth::startSession();
$router
    ->get('/', 'home', 'home')
    ->get('/blog', 'post/index', 'posts_index')
    ->get('/blog/category/[*:slug]-[i:id]', 'category/show', 'category')
    ->get('/blog/[*:slug]-[i:id]', 'post/show', 'post')
    ->get('/disease', 'disease/index', 'diseases_index')
    ->get('/disease/[*:slug]-[i:id]', 'disease/show', 'disease')
    ->get('/profil/[i:id]', 'user/show', 'user')
    ->match('/profil', 'user/update', 'user_update')
    ->match('/login', 'auth/login', 'login')
    ->match('/logout', 'auth/logout', 'logout')
    // Admin
    ->get('/admin', 'admin/index', 'admin')

    // User
    ->match('/signup', 'user/new', 'signup')
    ->get('/admin/users', 'admin/user/index', 'admin_users')
    ->match('/admin/user/[i:id]', 'admin/user/edit', 'admin_user')
    ->post('/admin/user/[i:id]/delete', 'admin/user/delete', 'admin_user_delete')

    // Post
    ->get('/admin/posts', 'admin/post/index', 'admin_posts')
    ->match('/admin/post/[i:id]', 'admin/post/edit', 'admin_post')
    ->post('/admin/post/[i:id]/delete', 'admin/post/delete', 'admin_post_delete')
    ->match('/admin/post/new', 'admin/post/new', 'admin_post_new')
    
    // Quote
    ->get('/admin/quotes', 'admin/quote/index', 'admin_quotes')
    ->match('/admin/quote/[i:id]', 'admin/quote/edit', 'admin_quote')
    ->post('/admin/quote/[i:id]/delete', 'admin/quote/delete', 'admin_quote_delete')
    ->match('/admin/quote/new', 'admin/quote/new', 'admin_quote_new')

    // Category
    ->get('/admin/categories', 'admin/category/index', 'admin_categories')
    ->match('/admin/category/[i:id]', 'admin/category/edit', 'admin_category')
    ->post('/admin/category/[i:id]/delete', 'admin/category/delete', 'admin_category_delete')
    ->match('/admin/category/new', 'admin/category/new', 'admin_category_new')
    // Disease
    ->get('/admin/diseases', 'admin/disease/index', 'admin_diseases')
    ->match('/admin/disease/[i:id]', 'admin/disease/edit', 'admin_disease')
    ->post('/admin/disease/[i:id]/delete', 'admin/disease/delete', 'admin_disease_delete')
    ->match('/admin/disease/new', 'admin/disease/new', 'admin_disease_new')
    
    ->run();
