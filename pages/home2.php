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

<!-- Desktop version -->
<section class="hero-wrap text-center relative desktop-version">
       	<div id="owl-hero" class="owl-carousel owl-theme light-arrows slider-animated">
			<div class="pix-content"><div id="myCarousel" class="carousel slide pix-slider" data-ride="carousel" data-interval="3000">
				<ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1" class=""></li>
					<li data-target="#myCarousel" data-slide-to="2" class=""></li>
				</ol>
				<div class="carousel-inner pix-header-item2">
					<div class="item active">		
         				 <div class="hero-slide" style="background-image:url(images/slider/slider-image-1.png)">
				            <div class="container">
              					<div class="hero-holder">
                					<div class="hero-message">
  						                <div class="pix-slider-btn pix-padding-bottom-80 pix-padding-top-200">
											<h2 class="carousel-title secondary-font"></h2>
											<h5 class="carousel-text secondary-font"></h5>
											<div class="pix-slider-btn pix-padding-top-200">
												<a href="https://api.whatsapp.com/send?phone=5511973755967&text=Ol%C3%A1%2C+estava+no+site+de+voc%C3%AAs+e+gostaria+de+mais+informa%C3%A7%C3%B5es%21" target="_blank" class="btn hero-btn btn-lg pix-white pix-margin-right-5 small-text secondary-font pix-margin-right-20">
											   <span class="pix_edit_text">
												<strong>Saiba Mais</strong>
											   </span>
												</a>
											</div>
										</div>
               						 </div>
       					       </div>
       					    </div>
 				        </div>
					</div>
					<div class="item">
 				        <div class="hero-slide" style="background-image:url(images/slider/slider-image-2.png)">
            				<div class="container">
	            				<div class="hero-holder">
                					<div class="hero-message">
										<div class="pix-slider-btn pix-padding-bottom-80 pix-padding-top-200">
											<h2 class="carousel-title secondary-font"></h2>
											<h5 class="carousel-text secondary-font"></h5>
											<div class="pix-slider-btn pix-padding-top-200">
												<a href="https://api.whatsapp.com/send?phone=5511973755967&text=Ol%C3%A1%2C+estava+no+site+de+voc%C3%AAs+e+gostaria+de+mais+informa%C3%A7%C3%B5es%21" target="_blank" class="btn hero-btn btn-lg pix-white pix-margin-right-5 small-text secondary-font pix-margin-right-20">
													<span class="pix_edit_text">
														<strong>Saiba Mais</strong>
													</span>
												</a>
											</div>
										</div>
                  					</div>
                				</div>
			            	</div>
		            	</div>
		        	</div>
					<div class="item">
			        	<div class="hero-slide" style="background-image:url(images/slider/slider-image-3.png)">
            				<div class="container">
              					<div class="hero-holder">
				    	            <div class="hero-message">
										<div class="pix-slider-btn pix-padding-bottom-80 pix-padding-top-200">
											<h2 class="carousel-title secondary-font"></h2>
											<h5 class="carousel-text secondary-font"></h5>
											<div class="pix-slider-btn pix-padding-top-200">
												<a href="https://api.whatsapp.com/send?phone=5511973755967&text=Ol%C3%A1%2C+estava+no+site+de+voc%C3%AAs+e+gostaria+de+mais+informa%C3%A7%C3%B5es%21" target="_blank" class="btn hero-btn btn-lg pix-white pix-margin-right-5 small-text secondary-font pix-margin-right-20">
											   <span class="pix_edit_text">
												<strong>Saiba Mais</strong>
											   </span>
												</a>
											</div>
										</div>	
						    	    </div>
              					</div>
            				</div>
          				</div>
        			</div>
				</div>
				<a class="left carousel-control" href="#myCarousel" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span>
					<span class="sr-only">Anterior</span>
				</a>
				<a class="right carousel-control" href="#myCarousel" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right"></span>
					<span class="sr-only">Próximo</span>
				</a>
			</div>	
		</div>		
    </section>
