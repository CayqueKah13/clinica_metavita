<?php
require __DIR__ . '/../source/autoload.php';

use \Source\Themes\AdminTheme;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;



$currentTab = "services";
require_once('header.php');

$whatsappLink = "https://wa.me/5511900000000?text=Informa%C3%A7%C3%B5es%20da%20consulta";

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
			<span style="font-size:30px;line-height: 40px;">Você é Vegetariano ou Vegano e quer adequar sua alimentação para que não te falte nenhum nutriente?</span>
			<p class="mt-3">
				Se você parou de consumir carne ou excluiu os alimentos de origem animal do seu cardápio e não sabe o que comer para obter os nutrientes necessários para o seu organismo, estamos aqui para te auxiliar nessa jornada e mostrar que é totalmente possível seguir um padrão alimentar vegetariano e ter a saúde em dia.
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
					<!-- <h3 class="mt-5" style="font-size:30px;color:#ffffff;">Oi! Eu sou a <span style="color:#1faa8b;">Roberta Ciudi</span>!</h3> -->
					<p class="mb-5 pt-5" style="color:#ffffff;text-align:center;font-size:21px">
						Em nossa equipe profissional contamos com Nutricionistas que são vegetarianos ou possuem afinidade com este padrão alimentar e junto com a prática do dia a dia aliado à ciência, desenvolvem – de acordo com as suas necessidades e demandas -- protocolo nutricional equilibrado e alinhado com a sua rotina e com o que você mais gosta de comer.
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
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Você sente que precisa ajustar sua alimentação para para ter refeições mais equilibradas?</li>
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Você acha que terá uma alimentação restrita e precisará abrir mão do que mais gosta de comer?</li>
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Você tem receio que uma alimentação vegetariana irá te trazer deficiências nutricionais?</li>
				</ul>
			</div>
			<div class="col-md-2"></div>
			<div class="col-md-5">
				<ul style="list-style-type:none;">
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Você pensa em substituir a carne de algumas refeições mas não sabe o que comer no lugar dela?</li>
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Você sente dores de cabeça frequentes, tontura ou cansaço e não sabe qual é causa?</li>
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Você acredita que vai precisar gastar muito dinheiro com alimentação e suplementação?</li>
					<!-- <li class="landing-features-list-item"><i class="fas fa-check-circle"></i> </li> -->
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
				Acreditamos que o básico funciona e por isso, nossa maior ferramenta de trabalho é o alimento. Através de uma conversa minuciosa, iremos analisar e entender sobre os seus objetivos, rotina, hábitos alimentares e corrigir algumas desordens nutricionais que podem ser que te acompanhem. 
			<br>
			<br>
				Sim, dá para ser vegetariano e não usar nenhuma suplementação e/ou ter que consumir alimentos mirabolantes. Você não precisa, e nem deve achar que irá precisar suplementar muitas vitaminas para ter saúde. Uma alimentação de qualidade e nutricionalmente adequada fará todo esse trabalho.
			<br>
			<br>
				Também não precisa ter medo e pensar que sua dieta será monótona, muito pelo contrário! Nosso trabalho também consiste em te estimular a conhecer novos sabores e variar o seu prato o máximo possível e, quem sabe, até se aventurar na cozinha seguindo algumas receitas que nossa equipe de Nutricionistas pode te fornecer.
			<br>
			<br>
				Para isso, o acompanhamento é muito focado na sua individualidade e possíveis desconfortos conversados em consulta. Juntos, vamos traçar as melhores estratégias para o seu caso de acordo com a sua rotina, vamos analisar seus exames de sangue para verificar se algo precisa ser corrigido durante o acompanhamento, além montar o seu cardápio na hora da consulta junto com você.
			</p>
			<!-- <h5 style="color:#1faa8b;font-size:32px;font-weight:400;">Então, se você já se convenceu a embarcar nesse mundo VEGGIE, bora entender como vou te ajudar!</h5> -->
		</div>
	</div>






	<!-- <div class="container py-5">
		<div class="text-center mb-5">
			<h4 style="font-size:30px;color:#3f4755;margin-bottom:90px;font-weight:700;">Como funciona meu atendimento?</h4>
		</div>


		<div class="row">
			<div class="col-md-5">
				<ul style="list-style-type:none;">

					<li class="landing-help-list-item">
						<div class="row">
							<div class="col-2">
								<i class="fas fa-flag-checkered" style="color:#31a1b1;"></i>
							</div>
							<div class="col-10">
								<h6>QUAL O SEU OBJETIVO?</h6>
								<p>Antes de tudo, vamos fazer uma bate-papo sobre como é a sua rotina e o porquê você chegou até mim. Nessa conversa você vai me contar qual sua meta principal, e assim podemos avançar e começar a traçar as melhores estratégias para você e sua realidade</p>
							</div>
						</div>
					</li>

					<li class="landing-help-list-item">
						<div class="row">
							<div class="col-2">
								<i class="fas fa-clipboard" style="color:#e7ca00;"></i>
							</div>
							<div class="col-10">
								<h6>A MONTAGEM DO PLANO ALIMENTAR</h6>
								<p>O plano alimentar é feito junto com você, na hora da consulta. Para mim, é fundamental montarmos o plano juntos, porque dessa maneira conseguirei tornar seu planejamento alimentar saudável e ao mesmo tempo prazeroso para você!</p>
							</div>
						</div>
					</li>

					<li class="landing-help-list-item">
						<div class="row">
							<div class="col-2">
								<i class="fas fa-gift" style="color:#31a1b1;"></i>
							</div>
							<div class="col-10">
								<h6>SURPRESA</h6>
								<p>Em todas as consultas, você ganha um presente muito show! Não posso contar o que vem nele, até porque sempre estou inovando os itens que ele contém. Você vai adorar!</p>
							</div>
						</div>
					</li>

				</ul>
			</div>
			<div class="col-md-2"></div>
			<div class="col-md-5">
				<ul style="list-style-type:none;">

					<li class="landing-help-list-item">
						<div class="row">
							<div class="col-2">
								<i class="fas fa-coffee" style="color:#85ae06;"></i>
							</div>
							<div class="col-10">
								<h6>DEPOIS, UM BATE PAPO PARA NOS CONHECERMOS</h6>
								<p>A duração total da consulta, é de aproximadamente 1h30. Vamos conversar muito sobre seus hábitos, horários de refeições, preferências alimentares, treinos, sua relação com a comida e lazer.</p>
							</div>
						</div>
					</li>

					<li class="landing-help-list-item">
						<div class="row">
							<div class="col-2">
								<i class="fas fa-list" style="color:#d02515;"></i>
							</div>
							<div class="col-10">
								<h6>PROTOCOLOS</h6>
								<p>Os protocolos aqui na Clínica são bastante específicos, além do protocolo para a realização de Bioimpedância e avaliação física através de adipômetro, também utilizamos protocolo para a realização de exames de sangue.</p>
							</div>
						</div>
					</li>

					<li class="landing-help-list-item">
						<div class="row">
							<div class="col-2">
								<i class="fas fa-mobile" style="color:#85ae06;"></i>
							</div>
							<div class="col-10">
								<h6>ACESSO AO APP E DURAÇÃO DO ATENDIMENTO</h6>
								<p>Assim que seu plano estiver finalizado, libero o seu acesso ao APP. Com ele, você pode consultar seu plano alimentar de onde estiver. Você vai poder falar diretamente comigo sobre qualquer dúvida que tiver durante o Acompanhamento. Isso mesmo, fico disponível para eventuais dúvidas e ajustes que surgirem, lembra que eu disse que seria seu braço direito?</p>
							</div>
						</div>
					</li>

				</ul>
			</div>
		</div>

		<div class="text-center">
			<a class="btn hero-btn mt-4" target="_blank" href="<?= $whatsappLink ?>" style="width: 100%;padding:22px;">QUERO FALAR COM A ROBERTA E SABER MAIS INFORMAÇÕES</a>

		</div>
	</div> -->


	<div class="container py-5">
		
			<div class="row px-3 text-center">
				<div class="col-md-3">
					
				</div>
				<div class="col-md-3">
					<img src="<?= $themePath ?>/assets/img/roberta_2.jpg" style="border-radius:15%;">
					<h3>Roberta Beltrame</h3>
				</div>
				<div class="col-md-3">
					<img src="<?= $themePath ?>/assets/img/lucas.jpg" style="border-radius:15%;">
					<h3>Lucas Scalabrin</h3>
				</div>
				<div class="col-md-3">
					
				</div>
			</div>

		<div class="text-center">
			<a class="btn hero-btn mt-4" target="_blank" href="<?= $whatsappLink ?>" style="width: 100%;padding:22px;">AGENDAR ATENDIMENTO</a>
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
