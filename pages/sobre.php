<?php
require __DIR__ . '/../source/autoload.php';

use \Source\Themes\AdminTheme;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;


$currentTab = "about";
require_once('header.php');




//$profissionais = [
	// [
	//	"name" => "João Morais",
	//	"title" => "Nutricionista",
	//	"subtitle" => "Especialista em aumentar o rendimento de praticantes e lutadores de jiu jitsu.",
	//	"img" => $themePath."/assets/img/Team/joao_6.jpg"
	// ],
	// [
	// 	"name" => "Mariana Paiva",
	// 	"title" => "Nutricionista",
	// 	"subtitle" => "Ajuda praticantes de corrida de rua a melhorarem o desempenho",
	// 	"img" => $themePath."/assets/img/Team/mariana-2.jpg"
	// ],
	// [
	// 	"name" => "Filipe Cortez",
	// 	"title" => "",
	// 	"subtitle" => "",
	// 	"img" => $themePath."/assets/img/Team/filipe.jpg"
	// ],
	// [
	// 	"name" => "Carolina Zanetti",
	// 	"title" => "Nutricionista",
	// 	"subtitle" => "Estou aqui para ajudar você que quer emagrecer 10kg, comendo de tudo! Tornando a comida sua amiga, e não inimiga!",
	// 	"img" => $themePath."/assets/img/Team/carolina_4.jpg"
	// ],
	// [
	//	"name" => "Michael Martini",
	//	"title" => "Nutricionista",
	//	"subtitle" => "Especialista em melhorar o shape de praticantes de musculação e crossfit.",
	//	"img" => $themePath."/assets/img/Team/michael.jpg"
	// ],
	// [
	// 	"name" => "Tatiana  Laterza",
	// 	"title" => "Acupunturista",
	// 	"subtitle" => "Através do conhecimento milenar da Medicina Tradicional Chinesa é possível amenizar e tratar sintomas físicos e emocionais.",
	// 	"img" => $themePath."/assets/img/Team/tatiana.jpg"
	// ],
	// [
	// 	"name" => "Fernanda Kimie",
	// 	"title" => "",
	// 	"subtitle" => "",
	// 	"img" => $themePath."/assets/img/Team/fernanda.jpg"
	// ],
// ];

?>
<!DOCTYPE html>
<html>
<head>
	<!-- CSS and JavaScript files -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css?v=2" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.min.css" />
	<link rel="stylesheet" type="text/css" href="css/main.css"/>
	<link rel="stylesheet" type="text/css" href="css/font-style.css" />
	<script src="js/jquery-1.11.2.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/velocity.min.js"></script>
	<script src="js/velocity.ui.min.js"></script>
	<script src="js/jquery.fancybox.min.js"></script>
	<script src="js/custom.js"></script>
</head>




		<!-- Quem Somos -->
<main>

<div class="pix_section pix-padding-top-30 pix-padding-bottom-20">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<div class="pix-content pix-padding-bottom-30">
						<h2 class="pix-black-gray-dark text-center pix-no-margin-top secondary-font">
							<span class="pix_edit_text"><strong>Nossa meta é transformar sua vida</strong></span>
						</h2>
						<p class="pix-black-gray-light big-text text-center">
							<span class="pix_edit_text">A escolha por MetaVita se deu por transformar a META dos nossos pacientes na nossa Meta.</span>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>


<!--NOSSA HISTÓRIA-->
	<div class="pix_section pix-padding-v-20 white-bg">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-xs-12 text-center">
					<img src="images/recepcao_3.png" alt="" class="img-responsive">
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="pix-content pix-padding-top-80">
						<h2 class="pix-dark-black pix-no-margin-top secondary-font">
							<span class="pix_edit_text"><strong>Nossa História</strong></span>
						</h2>
						<p class="pix-black-gray-dark big-text pix-margin-bottom-20">
							<span class="pix_edit_text">
								A Clínica Metavita foi idealizada por uma equipe de nutricionistas e, inicialmente, seguia apenas com atendimentos nutricionais. Com o passar do tempo, a equipe observou que o sucesso de um bom atendimento e evolução do paciente, não se resumia ao cuidado de apenas uma área da sua vida.
								<br>
								Entendendo que o ser humano necessita de um cuidado integrativo, a clínica evoluiu para o segmento multidisciplinar, onde o paciente é cuidado e assistido em diversas áreas da saúde num mesmo lugar.
							</span>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
<!--NOSSA HISTÓRIA-->

</main>

