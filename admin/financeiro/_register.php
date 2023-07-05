<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Controllers\FinancesController;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;
use \Source\Core\Tracker;

$link = Config::BASE_URL_ADMIN . "/financeiro/financeiro";

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_FINANCES)) {
  Session::setErrorMessage("Acesso Negado!");
  Helper::redirectToPage($link);
  exit;
}





$groupID = Helper::safeInt($_POST['group']);
$paymentMethod = Helper::safeInt($_POST['payment_method']);
$totalInstallments = Helper::safeInt($_POST['totalinstallments']);
$categoryID = Helper::safeInt($_POST['category']);
$supplierID = Helper::safeInt($_POST['supplier']);
$title = Helper::safeString($_POST['title']);
$price = Helper::safeString($_POST['price']);
$date = Helper::safeString($_POST['date']);




if ($groupID == 0 || $categoryID == 0 || $price == "" || $date == "") {
  Session::setErrorMessage("Dados inválidos!");
  Helper::redirectToPage($link);
  exit;
}




$controller = new FinancesController();

$id = 0;
if ($paymentMethod == 7 && $totalInstallments > 0) {
  // Parcelado no cartão de crédito
  $id = $controller->createNewIncomeWithInstallments($title, $price, $date, $totalInstallments);
} else {
  // Normal
  $id = $controller->createNew($groupID, $paymentMethod, $categoryID, $title, $price, $date, $supplierID);
}


if (Helper::safeInt($id) == 0) {
  Session::setErrorMessage($controller->message);
  Helper::redirectToPage($link);
  exit;
}



$link = Config::BASE_URL_ADMIN . "/financeiro/editar?id=" . $id;


// Tracker::trackAdminEvent(Tracker::TRACK_ADMIN_REGISTER_ADMIN, $id);

Session::setSuccessMessage($controller->message);
Helper::redirectToPage($link);
exit;

?>
