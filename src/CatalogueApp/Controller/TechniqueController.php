<?php


namespace Vassagnez\CatalogueApp\Controller;
use \Vassagnez\Framework\Http\Request;
use \Vassagnez\Framework\Http\Response;
use \Vassagnez\CatalogueApp\View\ViewCatalogue;

class TechniqueController
{
    protected $request;
    protected $response;
    protected $view;

    public function __construct(Request $request, Response $response, ViewCatalogue $view)
    {
        $this->request = $request;
        $this->response = $response;
        $this->view = $view;

        //création du menu
        $menu = array("Accueil" => '?objet=home&amp;action=show&amp;id=01',
            "Liste fichiers" => '?objet=catalogue&amp;action=show&amp;id=02',
            "Page technique" => '?objet=technique&amp;action=show&amp;id=03');

        $this->view->setPart('menu', $menu);
    }

    public function execute($action)
    {
        if (method_exists($this, $action)) {
            return $this->$action();
        } else {
            throw new Exception("Action {$action} non trouvée");
        }
    }

    public function defaultAction()
    {
        return $this->makeHomePage();
    }

    public function show() {
        $title = "Page technique";
        $content = "<div class='contenu_technique'>
                        <h2>Page technique du projet</h2>
                        <p>Ce projet a été réalisé par Sébastien AGNEZ et Sylvain VASSEUR. L'objectif était de
                        réaliser un catalogue de fichiers PDF.</p>
                        <h3>Détails techniques de l'implémentation</h3>
                        <h4>Fonctionnement du site web</h4>
                        <p></p>
                        <h4>Détails authentification</h4>    
                        <p>Le site possède une partie accessible par authentification, il est possible de s'y connecter
                        avec les deux comptes suivants : <br>
                        - Le compte de Mr Lecarpentier, <b>login : jml</b> et <b>mdp : toto</b> <br>
                        - Le compte de Mr Niveau, <b>login : alex</b> et <b>mdp : toto</b></p>             
                        
                    </div>";

        $this->view->setPart('title', $title);
        $this->view->setPart('content', $content);
    }

    public function unknownPdf()
    {
        $title = "Fichier inconnu ou non trouvé";
        $content = "Choisir un fichier dans la liste.";
        $this->view->setPart('title', $title);
        $this->view->setPart('content', $content);
    }
}