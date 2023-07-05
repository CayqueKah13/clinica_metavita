<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Core\Helper;
use \Source\Support\ImageUploader;
use \Source\Core\Database;


$id = Helper::safeInt($_POST['id']);
$folder = Helper::safeString($_POST['folder']);

// Check Parameters
if ($id == 0) {
  echo "failed";
  exit;
}

if ($folder != "profissionais" && $folder != "clientes" && $folder != "blog") {
  echo "failed";
  exit;
}


$database = new Database();


// Check if image should be updated
if ($_FILES['file']['size'] > 0) {

  $fileName = ImageUploader::uploadAndResizeImage($_FILES['file'], $folder, 500, 500);




  switch ($folder) {
    case 'profissionais':
    $query = "UPDATE instructors SET img='".$fileName."' WHERE id='".$id."' LIMIT 1;";
    $database->query($query);
    break;

    case 'clientes':
    $query = "UPDATE customers SET img='".$fileName."' WHERE id='".$id."' LIMIT 1;";
    $database->query($query);
    break;

    case 'blog':
    $query = "UPDATE blog SET img='".$fileName."' WHERE id='".$id."' LIMIT 1;";
    $database->query($query);
    break;

    default: break;
  }


}

echo "ok";
exit;

 ?>