<!-- Desktop version -->
<!-- Mobile version -->
<div class="pix_section mobile-version" id="section_sliders_1">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-xs-12 col-sm-12 column ui-droppable">
				<div class="pix-content">
					<div id="myCarousel" class="carousel slide pix-slider" data-ride="carousel" data-interval="3000">
						<ol class="carousel-indicators">
							<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
							<li data-target="#myCarousel" data-slide-to="1" class=""></li>
							<li data-target="#myCarousel" data-slide-to="2" class=""></li>
						</ol>
						<div class="carousel-inner pix-header-item2">
							<div class="item active">
								<img src="images/slider/slider-image-1.png" alt="slider-image-1">
								<div class="carousel-caption">
									<h2 class="carousel-title secondary-font"></h2>
									<h5 class="carousel-text secondary-font"></h5>
									<div class="pix-slider-btn btn-xs pix-padding-top-100">
										<a href="https://api.whatsapp.com/send?phone=5511973755967&text=Ol%C3%A1%2C+estava+no+site+de+voc%C3%AAs+e+gostaria+de+mais+informa%C3%A7%C3%B5es%21" target="_blank" class="btn hero-btn btn-lg pix-white pix-margin-right-5 small-text secondary-font pix-margin-right-20">
									   <span class="pix_edit_text">
										<strong>Saiba Mais</strong>
									   </span>
										</a>
									</div>
								</div>
							</div>
							<div class="item">
								<img src="images/slider/slider-image-2.png" alt="slider-image-2">
								<div class="carousel-caption">
									<h2 class="carousel-title secondary-font"></h2>
									<h5 class="carousel-text secondary-font"></h5>
									<div class="pix-slider-btn btn-xs pix-padding-top-100">
										<a href="https://api.whatsapp.com/send?phone=5511973755967&text=Ol%C3%A1%2C+estava+no+site+de+voc%C3%AAs+e+gostaria+de+mais+informa%C3%A7%C3%B5es%21" target="_blank" class="btn hero-btn btn-lg pix-white pix-margin-right-5 small-text secondary-font pix-margin-right-20">
									   <span class="pix_edit_text">
										<strong>Saiba Mais</strong>
									   </span>
										</a>
									</div>
								</div>
							</div>
							<div class="item">
								<img src="images/slider/slider-image-3.png" alt="slider-image-3">
								<div class="carousel-caption">
									<h2 class="carousel-title secondary-font"></h2>
									<h5 class="carousel-text secondary-font"></h5>
									<div class="pix-slider-btn btn-xs pix-padding-top-100">
										<a href="https://api.whatsapp.com/send?phone=5511973755967&text=Ol%C3%A1%2C+estava+no+site+de+voc%C3%AAs+e+gostaria+de+mais+informa%C3%A7%C3%B5es%21" target="_blank" class="btn hero-btn btn-lg pix-white pix-margin-right-5 small-text secondary-font pix-margin-right-20">
									   <span class="pix_edit_text">
										<strong>Saiba Mais</strong>
									   </span>
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
</div>

