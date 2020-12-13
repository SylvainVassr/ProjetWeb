<?php


namespace Vassagnez\CatalogueApp\Controller;

interface AuthentificationInterface
{
    public function checkAuthentification($login, $mdp);
    public function getBarreAuth();
    public function deconnecter();
}
