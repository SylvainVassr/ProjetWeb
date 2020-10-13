<?php
    namespace Vassagnez\CatalogueApp\Controller;
    
class AuthentificationManager
{
    private $request;

    public function __construct($request) 
    {
        $this->request = $request;
    }
    
    public function checkAuthentification()
    {
        $users = array(
            'jml' => array(
                'id' => 12,
                'nom' => 'Lecarpentier',
                'prenom' => 'Jean-Marc',
                'mdp' => 'toto',
                'statut' => 'admin'
            ),
            'alex' => array(
                'id' => 5,
                'nom' => 'Niveau',
                'prenom' => 'Alexandre',
                'mdp' => 'toto',
                'statut' => 'admin'
            ),
            'julia' => array(
                'id' => 12,
                'nom' => 'Dupont',
                'prenom' => 'Julia',
                'mdp' => 'toto',
                'statut' => 'redacteur'
            )
        );
        $post= $this->request->getAllPostParams();
        if(key_exists("login", $post) && key_exists("mdp", $post)) {
            foreach ($users as $key => $values) {
                if($key == $post["login"] && $post["mdp"] == $values["mdp"]) {
                    $_SESSION['user'] = $values;
                }
            }
        }
    }

}