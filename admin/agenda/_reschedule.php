<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Controllers\ScheduleController;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;
use \Source\Core\Tracker;
use \Source\Core\Dates;

$link = Config::BASE_URL_ADMIN . "/agenda/agenda";

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_SCHEDULE)) {
  Session::setErrorMessage("Acesso Negado!");
  Helper::redirectToPage($link);
  exit;
}



$id = Helper::safeInt($_POST['id']);
if ($id == 0) {
  Session::setErrorMessage("Agendamento não encontrado!");
  Helper::redirectToPage($link);
  exit;
}

$date = Helper::safeString($_POST['date']);
$hour = Helper::safeString($_POST['time']);
$reason = Helper::safeInt($_POST['reason']);
$description = Helper::safeString($_POST['title']);

$link = Config::BASE_URL_ADMIN . "/agenda/editar?id=" . $id;

if ($date == "" || $hour == "" || $reason == 0) {
  Session::setErrorMessage("Dados inválidos!");
  Helper::redirectToPage($link);
  exit;
}




$controller = new ScheduleController();
$newID = $controller->rescheduleEvent($id, $date, $hour, $reason, $description);

// Tracker::trackAdminEvent(Tracker::TRACK_ADMIN_EDIT_ADMIN, $id);
if ($newID > 0) {
  $link = Config::BASE_URL_ADMIN . "/agenda/editar?id=" . $newID;
  Session::setSuccessMessage($controller->message);
} else {
  Session::setErrorMessage($controller->message);
}

Helper::redirectToPage($link);
exit;

?>
