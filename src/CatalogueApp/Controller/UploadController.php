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
        $menu = array("Accueil" => '?objet=home&amp;action=makeHomePage&amp;',
            "Liste fichiers" => '?objet=catalogue&amp;action=show&amp;',
            "Page technique" => '?objet=technique&amp;action=show&amp;');

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
                        <form method='post' action='' enctype='multipart/form-data'>
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

        if( isset($_POST['upload']) )
        {
            if (isset($_FILES['fichier']))
            {
                $dossier = './src/CatalogueApp/Model/pdf/pdf-upload/';
                $fichier = $_FILES['fichier']['name'];
                if (move_uploaded_file($_FILES['fichier']['tmp_name'], $dossier . $fichier))
                {
                    $data = shell_exec("exiftool -json -g1 " . $dossier . $fichier);
                    //$img = shell_exec("convert ".$fichier."[0] output.jpeg");
                    $metadata = json_decode($data, true);

                    $content = '<form class="ctn_upload" method="post" action="">
                                <h2>Informations de l\'image</h2>';

                    foreach ($metadata[0]["System"] as $key => $value) {
                        if ($key == 'FileName') {
                            $content .= '<h4>Nom document : </h4><textarea name="titre" rows="2" cols="33">' . $value . '</textarea>';
                        }
                    }
                    foreach ($metadata[0]["PDF"] as $key => $value) {
                        if ($key == 'Title') {
                            $content .= '<h4>Titre : </h4><textarea name="titre" rows="2" cols="33">' . $value . '</textarea>';
                        }
                    }
                    foreach ($metadata[0]["XMP-dc"] as $key => $value) {
                        if($key == 'Description') {
                            $content .= '<h4>Description : </h4><textarea name="description" rows="8" cols="95">'.$value.'</textarea>';
                        }
                    }
                    foreach ($metadata[0]["PDF"] as $key => $value) {
                        if($key == 'Author') {
                            $content .= '<h4>Auteur : </h4><textarea name="author" rows="2" cols="33">'.$value.'</textarea>';
                        }
                    }
                    foreach ($metadata[0]["XMP-dc"] as $key => $value) {
                        if($key == 'Date') {
                            $content .= '<h4>Date création : </h4><textarea name="description" rows="2" cols="33">'.$value.'</textarea>';
                        }
                    }

                    $file_meta = "meta.txt";
                    file_put_contents($file_meta, $data);
                    $content .= "<br><br><div style='display: inline-block'><div class='position-div-orange'>
                                            <div class='svg-wrapper-div-orange'>
                                                <svg height='40' width='150' xmlns='http://www.w3.org/2000/svg'>
                                                    <rect id='shape-div-orange' height='40' width='150' />
                                                    <div id='text-div-orange'>
                                                        <input name='modif' type='submit' value='Modifier'>
                                                    </div>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class='position-div-orange'>
                                            <div class='svg-wrapper-div-orange'>
                                                <svg height='40' width='150' xmlns='http://www.w3.org/2000/svg'>
                                                    <rect id='shape-div-orange' height='40' width='150' />
                                                    <div id='text-div-orange'>
                                                        <input name='valid' type='submit' value='Valider'></form>
                                                    </div>
                                                </svg>
                                            </div>
                                        </div></div>";
                }
                $content .= '<br>Upload effectué avec succès !';
            }
        }

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