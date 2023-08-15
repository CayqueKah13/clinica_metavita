<?php
require __DIR__ . '/../source/autoload.php';

use \Source\Themes\AdminTheme;
use \Source\Themes\Theme;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;
use \Source\Controllers\BlogController;

$blogItems = BlogController::getListPreview();



$contactOptions = [
	[
		"id" => 'option-1',
		"title" => 'Perda de gordura',
		"message" => 'Se você precisa de ajuda para conseguir perder gordura e definir seu corpo, ter mais disposição, aumentar a autoestima e ter o corpo que tanto deseja, selecione esta opção. Vamos direcionar um dos membros da MetaFamily para te ajudar neste processo!',
	],
	[
		"id" => 'option-2',
		"title" => 'Ganho de massa muscular',
		"message" => 'Se você percebe que não está alcançando os resultados que deseja nos treinos, está com dificuldade para aumentar a quantidade de massa magra e não sabe o que está fazendo de errado, selecione esta opção. Vamos direcionar um dos membros da MetaFamily para te ajudar neste processo.',
	],
	// [
	// 	"id" => 'option-3',
	// 	"title" => 'Melhorar a performance na corrida de rua ou finalizar uma prova que tanto deseja',
	// 	"message" => 'Se você está tendo dificuldades para reduzir seu pace, bater seu RP, sente dificuldade para concluir aquela prova que se desafiou a fazer e quer saber o que precisa ser feito para reduzir as lesões que a corrida te causam, selecione esta opção. Vamos direcionar um dos membros da MetaFamily para te ajudar nesta jornada!',
	// ],
	[
		"id" => 'option-4',
		"title" => 'Melhorar seu rendimento no tatame',
		"message" => 'Se você quer diminuir as lesões que o desgaste te causa, aumentar o rendimento nos treinos e competições, conquistar títulos ou aguentar mais tempo nos rolas com os amigos, selecione essa opção. Vamos direcionar um dos membros da MetaFamily para te ajudar neste processo!',
	],
	[
		"id" => 'option-5',
		"title" => 'Saúde da mulher',
		"message" => 'Se você sofre com os sintomas da TPM ou pré-menopausa, tem queda de cabelo, celulite, flacidez, retenção de líquidos ou descobriu que tem Síndrome do Ovário Policístico ou Endometriose e quer saber o que precisa fazer para tratar essas desordens, selecione essa opção. Vamos direcionar um dos membros da MetaFamily para te ajudar a chegar nessa meta!',
	],
	[
		"id" => 'option-6',
		"title" => 'Outros',
		"message" => 'Marque esta opção e descreva sua meta no campo “Conte-nos um pouco sobre sua meta!”. Vamos direcionar um dos membros da MetaFamily para te ajudar a chegar nessa meta.',
	],
];



$currentTab = "home";
require_once('header.php');

