<?php
require __DIR__ . '/../source/autoload.php';

use \Source\Themes\AdminTheme;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;
use \Source\Controllers\BlogController;
use \Source\Controllers\CustomerController;
use \Source\Themes\Theme;


$item = BlogController::getDetails($blogID);
if (Helper::safeInt($item['id']) == 0) {
	require_once('404.php');
	exit;
}
$youtubeLink = Helper::safeString($item['video_link']);
if ($youtubeLink != '') {
	$youtubeLink = Helper::youtubeEmbedUrlFrom($youtubeLink);
}



$customerUser = Session::getCustomerUser();
$customerID = $customerUser->id;
$info = CustomerController::getProfileInfo($customerID);
$isBlogPostBlocked = 0;
if (Helper::safeInt($info['id']) == 0 && $item['id_category'] == 2) {
  $isBlogPostBlocked = 1;
}


$currentTab = "blog";
require_once('header.php');

?>

	<!-- Servicos -->
	<div class="container">
		<div class="row justify-content-center galeria-item">
			<div class="col-md-8 col-lg-6 col-12 text-center title-session">
				<h2><?= $item['title'] ?></h2>
				<p><?= $item['subtitle'] ?></p>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="blog-image text-center">
						<img src="<?= Theme::imageUrlFromSufix($item['img']) ?>" style="border-radius: 20px;" alt="capa">
					</div>

					<?php if ($isBlogPostBlocked == 1) { ?>
						<p class="text-center">Este conteúdo é exclusivo para MetaFriends!</p>
						<div class="row">
							<div class="col-12 text-center my-4">
								<a class="btn btn-padrao" href="<?= Config::BASE_URL ?>/cliente/login">FAZER LOGIN</a>
							</div>
						</div>
					<?php } else { ?>

						<div class="blog-body-post">
							<?= $item['body'] ?>
						</div>

						<?php if ($youtubeLink != '') { ?>
						<div class="youtube-container">
							<iframe class="youtube-frame" src="<?= $youtubeLink ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
						<?php } ?>

						<?php if (Helper::safeString($item['cta_title']) != '') { ?>
						<div class="cta-container text-center">
							<a class="btn btn-padrao" target="_blank" href="<?= $item['cta_link'] ?>"><?= $item['cta_title'] ?></a>
						</div>
						<?php } ?>

					<?php } ?>

				</div>
			</div>
		</div>
	</div>

	<?php

	require_once('footer.php');

	?>
