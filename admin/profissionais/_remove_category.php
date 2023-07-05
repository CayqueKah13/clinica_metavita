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



$id = Helper::safeInt($_GET['id']);
$category = Helper::safeInt($_GET['category']);

if ($id == 0) {
  Session::setErrorMessage("Profissional não encontrado!");
  Helper::redirectToPage(Config::BASE_URL_ADMIN . "/profissionais/profissionais");
  exit;
}

$link = Config::BASE_URL_ADMIN . "/profissionais/editar?id=" . $id;

if ($category == 0) {
  Session::setErrorMessage("Dados inválidos!");
  Helper::redirectToPage($link);
  exit;
}

$status = InstructorController::removeCategory($id, $category);


// Tracker::trackAdminEvent(Tracker::TRACK_ADMIN_EDIT_ADMIN, $id);

Session::setSuccessMessage("Categoria removida com sucesso!");
Helper::redirectToPage($link);
exit;

?>
