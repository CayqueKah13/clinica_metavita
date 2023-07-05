<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Controllers\FinancesController;
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


$eventID = Helper::safeInt($_POST['id']);
$link = Config::BASE_URL_ADMIN . "/agenda/editar?id=" . $eventID;


$categoryID = Helper::safeInt($_POST['category']);
$paymentMethod = Helper::safeInt($_POST['payment_method']);
$totalInstallments = Helper::safeInt($_POST['totalinstallments']);
$title = Helper::safeString($_POST['title']);
$date = Helper::safeString($_POST['date']);
$price = Helper::safeString($_POST['price']);

if ($eventID == 0 || $categoryID == 0 || $title == "" || $date == "" || $price == "") {
  Session::setErrorMessage("Dados inválidos!");
  Helper::redirectToPage($link);
  exit;
}




$controller = new FinancesController();


$id = 0;
if ($paymentMethod == 7 && $totalInstallments > 0) {
  // Parcelado no cartão de crédito
  $id = $controller->createNewIncomeWithInstallments($title, $price, $date, $totalInstallments, $eventID);
} else {
  // Normal
  $id = $controller->registerScheduleEventPayment($eventID, $paymentMethod, $categoryID, $title, $price, $date);
}

if (Helper::safeInt($id) == 0) {
  Session::setErrorMessage($controller->message);
  Helper::redirectToPage($link);
  exit;
}





// Tracker::trackAdminEvent(Tracker::TRACK_ADMIN_REGISTER_ADMIN, $id);

Session::setSuccessMessage($controller->message);
Helper::redirectToPage($link);
exit;

?>
