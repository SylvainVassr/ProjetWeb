<?php
namespace Vassagnez\CatalogueApp\Controller;

foreach ($_FILES['pdf']['tmp_name'] as $key => $values) {
    $dossier = '../../pdf/pdf-upload/'.$_FILES['pdf']['name'][$key];
    move_uploaded_file($values, $dossier);
    echo $_FILES['pdf']['name'][$key];
}