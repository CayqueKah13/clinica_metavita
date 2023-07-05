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




$id = Helper::safeInt($_GET['id']);
$key = Helper::safeInt($_GET['key']);

$controller = new CategoriesController();
$success = $controller->delete($id, $key);

if ($success) {
  Session::setSuccessMessage($controller->message);
} else {
  Session::setErrorMessage($controller->message);
}


Helper::redirectToPage($link);
exit;



?>
