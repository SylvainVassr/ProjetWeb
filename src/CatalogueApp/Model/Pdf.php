<?php

namespace Vassagnez\CatalogueApp\Model;

class Pdf
{
    protected $title;
    protected $image;
    protected $author;
    protected $description;

    public function __construct($title, $imgFile, $author, $description)
    {
        $this->title = $title;
        $this->image = file_get_contents("img/all-meta/{$imgFile}.jpeg", true);
        $this->author = $author;
        $this->description = $description;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getDescription()
    {
        return $this->description;
    }
}
