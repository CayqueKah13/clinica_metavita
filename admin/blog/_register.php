<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Controllers\BlogController;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;
use \Source\Core\Tracker;

$link = Config::BASE_URL_ADMIN . "/blog/blog";

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_GALLERY)) {
  Session::setErrorMessage("Acesso Negado!");
  Helper::redirectToPage($link);
  exit;
}




$title = Helper::safeString($_POST['title']);
if ($title == "") {
  Session::setErrorMessage("Dados inválidos!");
  Helper::redirectToPage($link);
  exit;
}




$controller = new BlogController();
$id = $controller->createNew($title);
if (Helper::safeInt($id) == 0) {
  Session::setErrorMessage($controller->message);
  Helper::redirectToPage($link);
  exit;
}



$link = Config::BASE_URL_ADMIN . "/blog/editar?id=" . $id;


// Tracker::trackAdminEvent(Tracker::TRACK_ADMIN_REGISTER_ADMIN, $id);

Session::setSuccessMessage($controller->message);
Helper::redirectToPage($link);
exit;

?>
