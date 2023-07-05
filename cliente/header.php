<?php

use \Source\Core\Config;
use \Source\Core\Session;
use \Source\Core\Helper;


$customerUser = Session::getCustomerUser();
if (Helper::safeInt($customerUser->id) == 0 && $loginHeader != true) {
  Session::setErrorMessage("Sessão Expirada!");
  Helper::redirectToPage(Config::BASE_URL_CUSTOMER . "/login");
  exit;
}

$themePath = Config::BASE_URL_CUSTOMER;

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
	<title>Metavita - Área do Paciente</title>

	<!-- Favicons-->
	<link rel="shortcut icon" href="<?= Config::BASE_URL_CUSTOMER ?>/assets/img/fav_icon.png" type="image/x-icon">
	<link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="assets/img/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="assets/img/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="assets/img/apple-touch-icon-144x144-precomposed.png">

	<!-- GOOGLE WEB FONT -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,500,500i,600,600i,700,700i&display=swap" rel="stylesheet">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">


	<!-- CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
	<link href="css/basic.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css" />

</head>

<body>

  <!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K6VXR2T"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->

	<!-- Navbar Area -->

	<nav class="navbar fixed-top navbar-expand-lg navbar-light">
		<div class="container">
			<a class="navbar-brand" href="<?= Config::BASE_URL ?>"><img class="nav-img-logo" src="<?= $themePath ?>/assets/logo.png" alt=""></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse text-right" id="navbarNav">
				<div class="nav-socials d-none d-lg-block ml-auto">
					<ul class="navbar-nav ml-auto nav-flex-icons">
            <li class="nav-item">
							<a class="nav-link waves-effect waves-light" href="https://www.facebook.com/Cl%C3%ADnica-MetaVita-Saude-e-Performance-Esportiva-101809064939591/">
								<i class="fa fa-facebook"></i>
							</a>
						</li>
						<!-- <li class="nav-item">
							<a class="nav-link waves-effect waves-light">
								<i class="fa fa-twitter"></i>
							</a>
						</li> -->
						<li class="nav-item">
							<a class="nav-link waves-effect waves-light" href="https://www.instagram.com/clinicametavita">
								<i class="fa fa-instagram"></i>
							</a>
						</li>
					</ul>
				</div>
				<ul class="nav navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="<?= Config::BASE_URL ?>">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?= Config::BASE_URL ?>/sobre">Sobre Nós</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?= Config::BASE_URL ?>/galeria">Conteúdos</a>
					</li>
					<!--<li class="nav-item <?php if ($currentTab == "services") { echo("active"); } ?>">-->
					<!--	<a class="nav-link" href="<?= Config::BASE_URL ?>/servicos">Serviços</a>-->
					<!--</li>-->
					
					<li class="nav-item dropdown">
	<a class="nav-link dropdown-toggle" href="servicos.html" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Serviços</a>
	<div class="dropdown-menu" aria-labelledby="navbarDropdown">
		<!--<a class="dropdown-item" href="<?= Config::BASE_URL ?>/corredores">Corredores</a>-->
		<a class="dropdown-item" href="<?= Config::BASE_URL ?>/jiujitsu">Jiu Jitsu</a>
		<a class="dropdown-item" href="<?= Config::BASE_URL ?>/perda-de-gordura-e-hipertrofia">Perda de Gordura e Hipertrofia</a>
		<a class="dropdown-item" href="<?= Config::BASE_URL ?>/vegetarianismo">Vegetarianismo</a>
		<a class="dropdown-item" href="<?= Config::BASE_URL ?>/corrida-de-rua">Corrida de Rua</a>
		<!--<a class="dropdown-item" href="#">Ciclistas</a>-->
<!-- <div class="dropdown-divider"></div> --> <!-- Caso precise dividir em sessões --> 
	</div>
</li>

					<li class="nav-item active">
						<a class="nav-link" href="<?= Config::BASE_URL_CUSTOMER ?>/resumo">Área do MetaFriend</a>
					</li>
					<?php if ($customerUser->id > 0) { ?>
					<li class="nav-item">
						<a class="nav-link logged-link" href="<?= Config::BASE_URL_CUSTOMER ?>/sair" onclick="return confirm('Tem certeza que deseja sair?');">(Sair)</a>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</nav>

	<!-- AP Area -->
