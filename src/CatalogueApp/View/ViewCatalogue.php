<?php

namespace Vassagnez\CatalogueApp\View;

use \Vassagnez\Framework\View;

class ViewCatalogue extends View
{
    /**
     * ViewCatalogue constructor.
     * @param $template
     * @param array $parts
     */
    public function __construct($template, $parts = array())
    {
        $this->template = $template;
        $this->parts = $parts;
    }

    /**
     * Génère la vue avec les contenus en remplissant les zones définies
     * @return false|string
     */
    public function render()
    {
        $title = $this->getPart('title');
        $content = $this->getPart('content');
        $menu = $this->getPart('menu');
        $auth = $this->getPart('auth');
        $meta = $this->getPart('meta');

        ob_start();
        include $this->template;
        $data = ob_get_contents();
        ob_end_clean();

        return $data;
    }
}
