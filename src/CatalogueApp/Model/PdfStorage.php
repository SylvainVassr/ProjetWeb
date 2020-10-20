<?php


namespace Vassagnez\CatalogueApp\Model;

interface PdfStorage
{
    public function read($id);
    public function readAll();
}
