<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Controllers\ScheduleController;
use \Source\Controllers\CustomerController;
use \Source\Controllers\InstructorController;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;
use \Source\Core\Tracker;
use \Source\Core\Dates;

use \Source\Support\PDFManager;

$link = Config::BASE_URL_ADMIN . "/agenda/agenda";

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_SCHEDULE)) {
  Session::setErrorMessage("Acesso Negado!");
  Helper::redirectToPage($link);
  exit;
}



$id = Helper::safeInt($_GET['id']);
if ($id == 0) {
  Session::setErrorMessage("Agendamento não encontrado!");
  Helper::redirectToPage($link);
  exit;
}



$item = ScheduleController::getDetails($id);
if (Helper::safeInt($item['id']) == 0) {
  Session::setErrorMessage("Agendamento não encontrado!");
  Helper::redirectToPage(Config::BASE_URL_ADMIN . "/agenda/agenda");
  exit;
}


$customerID = Helper::safeInt($item['id_customer']);
$customer = CustomerController::getDetails($customerID);



$html = file_get_contents('../../source/Support/PDF/recibo_modelo.html');

$html = str_replace("[#LOGO#]", '../../arquivos/imagens/blog/34.png', $html);
$html = str_replace("[#DIA#]", date('d'), $html);
$html = str_replace("[#MES#]", Dates::monthName(date('n')), $html);
$html = str_replace("[#ANO#]", date('Y'), $html);

$html = str_replace("[#NOME#]", $customer['name'], $html);
$html = str_replace("[#CPF#]", $customer['cpf'], $html);

$html = str_replace("[#VALOR#]", Helper::decimalToBrlMoney($item['price']), $html);
$html = str_replace("[#PROFISSIONAL#]", $item['instructor_name'], $html);

$timestamp = strtotime($item['start_at']);
$html = str_replace("[#DIA-CONSULTA#]", date('d', $timestamp), $html);
$html = str_replace("[#MES-CONSULTA#]", Dates::monthName(date('n', $timestamp)), $html);
$html = str_replace("[#ANO-CONSULTA#]", date('Y', $timestamp), $html);


$downloadFileName = 'Recibo #'.$id;

PDFManager::streamPDF($html, $downloadFileName);

exit;

?>
