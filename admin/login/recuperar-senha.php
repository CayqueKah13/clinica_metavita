<?php
require_once __DIR__ . '/../../source/autoload.php';

use \Source\Core\Helper;
use \Source\Core\Config;
use \Source\Core\Tracker;
use \Source\Core\Session;
use \Source\Controllers\AdminController;
use \Source\Themes\AdminTheme;
use \Source\Models\Admin;



$email = Helper::safeString($_POST["email"]);

// Check Recover Attempt
if ($email != "") {
  Session::setAdmLastEmail($email);

  $controller = new AdminController();
  $success = $controller->revoverPassword($email);
  if ($success) {
    // track --
    $adminID = AdminController::getAdminID($email);
    $admin = new Admin($adminID);
    Session::setAdminUser($admin);
    Tracker::trackAdminEvent(Tracker::TRACK_ADMIN_RECOVER_PASSWORD);
    Session::clearAdminUser();
    // --

    Session::setSuccessMessage($controller->message);
    Helper::redirectToPage(Config::BASE_URL_ADMIN . "/login/login");
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
    <p class="text-center" style="color:<?= AdminTheme::LOGIN_CARD_COLOR ?>;">Recuperar Senha</p>
    <hr>

    <form action="recuperar-senha" method="post">
      <div class="md-form">
        <input type="text" id="input-1" class="form-control" name="email" required value="<?= Session::getAdmLastEmail(); ?>">
        <label for="input-1">E-mail</label>
      </div>

      <div class="text-center">
        <button class="btn btn-login" type="submit">Enviar</button>
        <hr class="mt-4">
        <a class="p-2 m-2" style="color:<?= AdminTheme::LOGIN_CARD_COLOR ?>;" href="login">Entrar com sua Conta</a>
      </div>
    </form>

  </div>
</div>
<!-- Form -->



<?php
require_once('login-footer.php');
?>
