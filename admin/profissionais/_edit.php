<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Controllers\InstructorController;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;
use \Source\Core\Tracker;
use \Source\Core\Dates;

$link = Config::BASE_URL_ADMIN . "/profissionais/profissionais";

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_INSTRUCTORS)) {
  Session::setErrorMessage("Acesso Negado!");
  Helper::redirectToPage($link);
  exit;
}



$id = Helper::safeInt($_POST['id']);
$name = Helper::safeString($_POST['name']);
$email = Helper::safeString($_POST['email']);
$phone = Helper::safeString($_POST['phone']);
$pronoun = Helper::safeString($_POST['pronoun']);
$isEditor = Helper::safeInt($_POST['is_editor']);
$status = Helper::safeInt($_POST['status']);

if ($id == 0) {
  Session::setErrorMessage("Profissional não encontrado!");
  Helper::redirectToPage(Config::BASE_URL_ADMIN . "/profissionais/profissionais");
  exit;
}

$link = Config::BASE_URL_ADMIN . "/profissionais/editar?id=" . $id;

if ($name == ""|| $email == ""|| $pronoun == "" || $status == 0) {
  Session::setErrorMessage("Dados inválidos!");
  Helper::redirectToPage($link);
  exit;
}



$cpf = Helper::safeString($_POST['cpf']);
$docNumber = Helper::safeString($_POST['doc_number']);
$bornAt = Dates::databaseDateFormat($_POST['born']);
$status = InstructorController::editDetails($id, $name, $email, $phone, $pronoun, $cpf, $docNumber, $bornAt, $status, $isEditor);


// Tracker::trackAdminEvent(Tracker::TRACK_ADMIN_EDIT_ADMIN, $id);

Session::setSuccessMessage("Profissional atualizado com sucesso!");
Helper::redirectToPage($link);
exit;

?>
