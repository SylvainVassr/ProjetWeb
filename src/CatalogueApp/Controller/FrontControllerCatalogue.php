<?php
namespace Vassagnez\CatalogueApp\Controller;

use \Vassagnez\Framework\FrontController;
use \Vassagnez\CatalogueApp\Router;
use \Vassagnez\CatalogueApp\View\ViewCatalogue;
use \Vassagnez\Framework\Http\Request;
use Vassagnez\Framework\Http\Response;

class FrontControllerCatalogue extends FrontController
{
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function execute()
    {
        $view = new ViewCatalogue('template.php');

        try {
            $router = new Router($this->request);
            $className = $router->getControllerClassName();
            $action = $router->getControllerAction();

            $authentif = new AuthentificationManager($this->request);

            $controller = new $className($this->request, $this->response, $view, $authentif);
            $controller->execute($action);

            $loginAuthentif = $this->request->getPostParam('login', '');
            $mdpAuthentif = $this->request->getPostParam('mdp', '');
            $content = '';

            if($this->request->getSession('login') == '') {
                if($mdpAuthentif != '') {
                    if(!$authentif->checkAuthentification($loginAuthentif, $mdpAuthentif)) {
                        $content .= "<ul class='auth'>";
                        $content .= "<li><div class='barre_auth'><label class='label_nom'>Bonjour, " . $this->request->getSession('prenom') . " " . $this->request->getSession('nom') . "</label></div></li>";
                        $content .= "<li>
                                        <div class='position'>
                                            <div class='svg-wrapper'>
                                                <svg height='40' width='150' xmlns='http://www.w3.org/2000/svg'>
                                                    <rect id='shape' height='40' width='150' />
                                                    <div id='text'> 
                                                        <a href='?objet=home&amp;action=deco'>Déconnexion</a>                                              
                                                    </div>
                                                </svg>
                                            </div>
                                        </div>
                                    </li>";
                        $content .= "</ul>";
                        $menu = array("Accueil" => '?objet=home&amp;action=makeHomePage',
                            "Liste PDF" => '?objet=home&amp;action=show',
                            "Page technique" => '?objet=home&amp;action=technique',
                            "Upload PDF" => '?objet=home&amp;action=upload'
                        );
                        $view->setPart('menu', $menu);
                    }
                } else {
                    $content .= $authentif->getBarreAuth();
                    $menu = array("Accueil" => '?objet=home&amp;action=makeHomePage',
                        "Page technique" => '?objet=home&amp;action=technique'
                    );
                    $view->setPart('menu', $menu);
                }
            } else {
                $content .= "<ul class='auth'>";
                $content .= "<li><div class='barre_auth'>
                                    <label class='label_nom'>Bonjour, " . $this->request->getSession('prenom') . " " . $this->request->getSession('nom') . "</label>
                                 </div>
                             </li>";
                $content .= "<li>
                                <div class='position'>
                                    <div class='svg-wrapper'>
                                        <svg height='40' width='150' xmlns='http://www.w3.org/2000/svg'>
                                            <rect id='shape' height='40' width='150' />
                                            <div id='text'> 
                                                <a href='?objet=home&amp;action=deco'>Déconnexion</a>                                              
                                            </div>
                                        </svg>
                                    </div>
                                </div>
                             </li>";
                $content .= "</ul>";
                $menu = array("Accueil" => '?objet=home&amp;action=makeHomePage',
                    "Liste PDF" => '?objet=home&amp;action=show',
                    "Page technique" => '?objet=home&amp;action=technique',
                    "Upload PDF" => '?objet=home&amp;action=upload'
                );
                $view->setPart('menu', $menu);
            }
            $view->setPart('auth', $content);
        } catch (Exception $e) {
            $view->setPart('title', 'Erreur');
            $view->setPart('content', "Une erreur d'exécution s'est produite");
        }

//        if ($this->request->isAjaxRequest()) {
//            $content = $view->getPart('content');
//        } else {
//            $content = $view->render();
//        }
        $this->response->send($view->render());
    }
}
