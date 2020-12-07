<?php
namespace Vassagnez\CatalogueApp\Controller;

//use \Vassagnez\CatalogueApp\Model\PoemStorageStub;
use Vassagnez\CatalogueApp\Model\Pdf;
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
                      "Liste PDF" => '?objet=home&amp;action=show',
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
        $content = "<div class='btn-group' style='margin-bottom: 61.6%'> 
                        <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
                            Choisissez vos pdf <span class='caret''></span>
                        </button>
                       <ul class='dropdown-menu' role='menu'> 
                           <li><a href='?objet=home&amp;action=allMeta'>All-meta</a></li> 
                           <li><a href='?objet=home&amp;action=badMeta'>Bad-meta</a></li> 
                           <li><a href='?objet=home&amp;action=pdfMeta'>Pdf-meta</a></li> 
                           <li><a href='?objet=home&amp;action=xmpMeta'>Xmp-meta</a></li>
                       </ul> 
                    </div>";

        $this->view->setPart('title', $title);
        $this->view->setPart('content', $content);
    }

    public function allMeta() {
        $img = $this->getPdf('allMeta');
        $title = "Catalogue de fichiers PDF";

        $content = "<div class='btn-group' style='margin-bottom: 3%'> 
                        <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
                            Choisissez vos pdf<span class='caret''></span>
                        </button>
                       <ul class='dropdown-menu' role='menu'> 
                           <li><a href='?objet=home&amp;action=allMeta'>All-meta</a></li>
                           <li><a href='?objet=home&amp;action=badMeta'>Bad-meta</a></li> 
                           <li><a href='?objet=home&amp;action=pdfMeta'>Pdf-meta</a></li> 
                           <li><a href='?objet=home&amp;action=xmpMeta'>Xmp-meta</a></li>
                       </ul> 
                    </div>";

        $content .= "<h2 class='title-meta'><u>Pdf all-meta</u></h2><div class='grid-container'>";
        foreach ($img  as $pdf) {
            $imgAllMeta = "src/img/all-meta/".preg_replace("/.pdf/i", ".jpeg", $pdf->getImage());
            $content .= "<div class='img-container'>
                            <a href='?objet=home&amp;action=detail&amp;id=".$pdf->getName()."'>
                                <img class='div-img' src='".$imgAllMeta."' alt='".$pdf->getTitle()."'>
                            </a>
                         </div>";
        }
        $content .= '</div>';
        $this->view->setPart('title', $title);
        $this->view->setPart('content', $content);
    }

    public function badMeta() {
        $img = $this->getPdf('badMeta');
        $title = "Catalogue de fichiers PDF";

        $content = "<div class='btn-group' style='margin-bottom: 3%'> 
                        <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
                            Choisissez vos pdf<span class='caret''></span>
                        </button>
                       <ul class='dropdown-menu' role='menu'> 
                           <li><a href='?objet=home&amp;action=allMeta'>All-meta</a></li>
                           <li><a href='?objet=home&amp;action=badMeta'>Bad-meta</a></li> 
                           <li><a href='?objet=home&amp;action=pdfMeta'>Pdf-meta</a></li> 
                           <li><a href='?objet=home&amp;action=xmpMeta'>Xmp-meta</a></li>
                       </ul> 
                    </div>";

        $content .= "<h2 class='title-meta'><u>Pdf bad-meta</u></h2><div class='grid-container'>";
        foreach ($img  as $pdf) {
            $imgBadMeta = "src/img/bad-meta/".preg_replace("/.pdf/i", ".jpeg", $pdf->getImage());
            $content .= "<div class='img-container'>
                            <a href='?objet=home&amp;action=detail&amp;id=".$pdf->getName()."'>
                                <img class='div-img' src='".$imgBadMeta."' alt='".$pdf->getTitle()."'>
                            </a>
                         </div>";
        }
        $content .= '</div>';
        $this->view->setPart('title', $title);
        $this->view->setPart('content', $content);
    }

    public function pdfMeta() {
        $img = $this->getPdf('pdfMeta');
        $title = "Catalogue de fichiers PDF";

        $content = "<div class='btn-group' style='margin-bottom: 3%'> 
                        <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
                            Choisissez vos pdf<span class='caret''></span>
                        </button>
                       <ul class='dropdown-menu' role='menu'> 
                           <li><a href='?objet=home&amp;action=allMeta'>All-meta</a></li>
                           <li><a href='?objet=home&amp;action=badMeta'>Bad-meta</a></li> 
                           <li><a href='?objet=home&amp;action=pdfMeta'>Pdf-meta</a></li> 
                           <li><a href='?objet=home&amp;action=xmpMeta'>Xmp-meta</a></li>
                       </ul> 
                    </div>";

        $content .= "<h2 class='title-meta'><u>Pdf pdf-meta</u></h2><div class='grid-container'>";
        foreach ($img  as $pdf) {
            $imgPdfMeta = "src/img/pdf-meta/".preg_replace("/.pdf/i", ".jpeg", $pdf->getImage());
            $content .= "<div class='img-container'>
                            <a href='?objet=home&amp;action=detail&amp;id=".$pdf->getName()."'>
                                <img class='div-img' src='".$imgPdfMeta."' alt='".$pdf->getTitle()."'>
                            </a>
                         </div>";
        }
        $content .= '</div>';
        $this->view->setPart('title', $title);
        $this->view->setPart('content', $content);
    }

    public function xmpMeta() {
        $img = $this->getPdf('xmpMeta');
        $title = "Catalogue de fichiers PDF";

        $content = "<div class='btn-group' style='margin-bottom: 3%'> 
                        <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
                            Choisissez vos pdf<span class='caret''></span>
                        </button>
                       <ul class='dropdown-menu' role='menu'> 
                           <li><a href='?objet=home&amp;action=allMeta'>All-meta</a></li>
                           <li><a href='?objet=home&amp;action=badMeta'>Bad-meta</a></li> 
                           <li><a href='?objet=home&amp;action=pdfMeta'>Pdf-meta</a></li> 
                           <li><a href='?objet=home&amp;action=xmpMeta'>Xmp-meta</a></li>
                       </ul> 
                    </div>";

        $content .= "<h2 class='title-meta'><u>Pdf xmp-meta</u></h2><div class='grid-container'>";
        foreach ($img  as $pdf) {
            $imgXmpMeta = "src/img/xmp-meta/".preg_replace("/.pdf/i", ".jpeg", $pdf->getImage());
            $content .= "<div class='img-container'>
                            <a href='?objet=home&amp;action=detail&amp;id=".$pdf->getName()."'>
                                <img class='div-img' src='".$imgXmpMeta."' alt='".$pdf->getTitle()."'>
                            </a>
                         </div>";
        }
        $content .= '</div>';
        $this->view->setPart('title', $title);
        $this->view->setPart('content', $content);
    }

    public function getPdf($meta) {
        if($meta == 'allMeta') {
            $array = array();
            $dir = scandir('src/pdf/all-meta/');

            for($i = 2; $i < count($dir); $i++) {
                $data = shell_exec("exiftool -json src/pdf/all-meta/". $dir[$i]);
                $metadata = json_decode($data, true);

                array_push($array, (new Pdf($i-2, $metadata[0]['SourceFile'], $metadata[0]['Title'], $metadata[0]['Author'],
                    $metadata[0]['Description'], $metadata[0]['Language'],$metadata[0]['CreateDate'], $metadata[0]['FileName'])));
            }
            return ($array);
        } elseif ($meta == 'badMeta') {
            $array = array();
            $dir = scandir('src/pdf/bad-meta/');

            for($i = 2; $i < count($dir); $i++) {
                $data = shell_exec("exiftool -json src/pdf/bad-meta/". $dir[$i]);
                $metadata = json_decode($data, true);

                array_push($array, (new Pdf($i-2, $metadata[0]['SourceFile'], $metadata[0]['Title'], $metadata[0]['Author'],
                    $metadata[0]['Description'], $metadata[0]['Language'],$metadata[0]['CreateDate'], $metadata[0]['FileName'])));
            }
            return ($array);
        } elseif ($meta == 'pdfMeta') {
            $array = array();
            $dir = scandir('src/pdf/pdf-meta/');

            for($i = 2; $i < count($dir); $i++) {
                $data = shell_exec("exiftool -json src/pdf/pdf-meta/". $dir[$i]);
                $metadata = json_decode($data, true);

                array_push($array, (new Pdf($i-2, $metadata[0]['SourceFile'], $metadata[0]['Title'], $metadata[0]['Author'],
                    $metadata[0]['Subject'], $metadata[0]['FileSize'],$metadata[0]['CreateDate'], $metadata[0]['FileName'])));
            }
            return ($array);
        } elseif ($meta == 'xmpMeta') {
            $array = array();
            $dir = scandir('src/pdf/xmp-meta/');

            for($i = 2; $i < count($dir); $i++) {
                $data = shell_exec("exiftool -json src/pdf/xmp-meta/". $dir[$i]);
                $metadata = json_decode($data, true);

                array_push($array, (new Pdf($i-2, $metadata[0]['SourceFile'], $metadata[0]['Title'], $metadata[0]['Author'],
                    $metadata[0]['Description'], $metadata[0]['Language'],$metadata[0]['CreateDate'], $metadata[0]['FileName'])));
            }
            return ($array);
        } else {
            return null;
        }

    }

    public function detail() {
        $title = "Détails du fichier PDF";
        $name = $_GET['id'];
        $data = shell_exec("exiftool -json ".$name);
        $metadata = json_decode($data, true)[0];
        //        $imgXmpMeta = "src/img/xmp-meta/".preg_replace("/.pdf/i", ".jpeg", $pdf->getImage());


        if(isset($metadata['Description']))
            $desc = $metadata['Description'];
        else
            $desc = $metadata['Subject'];

        $content = "<div class='contenu-global-detail'>";
//        $content .= "<img class='div-img' src='".$metadata['']."' alt=''>";
        $content .= "<div class='contenu-detail'>";
        $content .= "<p><u>Nom</u> :  ". $metadata['FileName']."</p>";
        $content .= "<p><u>Titre</u> :  ". $metadata['Title']."</p>";
        $content .= "<p><u>Nombre de pages</u> :  ". $metadata['PageCount']." pages</p>";
        $content .= "<p><u>Auteur</u> :  ". $metadata['Author']."</p>";
        $content .= "<p><u>Description</u> :  ".$desc."</p>";
        $content .= "<p><u>Taille</u> :  ". $metadata['FileSize']."</p>";
        $content .= "<p><u>Date de création</u> :  ". $metadata['CreateDate']."</p>";
        $content .= "<p><u>Date d'accès</u> :  ". $metadata['FileAccessDate']."</p>";
        $content .= "<p><u>Type de fichier</u> :  ". $metadata['FileType']."</p>";
        $content .= "</div>";
        $content .= "</div>";

        // <!-- Open Graph / Facebook --> //
        $meta = "<meta property='og:title' content='".$metadata['Title']."'>";
        $meta .= "<meta property='og:url' content='https://dev-22000212.users.info.unicaen.fr/ProjetWeb/?objet=home&action=detail&id=".$metadata['SourceFile']."'>";
        $meta .= "<meta property='og:site_name' content='Catalogue de fichier PDF'>";
        $meta .= "<meta property='og:image' content=''>";
        $meta .= "<meta property='og:description' content='".$metadata['Subject']."'>";

        // <!-- Twitter Cards --> //
        $meta .= "<meta property='twitter:card' content='summary_large_image'>";
        $meta .= "<meta property='twitter:url' content='https://dev-22000212.users.info.unicaen.fr/ProjetWeb/?objet=home&action=detail&id=".$metadata['SourceFile']."'>";
        $meta .= "<meta property='twitter:title' content='".$metadata['Title']."'>";
        $meta .= "<meta property='twitter:description' content='".$metadata['Subject']."'>";
        $meta .= "<meta property='twitter:image' content=''>";

        $this->view->setPart('title', $title);
        $this->view->setPart('content', $content);
        $this->view->setPart('meta', $meta);
    }

    public function show()
    {
        $title = "Catalogue de fichiers Upload";
        $content = "<div class='contenu-upload'>
                        <p>Cette page liste les fichiers et permet de les modifier/supprimer.</p>
                    </div>";


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
                    $data = shell_exec("exiftool -json " . $dossier . $fichier);
//                    $img = shell_exec("convert ".$fichier."[0] ./src/output.jpeg");
                    $metadata = json_decode($data, true);

                    $content = '<form class="ctn_upload" method="post" action="">
                                    <h2>Informations de l\'image</h2>';
                    $content .= '<h4>Nom document : </h4><input for="text" name="FileName" value="'.$metadata[0]["FileName"].'">';
                    $content .= '<h4>Titre : </h4><input name="Title" value="'.$metadata[0]["Title"].'">';
                    $content .= '<h4>Description : </h4><textarea name="Description" rows="12" cols="70">'.$metadata[0]["Description"].'</textarea>';
                    $content .= '<h4>Auteur : </h4><input name="Author" value="'.$metadata[0]["Author"].'">';
                    $content .= '<h4>Date création : </h4><input name="CreateDate" value="'.$metadata[0]["CreateDate"].'">';
                    $content .= '<h4>Date modification : </h4><input name="ModifyDate" value="'.$metadata[0]["ModifyDate"].'">';

                    $file_meta = "meta.txt";
                    file_put_contents($file_meta, $data);

                    $content .= "<br><br>
                                        <div class='position-div-orange'>
                                            <div class='svg-wrapper-div-orange'>
                                                <svg height='40' width='150' xmlns='http://www.w3.org/2000/svg'>
                                                    <rect id='shape-div-orange' height='40' width='150' />
                                                    <div id='text-div-orange'>
                                                        <input name='valid' type='submit' value='Valider'>
                                                    </div>
                                                </svg>
                                            </div>
                                        </div>                                        
                                        <br><br>Upload effectué avec succès !</form>";
                }
            }
        }

        if (isset($_POST['FileName']) && isset($_POST['Title']) && isset($_POST['Description']) &&
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
                        case 'Description':
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
