<form action="" method="POST">
    <?= $form->input('name', 'Titre') ?>
    <button class="btn btn-primary">
        <?php if ($item->getId() !== null): ?>
            Modifier
        <?php else: ?>
            Enregistrer
        <?php endif ?> 
    </button>
</form>