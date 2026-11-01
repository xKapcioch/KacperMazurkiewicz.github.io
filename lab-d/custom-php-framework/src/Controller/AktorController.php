<?php
namespace App\Controller;

use App\Exception\NotFoundException;
use App\Model\Aktor;
use App\Service\Router;
use App\Service\Templating;

class AktorController
{
    public function indexAction(Templating $templating, Router $router): ?string
    {
        $aktorzy = Aktor::findAll();
        $html = $templating->render('aktor/index.html.php', [
            'aktorzy' => $aktorzy,
            'router' => $router,
        ]);
        return $html;
    }

    public function createAction(?array $requestAktor, Templating $templating, Router $router): ?string
    {
        if ($requestAktor) {
            $aktor = Aktor::fromArray($requestAktor);
            // @todo missing validation
            $aktor->save();

            $path = $router->generatePath('aktor-index');
            $router->redirect($path);
            return null;
        } else {
            $aktor = new Aktor();
        }

        $html = $templating->render('aktor/create.html.php', [
            'aktor' => $aktor,
            'router' => $router,
        ]);
        return $html;
    }

    public function editAction(int $aktorId, ?array $requestAktor, Templating $templating, Router $router): ?string
    {
        $aktor = Aktor::find($aktorId);
        if (! $aktor) {
            throw new NotFoundException("Missing aktor with id $aktorId");
        }

        if ($requestAktor) {
            $aktor->fill($requestAktor);
            // @todo missing validation
            $aktor->save();

            $path = $router->generatePath('aktor-index');
            $router->redirect($path);
            return null;
        }

        $html = $templating->render('aktor/edit.html.php', [
            'aktor' => $aktor,
            'router' => $router,
        ]);
        return $html;
    }

    public function showAction(int $aktorId, Templating $templating, Router $router): ?string
    {
        $aktor = Aktor::find($aktorId);
        if (! $aktor) {
            throw new NotFoundException("Missing aktor with id $aktorId");
        }

        $html = $templating->render('aktor/show.html.php', [
            'aktor' => $aktor,
            'router' => $router,
        ]);
        return $html;
    }

    public function deleteAction(int $aktorId, Router $router): ?string
    {
        $aktor = Aktor::find($aktorId);
        if (! $aktor) {
            throw new NotFoundException("Missing aktor with id $aktorId");
        }

        $aktor->delete();
        $path = $router->generatePath('aktor-index');
        $router->redirect($path);
        return null;
    }
}
