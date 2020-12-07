<?php

namespace Vassagnez\CatalogueApp\Model;

class Pdf
{
    protected $id;
    protected $name;
    protected $title;
    protected $path;
    protected $author;
    protected $description;
    protected $date;
    protected $pageCount;
    protected $size;
    protected $dateAccess;
    protected $type;

    public function __construct($id, $path, $title, $author, $description, $date, $name, $pageCount, $size, $dateAccess, $type)
    {
        $this->id = $id;
        $this->path = $path;
        $this->title = $title;
        $this->name = $name;
        $this->author = $author;
        $this->description = $description;
        $this->date = $date;
        $this->pageCount = $pageCount;
        $this->size = $size;
        $this->dateAccess = $dateAccess;
        $this->type = $type;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getPageCount() {
        return $this->pageCount;
    }

    public function getSize() {
        return $this->size;
    }

    public function getDateAccess() {
        return $this->dateAccess;
    }

    public function getType() {
        return $this->type;
    }
}
