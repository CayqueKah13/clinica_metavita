<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


require __DIR__ . '/../source/autoload.php';

// use \Source\Core\Database;
// use \Source\Core\Dates;
// use \Source\Controllers\FinancesController;
use \Source\Support\PDFManager;

// $items = FinancesController::getAllPaymentMethods();
// var_dump($items);

// $database = new Database();

// $title = "Teste de Parcelamento";
// $value = "1.200,00";
// $date = "31/01/2020";
// $totalInstallments = 12;
//
// $controller = new FinancesController();
// $controller->createNewIncomeWithInstallments($title, $value, $date, $totalInstallments);
//
// var_dump($controller);

// $date = '2020-01-31';
// $days = 30;
// $newDate = Dates::addDaysToDate($date, $days);
// var_dump($newDate);
//
// $nextBusinessDay = Dates::nextBusinessDateFrom('2020-02-03');
// var_dump($nextBusinessDay);

// $html = file_get_contents('../source/Support/PDF/recibo_modelo.html');
// // var_dump($html);
// // exit;
// $downloadFileName = 'Recibo';
//
// PDFManager::streamPDF($html, $downloadFileName);
// $target = "../arquivos/pdf/recibos/teste.pdf";
// PDFManager::createFile($html, $target);

// echo "ok";

// $time = strtotime('10:30:00');
// $time = date('10:30:00');
// $start = strtotime($time);
// // $html = str_replace("[#INICIO-CONSULTA#]", date('d/m/Y', $timestamp), $html);
// $start = date('h:i', $start);
// var_dump($start);
//
// $end = date('h:i', strtotime($start." +1 hours"));
// var_dump($end);


exit;

?>
