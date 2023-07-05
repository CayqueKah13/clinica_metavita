<?php
require __DIR__ . '/../source/autoload.php';

use \Source\Themes\AdminTheme;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;



$currentTab = "services";
require_once('header.php');

$whatsappLink = "https://wa.me/5511973755967?text=Informa%C3%A7%C3%B5es%20da%20consulta";

?>
<style media="screen">
	.landing-features-list-item {
		color: #3f4755;
		font-size:21px;
		margin-bottom:35px;
	}
	.landing-features-list-item .fas {
		font-style: normal;
		margin-right: 10px;
	}
	.landing-help-list-item {
		color: #3f4755;
		margin-bottom:35px;
	}
	.landing-help-list-item .fas {
		font-size: 45px;
		font-style: normal;
		margin-right: 10px;
	}
	.landing-help-list-item h6 {
		font-size: 18px;
		font-weight: 700;
	}
	.landing-help-list-item p {
		font-size:16px;
	}
	.img-rating {
		max-width: 100%;
		padding: 0 70px ;
	}
	.row {
		margin:0;
	}

	@media only screen and (max-width: 768px) {
		.landing-help-list-item .fas {
			font-size: 35px;
			font-style: normal;
			margin-right: 10px;
		}
		.img-rating {
			padding: 0;
		}
}
</style>

