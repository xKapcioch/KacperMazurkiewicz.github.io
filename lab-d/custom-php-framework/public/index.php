<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'autoload.php';

$config = new \App\Service\Config();

$templating = new \App\Service\Templating();
$router = new \App\Service\Router();

$action = $_REQUEST['action'] ?? null;
$view = null;
switch ($action) {
    case 'aktor-index':
        $controller = new \App\Controller\AktorController();
        $view = $controller->indexAction($templating, $router);
        break;
    case 'aktor-create':
        $controller = new \App\Controller\AktorController();
        $view = $controller->createAction($_REQUEST['aktor'] ?? null, $templating, $router);
        break;
    case 'aktor-edit':
        if (! $_REQUEST['id']) {
            break;
        }
        $controller = new \App\Controller\AktorController();
        $view = $controller->editAction($_REQUEST['id'], $_REQUEST['aktor'] ?? null, $templating, $router);
        break;
    case 'aktor-show':
        if (! $_REQUEST['id']) {
            break;
        }
        $controller = new \App\Controller\AktorController();
        $view = $controller->showAction($_REQUEST['id'], $templating, $router);
        break;
    case 'aktor-delete':
        if (! $_REQUEST['id']) {
            break;
        }
        $controller = new \App\Controller\AktorController();
        $view = $controller->deleteAction($_REQUEST['id'], $router);
        break;
    case 'post-index':
    case null:
        $controller = new \App\Controller\PostController();
        $view = $controller->indexAction($templating, $router);
        break;
    case 'post-create':
        $controller = new \App\Controller\PostController();
        $view = $controller->createAction($_REQUEST['post'] ?? null, $templating, $router);
        break;
    case 'post-edit':
        if (! $_REQUEST['id']) {
            break;
        }
        $controller = new \App\Controller\PostController();
        $view = $controller->editAction($_REQUEST['id'], $_REQUEST['post'] ?? null, $templating, $router);
        break;
    case 'post-show':
        if (! $_REQUEST['id']) {
            break;
        }
        $controller = new \App\Controller\PostController();
        $view = $controller->showAction($_REQUEST['id'], $templating, $router);
        break;
    case 'post-delete':
        if (! $_REQUEST['id']) {
            break;
        }
        $controller = new \App\Controller\PostController();
        $view = $controller->deleteAction($_REQUEST['id'], $router);
        break;
    case 'info':
        $controller = new \App\Controller\InfoController();
        $view = $controller->infoAction();
        break;
    default:
        $view = 'Not found';
        break;
}

if ($view) {
    echo $view;
}
