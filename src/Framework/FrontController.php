<?php


namespace Vassagnez\Framework;

abstract class FrontController
{
    protected $request;
    protected $response;

    abstract public function execute();
}
