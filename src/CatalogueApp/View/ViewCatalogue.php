<?php

namespace Vassagnez\CatalogueApp\View;

use \Vassagnez\Framework\View;

class ViewCatalogue extends View
{
    public function __construct($template, $parts = array())
    {
        $this->template = $template;
        $this->parts = $parts;
    }

    public function render()
    {
        $title = $this->getPart('title');
        $content = $this->getPart('content');
        $menu = $this->getPart('menu');

        ob_start();
        include $this->template;
        $data = ob_get_contents();
        ob_end_clean();

        return $data;
    }
}
