<?php
/** @var \App\Model\Aktor $aktor */
/** @var \App\Service\Router $router */
$title = 'Dodaj osobę — Aktorzy u Norbiego';
$bodyClass = 'edit';
ob_start(); ?>
    <h1>Dodaj osobę do spisu</h1>
    <form action="<?= $router->generatePath('aktor-create') ?>" method="post" class="edit-form">
        <?php require __DIR__ . '/_form.html.php'; ?>
    </form>
    <a href="<?= $router->generatePath('aktor-index') ?>">Wróć do spisu</a>
<?php $main = ob_get_clean();
include __DIR__ . '/../base.html.php';