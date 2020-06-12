<?php

use App\Connection;
use App\Table\CategoryTable;
use App\Table\DiseaseTable;

$id = (int)$params['id'];
$slug = $params['slug'];

$pdo = Connection::getPDO();
$disease = (new DiseaseTable($pdo))->find($id);

if ($disease->getSlug() !== $slug) {
    $url = $router->url('disease', ['slug' => $disease->getSlug(), 'id' => $id]);
    http_response_code(301);
    header('Location: ' . $url);
}
?>
<div class="container container-top">
    <h1><?= e($disease->getName()) ?></h1>
    <p>
        <span class="text-muted">Apparu depuis </span> <span class="font-weight-bold"><?=$disease->getFirstAt()->format('d F Y') ?></span>
    </p>
    <?php if($disease->getImage()): ?>
        <img src="<?= $disease->getImageURL('large') ?>" alt="" style="width: 100%;" class="mt-3">
    <?php endif ?>
    <p><?=$disease->getFormattedDescription() ?></p>
</div>