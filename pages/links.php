<?php
require __DIR__ . '/../source/autoload.php';

use \Source\Themes\AdminTheme;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;

$links = [
	[
		"title" => "Quero informações sobre consulta",
		"link" => "https://wa.me/5511973755967?text=Ol%C3%A1%21+Vim+do+Instagram+de+voc%C3%AAs+e+gostaria+de+informa%C3%A7%C3%B5es+sobre+os+servi%C3%A7os."
	],
	[
		"title" => "Conheça um pouco da experiência do atendimento MetaVita!",
		"link" => "https://www.youtube.com/watch?v=FKamLgPFhLQ&ab_channel=Cl%C3%ADnicaMetaVita"
		// "link" => "https://drive.google.com/file/d/1SvZkWRwKzM1k4o7tQA61-Ix1qeSlBrVx/view?usp=drivesdk"
	],
	[
		"title" => "E-book gratuito!",
		"link" => "https://https://demo.clinicametavita.com.br/arquivos/pdf/10-dicas-para-nao-perder-o-foco-da-dieta-no-final-de-semana.pdf"
	],
	[
		"title" => "Visite nosso site!",
		"link" => "https://www.clinicametavita.com.br/links"
	],
	[
		"title" => "Quero receber as dicas exclusivas da MetaFamily",
		"link" => "https://t.me/joinchat/AAAAAEXo57gkZloiDEU6Hg"
	],
	[
		"title" => "Quero acessar a área exclusiva dos MetaFriends",
		"link" => "https://https://demo.clinicametavita.com.br/cliente/login"
	],
];


$themePath = Config::BASE_URL.'/pages/theme/site';
$customerUser = Session::getCustomerUser();

$whatsappLink = "https://wa.me/5511973755967?text=Ol%C3%A1%21+Vim+do+Instagram+de+voc%C3%AAs+e+gostaria+de+informa%C3%A7%C3%B5es+sobre+os+servi%C3%A7os.";

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

</head>

<body>

	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K6VXR2T"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->


	<!-- <a href="<?php echo($whatsappLink); ?>" class="whatsapp-float" target="_blank"></a> -->
	<!-- Navbar Area -->

	<div class="text-center" style="padding-top:50px;">
		<a class="navbar-brand center" href="<?= Config::BASE_URL ?>"><img class="nav-img-logo" src="<?= $themePath ?>/assets/logo.png" alt=""></a>
	</div>

	<!-- AP Area -->

	<div style="padding-top:50px;" class="text-center">
		<h3>Pessoas transformam o mundo, nós transformamos pessoas!</h3>
		<br>
		<h4>Desejamos boas vindas à Clínica MetaVita!</br>Escolha uma opção abaixo e toque:</h4>
	</div>


	<div class="container" style="padding-top:50px;">
	<?php foreach($links as $value) { ?>
		<a class="btn hero-btn mt-4" target="_blank" href="<?= $value["link"] ?>" style="width: 100%;padding:22px;"><?= $value["title"] ?></a>
	<?php } ?>
</div>


<?php

require_once('footer.php');

?>
