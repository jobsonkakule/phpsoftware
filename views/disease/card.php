
<div class="card mb-4 box-shadow">
    <?php if($disease->getImage()): ?>
        <!-- <img src="<?= $disease->getImageURL('thumb') ?>" alt="" class="card-img-top"> -->
    <?php endif ?>
    <div class="card-header">
        <p class="my-0 font-weight-normal"><?= $disease->getState() ?></p>
    </div>
    <div class="card-body">
        <h2 class="card-title pricing-card-title text-center"> <?=htmlentities($disease->getName()) ?></h2>
        <ul class="list-unstyled mt-3 mb-4">
            <li>Depuis le <?=$disease->getFirstAt()->format('d F Y') ?></li>
            <li>1 120 cas confirmés dont 720 morts</li>
            <li>5 provinces touchées</li>
            <li><?= $disease->getFlag() ?></li>
        </ul>
        <a href="<?= $router->url('disease', ['id' => $disease->getId(), 'slug' => $disease->getSlug()])  ?>" class="btn btn-lg btn-block btn-outline-danger">Plus d'infos</a>
    </div>
</div>