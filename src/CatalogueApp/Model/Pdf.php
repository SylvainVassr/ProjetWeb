<?php

namespace Vassagnez\CatalogueApp\Model;

class Pdf
{
    protected $id;
    protected $name;
    protected $title;
    protected $image;
    protected $author;
    protected $description;
    protected $language;
    protected $date;



    public function __construct($id, $name, $title, $author, $description, $language, $date, $image)
    {
        $this->id = $id;
        $this->name = $name;
        $this->title = $title;
        $this->image = "src/img/all-meta/".preg_replace("/.pdf/i", ".jpeg", $image);
        $this->author = $author;
        $this->description = $description;
        $this->language = $language;
        $this->date = $date;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
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

    public function getLanguage()
    {
        return $this->language;
    }

    public function getDate()
    {
        return $this->date;
    }
}
