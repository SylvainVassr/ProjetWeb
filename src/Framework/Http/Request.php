<?php

namespace Vassagnez\Framework\Http;

class Request
{
    private $get;
    private $files;
    private $server;
    private $post;
    private $session;

    public function __construct($get, $files, $server, $post, $session)
    {
        $this->get = $get;
        $this->files = $files;
        $this->server = $server;
        $this->post = $post;
        $this->session = $session;
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

    public function setServer($key, $value)
    {
        $this->server[$key] = $value;
    }

    public function getServerParam($key, $default)
    {
        if (!isset($this->server[$key])) {
            return $default;
        }
        return $this->server[$key];
    }

    public function getPostParam($key, $default)
    {
        if (!isset($this->post[$key])) {
            return $default;
        }
        return $this->post[$key];
    }

    public function getSession($key, $default = null)
    {
        if(!key_exists($key, $this->session)) {
            return $default;
        }
        return $this->session[$key];
    }

    public function setSession($key, $value)
    {
        $this->session[$key] = $value;
    }

    public function __destruct()
    {
        $_SESSION = $this->session;
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
