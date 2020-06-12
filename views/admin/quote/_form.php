<form action="" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6">
            <?= $form->input('name', 'Auteur') ?>
        </div>
        <div class="col-md-6">
            <?= $form->file('image', 'Image à la une') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <?= $form->textarea('content', 'Contenu') ?>
        </div>
        <div class="col-md-3">
            <?php if($quote->getImage()): ?>
                <img src="<?= $quote->getImageURL('thumb') ?>" alt="" style="width: 100%;">
            <?php endif ?>
        </div>
    </div>
    
    <button class="btn btn-primary">
        <?php if ($quote->getId() !== null): ?>
            Modifier
        <?php else: ?>
            Enregistrer
        <?php endif ?> 
    </button>
</form>