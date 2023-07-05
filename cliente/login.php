<?php
require __DIR__ . '/../source/autoload.php';

use \Source\Themes\AdminTheme;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;
use \Source\Core\Auth;

Session::clearCustomerUser();

$cpf = Helper::safeString($_POST["cpf"]);
$bornAt = Helper::safeString($_POST["born_at"]);

$errorMessage = Session::errorMessage();
// Check Login Attempt
if ($cpf != "" && $bornAt != "") {
  $auth = new Auth();
  $success = $auth->customerSignIn($cpf, $bornAt);
  if ($success) {
    // Tracker::trackAdminEvent(Tracker::TRACK_ADMIN_LOGIN);
    // Session::setSuccessMessage($auth->message);
    Helper::redirectToPage(Config::BASE_URL_CUSTOMER . "/resumo");
    exit;
  } else {
		$errorMessage = $auth->message;
  }
}


$loginHeader = true;
require_once('header.php');

?>

<!-- Hero Area -->

<header class="flexbox fix-centerarea">
	<div class="flexdiv">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 col-md-7 col-lg-5 text-center">
					<h2>Área do MetaFriend</h2>
					<p class="message-text">Acompanhe suas consultas e tenha acesso a conteúdos exclusivos.</p>
					<p class="message-text" style="color:#ff0000;font-size:11pt;"><?= $errorMessage ?></p>
					<form action="login" method="post">
						<div class="form-group">
							<input type="text" class="form-control form-padrao cpf" aria-describedby="emailHelp" placeholder="CPF" name="cpf" value="<?= $cpf ?>">
						</div>
						<div class="form-group">
							<input type="text" class="form-control form-padrao date" aria-describedby="emailHelp" placeholder="Data de Nascimento" name="born_at" value="<?= $bornAt ?>">
						</div>
						<button type="submit" class="btn btn-padrao">Entrar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</header>

<?php
require_once('footer.php');
?>



<script type="text/javascript">
	$('.cpf').mask('000.000.000-00', {reverse: false});
	$('.date').mask('00/00/0000', {reverse: false});
</script>
