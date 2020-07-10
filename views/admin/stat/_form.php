<form action="" method="post">
    <div class="row">
        <div class="col-md-6">
            <?= $form->select('city_id', 'Ville', $cities, false, true) ?>
        </div>
        <div class="col-md-6">
            <?= $form->select('disease_id', 'Epidémie', $diseases, false, true) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->input('cases', 'Nombre de nouveaux cas', 'number') ?>
        </div>
        <div class="col-md-4">
            <?= $form->input('deaths', 'Nombre de nouveaux décès', 'number') ?>
        </div>
        <div class="col-md-4">
            <?= $form->input('recoveries', 'Nombre de nouveaux guéris', 'number') ?>
        </div>
    </div>
    <br>
    <button class="btn btn-primary">
        <?php if ($stat->getId() !== null): ?>
            Modifier
        <?php else: ?>
            Enregistrer
        <?php endif ?> 
    </button>
</form>