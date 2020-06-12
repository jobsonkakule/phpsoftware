<?php

use App\Attachment\EntityAttachment;
use App\Auth;
use App\Hydrator;
use App\HTML\Form;
use App\Connection;
use App\Entity\Post;
use App\Table\CategoryTable;
use App\Table\PostTable;
use App\Validators\PostValidator;

Auth::check();

$pdo = Connection::getPDO();
$postTable = new PostTable($pdo);
$categoryTable = new CategoryTable($pdo);
$categories = $categoryTable->list();
/** @var Post */
$post = $postTable->find($params['id']);
$categoryTable->hydratePosts([$post]);
$success = false;
$errors = [];

if(!empty($_POST)) {
    $data = array_merge($_POST, $_FILES);
    $v = new PostValidator($data, $postTable, $post->getId(), $categories);
    Hydrator::hydrate($post, $data, ['name', 'content', 'image']);
    if ($v->validate()) {
        $pdo->beginTransaction();
        EntityAttachment::upload($post);
        $postTable->updatePost($post);
        $postTable->attachCategories($post->getId(), $_POST['categories_ids']);
        $pdo->commit();
        $categoryTable->hydratePosts([$post]);
        $success = true;
    } else {
        $errors = $v->errors();
    }
}
$form = new Form($post, $errors);

?>
<?php if($success): ?>
    <div class="alert alert-success">
        L'article a bien été modifié
    </div>
<?php endif ?>
<?php if(isset($_GET['created'])): ?>
    <div class="alert alert-success">
        L'article a bien été créé
    </div>
<?php endif ?>
<?php if(!empty($errors)): ?>
    <div class="alert alert-danger">
        L'article n'a pas été modifié, corrigez les erreurs
    </div>
<?php endif ?>

<h1>Editer l'article <?= $params['id'] ?></h1>
<?php require('_form.php'); ?>