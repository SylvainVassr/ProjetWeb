<?php


namespace Vassagnez\CatalogueApp\Model;

use \Sagnez\CatalogueApp\Model\Pdf;
use \Sagnez\CatalogueApp\Model\PdfStorage;

class PdfStorageStub implements PdfStorage
{
    protected $db;

    public function __construct()
    {
        $this->db = array(
            "01" => new Pdf(""),
            "02" => new Pdf(""),
            "03" => new Pdf(""),
            "04" => new Pdf(""),
            "05" => new Pdf(""),
        );
    }

    public function read($id)
    {
        if(key_exists($id, $this->db)) {
            return $this->db[$id];
        }
    }

    public function readAll()
    {
        return $this->db;
    }
}