?>

	<header id="hero" class="bg-lightblue hero-area">
		<div class="header">
			<div class="container">
				<div class="row">
					<div class="col-xl-5 col-12">
						<div class="hero-text">
							<h1>Pessoas transformam o mundo, nós transformamos pessoas.</h1>
							<p class="mt-4">Queremos criar um mundo onde pessoas possam viver incondicionalmente e desfrutar de uma nova perspectiva do senso comum.</p>
							<a class="btn hero-btn mt-4" href="<?= Config::BASE_URL ?>/servicos">COMECE POR AQUI</a>
						</div>
					</div>
					<div class="col-lg-7 col-12">
					</div>
				</div>
			</div>
		</div>
	</header>

	<!-- A Dieta Ideal -->

	<main>
		<!-- <div id="DI-area" class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-5 col-12 text-center title-session">
					<h2>A Dieta Ideal</h2>
					<p>Encontre a dieta ideal para o seu corpo conosco e viva uma vida saudável.</p>
				</div>
			</div>
			<div class="row justify-content-center text-center">
				<div class="col-12 col-md-6 col-lg-4">
					<div class="neo-card DI-card">
						<img class="DI-image" src="<?= $themePath ?>/assets/img/DI-icon1.svg" alt="">
						<div class="DI-text">
							<h3>Os Melhores Alimentos</h3>
							<p>Orientamos onde encontrar todos os alimentos da sua dieta.</p>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 col-lg-4">
					<div class="neo-card DI-card">
						<img class="DI-image" src="<?= $themePath ?>/assets/img/DI-icon2.svg" alt="">
						<div class="DI-text">
							<h3>Dieta Personalizada</h3>
							<p>Sem dietas pré-montadas. Criamos uma dieta nova para cada caso.</p>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 col-lg-4">
					<div class="neo-card DI-card">
						<img class="DI-image" src="<?= $themePath ?>/assets/img/DI-icon3.svg" alt="">
						<div class="DI-text">
							<h3>Foco no Seu Objetivo</h3>
							<p>Montamos e orientamos um cronograma e com base no seu objetivo.</p>
						</div>
					</div>
				</div>
			</div>
		</div> -->

		<!-- Quem Somos -->

		<div id="QuemSomos" class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-5 col-12 text-center title-session">
					<h2>Quem Somos</h2>
					<p>Nossa meta é transformar sua vida</p>
					<p class="text-muted">A escolha por MetaVita se deu por transformar a META dos nossos pacientes na nossa Meta.</p>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-6">
				<img class="img-fix" src="<?= $themePath ?>/assets/img/quem-somos-2.png" alt="">
			</div>
			<div class="col-lg-6 flexbox">
				<div class="QS-text QS-lgtext">
					<h3>Nossa História</h3>
					<p>
						Uma clínica fundada por nutricionistas, a MetaVita surgiu com a ideia de oferecer algo nunca visto antes aos nossos pacientes. Para começar pelo nome, a escolha por MetaVita se deu por transformar a META dos nossos pacientes na nossa Meta.
						<br>
						<br>
						Nosso trabalho é marcado com cordialidade, cortesia, eficiência e harmonia. Buscamos incessavelmente mostrar aos nossos MetaFriends que precisamos ter harmonia em nossa vida e que ninguém vive só de arroz integral. Queremos mostrar à eles que está tudo bem tomar um drink em um barzinho da Emília Marengo com os amigos, ou comer uma pizza na Bráz com a família. Tudo precisa ser feito com harmonia, para que possamos chegar ao resultado que desejamos.
						<br>
						<br>
						Sabemos que pessoas transformam o mundo. Por isso, nós transformamos pessoas.
					</p>
					<a class="btn hero-btn mt-4" href="<?= Config::BASE_URL ?>/sobre">O que é MetaFriends?</a>
				</div>
			</div>
		</div>






		<!-- Conteúdos -->

		<div id="Conteudos" class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-5 col-12 text-center title-session" style="margin-bottom:20px;">
					<h2>Conteúdos</h2>
					<!-- <p>Aprenda mais sobre a sua saúde e como manter a sua dieta.</p> -->
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-lg-6 mb-4">
					<!-- <h3>Aprenda Mais Sobre Saúde</h3> -->
					<p>
						Conheça nossos materiais que já ajudaram mais de 1.000 pessoas a melhorarem a alimentação e encontrarem a melhor versão de si. Aqui você encontra conteúdos sobre esporte, mente, hábitos saudáveis, alimentação, organização, planejamento, prevenção de lesões e muuuito mais.
					</p>
					<div class="CT-item-list">
						<div class="CT-item mt-4">
							<div class="CT-number nc1"><span>1</span></div><p>+ de 50 e-books gratuitos recheados de conteúdo de qualidade.</p>
						</div>
						<div class="CT-item">
							<div class="CT-number nc2"><span>2</span></div><p>+ de 100 e-books EXCLUSIVOS para nossos MetaFriends.</p>
						</div>
						<!-- <div class="CT-item">
							<div class="CT-number nc3"><span>3</span></div><p>80+ Vídeos sobre nutrição exclusivos para clientes.</p>
						</div> -->
					</div>
				</div>
				<div class="col-12 col-lg-6">
					<div class="row CG-item-area">

						<?php foreach ($blogItems as $key => $value) { ?>
							<?php if ($key >= 2) {continue;} ?>
							<div class="col-12 mb-4">
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

						<!-- <div class="col-12">
							<div class="CG-item neo-card"><a href="#">
								<div class="CG-item-img">
									<img src="<?= $themePath ?>/assets/img/BC/BC1.jpg" alt="">
								</div>
								<h3>Estresse, ansiedade e depressão: Como prevenir e tratar através da nutrição.</h3>
								<p>Dra. Gisela Savioli explica o motivo pelo qual nossa sociedade está sofrendo tanto dos chamados males do século XXI.</p>
								<div class="CG-tag">
									<p>Conteúdo Exclusivo</p>
								</div>
								</a>
							</div>
						</div>
						<div class="col-12">
							<div class="CG-item neo-card"><a href="#">
								<div class="CG-item-img">
									<img src="<?= $themePath ?>/assets/img/BC/BC2.jpg" alt="">
								</div>
								<h3>Alimentação e Nutrição nos Ciclos da Vida.</h3>
								<p>Englobando os ciclos da vida como: histórico das políticas públicas de alimentação e nutrição no Brasil.</p>
							</div>
							</a>
						</div>
						<div class="col-12">
							<div class="CG-item neo-card"><a href="#">
								<div class="CG-item-img">
									<img src="<?= $themePath ?>/assets/img/BC/BC3.jpg" alt="">
								</div>
								<h3>Nutrição Moderna de Shils.</h3>
								<p>Montamos e orientamos um cronograma e com base no seu objetivo.</p>
							</div>
							</a>
						</div> -->

					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 text-center my-4">
					<a class="btn btn-padrao" href="<?= Config::BASE_URL ?>/galeria">VEJA A GALERIA COMPLETA</a>
				</div>
			</div>
		</div>





		<!-- Parceiros -->
		<div id="Parceiros" class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-5 col-12 text-center title-session" style="margin-bottom:0px;">
					<h2>Parceiros</h2>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="jcarousel-wrapper">
					<div class="jcarousel">
							<ul>
									<li style="padding:50px;"><img src="<?= $themePath ?>/assets/img/Parceiros/01.png"></li>
									<li style="padding:50px;"><img src="<?= $themePath ?>/assets/img/Parceiros/02.png"></li>
									<li style="padding:50px;"><img src="<?= $themePath ?>/assets/img/Parceiros/03.png"></li>
									<li style="padding:50px;"><img src="<?= $themePath ?>/assets/img/Parceiros/04.png"></li>
									<li style="padding:50px;"><img src="<?= $themePath ?>/assets/img/Parceiros/05.png"></li>
									<li style="padding:50px;"><img src="<?= $themePath ?>/assets/img/Parceiros/06.png"></li>
									<li style="padding:50px;"><img src="<?= $themePath ?>/assets/img/Parceiros/07.png"></li>
									<li style="padding:50px;"><img src="<?= $themePath ?>/assets/img/Parceiros/08.jpg"></li>
									<li style="padding:50px;"><img src="<?= $themePath ?>/assets/img/Parceiros/09.jpg"></li>
									<li style="padding:50px;"><img src="<?= $themePath ?>/assets/img/Parceiros/10.jpg"></li>
							</ul>
					</div>
					<a href="#" class="jcarousel-control-prev">&lsaquo;</a>
					<a href="#" class="jcarousel-control-next">&rsaquo;</a>
					<p class="jcarousel-pagination"></p>
			</div>
		</div>
		<!-- Parceiros -->







		<!-- Contato -->
		<?php foreach ($contactOptions as $key => $value): ?>
			<div class="modal fade" id="<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title"><?= $value['title'] ?></h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body mt-2">
			        <?= $value['message'] ?>
			      </div>
			      <div class="modal-footer">
			        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
			        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
			      </div>
			    </div>
			  </div>
			</div>
		<?php endforeach; ?>







		<div id="Contato" class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-5 col-12 text-center title-session">
					<h2>Fale com a MetaFamily!</h2>
					<p>Se identificou com nossa família? Nos conte em qual meta você precisa de ajuda:</p>
				</div>
			</div>
			<form action="enviar-mensagem" method="post">
			<div class="row">
				<div class="col-12 col-md-5">
					<h3>Selecione quais os seus objetivos</h3>
					<p>De acordo com seus objetivos, podemos orienta-lo melhor com o profissional adequado.</p>
					<div class="CNT-select-area">
						<?php foreach ($contactOptions as $key => $value): ?>
							<div class="CNT-select flexbox">
								<label class="form-container flexdiv" style="padding-right:40px;">
									<?= $value['title'] ?>
									<input type="checkbox" name="<?= $value['id'] ?>" value="<?= $value['title'] ?>">
									<span class="form-checkmark"></span>
								</label>
								<a class="info-button" data-toggle="modal" data-target="#<?= $value['id'] ?>"><img src="<?= $themePath ?>/assets/icons/information.svg" alt=""></a>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="col-12 col-md-7 flexbox">
					<div class="row">
						<div class="col-12 col-md-6">
							<div class="form-group">
								<input type="name" class="form-control form-padrao" aria-describedby="emailHelp" placeholder="Nome" name="name">
							</div>
							<div class="form-group">
								<input type="email" class="form-control form-padrao" aria-describedby="emailHelp" placeholder="E-mail" name="email">
							</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<input type="name" class="form-control form-padrao" aria-describedby="emailHelp" placeholder="Telefone" name="phone">
						</div>
						<div class="form-drop-container">
							<div class="form-group">
								<select class="form-control form-padrao select" name="genero">
									<option disabled selected>Gênero</option>
									<option value="Homem">Homem</option>
									<option value="Mulher">Mulher</option>
									<option value="Outro">Outro</option>
								</select>
							</div>
						</div>
				</div>
			</div>
			<div class="row textarea-flexdiv">
				<div class="col-12">
					<div class="form-group textarea-expand">
						<textarea type="textarea" class="form-control form-padrao" aria-describedby="emailHelp" placeholder="Conte-nos um pouco sobre sua meta! (opcional)" name="message"></textarea>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 text-center">
					<div class="CNT-select CNT-mailing flexbox">
						<label class="form-container flexdiv">
							Deseja receber nossos e-books e vídeos sobre nutrição?
							<input type="checkbox" name="newsletter">
							<span class="form-checkmark"></span>
						</label>
					</div>
					<button type="submit" class="btn btn-padrao">ENVIAR</button>
				</div>
			</div>
		</div>
	</div>
	</form>
</div>

</main>

<?php

require_once('footer.php');

?>