<main>
	<div id="QuemSomos" class="container">
		<div class="row">
			<div class="col-md-6 col-lg-5 col-12 text-center title-session" style="margin: 60px 0;">

			</div>
		</div>

	</div>

	<div class="row py-5 px-3" style="background-color: rgb(234, 238, 234);">
		<div class="container text-center">
			<span style="font-size:30px;line-height: 40px;">Você é apaixonado por esportes coletivos e/ou individuais mas não consegue ter um bom rendimento nos seus treinos?</span>
			<p class="mt-3">
				Se você quer participar de uma prova de corrida, natação, ciclismo ou um campeonato de tenis e conquistar o seu melhor resultado, se sentir mais disposto nos treinos ou apenas competir e ter um bom rendimento, estamos aqui para te mostrar que é possível e que a alimentação será seu combustível para dar o seu melhor nesses esportes!
				<br>
				<br>
				O nosso papel como nutricionistas é te mostrar que é possível ter resultados e performance sem sofrimentos e que, se você quiser, você pode superar qualquer meta e/ou recorde pessoal!
			</p>
		</div>
	</div>

	<div class="row" style="background-color: rgba(32, 36, 39, 1);">
		<div class="container text-center">

			<div class="row px-3">
				<!-- <div class="col-md-3">
					<img src="<?= $themePath ?>/assets/img/roberta.jpg" style="border-radius:50%;" class="mt-5">
				</div> -->
				<div class="col-md-12">
					<!-- <h3 class="mt-5" style="font-size:30px;color:#ffffff;">CONHEÇA A METODOLOGIA DA CLÍNICA METAVITA</h3> -->
					<p class="mb-5 pt-5" style="color:#ffffff;text-align:center;font-size:21px">
					Em nossa equipe profissional contamos com Nutricionistas que são praticantes de esportes de endurance e já participaram de diversas competições, das mais variadas.
					<br>
					<br>	
					Por praticar esse esporte por anos, trazemos nossas vivências práticas de treinos e provas e alinhamos junto às estratégias Nutricionais, baseadas em conhecimentos técnico científicos.
					</p>
				</div>
			</div>

		</div>
	</div>





	<div class="container py-5">
		<div class="text-center mb-5">
			<h4 style="font-size:30px;color:#3f4755;margin-bottom:50px;font-weight:700;">Como eu sei que este acompanhamento é para mim?</h4>
			<span  style="color:rgb(71, 200, 204);font-weight:700;font-size:30px;">Vamos lá:</span>
		</div>


		<div class="row">
			<div class="col-md-5">
				<ul style="list-style-type:none;">
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Você sente que precisa ajustar sua alimentação para evoluir no esporte e atingir seus recordes pessoais?</li>
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Você ama o esporte que você pratica, mas não está satisfeito com os seus resultados?</li>
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Você acha que terá uma alimentação restrita e precisará abrir mão do que mais gosta de comer?</li>
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Você sente cãibras e dores musculares após os treinos ou provas além de sofrer com lesões frequentes?</li>
				</ul>
			</div>
			<div class="col-md-2"></div>
			<div class="col-md-5">
				<ul style="list-style-type:none;">
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Você se frustra por sentir que se esforça muito e mesmo assim não diminui seu tempo nas provas e/ou treinos? Ou se sente cansado muito cansado durante as competições?</li>
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Você sente dores de cabeça frequentes ou tontura não sabe qual é causa?</li>
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Você acredita que vai precisar gastar muito dinheiro com alimentação e suplementação?</li>
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Sempre que os treinos ficam mais intensos sua imunidade cai e você não sabe o porquê surge aquele resfriado ou coriza?</li>
				</ul>
			</div>
		</div>

		<div class="text-center">
			<p class="mb-3" style="font-size:30px;font-weight:700;">Se você disse <span style="color:red;">SIM</span> para a maioria das perguntas, este é o acompanhamento certo para você!</p>

			<a class="btn hero-btn mt-4" target="_blank" href="<?= $whatsappLink ?>" style="width: 100%;padding:22px;">QUERO TER MAIS INFORMAÇÕES DE COMO FUNCIONA O ACOMPANHAMENTO</a>
		</div>
	</div>





	<div class="row px-3" style="background-color: rgba(17, 1, 1, 0.98);">
		<div class="container text-center py-5">

			<h5 style="color:#1faa8b;font-size:32px;font-weight:400;">CHEGOU A HORA DE VOCÊ ENTENDER COMO VAMOS TE AJUDAR!</h5>
			<p class="my-5" style="color:#ffffff;font-size:21px">
				Acreditamos que junto à prática esportiva a alimentação nos possibilita conquistar resultados de superação, e que estas pequenas conquistas nos impulsionam a extrapolar esses avanços para as demais áreas da nossa vida.
			<br>
			<br>
				Entendemos que as pessoas têm rotinas de vida corrida e que é difícil alinhar tudo, no entanto por sermos inseridos nesse contexto possuímos diversas estratégias para que você alinhe sua vida cotidiana com sua prática esportiva, convívio social, trabalho e estudos a uma boa alimentação que contemple todos os seus gostos, porém adequados as suas necessidades individuais.
			</p>
			<!-- <h5 style="color:#1faa8b;font-size:32px;font-weight:400;">Então, se você já se convenceu a embarcar nesse mundo VEGGIE, bora entender como vou te ajudar!</h5> -->
		</div>
	</div>


	<div class="container py-5">
			
		
			<div class="row px-3 text-center">
				<div class="col-md-3" style="text-align: center;display: block;margin: 0 auto;">
					<img src="<?= $themePath ?>/assets/img/roberta_2.jpg" style="border-radius:15%;">
					<h3>Roberta Beltrame</h3>
				</div>
				<div class="col-md-3" style="text-align: center;display: block;margin: 0 auto;">
					<img src="<?= $themePath ?>/assets/img/lucas.jpg" style="border-radius:15%;">
					<h3>Lucas Scalabrin</h3>
				</div>
				<div class="col-md-3" style="text-align: center;display: block;margin: 0 auto;">
					<img src="<?= $themePath ?>/assets/img/vinicius.jpg" style="border-radius:15%;">
					<h3>Vinicius Moura</h3>
				</div>
				<div class="col-md-3" style="text-align: center;display: block;margin: 0 auto;">
					<img src="<?= $themePath ?>/assets/img/joao_9.jpg" style="border-radius:15%;">
					<h3>João Morais</h3>
				</div>
				<div class="col-md-3" style="text-align: center;display: block;margin: 0 auto;">
					<img src="<?= $themePath ?>/assets/img/michael.jpg" style="border-radius:15%;">
					<h3>Michael Martini</h3>
				</div>
			</div>

			<div class="text-center">
				<a class="btn hero-btn mt-4" target="_blank" href="<?= $whatsappLink ?>" style="width: 100%;padding:22px;">Vamos agendar sua consulta?</a>
			</div>
	</div>


	
	<div class="row px-3" style="background-color: rgba(17, 1, 1, 0.98);">
		<div class="container text-center py-3">
			<p style="color:#ffffff;font-size:20px;font-weight:400;">
				O que você viu até aqui não foi o suficiente para te convencer?
				</br>
				Então veja nossos resultados e o que dizem do nosso trabalho nas avaliações do Google!
			</p>
		</div>
	</div>

	<div class="px-3 mb-5">
		<div class="row px-5 text-center">
			<div class="col-md-6 mt-5"><img src="<?= $themePath ?>/assets/img/rating-12.jpeg"></div>
			<div class="col-md-6 mt-5"><img src="<?= $themePath ?>/assets/img/rating-13.jpeg"></div>
			<div class="col-md-6 mt-5"><img src="<?= $themePath ?>/assets/img/rating-14.jpeg"></div>
			<div class="col-md-6 mt-5"><img src="<?= $themePath ?>/assets/img/rating-15.jpeg"></div>
			<div class="col-md-6 mt-5"><img src="<?= $themePath ?>/assets/img/rating-16.jpeg"></div>
			<div class="col-md-6 mt-5"><img src="<?= $themePath ?>/assets/img/rating-17.jpeg"></div>
			<div class="col-md-6 mt-5"><img src="<?= $themePath ?>/assets/img/rating-18.jpeg"></div>
			<div class="col-md-6 mt-5"><img src="<?= $themePath ?>/assets/img/rating-19.jpeg"></div>
			<div class="col-md-6 mt-5"><img src="<?= $themePath ?>/assets/img/rating-20.jpeg"></div>
		</div>

		<div class="container">
			<div class="text-center">
				<a class="btn hero-btn mt-4" target="_blank" href="<?= $whatsappLink ?>" style="width: 100%;padding:22px;">AGENDAR ATENDIMENTO</a>
			</div>
		</div>
	</div>


	<div class="row py-5 px-3" >
		<div class="container text-center">
			<div class="row">
				<div class="col-md-12 px-2 py-2">
					<img class="img-rating" style="max-width:600px;" src="<?= $themePath ?>/assets/img/rating-1.jpeg">
					<p style="margin-top:20px;font-size:16px;">Estamos em uma travessa da Radial Leste</p>
					<a class="btn hero-btn mt-4" href="https://maps.google.com/?q=Rua%20Vilela,%20652%20-%20Tatuap%C3%A9,%20S%C3%A3o%20Paulo%20-%20SP">Ver Localização</a>
				</div>
			</div>
		</div>
	</div>


</main>
<?php

require_once('footer.php');

?>
