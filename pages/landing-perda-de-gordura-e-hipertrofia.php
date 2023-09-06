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
			<span style="font-size:30px;line-height: 40px;">Você pratica musculação e está desanimando pois não vê evolução no seu físico e rendimento?</span>
			<p class="mt-3">
				Você tem dificuldade em aumentar as cargas que utiliza, sente que o seu treino não rende mais tão bem e que você está estagnado, além disso se olha no espelho e percebe que poderia ter um físico mais definido e também com maior volume muscular?
				<br>
				<br>
				Pode ser que você esteja desanimado e pensando em desistir por treinar a um bom tempo, mas não conseguir mais evoluir o seu shape.
				<br>
				<br>
				Olha, ficamos muito felizes por você ter chegado até aqui! Na Clínica MetaVita vamos te mostrar que mesmo com sua rotina apertada e estressante por conta do trabalho, estudos e também da vida social, é possível ter bons resultados, melhorar seu rendimento e conquistar o físico que você sempre quis!
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
					<h3 class="mt-5" style="font-size:30px;color:#ffffff;">CONHEÇA A METODOLOGIA DA CLÍNICA METAVITA</h3>
					<p class="mb-5 pt-5" style="color:#ffffff;text-align:center;font-size:21px">
						Em nossa equipe profissional temos nutricionistas que possuem o mesmo estilo de vida que você deseja ter, são praticantes de musculação que também buscam a melhora da composição corporal. Nossos profissionais combinam os conhecimentos técnicos da Nutrição Esportiva com os conhecimentos práticos desse estilo de vida para conseguir te atender da melhor forma possível.
						<br>
						<br>
						Conquistar um físico com bom volume muscular e baixo percentual de gordura não é fácil, mas está longe de ser impossível! Estamos aqui para te mostrar o melhor caminho até o seu objetivo. Você pode contar com a gente em todo o seu processo de definição ou hipertrofia. Estaremos juntos nessa jornada!
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
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Você nota que não consegue evoluir o seu shape? O peso não muda e nem a sua estética corporal?</li>
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Investe muito dinheiro em suplementos mas não vê diferença no seu físico?</li>
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Está desmotivado e dá um migué em alguns exercícios? Principalmente dos grupos musculares que você não vê uma boa evolução como panturrilhas, pernas e abdômen?</li>
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Você percebe que seu treino não rende após um longo dia de trabalho/estudo?</li>
					<!-- <li class="landing-features-list-item"><i class="fas fa-check-circle"></i> </li> -->
				</ul>
			</div>
			<div class="col-md-2"></div>
			<div class="col-md-5">
				<ul style="list-style-type:none;">
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Tem dificuldade para progredir cargas principalmente nos exercícios mais pesados como agachamento, levantamento terra ou supino? </li>
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Sente-se muito cansado e não se recupera totalmente entre as séries?</li>
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Você gosta de treinar, mas desanimou por não ver resultados?</li>
					<li class="landing-features-list-item"><i class="fas fa-check-circle"></i> Você acha que precisa cortar o carboidrato e não poderá comer uma pizza, ou beber com os amigos para ter o resultado que deseja?</li>
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
				O principal aqui é você saber que nossos profissionais possuem experiência com pessoas que buscam uma melhora da composição corporal aliando a alimentação com a prática de atividades físicas. Reforçamos sobre isso porque a estratégia que será criada para você terá como base os seus treinos, hábitos alimentares, estilo de vida e necessidades nutricionais, sendo um planejamento individualizado para que você alcance o seu objetivo!
			<br>
			<br>
				Acreditamos que você não precisa restringir completamente a sua alimentação para ter os resultados que você deseja. Queremos te ensinar que é possível melhorar a sua estética corporal mesmo que você queira aproveitar o final de semana com sua família ou amigos.
			<br>
			<br>
				Na sua primeira consulta vamos trabalhar diversos detalhes que podem influenciar na sua evolução. Faremos a sua avaliação física e também toda a avaliação da sua rotina, hábitos alimentares, qualidade do sono, hábito intestinal, hidratação, suplementações, medicamentos que você utiliza e outros fatores. Além de já montar o seu plano alimentar junto com você, para que você comece a seguir o mais rápido possível a estratégia elaborada.
			<br>
			<br>
				Entre as consultas vamos manter o acompanhamento online para podermos te ajudar com dúvidas, dificuldades e também se precisar realizar alterações no seu plano alimentar para que você siga da melhor forma possível.
			<br>
			<br>
				O acompanhamento será focado nas suas dificuldades, para te ajudar a ter mais organização com suas refeições diárias e se dedicar ao seu objetivo aliando a dieta com a periodização do seu treinamento. Além de corrigir alguns problemas que podem estar te acompanhando e atrapalhando a sua evolução, como cansaço, indisposição, desorganização com a alimentação, baixa auto estima, alterações em exames de sangue. Tendo um nutricionista esportivo ao seu lado você poderá alcançar os resultados que sempre sonhou e ainda obter mais saúde e qualidade de vida.
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
					<img src="<?= $themePath ?>/assets/img/michael.jpg" style="border-radius:15%;">
					<h3>Michael Martini</h3>
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
