<?php

namespace Source\Support;


require_once('PDF/dompdf/autoload.inc.php');


use Dompdf\Dompdf;

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
// use \Source\Core\Config;
// use \Source\Core\Database;
// use \Source\Core\Dates;


// require_once("PHPMailer/Exception.php");
// require_once("PHPMailer/OAuth.php");
// require_once("PHPMailer/PHPMailer.php");
// require_once("PHPMailer/POP3.php");
// require_once("PHPMailer/SMTP.php");



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
    header('Content-Disposition: attachment; filename="'.$downloadFileName.'.pdf"');
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




?>
