<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Controllers\FinancesController;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;
use \Source\Core\Tracker;
use \Source\Core\Dates;

$link = Config::BASE_URL_ADMIN . "/financeiro/financeiro";

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_FINANCES)) {
  Session::setErrorMessage("Acesso Negado!");
  Helper::redirectToPage($link);
  exit;
}



$id = Helper::safeInt($_POST['id']);

if ($id == 0) {
  Session::setErrorMessage("Registro não encontrado!");
  Helper::redirectToPage($link);
  exit;
}

$link = Config::BASE_URL_ADMIN . "/financeiro/editar?id=" . $id;



$categoryID = Helper::safeInt($_POST['category']);
$supplierID = Helper::safeInt($_POST['supplier']);
$paymentMethod = Helper::safeInt($_POST['payment_method']);
$title = Helper::safeString($_POST['title']);
$date = Helper::safeString($_POST['date']);

if ($categoryID == 0 || $date == "") {
  Session::setErrorMessage("Dados inválidos!");
  Helper::redirectToPage($link);
  exit;
}


$customerID = Helper::safeInt($_POST['customer']);
$description = Helper::safeString($_POST['description']);
$value = Helper::safeString($_POST['value']);
$repeatDay = Helper::safeInt($_POST['repeat-day']);
$isConfirmed = Helper::safeInt($_POST['confirmed']);

$status = FinancesController::editDetails($id, $categoryID, $paymentMethod, $customerID, $title, $description, $value, $date, $repeatDay, $isConfirmed, $supplierID);


// Tracker::trackAdminEvent(Tracker::TRACK_ADMIN_EDIT_ADMIN, $id);

Session::setSuccessMessage("Registro atualizado com sucesso!");
Helper::redirectToPage($link);
exit;

?>
