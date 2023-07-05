<?php
require __DIR__ . '/../source/autoload.php';

use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;
use \Source\Core\Database;
use \Source\Core\Dates;
use \Source\Support\Mailer;



$name = Helper::safeString($_POST['name']);
$email = Helper::safeString($_POST['email']);
$phone = Helper::safeString($_POST['phone']);
$genero = Helper::safeString($_POST['genero']);
$newsletter = Helper::safeString($_POST['newsletter']);
$message = Helper::safeString($_POST['message']);

$option1 = Helper::safeString($_POST['option-1']);
$option2 = Helper::safeString($_POST['option-2']);
$option3 = Helper::safeString($_POST['option-3']);
$option4 = Helper::safeString($_POST['option-4']);
$option5 = Helper::safeString($_POST['option-5']);
$option6 = Helper::safeString($_POST['option-6']);


$objetivos = "";
foreach ([$option1, $option2, $option3, $option4, $option5, $option6] as $key => $value) {
  if ($value != "") {
    if ($key > 0) {
      $objetivos .= " + ";
    }
    $objetivos .= $value;
  }
}




// Send e-mail
$html = file_get_contents(Config::BASE_URL.'/email_templates/contato.html');
$html = str_replace("#nome", $name, $html);
$html = str_replace("#email", $email, $html);
$html = str_replace("#telefone", $phone, $html);
$html = str_replace("#genero", $genero, $html);
$html = str_replace("#objetivos", $objetivos, $html);
$html = str_replace("#mensagem", $message, $html);



if ($newsletter == "on") {
  $newsletter = 1;
} else {
  $newsletter = 0;
}

$database = new Database();
$now = Dates::now();
$query = "INSERT INTO contact (name, email, phone, gender, message, categories, newsletter, created_at)
VALUES ('".$name."', '".$email."', '".$phone."', '".$genero."', '".$message."', '".$objetivos."', '".$newsletter."', '".$now."');";
$database->query($query);


// Mailer::sendEmail('roberto@vianti.com.br', 'Novo Contato do Site', $html);
Mailer::sendEmail('oi@clinicametavita.com.br', 'Novo Contato do Site', $html);

// $json = array('success' => 1);
// echo json_encode($json);


header("Location: ".'mensagem-enviada');
exit();

?>
