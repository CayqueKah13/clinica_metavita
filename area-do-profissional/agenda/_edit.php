<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Controllers\ScheduleController;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;
use \Source\Core\Tracker;
use \Source\Core\Dates;

$link = Config::BASE_URL_INSTRUCTOR . "/agenda/agenda";

if (!Session::isInstructorPermissionGranted()) {
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



$categoryID = Helper::safeInt($_POST['category']);
$customerID = Helper::safeInt($_POST['customer']);
$instructorUser = Session::getInstructorUser();
$instructorID = $instructorUser->id;// = Helper::safeInt($_POST['instructor']);
$title = Helper::safeString($_POST['title']);
$date = Helper::safeString($_POST['date']);
$hour = Helper::safeString($_POST['time']);
$price = Helper::safeString($_POST['price']);
$message = Helper::safeString($_POST['message']);
$paymentStatus = Helper::safeInt($_POST['payment_status']);
$status = Helper::safeInt($_POST['status']);

$link = Config::BASE_URL_INSTRUCTOR . "/agenda/editar?id=" . $id;

if ($categoryID == 0 || $customerID == 0 || $instructorID == 0 || $date == "" || $hour == "" || $status == 0) {
  Session::setErrorMessage("Dados inválidos!");
  Helper::redirectToPage($link);
  exit;
}

$status = ScheduleController::editDetails($id, $categoryID, $customerID, $instructorID, $title, $date, $hour, $price, $message, $paymentStatus, $status);


// Tracker::trackAdminEvent(Tracker::TRACK_ADMIN_EDIT_ADMIN, $id);

Session::setSuccessMessage("Agendamento atualizado com sucesso!");
Helper::redirectToPage($link);
exit;

?>
