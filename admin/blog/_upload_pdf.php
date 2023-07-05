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
$item = BlogController::getDetails($id);
if (Helper::safeInt($item['id']) == 0) {
  Session::setErrorMessage("Conteúdo não encontrado!");
  Helper::redirectToPage($link);
  exit;
}
$link = Config::BASE_URL_ADMIN . "/blog/editar?id=" . $id;

$slug = $item['slug'];


$controller = new BlogController();

$pdf = '';
if ($_FILES['file']['size'] > 0) {
  $pdf = $controller->uploadPDF($_FILES['file'], '../../arquivos/pdf', $slug);
}

if ($pdf == '') {
  Session::setErrorMessage("Falha ao enviar arquivo!");
  Helper::redirectToPage($link);
  exit;
}


$ctaTitle = $item['cta_title'];
if (Helper::safeString($ctaTitle) == '') {
  $ctaTitle = 'ABRIR PDF';
}

$ctaLink = Config::BASE_URL.'/arquivos/'.$pdf;
$controller->editCTA($id, $ctaTitle, $ctaLink);

// Tracker::trackAdminEvent(Tracker::TRACK_ADMIN_EDIT_ADMIN, $id);

Session::setSuccessMessage("PDF vinculado com sucesso!");
Helper::redirectToPage($link);
exit;

?>
