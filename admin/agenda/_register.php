<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Controllers\ScheduleController;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;
use \Source\Core\Tracker;

$link = Config::BASE_URL_ADMIN . "/agenda/agenda";

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_SCHEDULE)) {
  Session::setErrorMessage("Acesso Negado!");
  Helper::redirectToPage($link);
  exit;
}






$categoryID = Helper::safeInt($_POST['category']);
$customerID = Helper::safeInt($_POST['customer']);
$instructorID = Helper::safeInt($_POST['instructor']);

$date = Helper::safeString($_POST['date']);
$hour = Helper::safeString($_POST['time']);
$title = '';

if ($categoryID == 0 || $customerID == 0 || $instructorID == 0 || $date == ""|| $hour == "") {
  Session::setErrorMessage("Dados inválidos!");
  Helper::redirectToPage($link);
  exit;
}




$controller = new ScheduleController();
$id = $controller->createNew($categoryID, $customerID, $instructorID, $title, $date, $hour);
if (Helper::safeInt($id) == 0) {
  Session::setErrorMessage($controller->message);
  Helper::redirectToPage($link);
  exit;
}



$link = Config::BASE_URL_ADMIN . "/agenda/editar?id=" . $id;


// Tracker::trackAdminEvent(Tracker::TRACK_ADMIN_REGISTER_ADMIN, $id);

Session::setSuccessMessage($controller->message);
Helper::redirectToPage($link);
exit;

?>