<div class="pix_section pix-padding-v-30">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<div class="pix-content pix-padding-bottom-30">
						<h2 class="pix-black-gray-dark text-center pix-no-margin-top">
							<span class="pix_edit_text"><strong>Conheça Nossa Equipe</strong></span>
						</h2>
					</div>
				</div>
						<div class="col-md-4 col-xs-12">
								<div class="pix-content pix-radius-3 gray-bg pix-padding-h-20 pix-padding-v-30 text-center pix-margin-v-10">
									<div class="pix-round-shape-140">
										<img src="images/fernando.jpg" alt="">
									</div>
									<h5 class="pix-black-gray-dark pix-no-margin-bottom">
										<span class="pix_edit_text"><strong>Fernando Adolpho</strong></span>
									</h5>
									<h6 class="pix-brown pix-no-margin-top">
										<span class="pix_edit_text"><strong>Médico</strong></span>
									</h6>
									<a href="https://www.instagram.com/feadolpho/" target="_blank" class="small-social">
										<i class="pixicon-instagram4 big-icon-50 pix-slight-white"></i>
									</a>
								</div>
							</div>
							<div class="col-md-4 col-xs-12">
								<div class="pix-content pix-radius-3 gray-bg pix-padding-h-20 pix-padding-v-30 text-center pix-margin-v-10">
									<div class="pix-round-shape-140">
										<img src="images/joao.jpg" alt="">
									</div>
									<h5 class="pix-black-gray-dark pix-no-margin-bottom">
										<span class="pix_edit_text"><strong>João Morais</strong></span>
									</h5>
									<h6 class="pix-brown pix-no-margin-top">
										<span class="pix_edit_text"><strong>Nutricionista</strong></span>
									</h6>
									<a href="https://www.instagram.com/joaomoraisnutri/" target="_blank" class="small-social">
										<i class="pixicon-instagram4 big-icon-50 pix-slight-white"></i>
									</a>
								</div>
							</div>
							<div class="col-md-4 col-xs-12">
								<div class="pix-content pix-radius-3 gray-bg pix-padding-h-20 pix-padding-v-30 text-center pix-margin-v-10">
									<div class="pix-round-shape-140">
										<img src="images/lucas.jpg" alt="">
									</div>
									<h5 class="pix-black-gray-dark pix-no-margin-bottom">
										<span class="pix_edit_text"><strong>Lucas Scalabrin</strong></span>
									</h5>
									<h6 class="pix-brown pix-no-margin-top">
										<span class="pix_edit_text"><strong>Nutricionista</strong></span>
									</h6>
									<a href="https://www.instagram.com/lucas.scalabrin.nutri/" target="_blank" class="small-social">
										<i class="pixicon-instagram4 big-icon-50 pix-slight-white"></i>
									</a>
								</div>
							</div>

								<div class="col-md-4 col-xs-12">
									<div class="pix-content pix-radius-3 gray-bg pix-padding-h-20 pix-padding-v-30 text-center pix-margin-v-10">
										<div class="pix-round-shape-140">
											<img src="images/michael.jpg" alt="">
										</div>
										<h5 class="pix-black-gray-dark pix-no-margin-bottom">
											<span class="pix_edit_text"><strong>Michael Martini</strong></span>
										</h5>
										<h6 class="pix-brown pix-no-margin-top">
											<span class="pix_edit_text"><strong>Nutricionista</strong></span>
										</h6>
										<a href="https://www.instagram.com/michaelmartininutri/" target="_blank" class="small-social">
											<i class="pixicon-instagram4 big-icon-50 pix-slight-white"></i>
										</a>
										</div>
								</div>		
								<div class="col-md-4 col-xs-12">
									<div class="pix-content pix-radius-3 gray-bg pix-padding-h-20 pix-padding-v-30 text-center pix-margin-v-10">
										<div class="pix-round-shape-140">
											<img src="images/roberta_2.jpg" alt="">
										</div>
										<h5 class="pix-black-gray-dark pix-no-margin-bottom">
											<span class="pix_edit_text"><strong>Roberta Beltrame</strong></span>
										</h5>
										<h6 class="pix-brown pix-no-margin-top">
											<span class="pix_edit_text"><strong>Nutricionista</strong></span>
										</h6>
										<a href="https://www.instagram.com/robertabeltrame/" target="_blank" class="small-social">
											<i class="pixicon-instagram4 big-icon-50 pix-slight-white"></i>
										</a>
									</div>
								</div>
								<div class="col-md-4 col-xs-12">
									<div class="pix-content pix-radius-3 gray-bg pix-padding-h-20 pix-padding-v-30 text-center pix-margin-v-10">
										<div class="pix-round-shape-140">
											<img src="images/vinicius.jpg" alt="">
										</div>
										<h5 class="pix-black-gray-dark pix-no-margin-bottom">
											<span class="pix_edit_text"><strong>Vinícius Moura</strong></span>
										</h5>
										<h6 class="pix-brown pix-no-margin-top">
											<span class="pix_edit_text"><strong>Nutricionista</strong></span>
										</h6>
										<a href="https://www.instagram.com/viniciusmoura_nutri/" target="_blank" class="small-social">
										<i class="pixicon-instagram4 big-icon-50 pix-slight-white"></i>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>		

