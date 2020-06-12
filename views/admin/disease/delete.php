<?php

use App\Attachment\EntityAttachment;
use App\Auth;
use App\Connection;
use App\Table\DiseaseTable;

Auth::check();

$pdo = Connection::getPDO();

$table = new DiseaseTable($pdo);
$disease = $table->find($params['id']);
EntityAttachment::detach($disease);
$table->delete($params['id']);
header('Location:' . $router->url('admin_diseases') . '?delete=1');