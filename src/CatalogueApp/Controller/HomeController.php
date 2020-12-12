<?php
namespace Vassagnez\CatalogueApp\Controller;

use Vassagnez\CatalogueApp\Model\Pdf;
use \Vassagnez\Framework\Http\Request;
use \Vassagnez\Framework\Http\Response;
use Vassagnez\CatalogueApp\Model\Email;
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
        $content = "<div class='btn-group' style='margin-bottom: 3%'> 
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
        $img = $this->getImage('allMeta');
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
            $imgAllMeta = "src/img/all-meta/".preg_replace("/.pdf/i", ".jpeg", $pdf->getName());
            $content .= "<div class='img-container'>
                            <a href='?objet=home&amp;action=detail&amp;meta=AllMeta&amp;id=".$pdf->getId()."'>
                                <img class='div-img' src='".$imgAllMeta."'>
                            </a>
                         </div>";
        }
        $content .= '</div>';
        $this->view->setPart('title', $title);
        $this->view->setPart('content', $content);
    }

    public function badMeta() {
        $img = $this->getImage('badMeta');
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
            $imgBadMeta = "src/img/bad-meta/".preg_replace("/.pdf/i", ".jpeg", $pdf->getName());
            $content .= "<div class='img-container'>
                            <a href='?objet=home&amp;action=detail&amp;meta=BadMeta&amp;id=".$pdf->getId()."'>
                                <img class='div-img' src='".$imgBadMeta."'>
                            </a>
                         </div>";
        }
        $content .= '</div>';
        $this->view->setPart('title', $title);
        $this->view->setPart('content', $content);
    }

    public function pdfMeta() {
        $img = $this->getImage('pdfMeta');
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
            $imgPdfMeta = "src/img/pdf-meta/".preg_replace("/.pdf/i", ".jpeg", $pdf->getName());
            $content .= "<div class='img-container'>
                            <a href='?objet=home&amp;action=detail&amp;meta=PdfMeta&amp;id=".$pdf->getId()."'>
                                <img class='div-img' src='".$imgPdfMeta."'>
                            </a>
                         </div>";
        }
        $content .= '</div>';
        $this->view->setPart('title', $title);
        $this->view->setPart('content', $content);
    }

    public function xmpMeta() {
        $img = $this->getImage('xmpMeta');
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
            $imgXmpMeta = "src/img/xmp-meta/".preg_replace("/.pdf/i", ".jpeg", $pdf->getName());
            $content .= "<div class='img-container'>
                            <a href='?objet=home&amp;action=detail&amp;meta=XmpMeta&amp;id=".$pdf->getId()."'>
                                <img class='div-img' src='".$imgXmpMeta."'>
                            </a>
                         </div>";
        }
        $content .= '</div>';
        $this->view->setPart('title', $title);
        $this->view->setPart('content', $content);
    }

    public function getImage($meta) {
        if($meta == 'allMeta') {
            $dir = scandir('src/pdf/all-meta/');
            $path = "src/pdf/all-meta/";
        } elseif ($meta == 'badMeta') {
            $dir = scandir('src/pdf/bad-meta/');
            $path = "src/pdf/bad-meta/";
        } elseif ($meta == 'pdfMeta') {
            $dir = scandir('src/pdf/pdf-meta/');
            $path = "src/pdf/pdf-meta/";
        } elseif ($meta == 'xmpMeta') {
            $dir = scandir('src/pdf/xmp-meta/');
            $path = "src/pdf/xmp-meta/";
        } elseif ($meta == 'pdfUpload') {
            $dir = scandir('src/pdf/pdf-upload/');
            $path = "src/pdf/pdf-upload/";
        }

        $array = array();
            for($i = 2; $i < count($dir); $i++) {
                $data = shell_exec("exiftool -json ".$path.$dir[$i]);
                $metadata = json_decode($data, true);

                if(isset($metadata[0]['Description']))
                    $desc = $metadata[0]['Description'];
                else
                    $desc = $metadata[0]['Subject'];

                if(isset($metadata[0]['Author']) && $metadata[0]['Author'] != "") {
                    $author = $metadata[0]['Author'];
                } else if(isset($metadata[0]['Creator'])){
                    $author = $metadata[0]["Creator"];
                }

                array_push($array, (new Pdf($i-2, $metadata[0]['SourceFile'], $metadata[0]['Title'], $author,
                    $desc, $metadata[0]['CreateDate'], $metadata[0]['FileName'],
                    $metadata[0]['PageCount'], $metadata[0]['FileSize'], $metadata[0]['FileAccessDate'], $metadata[0]['FileType'])));
            }
            return ($array);
    }

    public function getPdf($meta) {
        if($meta == 'allMeta') {
            $dir = scandir('src/pdf/all-meta/');
            $path = "src/pdf/all-meta/";
        } elseif($meta == 'badMeta') {
            $dir = scandir('src/pdf/bad-meta/');
            $path = "src/pdf/bad-meta/";
        } elseif($meta == 'pdfMeta') {
            $dir = scandir('src/pdf/pdf-meta/');
            $path = "src/pdf/pdf-meta/";
        } elseif($meta == 'xmpMeta') {
            $dir = scandir('src/pdf/xmp-meta/');
            $path = "src/pdf/xmp-meta/";
        } elseif($meta == 'pdfUpload') {
            $dir = scandir('src/pdf/pdf-upload/');
            $path = "src/pdf/pdf-upload/";
        }

            $data = shell_exec("exiftool -json ".$path.$dir[$this->request->getGetParam("id")+2]);
            $metadata = json_decode($data, true);

            if(isset($metadata[0]['Description']))
                $desc = $metadata[0]['Description'];
            else
                $desc = $metadata[0]['Subject'];

            if(isset($metadata[0]['Author']) && $metadata[0]['Author'] != "") {
                $author = $metadata[0]['Author'];
            } else if(isset($metadata[0]['Creator'])){
                $author = $metadata[0]["Creator"];
            }

            $pdf = new Pdf($this->request->getGetParam("id"), $metadata[0]['SourceFile'], $metadata[0]['Title'], $author,
                $desc, $metadata[0]['CreateDate'], $metadata[0]['FileName'],
                $metadata[0]['PageCount'], $metadata[0]['FileSize'], $metadata[0]['FileAccessDate'], $metadata[0]['FileType']);
            return $pdf;

    }

    public function detail() {
        $title = "Détails du fichier PDF";
        if($this->request->getGetParam("meta") == 'AllMeta') {
            $pdf = $this->getPdf("allMeta");
            $img = "src/img/all-meta/".preg_replace("/.pdf/i", ".jpeg", $pdf->getName());
        } elseif($this->request->getGetParam("meta") == 'BadMeta') {
            $pdf = $this->getPdf("badMeta");
            $img = "src/img/bad-meta/".preg_replace("/.pdf/i", ".jpeg", $pdf->getName());
        } elseif($this->request->getGetParam("meta") == 'PdfMeta') {
            $pdf = $this->getPdf("pdfMeta");
            $img = "src/img/pdf-meta/".preg_replace("/.pdf/i", ".jpeg", $pdf->getName());
        } elseif($this->request->getGetParam("meta") == 'XmpMeta') {
            $pdf = $this->getPdf("xmpMeta");
            $img = "src/img/xmp-meta/".preg_replace("/.pdf/i", ".jpeg", $pdf->getName());
        } elseif($this->request->getGetParam("meta") == 'PdfUpload') {
            $pdf = $this->getPdf("pdfUpload");
            $img = "src/img/img-upload/".preg_replace("/.pdf/i", ".jpeg", $pdf->getName());
        }

        $content = "<div class='contenu-global-detail'>";
        $content .= "<div class='detail-img'><img class='img-pdf' src='".$img."' alt=''><div class='fond'></div></div>";
        $content .= "<div class='contenu-detail'>";
        $content .= "<p><u>Nom</u> :  ".$pdf->getName()."</p>";
        $content .= "<p><u>Titre</u> :  ".$pdf->getTitle()."</p>";
        $content .= "<p><u>Nombre de pages</u> :  ".$pdf->getPageCount()." pages</p>";
        $content .= "<p><u>Auteur</u> :  ". $pdf->getAuthor()."</p>";
        $content .= "<p><u>Description</u> :  ".$pdf->getDescription()."</p>";
        $content .= "<p><u>Taille</u> :  ".$pdf->getSize()."</p>";
        $content .= "<p><u>Date de création</u> :  ". $pdf->getDate()."</p>";
        $content .= "<p><u>Date d'accès</u> :  ". $pdf->getDateAccess()."</p>";
        $content .= "<p><u>Type de fichier</u> :  ".$pdf->getType()."</p>";
        $content .= "<p><u>Prix du pdf</u> :  15€</p>";

        $content .= "<form class='formAchat' action='?objet=paiement&amp;action=infosPaiement' method='POST'>";
        $content .= "<input type='hidden' name='prix' value='15'>";
        $content .= "<input type='hidden' name='pathFile' value='".$pdf->getPath()."'>";
        $content .= "<input type='email' class='email' name='email' size='25' placeholder='Entrez votre adresse mail'>";
        $content .= "<div class='position-div-orange'>";
        $content .= "<div class='svg-wrapper-div-orange'>";
        $content .= "<svg height='40' width='150' xmlns='http://www.w3.org/2000/svg'>";
        $content .= "<rect id='shape-div-orange' height='40' width='150' />";
        $content .= "<div id='text-div-orange'>";
        $content .= "<input class='btnAcheter' type='submit' value='Acheter'>";
        $content .= "</div>";
        $content .= "</svg>";
        $content .= "</div>";
        $content .= "</div>";
        $content .= "</form>";

        $content .= "</div>";
        $content .= "</div>";


        // <!-- Open Graph / Facebook --> //
        $meta = "<meta property='og:title' content='".$pdf->getTitle()."'>";
        $meta .= "<meta property='og:url' content='https://dev-22000212.users.info.unicaen.fr/ProjetWeb/?objet=home&action=detail&id=".$pdf->getId()."'>";
        $meta .= "<meta property='og:site_name' content='Catalogue de fichier PDF'>";
        $meta .= "<meta property='og:image' content='".$img."'>";
        $meta .= "<meta property='og:description' content='".$pdf->getDescription()."'>";

        // <!-- Twitter Cards --> //
        $meta .= "<meta property='twitter:card' content='summary_large_image'>";
        $meta .= "<meta property='twitter:url' content='https://dev-22000212.users.info.unicaen.fr/ProjetWeb/?objet=home&action=detail&id=".$pdf->getId()."'>";
        $meta .= "<meta property='twitter:title' content='".$pdf->getTitle()."'>";
        $meta .= "<meta property='twitter:description' content='".$pdf->getDescription()."'>";
//        $meta .= "<meta property='twitter:image' content='".$img.">";

        $this->view->setPart('title', $title);
        $this->view->setPart('content', $content);
        $this->view->setPart('meta', $meta);
    }

    public function show()
    {
        $title = "Catalogue de fichiers Upload";
        $img = $this->getImage('pdfUpload');

        $content = "<h2 class='title-meta'><u>Pdf Image-Upload</u></h2><div class='grid-container'>";
        foreach ($img  as $pdf) {
            $imgPdfMeta = "src/img/img-upload/".preg_replace("/.pdf/i", ".jpeg", $pdf->getName());
            $content .= "<div class='img-container'>
                            <a href='?objet=home&amp;action=detail&amp;meta=PdfUpload&amp;id=".$pdf->getId()."'>
                                <img class='div-img' src='".$imgPdfMeta."'>";
                $content .= "<div class='btnListe'>
                                <ul class='col'>
                                    <li class='ligne'>
                                      <div class='position-upload'>
                                        <div class='svg-wrapper-upload'>
                                            <svg height='40' width='150' xmlns='http://www.w3.org/2000/svg'>
                                            <rect id='shape-upload' height='40' width='150' />
                                            <div id='text-upload'>
                                                <a href='?objet=home&amp;action=fileUpload&amp;pdf=".$pdf->getName()."'>Modifier</a>
                                            </div>
                                            </svg>
                                        </div>
                                      </div>
                                    </li>
                                    <li class='ligne'>
                                      <div class='position-upload'>
                                        <div class='svg-wrapper-upload'>
                                            <svg height='40' width='150' xmlns='http://www.w3.org/2000/svg'>
                                            <rect id='shape-upload' height='40' width='150' />
                                            <div id='text-upload'>
                                                <a href='?objet=home&amp;action=deletePdf&amp;pdf=".$pdf->getName()."'>Supprimer</a>
                                            </div>
                                            </svg>
                                        </div>
                                      </div>
                                    </li>
                                </ul>  
                             </div>
                            </a>
                         </div>";
        }
        $content .= '</div>';

        $namePdf = $this->request->getGetParam('pdf');
        if(isset($namePdf)) {
            $dossier = 'src/pdf/pdf-upload/';
            $newPdf = str_replace(".pdf", ".pdf/", $namePdf);
            $arrayPdfImg = explode("/", $newPdf);

            for($i = 0; $i < count($arrayPdfImg); $i++) {
                $imgPdfUpload = preg_replace("/.pdf/i", ".jpeg", $arrayPdfImg[$i]);
                shell_exec("convert ".$dossier.$arrayPdfImg[$i]."[0] src/img/img-upload/".$imgPdfUpload);
            }
        }


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
                            <p><h5>Partie publique : </h5>
                                Le site possède deux onglets \"Accueil\" et \"Page technique\" lorsqu'un utilisateur n'est pas connecté
                                ou ne possède pas de compte. Nous avons une première page \"Accueil\" qui, à partir d'un menu
                                déroulant affiche la capture de la première page des différents PDF. Quand l'utilisateur clique 
                                sur l'un des PDF, il est renvoyé sur une nouvelle page qui affiche ses informations en faisant 
                                une extraction des métadonnées qu'il contient. Cette page de détails est composée d'un aperçu de
                                la première page du PDF ainsi qu'une autre partie où l'on voit toutes les informations qui lui
                                correspond. Il a également la possibilité d'acheter un pdf en inscrivant son email et en cliquant 
                                sur le bouton acheter. L'utilisateur est envoyé sur une nouvelle page qui affiche l'adresse mail, 
                                le montant et le moyen de paiement que l'on veut choisir. Une fois le paiement effectué, un mail
                                est envoyé à l'adresse indiquée et un lien est disponible pour le téléchargement.<br><br>
                                
                                <h5>Partie à accès restreint :</h5> 
                                Une fois l'utilisateur connecté, deux nouveaux onglets \"Liste PDF\" et \"Upload PDF\" sont ajoutés 
                                dans la barre de navigation. La page \"Liste PDF\" contient tous les fichiers qui ont été ajoutés
                                par l'utilisateur, il est possible de supprimer un PDF ou modifier ses métadonnées ou voir ses
                                détails lorsqu'il clique sur l'image. Quand l'utilisateur veut modifier un PDF, il arrive sur
                                un formulaire qui contient toutes les métadonnées, s'il veut modifier des données, il écrit dans
                                les cases correspondantes et valide. Il pourra voir ce qu'il a modifié dans la page des détails
                                du PDF. La page \"Upload PDF\" permet de télécharger un ou plusieurs PDF sur le site, une barre
                                de progression affiche l'état du téléchargement quand il clique sur le bouton \"upload\". Une fois
                                ajouté, il est renvoyé sur la liste des PDF.</p>
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
                            <p>
                                Sélectionner un ou plusieurs pdf :<br><input type='file' id='filePdf' name='fichier' style='margin-bottom: 4%' multiple>
                                <div class='position-div-orange'>
                                    <div class='svg-wrapper-div-orange'>
                                        <svg height='40' width='150' xmlns='http://www.w3.org/2000/svg'>
                                            <rect id='shape-div-orange' height='40' width='150' />
                                            <div id='text-div-orange'>
                                                <input id='submitPdf' name='submit' type='submit' value='Upload'>
                                            </div>
                                        </svg>
                                    </div>
                                </div>
                            </p>
                            <div class='progress_bar'>
                                <div id='progress' class='progress'></div>
                            </div>
                    </div>";

        $this->view->setPart('title', $title);
        $this->view->setPart('content', $content);
    }


    public function fileUpload() {
        $title = "Upload fichier";
        $dossier = 'src/pdf/pdf-upload/';

        $pdf = $this->request->getGetParam('pdf');

        $data = shell_exec("exiftool -json ".$dossier.$pdf);
        $metadata = json_decode($data, true);

        $fileMeta = file_put_contents('src/CatalogueApp/Controller/meta.txt', $data);

        if(isset($metadata[0]['Description']))
            $desc = $metadata[0]['Description'];
        else
            $desc = $metadata[0]['Subject'];

        if(isset($metadata[0]['Author']) && $metadata[0]['Author'] != "") {
            $author = $metadata[0]['Author'];
        } else if(isset($metadata[0]['Creator'])){
            $author = $metadata[0]["Creator"];
        }


        $content = '<form class="ctn_upload" method="post" action="?objet=home&amp;action=newMeta" enctype="multipart/form-data">
                        <h2>Informations du PDF</h2>';
        $content .= '<h4>Nom document : </h4><textarea name="FileName" rows="1" cols="33">' . $metadata[0]["FileName"] . '</textarea>';
        $content .= '<h4>Titre : </h4><textarea name="Title" rows="1" cols="33">' . $metadata[0]["Title"] . '</textarea>';
        $content .= '<h4>Description : </h4><textarea name="Description" rows="12" cols="80">'.$desc.'</textarea>';
        $content .= '<h4>Auteur : </h4><textarea name="Author" rows="1" cols="33">'.$author.'</textarea>';

        $content .= "<br><br>
                            <div class='position-div-orange'>
                                <div class='svg-wrapper-div-orange'>
                                    <svg height='40' width='150' xmlns='http://www.w3.org/2000/svg'>
                                        <rect id='shape-div-orange' height='40' width='150' />
                                        <div id='text-div-orange'>
                                            <input type='submit' value='Valider'>
                                        </div>
                                    </svg>
                                </div>
                            </div>
                            <br><br><p style='color: darkviolet'>Upload effectué avec succès !<p></form>";

        $this->view->setPart('title', $title);
        $this->view->setPart('content', $content);
    }

    public function newMeta() {
        if(isset($_POST['FileName']) && $_POST['Title'] && $_POST['Description'] && $_POST['Author']) {
            $filename = $_POST['FileName'];
            $title = $_POST['Title'];
            $description = $_POST['Description'];
            $author = $_POST['Author'];
            $path = 'src/CatalogueApp/Controller/meta.txt';

            $metatxt = fopen($path, 'r');
            $data = fread($metatxt, filesize($path));
            $metadata = json_decode($data, true);
            $pdf = "src/pdf/pdf-upload/" . $metadata[0]['FileName'];

            foreach ($metadata[0] as $key => $value) {
                if ($key == 'FileName' && $value != $filename) {
                    $metadata[0]['FileName'] = $filename;
                }
                if ($key == 'Title' && $value != $title) {
                    $metadata[0]['Title'] = $title;
                }
                if ($value != $description) {
                    if($key == 'Description') {
                        $metadata[0]['Description'] = $description;
                    } elseif($key == 'Subject') {
                        $metadata[0]['Subject'] = $description;
                    }
                }
                if ($key == 'Author' && $value != $author) {
                    $metadata[0]['Author'] = $author;
                }
            }

            $data = json_encode($metadata);
            $json = file_put_contents($path, $data);
            shell_exec("exiftool -json=" . $path . " " . $pdf);
            fclose($metatxt);

            if (file_exists("src/pdf/pdf-upload/" . $filename . "_original"))
                unlink("src/pdf/pdf-upload/" . $filename . "_original");
            $this->show();
        }
    }

    public function deletePdf() {
        $pdf = $this->request->getGetParam('pdf');
        $dossierPDF = 'src/pdf/pdf-upload/';
        $imgPdf = "src/img/img-upload/".preg_replace("/.pdf/i", ".jpeg", $pdf);

        if(file_exists($dossierPDF.$pdf) && file_exists($imgPdf))
            unlink($dossierPDF.$pdf);
            unlink($imgPdf);
        $this->show();
    }

    public function reponseAccepte()
    {
        $fichier_exec = "/users/22000212/www-dev/devoir-idc2020/ProjetWeb/src/Sherlocks/bin/static/response";
        $pathfile = "pathfile=/users/22000212/www-dev/devoir-idc2020/ProjetWeb/src/Sherlocks/param_demo/pathfile";

        $message_data = "message=" . $_POST['DATA'];
        $exec = exec($fichier_exec . " " . $message_data . " " . $pathfile);
        $tableau = explode("!", $exec);

        $caddie = $tableau[22];
        $customer_email = $tableau[28];

        $email = new Email($caddie);
        $email->sendMail($customer_email);
        $this->makeHomePage();
    }

    public function reponseRefuse()
    {
        $this->makeHomePage();
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