<?php

namespace Vassagnez\CatalogueApp;

use \Vassagnez\Framework\Http\Request;
use Exception;


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

    protected function parseRequest()
    {
        $package = $this->request->getGetParam('objet');

        switch ($package) {
            case 'home':
                $this->controllerClassName = '\Vassagnez\CatalogueApp\Controller\HomeController';
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
