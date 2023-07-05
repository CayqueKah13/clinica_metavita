<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Controllers\AdminController;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;
use \Source\Core\Tracker;

$link = Config::BASE_URL_ADMIN . "/administradores/administradores";

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_ADMINS)) {
  Session::setErrorMessage("Acesso Negado!");
  Helper::redirectToPage($link);
  exit;
}



$id = Helper::safeInt($_POST['id']);
$name = Helper::safeString($_POST['name']);
$email = Helper::safeString($_POST['email']);
$status = Helper::safeInt($_POST['status']);

if ($id == 0) {
  Session::setErrorMessage("Administrador não encontrado!");
  Helper::redirectToPage(Config::BASE_URL_ADMIN . "/administradores/administradores");
  exit;
}

$link = Config::BASE_URL_ADMIN . "/administradores/editar?id=" . $id;

if ($name == ""|| $email == ""|| $status == 0) {
  Session::setErrorMessage("Dados inválidos!");
  Helper::redirectToPage($link);
  exit;
}

$status = AdminController::editDetails($id, $name, $email, $status);


Tracker::trackAdminEvent(Tracker::TRACK_ADMIN_EDIT_ADMIN, $id);

Session::setSuccessMessage("Administrador atualizado com sucesso!");
Helper::redirectToPage($link);
exit;

?>
