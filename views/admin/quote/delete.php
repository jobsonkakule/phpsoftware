<?php

use App\Attachment\EntityAttachment;
use App\Auth;
use App\Connection;
use App\Table\QuoteTable;

Auth::check();

$pdo = Connection::getPDO();

$table = new QuoteTable($pdo);
$quote = $table->find($params['id']);
EntityAttachment::detach($quote);
$table->delete($params['id']);
header('Location:' . $router->url('admin_quotes') . '?delete=1');