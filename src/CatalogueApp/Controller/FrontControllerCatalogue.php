<?php
namespace Vassagnez\CatalogueApp\Controller;

use \Vassagnez\Framework\FrontController;
use \Vassagnez\CatalogueApp\Router;
use \Vassagnez\CatalogueApp\View\ViewCatalogue;

class FrontControllerCatalogue extends FrontController
{
    public function __construct($request, $response)
    {
        $this->request = $request;
        $this->response = $response;
        $this->auth = new AuthentificationManager($request);
    }

    public function execute()
    {
        $view = new ViewCatalogue('template.php');

        try {
            $router = new Router($this->request);
            $className = $router->getControllerClassName();
            $action = $router->getControllerAction();

            $this->auth->checkAuthentification();
            $controller = new $className($this->request, $this->response, $view);
            $controller->execute($action);

        } catch (Exception $e) {
            $view->setPart('title', 'Erreur');
            $view->setPart('content', "Une erreur d'exécution s'est produite");
        }

        if ($this->request->isAjaxRequest()) {
            $content = $view->getPart('content');
        } else {
            $content = $view->render();
        }
        $this->response->send($content);
    }
}