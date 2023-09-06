<?php
require __DIR__ . '/../source/autoload.php';

use \Source\Themes\AdminTheme;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;



$currentTab = "services";
require_once('header.php');

$whatsappLink = "https://wa.me/5511900000000?text=Informa%C3%A7%C3%B5es%20da%20consulta%20com%20a%20nutri%20Mari.";

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
			<span style="font-size:30px;line-height: 40px;">Você é apaixonado pela corrida, mas não consegue se ver participando de uma Maratona?</span>
			<p class="mt-3">Eu sei que você sente cansaço no meio da prova e quer desistir. Sei que se frustra quando vê que fez a prova no mesmo tempo ou em um tempo maior que as anteriores. Talvez você tenha lesões frequentes e acha que para ter um bom rendimento na corrida, precisará abandonar totalmente a vida social. O meu papel como Nutricionista é te mostrar que mesmo com sua rotina estressante de trabalho e vida social ativa, é possível ter bons resultados e aumentar seu desempenho na Corrida.</p>
		</div>
	</div>

	<div class="row" style="background-color: rgba(32, 36, 39, 1);">
		<div class="container text-center">

			<div class="row px-3">
				<div class="col-md-3">
					<img src="<?= $themePath ?>/assets/img/Team/mariana-3.jpg" style="border-radius:50%;" class="mt-5">
				</div>
				<div class="col-md-9">
					<h3 class="mt-5" style="font-size:30px;color:#ffffff;">Oi, eu sou a <span style="color:#1faa8b;">Mariana Paiva</span></h3>
					<p class="mb-5" style="color:#ffffff;text-align:left;">
						Sou Nutricionista, ou como costumam me chamar, a Nutri dos corredores. Estou aqui para te ajudar a chegar no seu grande objetivo, sem desistir, sendo o seu braço direito em todo o processo de melhora de performance na corrida. Ele não é fácil, mas está longe de ser impossível!
						<br>
						<br>
						Com a minha experiência, desenvolvi um estilo perfeito para que a sua jornada em busca de uma vida Ativa e Equilibrada seja extremamente possível.
						Gosto demais de ver a transformação dos meus MetaFriends (pacientes): a superação e o Pódio da Performance .
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
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Você se frustra por querer diminuir o tempo na prova e raramente consegue. Sente que se esforça demais e está sempre no mesmo ou abaixo?</li>
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Você tem uma paixão por corrida e todos os benefícios dela, mas cansou de não ter resultados?</li>
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Você sente dores de cabeça frequentes e se estressa por não saber a causa?</li>
				</ul>
			</div>
			<div class="col-md-2"></div>
			<div class="col-md-5">
				<ul style="list-style-type:none;">
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Você acredita que vai precisar gastar muito dinheiro com alimentação e suplementação?</li>
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Você acha que terá uma alimentação restrita e precisará abandonar a vida social?</li>
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Você sente cãibras e dores musculares após os treinos ou provas além de sofrer com lesões frequentes?</li>
				</ul>
			</div>
		</div>

		<div class="text-center">
			<p class="mb-3" style="font-size:30px;font-weight:700;">Se você disse <span style="color:red;">SIM</span> para a maioria das minhas perguntas, este é o acompanhamento certo para você!</p>

			<a class="btn hero-btn mt-4" target="_blank" href="<?= $whatsappLink ?>" style="width: 100%;padding:22px;">QUERO FALAR COM A MARI E ENTENDER MAIS COMO FUNCIONA</a>

		</div>
	</div>





	<div class="row px-3" style="background-color: rgba(17, 1, 1, 0.98);">
		<div class="container text-center py-5">

			<h5 style="color:#1faa8b;font-size:32px;font-weight:400;">Mariana, como funciona sua consulta?</h5>
			<p class="my-5" style="color:#ffffff;font-size:21px">
				O principal aqui é você saber que eu só atendo quem corre ou pretende correr, ok? Porque toda minha estratégia é criada para agir juntamente com os seus treinos.
			</p>
			<h5 style="color:#1faa8b;font-size:32px;font-weight:400;">Então, se você já ativou sua paixão por corrida, bora entender como vou te ajudar!</h5>

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
								<p>Primeiro, vamos falar sobre seus objetivos. É essencial entendermos esse ponto antes de colocar a mão na massa e começar de fato a traçar as estratégias e manobras nutricionais para você!</p>
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
								<p>O plano alimentar é feito junto com você, na hora da consulta. Para mim, é imprescindível montarmos o plano juntos,  assim, é muito mais fácil de conseguir seguir certinho a estratégia. Você já sai com ele na palma da mão e o melhor, do seu jeito.</p>
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
								<p>Em todas as consultas, você ganha um presente muito show! Não posso contar o que vem nele, até porque sempre estou inovando os itens que ele contém. Só posso dizer que ele tem tudo a ver com você!</p>
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
								<h6>DEPOIS, UM BATE PAPO PARA NOS CONHECERMOS...</h6>
								<p>A duração total da consulta, é de aproximadamente 1h30. Vamos conversar muito sobre seus hábitos, horários de refeições, preferências alimentares, treinos, controle emocional (para não comer as emoções) e lazer.</p>
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
								<p>Os Protocolos aqui na clínica são bastante específicos, além do protocolo para a realização de Bioimpedância e avaliação física através de adipômetro, também utilizamos protocolo para a realização de exames de sangue.</p>
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
								<p>Além de sair da consulta com o plano pronto, aqui na Clínica eu já libero o seu acesso ao APP. Com ele, você pode consultar seu plano alimentar de onde estiver e também, falar diretamente comigo sobre qualquer dúvida que tiver durante o Acompanhamento. Isso mesmo, fico disponível para eventuais dúvidas e ajustes que surgirem.</p>
							</div>
						</div>
					</li>

				</ul>
			</div>
		</div>

		<div class="text-center">
			<a class="btn hero-btn mt-4" target="_blank" href="<?= $whatsappLink ?>" style="width: 100%;padding:22px;">QUERO FALAR COM A MARI E SABER MAIS INFORMAÇÕES</a>

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
					<img class="img-rating" src="<?= $themePath ?>/assets/img/rating-3.jpeg">
					<img class="img-rating" src="<?= $themePath ?>/assets/img/rating-2.jpeg">
					<p style="margin-top:20px;font-size:16px;">Avaliações de Clientes</p>
					<a class="btn hero-btn mt-4" href="https://www.google.com.br/search?hl=pt-BR&_ga=2.77878738.719991695.1613316903-1138421236.1609947123&q=Cl%C3%ADnica+MetaVita+-+Sa%C3%BAde+e+Performance+Esportiva+-+M%C3%A9dico+e+Nutricionista+Esportiva+-+Zona+Leste&ludocid=7666152772053892184&lsig=AB86z5VcRLh_hME1acfW325I3Egm">Ver Todas as Avaliações</a>
				</div>
			</div>
		</div>
	</div>








</main>
<?php

require_once('footer.php');

?>
