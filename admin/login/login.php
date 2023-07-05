<?php
require_once __DIR__ . '/../../source/autoload.php';

use \Source\Core\Helper;
use \Source\Core\Config;
use \Source\Core\Session;
use \Source\Core\Auth;
use \Source\Core\Tracker;
use \Source\Themes\AdminTheme;



$email = Helper::safeString($_POST["email"]);
$password = Helper::safeString($_POST["password"]);


// Check Login Attempt
if ($email != "" && $password != "") {
  Session::setAdmLastEmail($email);

  $auth = new Auth();
  $success = $auth->adminSignIn($email, $password);
  if ($success) {
    Tracker::trackAdminEvent(Tracker::TRACK_ADMIN_LOGIN);
    Session::setSuccessMessage($auth->message);
    Helper::redirectToPage(Config::BASE_URL_ADMIN . "/dashboard");
    exit;
  } else {
    Session::setErrorMessage($auth->message);
  }
}


require_once('login-header.php');

?>



<!-- Form with header -->
<div class="card mt-2 wow fadeIn" data-wow-delay="0.3s">
  <div class="card-body" style="background-color:<?= AdminTheme::LOGIN_CARD_BG_COLOR ?>;">

    <h1 class="text-center" style="color:<?= AdminTheme::LOGIN_CARD_COLOR ?>;">Painel de Controle</h1>
    <p class="text-center" style="color:<?= AdminTheme::LOGIN_CARD_COLOR ?>;">Entrar</p>
    <hr>

    <!-- Header -->
    <form action="login" method="post">
      <div class="md-form">
        <input type="text" id="input-1" class="form-control" name="email" required value="<?= Session::getAdmLastEmail(); ?>">
        <label for="input-1">E-mail</label>
      </div>

      <div class="md-form">
        <input type="password" id="input-2" class="form-control" name="password" required>
        <label for="input-2">Senha</label>
      </div>

      <div class="text-center">
        <button class="btn btn-login" type="submit">Entrar</button>
        <hr class="mt-4">
        <a class="p-2 m-2" style="color:<?= AdminTheme::LOGIN_CARD_COLOR ?>;" href="recuperar-senha">Esqueceu sua senha?</a>
      </div>
    </form>

  </div>
</div>
<!-- Form with header -->

<?php
require_once('login-footer.php');
?>
