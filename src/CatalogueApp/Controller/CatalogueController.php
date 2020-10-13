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
                      "Page technique" => '?objet=catalogue&amp;action=show&amp;id=02',);
        
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
        $content = "";
        
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
    }

    public function unknownPoem()
    {
        $title = "Fichier inconnu ou non trouvé";
        $content = "Choisir un fichier dans la liste.";
        $this->view->setPart('title', $title);
        $this->view->setPart('content', $content);
    }
}