<!-- Mobile version -->

	<!-- A Dieta Ideal -->

	<main>
		

		<!-- Quem Somos --> 
		<!--
		<div id="QuemSomos" class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-5 col-12 text-center title-session">
					<h2>Quem Somos</h2>
					<p>Nossa meta é transformar sua vida</p>
					<p class="text-muted">A escolha por MetaVita se deu por transformar a META dos nossos pacientes na nossa Meta.</p>
				</div>
			</div>
		</div>
		-->

		<div class="pix-padding-top-10 pix-padding-bottom-60" style="display: block;">
			<div class="row">
				<div class="col-lg-6">
					<img class="img-fix" src="<?= $themePath ?>/assets/img/quem-somos-2.png" alt="">
				</div>
				<div class="col-lg-6 flexbox">
					<div class="QS-text QS-lgtext">
					<h3 class="pix-dark-green pix-no-margin-top pix-sm-lineheight pix-margin-bottom-20">
					<span class="pix_edit_text"><strong>Nossa História</strong></span>
					</h3>
						<p>
						A Clínica Metavita foi idealizada por uma equipe de nutricionistas e, inicialmente, seguia apenas com atendimentos nutricionais. Com o passar do tempo, a equipe observou que o sucesso de um bom atendimento e evolução do paciente, não se resumia ao cuidado de apenas uma área da sua vida.
						<br>
						Entendendo que o ser humano necessita de um cuidado integrativo, a clínica evoluiu para o segmento multidisciplinar, onde o paciente é cuidado e assistido em diversas áreas da saúde num mesmo lugar.
						</p>
						<a class="btn hero-btn mt-4" href="https://api.whatsapp.com/send?phone=5511973755967&text=Ol%C3%A1%2C+estava+no+site+de+voc%C3%AAs+e+gostaria+de+mais+informa%C3%A7%C3%B5es%21" target="_blank"><strong>Quero mais informações sobre o atendimento</strong></a>
					</div>
				</div>
			</div>
		</div>


		<div class="pix_section pix-padding-v-75 footerbg2">
		<div class="container">
			<div class="row">
				<div class="col-md-10 col-xs-12">
					<div class="pix-content">
						<h3 class="pix-dark-green pix-no-margin-top pix-sm-lineheight pix-margin-bottom-20">
							<span class="pix_edit_text"><strong>Nosso Propósito </strong></span>
						</h3>
						<span class="pix_edit_text pix-green-gray">
						A Equipe de profissionais da Metavita tem como visão principal o cuidado integrativo e humanizado do paciente. Temos como base otimizar a sua saúde, fornecendo um atendimento de excelência e individualizado, de acordo com as suas demandas.
						<br>
						Entendemos que por meio de um bom atendimento médico somado ao acompanhamento nutricional, será possível cuidar da sua saúde de forma detalhada, com o suporte de exames complementares e assim, equilibrar o seu corpo para que ele funcione da melhor forma, proporcionando longevidade e qualidade de vida. 
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>


		<div class="pix_section pix-padding-top-30 pix-padding-bottom-30 pix-showcase-1">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<div class="pix-content text-center pix-padding-top-10 pix-padding-bottom-30">
						<h1 class="pix-white text-center pix-no-margin-top secondary-font">
							<span class="pix_edit_text"><strong>Fale com a Metavita</strong></span>
						</h1>
						<p class="pix-light-gray big-text-20 text-center pix-margin-bottom-30">
							<span class="pix_edit_text">Se identificou com o nosso método de atendimento? Nos conte como podemos te ajudar</span>
						</p>
						<a href="https://api.whatsapp.com/send?phone=5511973755967&text=Ol%C3%A1%2C+estava+no+site+de+voc%C3%AAs+e+gostaria+de+mais+informa%C3%A7%C3%B5es%21" target="_blank" class="btn bg-lg hero-btn btn-lg pix-white wide">
							<span class="pix_edit_text">
								<strong>Entre em contato</strong>
								<i class="pixicon-whatsapp2 pix-white"></i>
							</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="pix_section pix-padding-v-50">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<div class="pix-content pix-padding-bottom-40">
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
				<div class="col-12 text-center my-4 pix_edit_text">
					<a class="btn btn-padrao pix-white" href="<?= Config::BASE_URL ?>/galeria"><strong>VEJA A GALERIA COMPLETA</strong></a>
				</div>
			</div>
		</div>

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


<!-- Parceiros --><!--
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


		<!-- Antigo MetaFamily -->
		<!--<div id="Contato" class="container">
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
</div>-->

</main>
</html>
<?php

require_once('footer.php');

?>
