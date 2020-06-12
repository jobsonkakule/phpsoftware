<?php

use App\Attachment\EntityAttachment;
use App\Auth;
use App\Connection;
use App\Table\PostTable;

Auth::check();

$pdo = Connection::getPDO();

$table = new PostTable($pdo);
$post = $table->find($params['id']);
EntityAttachment::detach($post);
$table->delete($params['id']);
header('Location:' . $router->url('admin_posts') . '?delete=1');