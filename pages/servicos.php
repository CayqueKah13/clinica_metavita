<?php
require __DIR__ . '/../source/autoload.php';

use \Source\Themes\AdminTheme;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;

$currentTab = "services";
require_once('header.php');

?>

	<!-- Servicos -->

		<!-- <div class="container services">
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-5 col-12 text-center title-session">
					<h2>Serviços</h2>
				</div>
			</div>
			<div class="row justify-content-center text-center">
				<div class="col-12 col-md-4 my-3">
					<img src="<?= $themePath ?>/assets/img/Servicos/consulta.svg" alt="">
					<h3>Consulta Nutricional</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard.</p>
				</div>
				<div class="col-12 col-md-4 my-3">
					<img src="<?= $themePath ?>/assets/img/Servicos/programa.svg" alt="">
					<h3>Programa Nutricional</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard.</p>
				</div>
				<div class="col-12 col-md-4 my-3">
					<img src="<?= $themePath ?>/assets/img/Servicos/psicologia.svg" alt="">
					<h3>Psicologia</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard.</p>
				</div>
				<div class="col-12 col-md-4 my-3">
					<img src="<?= $themePath ?>/assets/img/Servicos/avaliacao.svg" alt="">
					<h3>Avaliação Física</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard.</p>
				</div>
				<div class="col-12 col-md-4 my-3">
					<img src="<?= $themePath ?>/assets/img/Servicos/exame.svg" alt="">
					<h3>Exame de Sangue</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard.</p>
				</div>
			</div>
		</div> -->


