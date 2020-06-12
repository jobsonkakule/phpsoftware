<?php

use App\Auth;
use App\Hydrator;
use App\HTML\Form;
use App\Connection;
use App\Entity\Post;
use App\Table\PostTable;
use App\Table\CategoryTable;
use App\Validators\PostValidator;
use App\Attachment\EntityAttachment;

Auth::check();
$pdo = Connection::getPDO();
$errors = [];
$categoryTable = new CategoryTable($pdo);
$categories = $categoryTable->list();
/** @var Post */
$post = new Post();
// $post->setCreatedAt(date('Y-m-d H:i:s'));

if(!empty($_POST)) {
    $postTable = new PostTable($pdo);
    $data = array_merge($_POST, $_FILES);
    $v = new PostValidator($data, $postTable, $post->getId(), $categories);
    Hydrator::hydrate($post, $data, ['name', 'content', 'created_at', 'image']);
    if ($v->validate()) {
        $pdo->beginTransaction();
        EntityAttachment::upload($post);
        $postTable->createPost($post);
        $postTable->attachCategories($post->getId(), $_POST['categories_ids']);
        $pdo->commit();
        header('Location: ' . $router->url('admin_post', ['id' => $post->getId()]) . '?created=1') ;
        exit();
    } else {
        $errors = $v->errors();
    }
}
$form = new Form($post, $errors);

?>
<?php if(!empty($errors)): ?>
    <div class="alert alert-danger">
        L'article n'a pas été enregistré, corrigez les erreurs
    </div>
<?php endif ?>

<h1>Créer un article</h1>
<?php require('_form.php'); ?>