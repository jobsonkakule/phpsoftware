<form action="" method="post" enctype="multipart/form-data">
    <?= $form->input('name', 'Titre') ?>
    <?= $form->textarea('description', 'Description') ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->input('first_at', 'Apparu depuis', 'text', true, false, ['datepicker']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->select('state', 'Status', ['En cours', 'Passé', 'En attente']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->select('flag', 'Niveau d\'alerte', ['Minimal', 'Moyen', 'Maximal']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->file('image', 'Image à la une') ?>
        </div>
        <div class="col-md-3">
            <?php if($disease->getImage()): ?>
                <img src="<?= $disease->getImageURL('thumb') ?>" alt="" style="width: 100%;">
            <?php endif ?>
        </div>
    </div>
    <br>
    <button class="btn btn-primary">
        <?php if ($disease->getId() !== null): ?>
            Modifier
        <?php else: ?>
            Enregistrer
        <?php endif ?> 
    </button>
</form>