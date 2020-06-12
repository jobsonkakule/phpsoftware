<form action="" method="POST">
    <div class="row">
        <div class="col-md-6">
            <?= $form->input('username', 'Nom d\'utilisateur', 'text', false, true) ?>
            <?= $form->input('email', 'Email', 'email', false, true) ?>
            <?= $form->select('role', 'Rôle', ['Utilisateur', 'Editeur', 'Administrateur']) ?>
        </div>
        <div class="col-md-6">
            <?php if($user->getImage()): ?>
                <img src="<?= $user->getImageURL('thumb') ?>" alt="" style="height: 100%;" class="avatar">
            <?php endif ?>
        </div>
    </div>
    <button class="btn btn-primary">
        Modifier
    </button>
</form>