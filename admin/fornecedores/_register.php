<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Controllers\SuppliersController;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;
use \Source\Core\Tracker;

$link = Config::BASE_URL_ADMIN . "/fornecedores/fornecedores";

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_FINANCES)) {
  Session::setErrorMessage("Acesso Negado!");
  Helper::redirectToPage($link);
  exit;
}




$name = Helper::safeString($_POST['name']);

if ($name == "") {
  Session::setErrorMessage("Dados inválidos!");
  Helper::redirectToPage($link);
  exit;
}




$controller = new SuppliersController();
$id = $controller->createNew($name);
if (Helper::safeInt($id) == 0) {
  Session::setErrorMessage($controller->message);
  Helper::redirectToPage($link);
  exit;
}



$link = Config::BASE_URL_ADMIN . "/fornecedores/editar?id=" . $id;


// Tracker::trackAdminEvent(Tracker::TRACK_ADMIN_REGISTER_ADMIN, $id);

Session::setSuccessMessage($controller->message);
Helper::redirectToPage($link);
exit;

?>
