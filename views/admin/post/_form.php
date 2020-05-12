<form action="" method="POST" enctype="multipart/form-data">
    <?= $form->input('name', 'Titre') ?>
    <?= $form->input('slug', 'Url') ?>
    <div class="row">
        <div class="col-md-9">
            <?= $form->file('image', 'Image à la une') ?>
        </div>
        <div class="col-md-3">
            <?php if($post->getImage()): ?>
                <img src="<?= $post->getImageURL('thumb') ?>" alt="" style="width: 100%;">
            <?php endif ?>
        </div>
    </div>
    <?= $form->select('categories_ids', 'Catégories', $categories) ?>
    <?= $form->textarea('content', 'Contenu') ?>
    <?= $form->input('created_at', 'Date de création') ?>
    
    <button class="btn btn-primary">
        <?php if ($post->getId() !== null): ?>
            Modifier
        <?php else: ?>
            Enregistrer
        <?php endif ?> 
    </button>
</form>