<?php
/** @var \App\Model\Aktor $aktor */
/** @var \App\Service\Router $router */
$title = 'Edytuj osobę — Aktorzy u Norbiego';
$bodyClass = 'edit';
ob_start(); ?>
    <h1>Edytuj: <?= $aktor->getNickname() ?? '' ?></h1>
    <form action="<?= $router->generatePath('aktor-edit', ['id' => $aktor->getId()]) ?>" method="post" class="edit-form">
        <?php require __DIR__ . '/_form.html.php'; ?>
    </form>
    <ul class="action-list">
        <li><a href="<?= $router->generatePath('aktor-index') ?>">Wróć do spisu</a></li>
        <li><a href="<?= $router->generatePath('aktor-show', ['id' => $aktor->getId()]) ?>">Szczegóły</a></li>
        <li>
            <form action="<?= $router->generatePath('aktor-delete', ['id' => $aktor->getId()]) ?>" method="post"
                  onsubmit="return confirm('Czy na pewno usunąć tę osobę ze spisu?')">
                <input type="submit" value="Usuń osobę">
            </form>
        </li>
    </ul>
<?php $main = ob_get_clean();
include __DIR__ . '/../base.html.php';