<?php
require __DIR__ . '/../source/autoload.php';

use \Source\Themes\AdminTheme;
use \Source\Themes\Theme;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;
use \Source\Controllers\BlogController;


$blogItems = BlogController::getListPreview(100);


$currentTab = "blog";
require_once('header.php');

?>

	<!-- Quem Somos -->
	<main>

		<!-- Conteúdos -->
		<div id="Conteudos" class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-5 col-12 text-center title-session" style="margin-bottom:20px;">
					<h2>Conteúdos</h2>
					<!-- <p>Aprenda mais sobre a sua saúde e como manter a dieta.</p> -->
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-lg-6 mb-4">
					<h3>Preocupe-se com sua saúde!</h3>
					<p>
						Fique a vontade para visitar nossa galeria digital, aqui você encontra conteúdos sobre esporte, mente, hábitos saudáveis, alimentação, atividades físicas, organização e planejamento, lesões, mitos e verdades e muuuito mais!
					</p>
				</div>
				<div class="col-12 col-lg-6">
					<div class="CT-item-list">
						<div class="CT-item">
							<div class="CT-number nc1"><span>1</span></div><p>+ de 50 e-books gratuitos recheados de conteúdo de qualidade.</p>
						</div>
						<div class="CT-item">
							<div class="CT-number nc2"><span>2</span></div><p>+ de 100 e-books EXCLUSIVOS para pacientes.</p>
						</div>
						<div class="CT-item">
							<div class="CT-number nc3"><span>3</span></div><p>+ de 100 vídeos EXCLUSIVOS para pacientes.</p>
						</div>
					</div>
				</div>
			</div>

				<!-- <div class="row">
					<div class="col-12 text-center">
						<div class="CNT-search">
						<div class="form-group">
							<input type="text" class="form-control form-padrao" placeholder="Procurando por algo?">
							<div class="form-group-prepend">
								<button class="btn CNT-searchbtn" type="button"><i class="fa fa-search"></i></button>
							</div>
						</div>
					</div>
				</div>
				</div> -->


				<?php if (count($blogItems) == 0) { ?>
				<p class="text-center mt-5">Nenhum resultado encontrado</p>
				<?php } else { ?>
				<div class="row CG-item-area mt-5">
						<?php foreach ($blogItems as $key => $value) { ?>
							<div class="col-12 col-md-6 mb-4">
								<a href="<?= Config::BASE_URL . '/conteudo/' . $value['slug'] ?>"><div class="CG-item neo-card" style="height:100%;">
									<div class="CG-item-img">
										<div class="cover-100" style="background-image:url('<?= Theme::imageUrlFromSufix($value['img']) ?>');"></div>
									</div>
									<h3><?= $value['title'] ?></h3>
									<p><?= $value['subtitle'] ?></p>
									<div class="CG-tag">
										<p><?php if ($value['id_category'] == 2) {echo $value['category'];} ?></p>
									</div>
								</div>
								</a>
							</div>
						<?php } ?>
						</div>
					<?php } ?>


		<!-- <div class="row">
			<div class="col-12 text-center my-4">
				<a class="btn btn-padrao" href="#">CARREGAR MAIS</a>
			</div>
		</div> -->

	</div>


</main>

<?php

require_once('footer.php');

?>
