<?php

namespace Vassagnez\CatalogueApp;

use \Vassagnez\Framework\Http\Request;
use Exception;


class Router
{

    protected $controllerClassName;
    protected $controllerAction;
    protected $request;

    /**
     * Router constructor.
     * @param Request $request
     * @throws Exception
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->parseRequest();
    }

    /**
     * Retourne la classe du contrôleur
     * @return mixed
     */
    public function getControllerClassName()
    {
        return $this->controllerClassName;
    }

    /**
     * Retourne l'action du contrôleur
     * @return mixed
     */
    public function getControllerAction()
    {
        return $this->controllerAction;
    }

    /**
     * @throws Exception
     */
    protected function parseRequest()
    {
        $package = $this->request->getGetParam('objet');

        switch ($package) {
            case 'home':
                $this->controllerClassName = '\Vassagnez\CatalogueApp\Controller\HomeController';
                break;
            case 'paiement':
                $this->controllerClassName = '\Vassagnez\CatalogueApp\Controller\PaiementController';
                break;
            default:
                $this->controllerClassName = '\Vassagnez\CatalogueApp\Controller\HomeController';
        }

        if (!class_exists($this->controllerClassName)) {
            throw new Exception("Classe non existante");
        }

        $this->controllerAction = $this->request->getGetParam('action', 'defaultAction');
    }
}
