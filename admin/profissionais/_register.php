<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Controllers\InstructorController;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;
use \Source\Core\Tracker;

$link = Config::BASE_URL_ADMIN . "/profissionais/profissionais";

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_INSTRUCTORS)) {
  Session::setErrorMessage("Acesso Negado!");
  Helper::redirectToPage($link);
  exit;
}




$name = Helper::safeString($_POST['name']);
$email = Helper::safeString($_POST['email']);
$pronoun = Helper::safeString($_POST['pronoun']);
if ($name == ""|| $email == "") {
  Session::setErrorMessage("Dados inválidos!");
  Helper::redirectToPage($link);
  exit;
}




$controller = new InstructorController();
$id = $controller->createNew($name, $email, $pronoun);
if (Helper::safeInt($id) == 0) {
  Session::setErrorMessage($controller->message);
  Helper::redirectToPage($link);
  exit;
}



$link = Config::BASE_URL_ADMIN . "/profissionais/editar?id=" . $id;


// Tracker::trackAdminEvent(Tracker::TRACK_ADMIN_REGISTER_ADMIN, $id);

Session::setSuccessMessage($controller->message);
Helper::redirectToPage($link);
exit;

?>
