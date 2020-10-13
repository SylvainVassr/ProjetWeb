<?php

namespace Vassagnez\CatalogueApp;

use \Vassagnez\Framework\Http\Request;
use Exception;

/*
 * Le routeur s'occupe d'analyser les requêtes HTTP
 * pour décider quoi faire et quoi afficher.
 * Il se contente de passer la main au contrôleur et
 * à la vue une fois qu'il a déterminé l'action à effectuer.
 */

class Router
{

    protected $controllerClassName;
    protected $controllerAction;
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->parseRequest();
    }

    public function getControllerClassName()
    {
        return $this->controllerClassName;
    }

    public function getControllerAction()
    {
        return $this->controllerAction;
    }

    /*public function getPoemURL($objet, $action, $id)
    {
        return "?objet=$objet&amp;action=$action&amp;id=$id";
    }*/

    protected function parseRequest()
    {
        $package = $this->request->getGetParam('objet');

        switch ($package) {
            case 'catalogue':
                $this->controllerClassName = '\Vassagnez\CatalogueApp\Controller\CatalogueController';
                break;
            default:
                $this->controllerClassName = '\Vassagnez\CatalogueApp\Controller\CatalogueController';
        }

        if (!class_exists($this->controllerClassName)) {
            throw new Exception("Classe non existante");
        }

        $this->controllerAction = $this->request->getGetParam('action', 'defaultAction');
    }
}
