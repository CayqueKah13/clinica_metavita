<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Controllers\FinancesController;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;
use \Source\Core\Tracker;

$ref = Helper::safeInt($_GET['ref']);
$link = Config::BASE_URL_ADMIN . "/agenda/editar?id=" . $ref;

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_FINANCES)) {
  Session::setErrorMessage("Acesso Negado!");
  Helper::redirectToPage($link);
  exit;
}





$id = Helper::safeInt($_GET['id']);
$controller = new FinancesController();
$success = $controller->delete($id);

if ($success) {
  // Tracker::trackAdminEvent(Tracker::TRACK_ADMIN_DELETE_ADMIN, $id);
  Session::setSuccessMessage($controller->message);
  Helper::redirectToPage($link);
  exit;
} else {
  Session::setErrorMessage($controller->message);
  Helper::redirectToPage($link);
  exit;
}




?>
