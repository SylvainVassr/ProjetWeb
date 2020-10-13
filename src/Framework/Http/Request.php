<?php

namespace Vassagnez\Framework\Http;

class Request
{
    private $get;
    private $files;
    private $server;
    private $post;

    public function __construct($get, $files, $server, $post)
    {
        $this->get = $get;
        $this->files = $files;
        $this->server = $server;
        $this->post = $post;
    }

    /**
     * détection des requêtes AJAX
     */
    public function isAjaxRequest()
    {
        return (!empty($this->server['HTTP_X_REQUESTED_WITH']) &&
            strtolower($this->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    }

    /**
     * @param $key la clé à chercher dans GET
     * @param $default la valeur à renvoyer si $key n'existe pas
     * @return null
     */
    public function getGetParam($key, $default = null)
    {
        if (!isset($this->get[$key])) {
            return $default;
        }
        return $this->get[$key];
    }

    public function getPostParam($key, $default)
    {
        if (!isset($this->post[$key])) {
            return $default;
        }
        return $this->post[$key];
    }

    /**
     * obtenir tous les paramètres POST
     * @return array
     */
    public function getAllPostParams()
    {
        return $this->post;
    }
}
