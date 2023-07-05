<?php
require __DIR__ . '/../../../../source/autoload.php';

use \Source\Core\Config;

  /*******************************************************
   * Only these origins will be allowed to upload images *
   ******************************************************/
  // require_once('../../../../includes/imagesFunctions.php');
  $accepted_origins = array(Config::BASE_URL);

  /*********************************************
   * Change this line to set the upload folder *
   *********************************************/
   $folder = $_GET['folder'];
   if (is_null($folder) || !is_string($folder) || $folder == "") {
   	$folder = "";
   } else {
   	$folder = addslashes($folder);
   }
   // Folder prefix + destination folder
   $imagesFolder = "../../../../arquivos/imagens/" . $folder;



  reset ($_FILES);
  $temp = current($_FILES);
  if (is_uploaded_file($temp['tmp_name'])){
    if (isset($_SERVER['HTTP_ORIGIN'])) {
      // same-origin requests won't set an origin. If the origin is set, it must be valid.
      if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
        header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
      } else {
        header("HTTP/1.0 403 Origin Denied");
        return;
      }
    }

    // Sanitize input
    if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
        header("HTTP/1.0 500 Invalid file name.");
        return;
    }

    // Verify extension
    if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))) {
        header("HTTP/1.0 500 Invalid extension.");
        return;
    }

    // Check Number of files inside folder
    $listadir = scandir($imagesFolder);
  	$cont = count($listadir);
  	$fileExt  = strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION));

    // $json = array('a' => $cont);
    // echo json_encode($json);
    // exit;

    // Accept upload if there was no origin, or if it is an accepted origin
    $filetowrite = $imagesFolder. $cont . "." . $fileExt;
    move_uploaded_file($temp['tmp_name'], $filetowrite);
    if ($fileExt != 'gif' && $fileExt != 'GIF') {
      // resizeImageIfNeeded($filetowrite, 1200, 1200); do not resize
    }
    // Respond to the successful upload with JSON.
    // Use a location key to specify the path to the saved image resource.
    echo json_encode(array('location' => $filetowrite));
  } else {
    // Notify editor that the upload failed
    header("HTTP/1.0 500 Server aError");
  }
?>