<main>


		<!-- MVV -->

		<div class="MVV-bg">
			<div class="MVV-mask">
			<div class="container">
				<div class="row">
					<div class="col-12 col-md-4 MVV-item">
						<h3>Missão</h3>
						<p>Contribuir com uma sociedade humanizada, auxiliando pessoas a fortalecerem os 4 pilares de uma vida plena e, assim, encontrarem a melhor versão de si.</p>
					</div>
					<div class="col-12 col-md-4 MVV-item">
						<h3>Visão</h3>
						<p>Criar um mundo onde as pessoas possam viver incondicionalmente e desfrutar de uma nova perspectiva do senso comum.</p>
					</div>
					<div class="col-12 col-md-4 MVV-item">
						<h3>Valores</h3>
						<p>Honestidade</p>
						<p>Propósito</p>
						<p>Energia</p>
						<p>Criatividade</p>
						<p>Melhoria Contínua</p>
					</div>
				</div>
			</div>
			</div>
		</div>

		

		<!-- Pilares -->
		<div class="container">
			<div class="text-center" style="display: block;margin: 100px auto 50px auto;">
				<h3>4 PILARES</h3>
				<p>
					Nós da MetaVita entendemos que a vida é excepcional e para aproveitar cada momento, é necessário cuidar da saúde. A prevenção de saúde buscando por melhora na performance esportiva ou por uma longevidade saudável, com energia e disposição para curtir a família, amigos, conhecer lugares incríveis é o que almejamos com nossos atendimentos.
					<br>
					<br>
					Para chegar nessas metas, priorizamos o fortalecimento dos 4 pilares de uma vida plena, que são: alimentação, atividades físicas, mente, repouso. Entenda um pouco de cada um destes pilares
				</p>
			</div>
		</div>

		<h4 class="text-center" style="font-size:15pt;">Metodologia baseada nos 4 pilares de uma vida saudável</h4>
		<div class="">
			<div class="MVV-mask" style="padding-top: 20px;padding-bottom: 20px;">
			<div class="container">
				<div class="row">
					<div class="col-12 col-md-3 MVV-item" style="height: 50px;padding: 0;"><h3 style="line-height:50px;">Alimentação</h3></div>
					<div class="col-12 col-md-3 MVV-item" style="height: 50px;padding: 0;"><h3 style="line-height:50px;">Exercício Físico</h3></div>
					<div class="col-12 col-md-3 MVV-item" style="height: 50px;padding: 0;"><h3 style="line-height:50px;">Descanso</h3></div>
					<div class="col-12 col-md-3 MVV-item" style="height: 50px;padding: 0;"><h3 style="line-height:50px;">Saúde Mental</h3></div>
				</div>
			</div>
			</div>
		</div>

		<div class="container">
			<div class="" style="display: block;margin: 50px auto 0 auto;">
				<h3>ALIMENTAÇÃO</h3>
				<p>
					Nosso corpo precisa de energia para desempenhar funções necessárias do dia a dia. Andar, acordar, respirar, fazer atividades físicas, manter a sua imunidade são funções essenciais que o nosso corpo desempenha e que, se não tivermos energia de boa qualidade, começaremos a desempenhar de forma errada e trazer prejuízos ao nosso corpo: imunidade baixa e resfriados recorrentes, indisposição, fraqueza, cansaço em excesso e queda de cabelo são alguns sinais de que nosso corpo não está desempenhando da melhor forma.
				</p>
			</div>
		</div>

		<div class="container">
			<div class="" style="display: block;margin: 50px auto 0 auto;">
				<h3>EXERCÍCIO FÍSICO</h3>
				<p>
					A prática de atividades físicas é indispensável no fortalecimento do seu maior bem, o seu corpo! Pois é, você vive em uma fortaleza que precisa de diversos cuidados para se manter bem, as atividades físicas fortalecem essa fortaleza e fazem com que você tenha mais disposição, livra o estresse, eleva a produção de diversos hormônios e também previne uma série de doenças.
				</p>
			</div>
		</div>

		<div class="container">
			<div class="" style="display: block;margin: 50px auto 0 auto;">
				<h3>SAÚDE MENTAL</h3>
				<p>
					A mente manda e o corpo obedece! É importantíssimo saber lidar com as emoções e não descontá-las na comida. Utilizamos estratégias e trabalho interdisciplinar para prevenir e tratar sintomas de ansiedade, depressão, baixa autoestima e diversos outros relatos dos nossos MetaFriends.
				</p>
			</div>
		</div>

		<div class="container">
			<div class="" style="display: block;margin: 50px auto 0 auto;">
				<h3>DESCANSO</h3>
				<p>
					Nosso corpo precisa de momentos de descanso para que seja possível recuperar as energias e o desgaste muscular de um dia de atividades, para isso, não podemos deixar de lado o sono! Em atendimento com os membros da MetaFamily, cuidamos do seu sono com muito carinho e aplicamos estratégias que têm comprovações científicas de eficácia, sempre pensando no melhor aos nossos MetaFriends.
				</p>
			</div>
		</div>
		<!-- Pilares -->





















</main>

<?php

require_once('footer.php');

?>
