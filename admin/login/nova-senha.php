<?php
require_once __DIR__ . '/../../source/autoload.php';

use \Source\Core\Helper;
use \Source\Core\Config;
use \Source\Core\Session;
use \Source\Core\Tracker;
use \Source\Core\Auth;
use \Source\Controllers\AdminController;
use \Source\Themes\AdminTheme;




$token = Helper::safeString($_GET["t"]);

$auth = new Auth();
$reference = $auth->securityTokenReference($token, Auth::STR_ADMIN_NEW_PASSWORD);

if ($reference == 0) {
  Session::setErrorMessage($auth->message);
  Helper::redirectToPage(Config::BASE_URL_ADMIN . "/login/login");
  exit();
}





// Check Attempt
$password1 = Helper::safeString($_POST["password1"]);
$password2 = Helper::safeString($_POST["password2"]);
if ($password1 != "" && $password2 != "") {
  $controller = new AdminController();
  $success = $controller->createNewPasswordAndSignIn($reference, $password1, $password2, $token);
  if ($success) {
    Tracker::trackAdminEvent(Tracker::TRACK_ADMIN_NEW_PASSWORD);
    Session::setSuccessMessage($controller->message);
    Helper::redirectToPage(Config::BASE_URL_ADMIN . "/dashboard");
    exit;
  } else {
    Session::setErrorMessage($controller->message);
  }
}


require_once('login-header.php');

?>


<!-- Form -->
<div class="card wow fadeIn" data-wow-delay="0.3s">
  <div class="card-body" style="background-color:<?= AdminTheme::LOGIN_CARD_BG_COLOR ?>;">

    <h1 class="text-center" style="color:<?= AdminTheme::LOGIN_CARD_COLOR ?>;">Painel de Controle</h1>
    <p class="text-center" style="color:<?= AdminTheme::LOGIN_CARD_COLOR ?>;">Nova Senha</p>
    <hr>

    <form action="nova-senha?t=<?= $token ?>" method="post">
      <div class="md-form">
        <input type="password" id="input-1" class="form-control" name="password1" required>
        <label for="input-1">Nova Senha</label>
      </div>

      <div class="md-form">
        <input type="password" id="input-2" class="form-control" name="password2" required>
        <label for="input-2">Confirmar Senha</label>
      </div>

      <div class="text-center">
        <button class="btn btn-login" type="submit">Salvar</button>
        <hr class="mt-4">
      </div>
    </form>

  </div>
</div>
<!-- Form -->


<?php
require_once('login-footer.php');
?>
