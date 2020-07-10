
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
            <?php
                $cases = $disease->getCases();
                $deaths = $disease->getDeaths();
                $recoveries = $disease->getRecoveries();
                $provinve = $disease->getProvince();
            ?>
            <li>Depuis le <?=$disease->getFirstAt()->format('d F Y') ?></li>
            <li><?= $cases ?> cas confirmé<?= $cases > 1 ? "s" : "" ?></li>
            <li><?= $deaths ?> décè<?= $deaths > 1 ? "s" : "" ?></li>
            <li><?= $recoveries ?> guéri<?= $recoveries > 1 ? "s" : "" ?></li>
            <li><?= $provinve ?> province<?= $provinve > 1 ? "s" : "" ?> touchée<?= $provinve > 1 ? "s" : "" ?></li>
            <li><?= $disease->getFlag() ?></li>
        </ul>
        <a href="<?= $router->url('disease', ['id' => $disease->getId(), 'slug' => $disease->getSlug()])  ?>" class="btn btn-lg btn-block btn-outline-danger">Plus d'infos</a>
    </div>
</div>