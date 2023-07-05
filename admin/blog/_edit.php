<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Controllers\BlogController;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;
use \Source\Core\Tracker;
use \Source\Core\Dates;

$link = Config::BASE_URL_ADMIN . "/blog/blog";

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_GALLERY)) {
  Session::setErrorMessage("Acesso Negado!");
  Helper::redirectToPage($link);
  exit;
}



$id = Helper::safeInt($_POST['id']);
$title = Helper::safeString($_POST['title']);
$status = Helper::safeInt($_POST['status']);

if ($id == 0) {
  Session::setErrorMessage("Conteúdo não encontrado!");
  Helper::redirectToPage($link);
  exit;
}

$link = Config::BASE_URL_ADMIN . "/blog/editar?id=" . $id;

if ($title == "" || $status == 0) {
  Session::setErrorMessage("Dados inválidos!");
  Helper::redirectToPage($link);
  exit;
}


$categoryID = Helper::safeInt($_POST['category']);
$subtitle = Helper::safeString($_POST['subtitle']);
$body = Helper::safeString($_POST['body']);
$ctaTitle = Helper::safeString($_POST['cta-title']);
$ctaLink = Helper::safeString($_POST['cta-link']);
$videoLink = Helper::safeString($_POST['video-link']);

$controller = new BlogController();
$success = $controller->editDetails($id, $categoryID, $title, $subtitle, $body, $ctaTitle, $ctaLink, $videoLink, $status);

if ($success != true) {
  Session::setErrorMessage($controller->message);
  Helper::redirectToPage($link);
  exit;
}

// Tracker::trackAdminEvent(Tracker::TRACK_ADMIN_EDIT_ADMIN, $id);

Session::setSuccessMessage("Conteúdo atualizado com sucesso!");
Helper::redirectToPage($link);
exit;

?>
