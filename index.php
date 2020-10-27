<?php
namespace Vassagnez\Framework;

use \Vassagnez\CatalogueApp\Controller\FrontControllerCatalogue;
use \Vassagnez\Framework\Http\Request;
use \Vassagnez\Framework\Http\Response;
session_start();

spl_autoload_register(
    function ($class_name) {
        $class_name = str_replace('\\', '/', $class_name);
        $class_name = str_replace('Vassagnez', 'src', $class_name);

        include $class_name . '.php';
    }
);

$server = $_SERVER;

$request = new Request($_GET, $_FILES, $server, $_POST);
$response = new Response();
$router = new FrontControllerCatalogue($request, $response);
$router->execute();