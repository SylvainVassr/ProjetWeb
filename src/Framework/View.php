<?php

namespace Vassagnez\Framework;

abstract class View
{
    protected $parts; //tableau des parties de HTML qui pourront être utilisées
    protected $template; //nom du fichier servant de squelette HTML à la page

    public function getPart($key)
    {
        if (isset($this->parts[$key])) {
            return $this->parts[$key];
        } else {
            return null;
        }
    }

    public function setPart($key, $content)
    {
        $this->parts[$key] = $content;
    }

    abstract public function render();
}
