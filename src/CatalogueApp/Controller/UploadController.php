<?php


namespace Vassagnez\CatalogueApp\Controller;


use Vassagnez\CatalogueApp\View\ViewCatalogue;
use Vassagnez\Framework\Http\Request;
use Vassagnez\Framework\Http\Response;

class UploadController
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
        $title = "Upload fichier";
        $content = "<div class='upload_style'>
                        <form method='post' action='#' enctype='multipart/form-data'>
                            <input name='fichier' type='file'><br><br>
                            <div class='position'>
                                <div class='svg-wrapper'>
                                    <svg height='40' width='150' xmlns='http://www.w3.org/2000/svg'>
                                        <rect id='shape' height='40' width='150' />
                                        <div id='text'>
                                            <input name='upload' type='submit' value='upload'>
                                        </div>
                                    </svg>
                                </div>
                            </div>
                        </form>
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