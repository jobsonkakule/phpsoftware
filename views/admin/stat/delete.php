<?php

use App\Auth;
use App\Connection;
use App\Table\StatTable;

Auth::check();

$pdo = Connection::getPDO();

$table = new StatTable($pdo);
$table->delete($params['id']);
header('Location:' . $router->url('admin_stats') . '?delete=1');