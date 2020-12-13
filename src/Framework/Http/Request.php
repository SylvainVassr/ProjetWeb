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

    /**
     * @param $key
     * @param $value
     */
    public function setServer($key, $value)
    {
        $this->server[$key] = $value;
    }

    /**
     * @param $key
     * @param $default
     * @return mixed
     */
    public function getServerParam($key, $default)
    {
        if (!isset($this->server[$key])) {
            return $default;
        }
        return $this->server[$key];
    }

    /**
     * @param $key la clé à chercher dans POST
     * @param $default la valeur à renvoyer si $key n'existe pas
     * @return mixed
     */
    public function getPostParam($key, $default)
    {
        if (!isset($this->post[$key])) {
            return $default;
        }
        return $this->post[$key];
    }

    /**
     * @param $key la clé à chercher dans SESSION
     * @param null $default
     * @return mixed|null
     */
    public function getSession($key, $default = null)
    {
        if (!key_exists($key, $this->session)) {
            return $default;
        }
        return $this->session[$key];
    }

    /**
     * @param $key
     * @param $value
     */
    public function setSession($key, $value)
    {
        $this->session[$key] = $value;
    }

    /**
     * Destruction d'une session
     */
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
