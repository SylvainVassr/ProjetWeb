<?php
namespace Vassagnez\CatalogueApp\Controller;

//use \Vassagnez\CatalogueApp\Model\PoemStorageStub;
use \Vassagnez\Framework\Http\Request;
use \Vassagnez\Framework\Http\Response;
use \Vassagnez\CatalogueApp\View\ViewCatalogue;

class CatalogueController
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
        $menu = array("Accueil" => '.',
                      "Liste fichiers" => '?objet=catalogue&amp;action=show&amp;id=01',
                      "Page technique" => '?objet=catalogue&amp;action=contenuTechnique&amp;id=02',);
        
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

    public function makeHomePage()
    {
        $title = "Catalogue de fichiers PDF";
        $content = "<div class='img-container'>
                        <a href='#'>
                        <img src='src/CatalogueApp/Model/img/all-document1.jpeg'>
                        <div class='title'>Consequat</div>
                        </a>
                     </div>
                     <div class='img-container'>
                        <a href='#'>
                        <img src='src/CatalogueApp/Model/img/all-document2.jpeg'>                       
                        <div class='title'>Congue</div>
                        </a>
                    </div>
                    <div class='img-container'>
                        <a href='#'>
                        <img src='src/CatalogueApp/Model/img/all-document3.jpeg'>                       
                        <div class='title'>Mollis est</div>
                        </a>
                    </div>";

        //exiftool -json -g1 FichierTest.pdf
        //$this->pdf_to_jpg('/Model/pdf/all-meta/all-document1.pdf');
        
        $this->view->setPart('title', $title);
        $this->view->setPart('content', $content);
    }

    public function show()
    {
        /*$this->response->addHeader('X-Debugging: show me a poem');
        $id = $this->request->getGetParam('id');
        $poemStorage = new PoemStorageStub();
        $poem = $poemStorage->read($id);

        if ($poem !== null) {
            // Le poème existe, on prépare la page
            $image = "images/{$poem->getImage()}";
            $title = "« {$poem->getTitle()} », par {$poem->getAuthor()}";
            $content = "<figure>\n<img src=\"$image\" alt=\"{$poem->getAuthor()}\" />\n";
            $content .= "<figcaption>{$poem->getAuthor()}</figcaption>\n</figure>\n";
            $content .= "<div class=\"poem\">{$poem->getText()}</div>\n";

            $this->view->setPart('title', $title);
            $this->view->setPart('content', $content);
        } else {
            $this->unknownPoem();
        }*/
        $content = "Je suis la page test1 liste fichiers";

        $this->view->setPart('content', $content);
    }

    public function contenuTechnique()
    {
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


        $this->view->setPart('content', $content);
    }

    public function pdf_to_jpg($filename/*,$destination*/) {
        try {
            $imagick = new \Imagick($filename);
        } catch (\ImagickException $e) {
        }
        $imagick->setIteratorIndex(0);
        $imagick->setImageFormat('jpg');
        echo $imagick;
        //return $imagick->writeImage($destination);
    }

    public function unknownPoem()
    {
        $title = "Fichier inconnu ou non trouvé";
        $content = "Choisir un fichier dans la liste.";
        $this->view->setPart('title', $title);
        $this->view->setPart('content', $content);
    }
}
