<?php
require __DIR__ . '/../source/autoload.php';

use \Source\Themes\AdminTheme;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;



// $currentTab = "services";
// require_once('header.php');
$themePath = Config::BASE_URL.'/pages/theme/site';
$themePath2 = Config::BASE_URL.'/pages/theme/lp-servicos';


$whatsappLink = "https://wa.me/5511973755967?text=Informa%C3%A7%C3%B5es%20da%20consulta";

?>


<!DOCTYPE html>
<html lang="pt">

<head>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-K6VXR2T');</script>
	<!-- End Google Tag Manager -->
	
	<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '2929716927272121');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=2929716927272121&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Clínica Metavita</title>

	<!-- Favicons-->
	<link rel="shortcut icon" href="<?= $themePath ?>/assets/img/fav_icon.png" type="image/x-icon">
	<link rel="apple-touch-icon" type="image/x-icon" href="<?= $themePath ?>/img/apple-touch-icon-57x57-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="<?= $themePath ?>/assets/img/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="<?= $themePath ?>/assets/img/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="<?= $themePath ?>/assets/img/apple-touch-icon-144x144-precomposed.png">

	<!-- GOOGLE WEB FONT -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,500,500i,600,600i,700,700i&display=swap" rel="stylesheet">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">


	<!-- CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
	<link href="<?= $themePath ?>/css/jcarousel.responsive.css" rel="stylesheet">
	<link href="<?= $themePath ?>/css/basic.css" rel="stylesheet">
	<link href="<?= $themePath ?>/css/style.css" rel="stylesheet">
	<link href="<?= $themePath ?>/css/whatsapp.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css" />

	<link rel="stylesheet" type="text/css" href="<?= $themePath2 ?>/css/bootstrap.min.css?7304">
	<link rel="stylesheet" type="text/css" href="<?= $themePath2 ?>/style.css?6563">
	<link rel="stylesheet" type="text/css" href="<?= $themePath2 ?>/css/all.min.css">

</head>

<body>

<!-- Preloader -->
<div id="page-loading-blocs-notifaction" class="page-preloader"></div>
<!-- Preloader END -->


<!-- Main container -->
<div class="page-container">
    
<!-- ScrollToTop Button -->
<a class="bloc-button btn btn-d scrollToTop" onclick="scrollToTarget('1',this)"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 32 32"><path class="scroll-to-top-btn-icon" d="M30,22.656l-14-13-14,13"/></svg></a>
<!-- ScrollToTop Button END-->


<!-- bloc-0 -->
<div class="bloc bg--2- d-bloc bloc-bg-texture texture-darken" id="bloc-0">
	<div class="bloc-shape-divider bloc-divider-bottom">
		<svg class="svg-divider bloc-divider-b-fill" fill-rule="evenodd" preserveAspectRatio="none" viewBox="0 0 1000 250"><path style="opacity:0.5" d="M1000,0V250H0v-1Z"></path><path d="M1000,60V250H0v-1Z"></path></svg>
	</div>
	<div class="container bloc-lg">
			<div class="row">
				<div class="col text-md-left text-center">
					<h1 class="text-lg-center hero-text h1-style mg-lg text-md-center">
						<strong>Atendimento Nutricional</strong>
					</h1>
					<h3 class="text-lg-center hero-text h3-style mg-sm text-md-center">
						<strong>Você já se consultou com um nutricionista?</strong>
					</h3>
					<p class="text-lg-center hero-text p-style mg-sm text-md-center">
						Aqui na Metavita, nossa missão é transformar<br>a sua meta em nossa meta, promovendo qualidade de vida
					</p>
				</div>
			</div>
		</div>
</div>
<!-- bloc-0 END -->

