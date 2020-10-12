<?php
require 'vendor/autoload.php';

//Routing
$page = 'home';
if(isset($_GET['p'])) {
    $page = $_GET['p'];
}

//Rendu du template
$loader = new \Twig\Loader\FilesystemLoader('Templates');
$twig = new \Twig\Environment($loader, [
    'cache' => false // /path/to/compilation_cache';
]);

switch ($page) {
    case 'home':
        echo $twig->render('home.twig');
        break;
    case 'fichier':
        echo $twig->render('fichier.twig');
    default:
        echo $twig->render('home.twig');
        break;
}