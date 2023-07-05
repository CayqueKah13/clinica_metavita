<?php
require __DIR__ . '/../source/autoload.php';

use \Source\Themes\AdminTheme;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;

require_once('header.php');

?>

	<header class="flexbox fix-centerarea">
		<div class="flexdiv">
			<div class="container">
				<div class="row">
					<div class="col-12 text-center">
						<h2>Mensagem Enviada!</h2>
						<p class="message-text">Entraremos em contato para orienta-lo<br> o mais breve possível.</p>
						<a class="btn btn-padrao" href="<?= Config::BASE_URL ?>">Voltar</a>
					</div>
				</div>
			</div>
		</div>
	</header>

	<?php
	require_once('footer.php');
	?>
