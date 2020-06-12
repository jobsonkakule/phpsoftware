<?php

use App\Attachment\EntityAttachment;
use App\Auth;
use App\Connection;
use App\Table\UserTable;

Auth::check();
Auth::restrict();

$pdo = Connection::getPDO();

$table = new UserTable($pdo);
$user = $table->find($params['id']);
EntityAttachment::detach($user);
$table->delete($params['id']);
header('Location:' . $router->url('admin_users') . '?delete=1');