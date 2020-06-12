<?php

use App\Auth;
use App\Hydrator;
use App\HTML\Form;
use App\Connection;
use App\Entity\Category;
use App\Table\CategoryTable;
use App\Validators\CategoryValidator;

Auth::check();
Auth::restrict();
$errors = [];
/** @var Category */
$item = new Category();

if(!empty($_POST)) {
    $pdo = Connection::getPDO();
    $table = new CategoryTable($pdo);
    $v = new CategoryValidator($_POST, $table);
    Hydrator::hydrate($item, $_POST, ['name']);
    if ($v->validate()) {
        $table->create([
            'name' => $item->getName(),
            'slug' => $item->getSlug()
        ]);
        header('Location: ' . $router->url('admin_categories') . '?created=1') ;
        exit();
    } else {
        $errors = $v->errors();
    }
}
$form = new Form($item, $errors);

?>
<?php if(!empty($errors)): ?>
    <div class="alert alert-danger">
        La catégorie n'a pas été enregistrée, corrigez les erreurs
    </div>
<?php endif ?>

<h1>Créer une catégorie</h1>
<?php require('_form.php'); ?>