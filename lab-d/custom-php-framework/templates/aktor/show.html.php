<?php
/** @var \App\Model\Aktor $aktor */
/** @var \App\Service\Router $router */
$title = 'Szczegóły osoby — Aktorzy u Norbiego';
$bodyClass = 'show';
ob_start(); ?>
    <h1><?= $aktor->getNickname() ?? '' ?></h1>
    <article>
        <?= $aktor->getDescription() ?>
    </article>
    <?php if ($aktor->getVideoUrl()): ?>
        <p><a href="<?= $aktor->getVideoUrl() ?>">Obejrzyj film z tą osobą</a></p>
    <?php endif; ?>
    <ul class="action-list">
        <li><a href="<?= $router->generatePath('aktor-index') ?>">Wróć do spisu</a></li>
        <li><a href="<?= $router->generatePath('aktor-edit', ['id' => $aktor->getId()]) ?>">Edytuj / usuń</a></li>
    </ul>
<?php $main = ob_get_clean();
include __DIR__ . '/../base.html.php';