<main>

	<div id="QuemSomos" class="container">
		<div class="row justify-content-center">
			<div class="col-md-6 col-lg-5 col-12 text-center title-session">
				<h1>Serviços</h1>
			</div>
		</div>
	</div>


		<!-- Pilares -->

		<div class="container">
			<div class="" style="display: block;margin: 50px auto 0 auto;">
				<h3>Acompanhamento Nutricional</h3>
				<p>
					Através do conhecimento sobre a composição nutricional dos alimentos, o nutricionista visa desenvolver e organizar planos de alimentação (que seriam as dietas) e com o auxílio da avaliação física, averiguar o ganho e perda de peso de acordo com as suas atividades físicas e objetivos, adaptando sua alimentação para não ter nenhuma carência nutricional e garantindo que seu rendimento esportivo seja o melhor possível. Dessa forma, com o entendimento da rotina, hábitos e costumes do paciente, a dieta pode ser planejada para atingir o resultado que almejar.
				</p>
			</div>
		</div>

		<div class="container pl-5">
			<div class="" style="display: block;margin: 50px auto 0 auto;">
				<h4>Para atletas e praticantes de corrida de rua</h4>
				<p>
					Sabemos que você já deve ter ouvido diversas vezes que para melhorar na corrida, correr mais rápido, precisa deixar de comer seus alimentos preferidos, de aproveitar seu final de semana e viver de carbogel. Eu vou te ajudar a tornar a evolução na corrida possível dentro da sua rotina. Acredito que nada adianta você deixar de viver a vida que tem hoje e deixar de comer os seus alimentos preferidos, porque senão os resultados não serão mantidos para o resto da vida.  Com o meu acompanhamento, você saberá exatamente como adequar a sua alimentação à sua rotina, seja rotina de treinos ou de trabalho, para que seus resultados sejam ainda melhores. te ensinarei sobre como precisa ser a sua alimentação durante o dia, antes e depois dos treinos e, principalmente, o que comer durante os longões, para que você não tenha nenhuma chance de se lesionar enquanto corre.
				</p>
			</div>
		</div>

		<div class="container pl-5">
			<div class="" style="display: block;margin: 50px auto 0 auto;">
				<h4>Para pessoas que querem definir o corpo</h4>
				<img class="img-fix" src="<?= $themePath ?>/assets/img/mariana.jpg" style="max-width:350px;">
				<p> <i>¹consultar as condições deste serviço.</i> </p>
			</div>
		</div>

		<div class="container pl-5">
			<div class="" style="display: block;margin: 50px auto 0 auto;">
				<h4>Para atletas e praticantes de futebol</h4>
				<p>
					Acredito que para conseguir ter um bom desempenho no futebol de nada adianta você deixar de viver a vida que tem hoje e de comer seus alimentos preferidos, pois irá resultar em estresse, vontade de comer e, consequentemente, em falta de foco. Isso pode te prejudicar tanto emocionalmente quanto no seu resultado. Quero te ensinar que é possível melhorar o desempenho no futebol mesmo que você queira aproveitar o final de semana com os amigos ou com a família e, ainda assim, corrigir alguns problemas que podem estar te acompanhando, como: desorganização, falta de tempo, indisposição, procrastinação, não suportar um jogo inteiro, baixa autoestima, excesso de lesões, cãibras entre outros. Sou um nutricionista especializado em futebol e, vou te ajudar a ser destaque no seu time!
				</p>
				<img class="img-fix" src="<?= $themePath ?>/assets/img/joao.jpg" style="max-width:350px;">
			</div>
		</div>





		<div class="container">
			<div class="" style="display: block;margin: 50px auto 0 auto;">
				<h3>Medicina esportiva</h3>
				<p>
					A atuação do médico do esporte visa, principalmente, gerir a saúde do atleta ou praticante de atividade física, proporcionando o máximo de desempenho com o máximo de segurança. Englobando conhecimentos de diversas áreas, como ortopedia, cardiologia, nutrologia, fisiologia, endocrinologia, entre outras, este profissional tem um enfoque não apenas num sistema orgânico, mas no indivíduo como um todo. Dessa forma, as suas necessidades podem ser prontamente identificadas e abordadas de forma a trazer o resultado esperado, seja na melhora do desempenho esportivo, seja na saúde em geral.
				</p>
				<img class="img-fix" src="<?= $themePath ?>/assets/img/filipe.jpg" style="max-width:500px;">
			</div>
		</div>



		<div class="container">
			<div class="" style="display: block;margin: 50px auto 0 auto;">
				<h4>Avaliação Física por Bioimpedância</h4>
				<p>
					Contamos com exame de Bioimpedância, realizado por uma balança InBody® que é referência mundial. Visando avaliar a composição corporal por meio de uma corrente elétrica, o exame de bioimpedância não é doloroso e nem invasivo, pois se trata de uma corrente elétrica de baixa amplitude e alta frequência que passa por todo o corpo. É um exame rápido que fornece um relatório com:
				</p>
				<ul>
					<li>Seu peso</li>
					<li>Sua massa muscular</li>
					<li>Seu percentual de gordura</li>
					<li>Seu nível de gordura nos órgãos (gordura visceral)</li>
					<li>Sua água corporal total</li>
					<li>A idade do seu metabolismo (idade metabólica)</li>
					<li>Sua análise segmentada (quantidade de gordura e músculo em cada membro do corpo)</li>
					<li>Seu IMC (Índice de Massa Corporal)</li>
					<li>Sua taxa metabólica de repouso (TMB)</li>
				</ul>
				<p>O relatório será entregue à você logo após a realização do exame em PDF ou impresso, para que você possa levar seu resultado para casa. </p>
			</div>
		</div>


		<div class="container">
			<div class="" style="display: block;margin: 50px auto 0 auto;">
				<h4>Exame de Sangue</h4>
				<p>
					Na Clínica, em parceria com um Laboratório contamos com um posto de coleta de sangue PARA QUE VOCÊ POSSA FAZER SEU CHECK UP E verificar COMO ANDA SEU CORPO POR DENTRO. A AVALIAÇÃO LABORATORIAL É um parâmetro ESSENCIAL PARA QUE OS MEMBROS DA METAFAMILY possam traçar a melhor estratégia e REALIZAR intervenções NUTRICIONAIS, PSICOLÓGICAS E MÉDICAS, visando os melhores resultados PARA VOCÊ.
				</p>
				<ul>
					<li>Capsulite adesiva do ombro</li>
					<li>Epicondilite lateral</li>
					<li>Tendinopatias</li>
					<li>Dores miofasciais</li>
					<li>Pseudoartrose</li>
				</ul>
			</div>
		</div>


		<div class="container">
			<div class="" style="display: block;margin: 50px auto 0 auto;">
				<h4>Terapia de agulhamento a seco</h4>
				<p>
					Entre as estratégias para inativação de pontos gatilho e tratamento da dor miofascial, temos como exemplo o agulhamento a seco. Essa técnica consiste em introduzir uma agulha romba no ponto gatilho, buscando atingir o ponto de maior dor. Quando isso acontece, podemos notar uma contração visível e palpável do músculo, conhecida como “twitch”. Associa-se esse fenômeno a uma maior efetividade do agulhamento (se teve o twitch, é porque você pegou o ponto certo). Existem teorias que tentam explicar os resultados do agulhamento. Uma possibilidade seria o próprio efeito mecânico da passagem da agulha, que leva a destruição de placas motoras e redução da atividade elétrica das células musculares, contribuindo para o relaxamento da musculatura. Também ocorre a liberação de substâncias vasoativas e mediadores inflamatórios que auxiliam no processo. O procedimento em geral é seguro e de baixo risco. O efeito colateral mais comum é a dor no local da aplicação, que pode aumentar nos primeiros dias após a realização. O resultado é variável de pessoa para pessoa, alguns não toleram bem enquanto outras sentem um alívio muito grande da dor, por isso a indicação deve ser individualizada.
				</p>
			</div>
		</div>




		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-5 col-12 text-center title-session">
					<h2>Fale com a MetaFamily!</h2>
					<!-- <a class="btn hero-btn mt-4" href="<?= Config::BASE_URL ?>/sobre">ENTRE EM CONTATO</a> -->
				</div>
			</div>
		</div>




</main>




<?php

require_once('footer.php');

?>
