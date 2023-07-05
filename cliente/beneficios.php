<?php
require __DIR__ . '/../source/autoload.php';

use \Source\Themes\AdminTheme;
use \Source\Themes\Theme;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;

require_once('header.php');

?>

	<!-- Hero Area -->
	<header id="beneficios" class="beneficios-area">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-md-7 col-lg-5 text-center">
						<h2>Benefícios de Parceiros</h2>
						<p class="message-text">Confira os benefícios com os nossos parceiros!</p>
					</div>
				</div>
				<div class="row justify-content-center text-center mt-4">
					<div class="col-12 col-md-6 col-lg-4 col-xl-3">
						<div class="neo-card p-2 mb-4">
							<div class="beneficios-img-area flexbox">
								<div class="flexdiv">
									<img src="<?= $themePath ?>/assets/img/Parceiros/partner1.png" alt="">
								</div>
							</div>
							<p>Tenha 25% de desconto em sua primeira avaliação.</p>
							<!-- <a class="btn btn-padrao" href="#">Saiba Mais</a> -->
						</div>
						</div>
					<div class="col-12 col-md-6 col-lg-4 col-xl-3">
						<div class="neo-card p-2 mb-4">
							<div class="beneficios-img-area flexbox">
								<div class="flexdiv">
									<img src="<?= $themePath ?>/assets/img/Parceiros/partner1.png" alt="">
								</div>
							</div>
							<p>Tenha 25% de desconto em sua primeira avaliação.</p>
							<!-- <a class="btn btn-padrao" href="#">Saiba Mais</a> -->
						</div>
						</div>
					<div class="col-12 col-md-6 col-lg-4 col-xl-3">
						<div class="neo-card p-2 mb-4">
							<div class="beneficios-img-area flexbox">
								<div class="flexdiv">
									<img src="<?= $themePath ?>/assets/img/Parceiros/partner2.png" alt="">
								</div>
							</div>
							<p>Tenha 25% de desconto em sua primeira avaliação.</p>
							<!-- <a class="btn btn-padrao" href="#">Saiba Mais</a> -->
						</div>
						</div>
					<div class="col-12 col-md-6 col-lg-4 col-xl-3">
						<div class="neo-card p-2 mb-4">
							<div class="beneficios-img-area flexbox">
								<div class="flexdiv">
									<img src="<?= $themePath ?>/assets/img/Parceiros/partner2.png" alt="">
								</div>
							</div>
							<p>Tenha 25% de desconto em sua primeira avaliação.</p>
							<!-- <a class="btn btn-padrao" href="#">Saiba Mais</a> -->
						</div>
						</div>
				</div>
			</div>
	</header>


	<div class="text-center">
		<input type="button" class="btn btn-padrao" value="Voltar" onclick="history.back()"/>
	</div>


	<?php
	require_once('footer.php');
	?>
