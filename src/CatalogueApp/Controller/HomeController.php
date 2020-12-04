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
    protected $auth;

    public function __construct(Request $request, Response $response, ViewCatalogue $view, AuthentificationInterface $auth)
    {
        $this->request = $request;
        $this->response = $response;
        $this->view = $view;
        $this->auth = $auth;

        //création du menu
        $menu = array("Accueil" => '?objet=home&amp;action=makeHomePage',
                      "Liste fichiers" => '?objet=home&amp;action=show',
                      "Page technique" => '?objet=home&amp;action=technique');
        
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
        $path = 'src/img/all-meta/';
        $directory = opendir($path);

        $content = "<div style='text-align: center'>";
        while($file = readdir($directory)) {
            if(!is_dir($path.$file))
            {
                $data = shell_exec("exiftool -json -g1 " . $path . $file);
                $metadata = json_decode($data, true);

                foreach ($metadata[0]["XMP-dc"] as $key => $value) {
                    if ($key == 'Title') {
                        $content .= "<div class='img-container'>
                                        <a href='$path$file'>
                                        <img src='$path$file'>
                                        <div class='title'>$value</div>
                                        </a>
                                    </div>
                        ";
                    }
                }
            }
        }
        $content .= "</div>";
        closedir($directory);

        $this->view->setPart('title', $title);
        $this->view->setPart('content', $content);
    }

    public function show()
    {
        $title = "Catalogue de fichiers PDF upload";
        $content = "Cette page liste les fichiers et permet de les modifier/supprimer.";


        $this->view->setPart('title', $title);
        $this->view->setPart('content', $content);
    }

    public function technique() {
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

    public function upload() {
        $title = "Upload fichier";
        $content = "<div class='upload_style'>
                        <form class='form-upload' method='post' action='' enctype='multipart/form-data'>
                            <input class='btn-file' name='fichier' type='file'><br><br>
                            <div class='position-div-orange'>
                                <div class='svg-wrapper-div-orange'>
                                    <svg height='40' width='150' xmlns='http://www.w3.org/2000/svg'>
                                        <rect id='shape-div-orange' height='40' width='150' />
                                        <div id='text-div-orange'>
                                            <input name='upload' type='submit' value='upload'>
                                        </div>
                                    </svg>
                                </div>
                            </div>
                        </form>
                    </div>";

        if(isset($_POST['upload']))
        {
            if(isset($_FILES['fichier']))
            {
                $dossier = 'src/pdf/pdf-upload/';
                $fichier = $_FILES['fichier']['name'];
                if (move_uploaded_file($_FILES['fichier']['tmp_name'], $dossier . $fichier))
                {
                    $data = shell_exec("exiftool -json -g1 " . $dossier . $fichier);
                    //$img = shell_exec("convert ".$fichier."[0] output.jpeg");
                    $metadata = json_decode($data, true);
                    var_dump($metadata[0]);
                    $content = '<form class="ctn_upload" method="post" action="">
                                <h2>Informations de l\'image</h2>';

                    foreach ($metadata[0]["System"] as $key => $value) {
                        if ($key == 'FileName') {
                            $content .= '<p> 
                                            <label for="">Nom du Document : </label>
                                            <input for="text" name="FileName" value="' .$value .'">
                                        </p>';
                        }
                    }
                    foreach ($metadata[0]["PDF"] as $key => $value) {
                        if ($key == 'Title') {
                            $content .= '<p> 
                                            <label for="">Titre : </label>
                                            <input for="text" name="Title" value="' .$value .'">
                                        </p>';
                        }
                    }
                    foreach ($metadata[0]["PDF"] as $key => $value) {
                        if($key == 'Subject') {
                            $content .= '<p> 
                                            <label for="">Description : </label>
                                            <input for="text" name="Subject"  size="50" value="' .$value .'">
                                        </p>';
                        }
                    }
                    foreach ($metadata[0]["PDF"] as $key => $value) {
                        if($key == 'Author') {
                            $content .= '<p> 
                                            <label for="">Auteur : </label>
                                            <input for="text" name="Author" value="' .$value .'">
                                        </p>';
                        }
                    }
                    foreach ($metadata[0]["PDF"] as $key => $value) {
                        if($key == 'CreateDate') {
                            $content .= '<p> 
                                            <label for="">Date de création : </label>
                                            <input for="text" name="CreateDate" value="' .$value .'">
                                        </p>';
                        }
                    }
                    foreach ($metadata[0]["PDF"] as $key => $value) {
                        if($key == 'ModifyDate') {
                            $content .= '<p> 
                                            <label for="">Date de modification : </label>
                                            <input for="text" name="ModifyDate" value="' .$value .'">
                                        </p>';
                        }
                    }

                    $file_meta = "meta.txt";
                    file_put_contents($file_meta, $data);
                    $content .= "<br><br><div class='position-div-orange'>
                                            <div class='svg-wrapper-div-orange'>
                                                <svg height='40' width='150' xmlns='http://www.w3.org/2000/svg'>
                                                    <rect id='shape-div-orange' height='40' width='150' />
                                                    <div id='text-div-orange'>
                                                        <input name='valid' type='submit' value='Valider'></form>
                                                    </div>
                                                </svg>
                                            </div>
                                        </div>";
                    $content .= '<br>Upload effectué avec succès !</div>';
                }
            }
        }
        if (isset($_POST['FileName']) && isset($_POST['Title']) && isset($_POST['Subject']) &&
            isset($_POST['Author']) && isset($_POST['CreateDate']) && isset($_POST['ModifyDate'])){

            $dossier = 'src/pdf/pdf-upload/';
            $data = shell_exec("exiftool -json -g1 " . $dossier . $_POST['FileName']);
            $metadata = json_decode($data, true);

            foreach ($metadata[0]['PDF'] as $k => $v){
                if (isset($_POST[$k])){
                    switch ($k){
                        case 'FileName':
                            $v = $_POST[$k];
                        case 'Title':
                            print_r($v);
                            $v = $_POST[$k];
                            print_r($v);
                        case 'Subject':
                            $v = $_POST[$k];
                        case 'Author':
                            $v = $_POST[$k];
                        case 'CreateDate':
                            $v = $_POST[$k];
                        case 'ModifyDate':
                            $v = $_POST[$k];
                    }
                }
            }
            var_dump($metadata[0]['PDF']);
        }


        $this->view->setPart('title', $title);
        $this->view->setPart('content', $content);
    }

    public function deco() {
        $this->auth->deconnecter();
        $this->response->addHeader('Location: ?objet=home&amp;action=makeHomePage&amp;');
    }

    public function unknownPdf()
    {
        $title = "Fichier inconnu ou non trouvé";
        $content = "Choisir un fichier dans la liste.";
        $this->view->setPart('title', $title);
        $this->view->setPart('content', $content);
    }
}