<!-- bloc-1 -->
<div class="bloc l-bloc" id="bloc-1">
	<div class="container bloc-lg bloc-md-lg">
		<div class="row">
			<div class="col">
				<h2 class="mg-md text-lg-center section-title text-md-center">
					Como funciona o nosso atendimento
				</h2>
			</div>
		</div>
		<div class="row voffset">
			<div class="col-md-6 text-lg-center">
				<img src="<?= $themePath2 ?>/img/lazyload-ph.png" data-src="<?= $themePath2 ?>/img/maca.png" class="img-fluid img-style img-protected mx-auto d-block lazyload" alt="placeholder image" />
			</div>
			<div class="col-md-6 align-self-center">
				<h2 class="mg-md list-title">
					01 -&nbsp;ALIMENTAÇÃO
				</h2>
				<p class="list-text">
					Consuma alimentos imunoprotetores, ou seja,<br>aqueles que irão ajudar a proteger<br>a sua imunidade. Alguns exemplos são: frutas vermelhas, iogurte, azeite, abacate, açafrão, chá verde, frutas cítricas, aveia, oleaginosas. Algumas pessoas podem apresentar intolerância ou alergia a estes alimentos.<br>
				</p>
			</div>
		</div>
		<div class="row voffset-md">
			<div class="col-md-6 align-self-center">
				<h2 class="mg-md text-lg-right list-title text-md-right">
					02 -&nbsp;DESCANSO
				</h2>
				<p class="text-lg-right list-text text-md-right">
					Ter boas noites de sono é fundamental para mantermos a nossa saúde mental, o nosso corpo bem recuperado e não sentir vontade de comer até o reboco das paredes. Para isso, tenha o seu dia bem organizado para conseguir dormir sempre no mesmo horário e durma pelo menos 7 horas por noite.<br>
				</p>
			</div>
			<div class="col-md-6">
				<img src="<?= $themePath2 ?>/img/lazyload-ph.png" data-src="<?= $themePath2 ?>/img/relogio.png" class="img-fluid img-relog-style img-protected mx-auto d-block lazyload" alt="placeholder image" />
			</div>
		</div>
		<div class="row voffset-md">
			<div class="col-md-6">
				<img src="<?= $themePath2 ?>/img/lazyload-ph.png" data-src="<?= $themePath2 ?>/img/cerebro.png" class="img-fluid img-cereb-style img-protected mx-auto d-block lazyload" alt="placeholder image" />
			</div>
			<div class="col-md-6 align-self-center">
				<h2 class="mg-md list-title">
					03 -&nbsp;SAÚDE MENTAL
				</h2>
				<p class="list-text">
					Você já parou para pensar em como anda sua saúde mental? Saber encarar os desafios, as mudanças da vida e as nossas emoções de forma harmônica são fundamentais para que possamos viver de forma plena.<br>
				</p>
			</div>
		</div>
		<div class="row voffset-md">
			<div class="col-md-6 align-self-center">
				<h2 class="mg-md text-lg-right list-title text-md-right">
					04 -&nbsp;ATIVIDADE FISÍCA
				</h2>
				<p class="text-lg-right list-text text-md-right">
					Complementando a dica 3 e te ajudando na atividade física você pode incluir na sua rotina a prática do yoga, que irá te trazer mais equilibro e paz no dia a dia.<br>
				</p>
			</div>
			<div class="col-md-6">
				<img src="<?= $themePath2 ?>/img/lazyload-ph.png" data-src="<?= $themePath2 ?>/img/academia.png" class="img-fluid img-academ-style img-protected mx-auto d-block lazyload" alt="placeholder image" />
			</div>
		</div>
	</div>
</div>
<!-- bloc-1 END -->

<!-- bloc-2 -->
<div class="bloc l-bloc" id="bloc-2">
	<div class="container bloc-lg">
		<div class="row">
			<div class="col-md-6 text-md-right align-self-start">
				<div class="embed-responsive embed-responsive-16by9">
					<iframe class="embed-responsive-item lazyload" src="<?= $themePath2 ?>/img/lazyload-ph.png" data-src="https://www.youtube.com/embed/FKamLgPFhLQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
					</iframe>
				</div>
			</div>
			<div class="col-md-6 align-self-center">
				<p class="p-6-style text-center text-md-left">
					Nossa conduta contempla uma avaliação minuciosa sobre sua saúde e objetivos, para que a partir disso possamos traçar metas e objetivos individuais e elaborar um plano alimentar e orientações personalizadas.<br><br>De acordo com cada caso, também são prescritos suplementos (quando necessários) e sugestões de receitas para que seja mais fácil colocar as orientações do Nutricionista em prática.<br>
				</p>
			</div>
		</div>
	</div>
</div>
<!-- bloc-2 END -->

