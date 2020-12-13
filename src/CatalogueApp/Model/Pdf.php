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

    /**
     * Pdf constructor.
     * @param $id
     * @param $path
     * @param $title
     * @param $author
     * @param $description
     * @param $date
     * @param $name
     * @param $pageCount
     * @param $size
     * @param $dateAccess
     * @param $type
     */
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

    /**
     * Récupère l'id du pdf
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Récupère le chemin du pdf
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Récupère le titre du pdf
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Récupère le nom du pdf
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Récupère l'auteur du pdf
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Récupère la description du pdf
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Récupère la date de création
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Récupère le nombre de page du pdf
     * @return mixed
     */
    public function getPageCount() {
        return $this->pageCount;
    }

    /**
     * Récupère la taille du pdf
     * @return mixed
     */
    public function getSize() {
        return $this->size;
    }

    /**
     * Récupère la date d'accès du pdf
     * @return mixed
     */
    public function getDateAccess() {
        return $this->dateAccess;
    }

    /**
     * Récupère le type du pdf
     * @return mixed
     */
    public function getType() {
        return $this->type;
    }
}
