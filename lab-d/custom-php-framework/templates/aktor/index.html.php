<?php
/** @var \App\Model\Aktor[] $aktorzy */
/** @var \App\Service\Router $router */
$title = 'Aktorzy u Norbiego — spis';
$bodyClass = 'index';
ob_start(); ?>
    <h1>Aktorzy u Norbiego</h1>
    <p>Spis osób, które pojawiły się w filmach Norbiego.</p>
    <a href="<?= $router->generatePath('aktor-create') ?>">Dodaj osobę</a>
    <?php if (!$aktorzy): ?>
        <p>Spis jest pusty. Dodaj pierwszą osobę.</p>
    <?php else: ?>
        <ul class="index-list">
            <?php foreach ($aktorzy as $aktor): ?>
                <li>
                    <h3><?= $aktor->getNickname() ?? '' ?></h3>
                    <ul class="action-list">
                        <li><a href="<?= $router->generatePath('aktor-show', ['id' => $aktor->getId()]) ?>">Szczegóły</a></li>
                        <li><a href="<?= $router->generatePath('aktor-edit', ['id' => $aktor->getId()]) ?>">Edytuj / usuń</a></li>
                    </ul>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
<?php $main = ob_get_clean();
include __DIR__ . '/../base.html.php';