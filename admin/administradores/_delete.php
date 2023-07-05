<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Controllers\AdminController;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;
use \Source\Core\Tracker;

$link = Config::BASE_URL_ADMIN . "/administradores/administradores";

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_ADMINS)) {
  Session::setErrorMessage("Acesso Negado!");
  Helper::redirectToPage($link);
  exit;
}




$id = Helper::safeInt($_GET['id']);
$controller = new AdminController();
$success = $controller->delete($id);

if ($success) {
  Tracker::trackAdminEvent(Tracker::TRACK_ADMIN_DELETE_ADMIN, $id);
  Session::setSuccessMessage($controller->message);
  Helper::redirectToPage($link);
  exit;
} else {
  Session::setErrorMessage($controller->message);
  $link = Config::BASE_URL_ADMIN . "/administradores/editar?id=" . $id;
  Helper::redirectToPage($link);
  exit;
}




?>
