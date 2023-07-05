<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Controllers\SuppliersController;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;
use \Source\Core\Tracker;
use \Source\Core\Dates;

$link = Config::BASE_URL_ADMIN . "/fornecedores/fornecedores";

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_FINANCES)) {
  Session::setErrorMessage("Acesso Negado!");
  Helper::redirectToPage($link);
  exit;
}



$id = Helper::safeInt($_POST['id']);
$name = Helper::safeString($_POST['name']);
$email = Helper::safeString($_POST['email']);
$phone = Helper::safeString($_POST['phone']);

if ($id == 0) {
  Session::setErrorMessage("Fornecedor não encontrado!");
  Helper::redirectToPage(Config::BASE_URL_ADMIN . "/fornecedores/fornecedores");
  exit;
}

$link = Config::BASE_URL_ADMIN . "/fornecedores/editar?id=" . $id;

if ($name == "") {
  Session::setErrorMessage("Dados inválidos!");
  Helper::redirectToPage($link);
  exit;
}



$cnpj = Helper::safeString($_POST['cnpj']);
$status = SuppliersController::editDetails($id, $name, $email, $phone, $cnpj);


// Tracker::trackAdminEvent(Tracker::TRACK_ADMIN_EDIT_ADMIN, $id);

Session::setSuccessMessage("Fornecedor atualizado com sucesso!");
Helper::redirectToPage($link);
exit;

?>
