<?php


namespace Vassagnez\CatalogueApp\Controller;


use Vassagnez\CatalogueApp\View\ViewCatalogue;
use Vassagnez\Framework\Http\Request;
use Vassagnez\Framework\Http\Response;

class PaiementController
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
            "Page technique" => '?objet=home&amp;action=technique',
            "Upload PDF" => '?objet=home&amp;action=upload');

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
        return $this->infosPaiement();
    }

    public function infosPaiement()
    {
        $email = $this->request->getPostParam('email', '');
        $prix = $this->request->getPostParam('prix', '');
        $pathFile = $this->request->getPostParam('pathFile', '');

        $fichier_exec = "/users/22000212/www-dev/Tp5/paiement/Sherlocks/bin/static/request";
        $pathfile = "/users/22000212/www-dev/Tp5/paiement/Sherlocks/param_demo/pathfile";
        $id_trans = rand(100, 100000);
        $rand = rand(10, 2450);

        $data = [
            "amount" => $rand*100,
            "merchant_id" => "014295303911111",
            "merchant_country" => "fr",
            "currency_code" => 978,
            "pathfile" => "/users/22000212/www-dev/Tp5/paiement/Sherlocks/param_demo/pathfile",
            "transaction_id" => $id_trans,
            "normal_return_url" => "https://dev-22000212.users.info.unicaen.fr/Tp5/paiement/retourManuel.php",
            "cancel_return_url" => "https://dev-22000212.users.info.unicaen.fr/Tp5/paiement/cancel.php",
            "automatic_response_url" => "https://dev-22000212.users.info.unicaen.fr/Tp5/paiement/retourAuto.php",
            "language" => "fr",
            "payment_means" => "CB,2,VISA,2,MASTERCARD,2",
            "header_flag" => "no",
            "capture_day" => "",
            "capture_mode" => "",
            "background_id" => "",
            "bgcolor" => "",
            "block_align" => "",
            "block_order" => "",
            "textcolor" => "",
            "textfont" => "",
            "templatefile" => "",
            "logo_id" => "",
            "receipt_complement" => "",
            "caddie" => "",
            "customer_id" => "156198489",
            "customer_email" => "",
            "customer_ip_address" => "",
            "data" => "",
            "return_context" => "",
            "target" => "",
            "order_id" => "56516564876"
        ];

        $request = "";
        foreach($data as $key => $values) {
            if($values) {
                $request .= $key. "=" .$values." ";
            }
        }
        print_r($request);
        $exec = exec($fichier_exec." ".$request);
        $contenu = explode("!", $exec);
        var_dump($contenu);

        $title = "Paiement du PDF";
        $content = "<div class='contenu-paiement'>
                        <h3>Montant du paiement :</h3>
                        <p>$prix €</p><br><br>
                        <h3>Votre adresse mail :</h3>
                         <p>$email</p><br><br>
                        <h3>Choisissez votre moyen de paiment :</h3>
                        ".$contenu[3]."
                    </div>";
        $this->view->setPart('title', $title);
        $this->view->setPart('content', $content);
    }

}