<!-- bloc-3 -->
<div class="bloc bloc-bg-texture texture-darken bg-vista-wide d-bloc" id="bloc-3">
	<div class="bloc-shape-divider bloc-divider-flip-y bloc-divider-top bloc-divider-flip-x">
		<svg class="svg-divider bloc-divider-t-fill" fill-rule="evenodd" preserveAspectRatio="none" viewBox="0 0 1000 250"><path style="opacity:0.5" d="M1000,0V250H0v-1Z"></path><path d="M1000,60V250H0v-1Z"></path></svg>
	</div>
	<div class="bloc-shape-divider bloc-divider-bottom">
			<svg class="svg-divider bloc-divider-b-fill" fill-rule="evenodd" preserveAspectRatio="none" viewBox="0 0 1000 250"><path style="opacity:0.5" d="M1000,0V250H0v-1Z"></path><path d="M1000,60V250H0v-1Z"></path></svg>
		</div>
	<div class="container bloc-xxl-lg bloc-lg-md bloc-lg">
				<div class="row">
					<div class="col text-md-left text-center">
						<p class="text-lg-center hero-text p-style mg-sm text-md-center">
							Acreditamos que a nutrição vai muito além da dieta e, por isso, prezamos um ambiente harmônico, onde você irá se sentir leve ao passar pela porta e sentir nosso agradável perfume e contemplar uma vista quase que panorâmica do bairro do Tatuapé.<br>
						</p>
					</div>
				</div>
			</div>
</div>
<!-- bloc-3 END -->

<!-- bloc-5 -->
<div class="bloc l-bloc" id="bloc-5">
	<div class="container bloc-lg bloc-lg-lg">
		<div class="row">
			<div class="col-lg-4 offset-lg-4 col-sm-6 offset-sm-3 col">
				<a href="<?= $whatsappLink ?>" class="btn btn-d btn-block btn-xl primary-button" target="_blank">Entrar em Contato</a>
			</div>
		</div>
	</div>
</div>
<!-- bloc-5 END -->

<!-- bloc-4 -->
<div class="bloc l-bloc" id="bloc-4">
	<div class="container bloc-lg-lg bloc-sm">
		<div class="row">
			<div class="col-md-6 order-md-1">
				<img src="<?= $themePath2 ?>/img/lazyload-ph.png" data-src="<?= $themePath2 ?>/img/[6]%20copy.jpeg" class="img-fluid mx-auto d-block img-protected mg-sm picture-shadow lazyload" alt="[6].jpeg" />
			</div>
			<div class="col-md-6 align-self-center">
				<p class="p-8-style text-lg-right float-md-right text-md-right text-sm-center mg-md-sm text-center">
					Nossa recepção conta o “Espaço do café”, no qual você pode degustar um café e um chocolate enquanto aguarda seu atendimento.
				</p>
			</div>
		</div>
	</div>
</div>
<!-- bloc-4 END -->

<!-- bloc-6 -->
<!-- <div class="bloc l-bloc" id="bloc-6">
	<div class="container bloc-lg">
		<div class="row">
			<div class="col-md-2 offset-md-3 col-sm-4 offset-0 col-4">
				<div class="text-center">
					<a href="<?= $whatsappLink ?>" target="_blank"><span class="social-icon fab fa-whatsapp icon-lg"></span></a>
				</div>
			</div>
			<div class="col-md-2 col-sm-4 col-4">
				<div class="text-center">
					<a href="https://www.facebook.com/Cl%C3%ADnica-MetaVita-Saude-e-Performance-Esportiva-101809064939591/" target="_blank"><span class="fab fa-facebook-square social-icon icon-lg"></span></a>
				</div>
			</div>
			<div class="col-md-2 col-sm-4 col-4 ">
				<div class="text-center">
					<a href="https://www.instagram.com/clinicametavita" target="_blank"><span class="fab fa-instagram social-icon icon-lg"></span></a>
				</div>
			</div>
		</div>
	</div>
</div> -->
<!-- bloc-6 END -->

</div>
<!-- Main container END -->
    

<?php

require_once('footer.php');

?>



<!-- Additional JS -->
<script src="<?= $themePath2 ?>/js/jquery.min.js?1197"></script>
<script src="<?= $themePath2 ?>/js/bootstrap.bundle.min.js?2513"></script>
<script src="<?= $themePath2 ?>/js/blocs.min.js?9638"></script>
<script src="<?= $themePath2 ?>/js/lazysizes.min.js" defer></script><!-- Additional JS END -->


</body>
</html>
