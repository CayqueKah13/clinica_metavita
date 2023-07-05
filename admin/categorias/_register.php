<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Controllers\CategoriesController;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;
use \Source\Core\Tracker;

$link = Config::BASE_URL_ADMIN . "/categorias/categorias";

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_ADMINS)) {
  Session::setErrorMessage("Acesso Negado!");
  Helper::redirectToPage($link);
  exit;
}




$title = Helper::safeString($_POST['title']);
$key = Helper::safeInt($_POST['key']);

if ($title == ""|| $key == 0) {
  Session::setErrorMessage("Dados inválidos!");
  Helper::redirectToPage($link);
  exit;
}




$controller = new CategoriesController();
$id = $controller->createNew($title, $key);
if (Helper::safeInt($id) == 0) {
  Session::setErrorMessage($controller->message);
} else {
  Session::setSuccessMessage($controller->message);
}

Helper::redirectToPage($link);
exit;

?>
