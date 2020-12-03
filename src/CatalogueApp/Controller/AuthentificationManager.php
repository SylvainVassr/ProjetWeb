<?php

namespace Vassagnez\CatalogueApp\Controller;

use \Vassagnez\Framework\Http\Request;
    
class AuthentificationManager implements AuthentificationInterface
{
    private $request;
    private $login;
    private $nom;
    private $prenom;
    private $statut;
    private $barreAuth;

    private $users = array(
        'jml' => array(
            'id' => 1,
            'nom' => 'Lecarpentier',
            'prenom' => 'Jean-Marc',
            'mdp' => 'toto',
            'statut' => 'admin'
        ),
        'alex' => array(
            'id' => 2,
            'nom' => 'Niveau',
            'prenom' => 'Alexandre',
            'mdp' => 'toto',
            'statut' => 'admin'
        )
    );

    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->barreAuth = "<form action='".$this->request->getServerParam('REQUEST_AUTH', '?objet=home&amp;action=makeHomePage&amp')."' method='POST'>";
        $this->barreAuth .= "<ul class='auth'>";
        $this->barreAuth .= "<li><div class='barre_auth'><label>Login : </label><input name='login' type='text'></div></li>";
        $this->barreAuth .= "<li><div class='barre_auth'><label>Mdp : </label><input name='mdp' type='password'></div></li>";
        $this->barreAuth .= "<li><div class='position'>
                                    <div class='svg-wrapper'>
                                        <svg height='40' width='150' xmlns='http://www.w3.org/2000/svg'>
                                        <rect id='shape' height='40' width='150' />
                                        <div id='text'>
                                            <input type='submit' value='Connexion'>
                                        </div>
                                        </svg>
                                    </div>
                                 </div>
                              </li>";
        $this->barreAuth .= "</form></ul>";

        if($request->getSession('login')) {
            $this->login = $request->getSession('login');
            $this->nom = $request->getSession('nom');
            $this->prenom = $request->getSession('prenom');
            $this->statut = $request->getSession('statut');
        } else {
            $this->login = null;
            $this->nom = null;
            $this->prenom = null;
            $this->statut = null;
        }
    }
    
    public function checkAuthentification($login, $mdp)
    {
        foreach ($this->users as $key => $values) {
            if ($key == $login && $values["mdp"] == $mdp) {
                $this->request->setSession('login', $key);
                $this->request->setSession('nom', $values['nom']);
                $this->request->setSession('prenom', $values['prenom']);
                $this->request->setSession('statut', $values['statut']);
            }
        }
        return false;
    }

    public function getBarreAuth()
    {
        return $this->barreAuth;
    }

    public function deconnecter()
    {
        session_destroy();
    }
}
