<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Controllers\ScheduleController;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;
use \Source\Core\Tracker;
use \Source\Core\Auth;

$link = Config::BASE_URL_ADMIN . "/agenda/agenda";

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_SCHEDULE)) {
  Session::setErrorMessage("Acesso Negado!");
  Helper::redirectToPage($link);
  exit;
}




$id = Helper::safeInt($_POST['id']);
$email = Helper::safeString($_POST['admin']);
$password = Helper::safeString($_POST['password']);

$isAdminPasswordValid = Auth::confirmAdminPassword($email, $password);
if (!$isAdminPasswordValid) {
  Session::setErrorMessage('Senha inválida');
  $link = Config::BASE_URL_ADMIN . "/agenda/editar?id=" . $id;
  Helper::redirectToPage($link);
  exit;
}


$controller = new ScheduleController();
$success = $controller->delete($id);

if ($success) {
  Tracker::trackAdminEvent(Tracker::TRACK_ADMIN_DELETE_SCHEDULE_EVENT, $id);
  Session::setSuccessMessage($controller->message);
  Helper::redirectToPage($link);
  exit;
} else {
  Session::setErrorMessage($controller->message);
  $link = Config::BASE_URL_ADMIN . "/agenda/editar?id=" . $id;
  Helper::redirectToPage($link);
  exit;
}




?>
