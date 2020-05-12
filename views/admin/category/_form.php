<form action="" method="POST">
    <?= $form->input('name', 'Titre') ?>
    <?= $form->input('slug', 'Url') ?>
    <button class="btn btn-primary">
        <?php if ($item->getId() !== null): ?>
            Modifier
        <?php else: ?>
            Enregistrer
        <?php endif ?> 
    </button>
</form>