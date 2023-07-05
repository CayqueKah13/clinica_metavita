<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Controllers\CustomerController;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;
use \Source\Core\Tracker;

$link = Config::BASE_URL_INSTRUCTOR . "/clientes/clientes";

if (!Session::isInstructorPermissionGranted()) {
  Session::setErrorMessage("Acesso Negado!");
  Helper::redirectToPage($link);
  exit;
}




$id = Helper::safeInt($_GET['id']);
$controller = new CustomerController();
$success = $controller->delete($id);

if ($success) {
  // Tracker::trackAdminEvent(Tracker::TRACK_ADMIN_DELETE_ADMIN, $id);
  Session::setSuccessMessage($controller->message);
  Helper::redirectToPage($link);
  exit;
} else {
  Session::setErrorMessage($controller->message);
  $link = Config::BASE_URL_INSTRUCTOR . "/clientes/editar?id=" . $id;
  Helper::redirectToPage($link);
  exit;
}




?>
