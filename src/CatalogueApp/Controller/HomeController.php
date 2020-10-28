<?php
namespace Vassagnez\CatalogueApp\Controller;

//use \Vassagnez\CatalogueApp\Model\PoemStorageStub;
use \Vassagnez\Framework\Http\Request;
use \Vassagnez\Framework\Http\Response;
use \Vassagnez\CatalogueApp\View\ViewCatalogue;

class HomeController
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

    public function makeHomePage()
    {
        $title = "Catalogue de fichiers PDF";
        $path = 'src/CatalogueApp/Model/img/all-meta/';
        $directory = opendir($path);

        $content = "<div style='text-align: center'>";
        while($file = readdir($directory)) {
            if(!is_dir($path.$file))
            {
                $content .= "<div class='img-container'>
                                    <a href='$path$file'>
                                    <img src='$path$file'>
                                    <div class='title'>Consequat</div>
                                    </a>
                                </div>
                            ";
            }
        }
        $content .= "</div>";
        closedir($directory);

        $this->view->setPart('title', $title);
        $this->view->setPart('content', $content);
    }

    public function show()
    {
        $title = "Catalogue de fichiers PDF";
        $path = 'src/CatalogueApp/Model/img/all-meta/';
        $directory = opendir($path);

        $content = "<div style='text-align: center'>";
        while($file = readdir($directory)) {
            if(!is_dir($path.$file))
            {
                $content .= "<div class='img-container'>
                                    <a href='$path$file'>
                                    <img src='$path$file'>
                                    <div class='title'>Consequat</div>
                                    </a>
                                </div>
                            ";
            }
        }
        $content .= "</div>";
        closedir($directory);

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