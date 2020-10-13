<?php


namespace Vassagnez\Framework;


abstract class FrontController
{
    protected $request;
    protected $response;
    protected $auth;

    abstract public function execute();
}