<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Controllers\CustomerController;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;
use \Source\Core\Tracker;
use \Source\Core\Dates;

$link = Config::BASE_URL_ADMIN . "/clientes/clientes";

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_CUSTOMERS)) {
  Session::setErrorMessage("Acesso Negado!");
  Helper::redirectToPage($link);
  exit;
}



$id = Helper::safeInt($_POST['id']);
$name = Helper::safeString($_POST['name']);
$email = Helper::safeString($_POST['email']);
$phone = Helper::safeString($_POST['phone']);
$pronoun = Helper::safeString($_POST['pronoun']);
$status = Helper::safeInt($_POST['status']);
$goalID = Helper::safeInt($_POST['goal']);

if ($id == 0) {
  Session::setErrorMessage("Paciente não encontrado!");
  Helper::redirectToPage($link);
  exit;
}

$link = Config::BASE_URL_ADMIN . "/clientes/editar?id=" . $id;

if ($name == ""|| $email == ""|| $pronoun == "" || $status == 0) {
  Session::setErrorMessage("Dados inválidos!");
  Helper::redirectToPage($link);
  exit;
}



$cpf = Helper::safeString($_POST['cpf']);
$bornAt = Dates::databaseDateFormat($_POST['born']);

$address = Helper::safeString($_POST['address']);
$complement = Helper::safeString($_POST['complement']);
$zipcode = Helper::safeString($_POST['zipcode']);


$message = Helper::safeString($_POST['message']);
$secondaryMessage = Helper::safeString($_POST['secondary_message']);

$status = CustomerController::editDetails($id, $name, $email, $phone, $pronoun, $cpf, $bornAt, $goalID, $status, $message, $secondaryMessage, $address, $complement, $zipcode);


// Tracker::trackAdminEvent(Tracker::TRACK_ADMIN_EDIT_ADMIN, $id);

Session::setSuccessMessage("Paciente atualizado com sucesso!");
Helper::redirectToPage($link);
exit;

?>
