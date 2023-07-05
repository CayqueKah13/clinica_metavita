<?php


// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


require_once('dompdf/autoload.inc.php');


use Dompdf\Dompdf;


class PDFManager {

  static function streamPDF($html, $downloadFileName) {
    $dompdf = new Dompdf();
    //inserindo o HTML que queremos converter
    $dompdf->loadHtml($html);
    // Definindo o papel e a orientação
    $dompdf->setPaper('A4', 'portrait');
    // Renderizando o HTML como PDF
    $dompdf->render();
    // Set downlaod file name
    $dompdf->stream($downloadFileName.".pdf");
    // Enviando o PDF para o browser
    $dompdf->stream();

  }


  static function createFile($html, $target) {
    $dompdf = new Dompdf();
    //inserindo o HTML que queremos converter
    $dompdf->loadHtml($html);

    // Definindo o papel e a orientação
    // $dompdf->setPaper('A4', 'landscape');
    $dompdf->setPaper('A4', 'portrait');

    // Renderizando o HTML como PDF
    $dompdf->render();

    // Salvar o PDF
    $output = $dompdf->output();
    file_put_contents($target, $output);
  }

}

// $html = file_get_contents('modelo.html');
// PDFManager::streamPDF($html, 'Contrato');

// $html = file_get_contents('modelo.html');
// $target = 'testando.pdf';
// PDFManager::createFile($html, $target);
// echo date('d/m/Y h:i:s');

?>
