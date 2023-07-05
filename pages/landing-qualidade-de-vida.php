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
			<span style="font-size:30px;line-height: 40px;">Você está em busca de atingir a sua melhor versão com qualidade de vida e não sabe como chegar lá?</span>
			<p class="mt-3">Sei que esse pensamento é clichê, mas todas as suas ações do momento presente, irão afetar o seu "eu" do futuro. Por isso, que tal começarmos agora?
			<br>
			<br>
			Independente de qual for o seu objetivo: melhorar seus hábitos alimentares, render mais nos treinos, reduzir o consumo de carne ou até mesmo melhorar sua composição corporal, nós vamos chegar lá juntos
			<br>
			<br>
			E é aqui que eu entro em ação, como uma guia. Como nutricionista, irei te mostrar que é possível viver de forma harmoniosa e atingir suas maiores metas através de uma boa alimentação e um estilo de vida saudável, sem sofrimentos ou restrições.
			<br>
			<br>
			Fico muito feliz por fazer parte da sua jornada e te acompanhar. Nosso destino é atingir sua melhor versão física e mental e te ensinar a fazer escolhas que te tragam resultados duradouros e alegria em comer bem também.
			</p>
		</div>
	</div>

	<div class="row" style="background-color: rgba(32, 36, 39, 1);">
		<div class="container text-center">

			<div class="row px-3">
				<div class="col-md-3">
					<img src="<?= $themePath ?>/assets/img/roberta.jpg" style="border-radius:50%;" class="mt-5">
				</div>
				<div class="col-md-9">
					<h3 class="mt-5" style="font-size:30px;color:#ffffff;">Oie! Seja bem-vindo, sou a <span style="color:#1faa8b;">Roberta Ciudi</span>!</h3>
					<p class="mb-5" style="color:#ffffff;text-align:left;">
					Sou Nutricionista e estou aqui para te ajudar a viver em harmonia com a comida e seu corpo.
						<br>
						<br>
						Eu acredito que o alimento é capaz de nos transformar e que a nutrição serve tanto para o nosso corpo, quanto mente e consciência.
						<br>
						<br>
						Também sou vegetariana e meia maratonista, por isso trago a combinação dos conhecimentos técnicos das áreas da Nutrição que envolvem Vegetarianismo, Esporte e Comportamento com os conhecimentos práticos desse estilo de vida para conseguir te entender da melhor forma possível. Vamos embarcar juntos nessa jornada?
					</p>
				</div>
			</div>

		</div>
	</div>





	<div class="container py-5">
		<div class="text-center mb-5">
			<h4 style="font-size:30px;color:#3f4755;margin-bottom:90px;font-weight:700;">Como eu sei que este acompanhamento é para mim?</h4>

			<span  style="color:rgb(71, 200, 204);font-weight:700;font-size:30px;">Vamos lá:</span>
		</div>


		<div class="row">
			<div class="col-md-5">
				<ul style="list-style-type:none;">
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Você identifica que seus hábitos alimentares podem ser melhorados?</li>
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Não sabe como se alimentar de forma saudável e equilibrada?</li>
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Sente que poderia ter mais resultados estéticos se comesse de forma mais adequada?</li>
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Você acha que precisa fazer detox, jejum intermitente ou cortar carboidratos depois de um fim de semana de refeições fora do habitual?</li>
				</ul>
			</div>
			<div class="col-md-2"></div>
			<div class="col-md-5">
				<ul style="list-style-type:none;">
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Seus treinos não estão rendendo tanto quanto você gostaria e você se cansa muito fácil?</li>
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Seu relacionamento com a comida é influenciado de acordo com suas emoções? A comida é uma válvula de escape para você?</li>
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Tem vontade de fazer a transição para o vegetarianismo/veganismo mas não sabe por onde começar?</li>
					<!-- <li class="landing-features-list-item"><i class="fas fa-check-circle"></i> </li> -->
				</ul>
			</div>
		</div>

		<div class="text-center">
			<p class="mb-3" style="font-size:30px;font-weight:700;">Se você disse <span style="color:red;">SIM</span> para a maioria das perguntas, este é o acompanhamento certo para você!</p>

			<a class="btn hero-btn mt-4" target="_blank" href="<?= $whatsappLink ?>" style="width: 100%;padding:22px;">QUERO FALAR COM A ROBERTA E TER MAIS INFORMAÇÕES DE COMO FUNCIONA O ACOMPANHAMENTO</a>
		</div>
	</div>





	<div class="row px-3" style="background-color: rgba(17, 1, 1, 0.98);">
		<div class="container text-center py-5">

			<h5 style="color:#1faa8b;font-size:32px;font-weight:400;">Roberta, como funciona sua consulta?</h5>
			<p class="my-5" style="color:#ffffff;font-size:21px">
			O principal aqui é você saber que eu atendo pessoas que sentem que precisam melhorar sua saúde e transformar seus hábitos alimentares, além de estabelecer uma rotina mais organizada e ter um bom relacionamento com a comida! Reforço isso porque toda minha conduta será baseada exclusivamente em você e no seu estilo de vida.
			</p>
			<h5 style="color:#1faa8b;font-size:32px;font-weight:400;">Então chegou a hora de você entender como vou te ajudar!</h5>

		</div>
	</div>






	<div class="container py-5">
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
								<p>Antes de tudo, vamos fazer uma bate-papo sobre como é a sua rotina e o porquê você chegou até mim. Nessa conversa você vai me contar qual sua meta principal, e assim podemos avançar e começar a traças as melhores estratégias para você e sua realidade</p>
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
	</div>





	<div class="row py-5 px-3" style="background-color: rgb(234, 238, 234);">
		<div class="container text-center">
			<div class="row">
				<div class="col-md-6 px-2 py-2">
					<img class="img-rating" src="<?= $themePath ?>/assets/img/rating-1.jpeg">
					<p style="margin-top:20px;font-size:16px;">Estamos em uma travessa da Radial Leste</p>
					<a class="btn hero-btn mt-4" href="https://maps.google.com/?q=Rua%20Vilela,%20652%20-%20Tatuap%C3%A9,%20S%C3%A3o%20Paulo%20-%20SP">Ver Localização</a>
				</div>
				<div class="col-md-6 px-2 py-2">
					<img class="img-rating" src="<?= $themePath ?>/assets/img/rating-8.png">
					<img class="img-rating" src="<?= $themePath ?>/assets/img/rating-9.png">
					<p style="margin-top:20px;font-size:16px;">Avaliações de Clientes</p>
					<a class="btn hero-btn mt-4" href="https://www.google.com.br/search?hl=pt-BR&_ga=2.77878738.719991695.1613316903-1138421236.1609947123&q=Cl%C3%ADnica+MetaVita+-+Sa%C3%BAde+e+Performance+Esportiva+-+M%C3%A9dico+e+Nutricionista+Esportiva+-+Zona+Leste&ludocid=7666152772053892184&lsig=AB86z5VcRLh_hME1acfW325I3Egm#lrd=0x94ce5f1d2af4d191:0x6a63a5544425fc58,1">Ver Todas as Avaliações</a>
				</div>
			</div>
		</div>
	</div>








</main>
<?php

require_once('footer.php');

?>
