<?php
require __DIR__ . '/../source/autoload.php';

use \Source\Themes\AdminTheme;
use \Source\Themes\Theme;
use \Source\Core\Helper;
use \Source\Core\Dates;
use \Source\Core\Session;
use \Source\Core\Config;
use \Source\Controllers\ScheduleController;
use \Source\Controllers\CustomerController;
use \Source\Controllers\BlogController;


$customerUser = Session::getCustomerUser();
$customerID = $customerUser->id;
$info = CustomerController::getProfileInfo($customerID);
if (Helper::safeInt($info['id']) == 0) {
  Session::setErrorMessage("Sessão expirada!");
  Helper::redirectToPage(Config::BASE_URL_CUSTOMER . "/login");
  exit;
}

$scheduleItems = ScheduleController::getListForCustomer($customerID);
$blogItems = BlogController::getListPreview();


require_once('header.php');

?>

<div class="ap-area">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-4 text-center">
				<div class="row">
					<div class="col-12">
						<div class="neo-card px-2 pt-4 mb-4 pb-2">
							<h3>Dados</h3>
							<div class="profile-img">
								<div class="avatar-100" style="background-image:url('<?= Theme::imageUrlFromSufix($info['img']) ?>');"></div>
							</div>
							<div class="dados">
								<div class="dados-item">
									<p><b>Nome:</b> <?= $info['name'] ?></p>
								</div>
								<div class="dados-item">
									<p><b>E-mail:</b> <?= $info['email'] ?></p>
								</div>
								<div class="dados-item">
									<p><b>CPF:</b> <?= $info['cpf'] ?></p>
								</div>
								<div class="dados-item">
									<p><b>Telefone:</b> <?= $info['phone'] ?></p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12">
						<div class="neo-card px-2 py-4 mb-4">
							<h3>Benefícios de Parceiros</h3>
							<p>Confira os benefícios com nossos parceiros!</p>
							<a class="btn btn-padrao" href="<?= Config::BASE_URL_CUSTOMER.'/beneficios' ?>">Acesse Aqui</a>
						</div>
					</div>
					<!-- <div class="col-12 mb-4">
						<a href="ap-pesquisa-m1.html">
						<div class="dark-card">
							<h3>Pesquisa de Satisfação</h3>
							<p>Dê um feedback sobre os nossos serviços, é bem rápido :)</p>
						</div>
						</a>
					</div> -->
				</div>
			</div>
			<div class="col-sm-12 col-lg-8">
				<div class="row">
					<div class="col-12 minhameta text-center">
						<h3>Minha Meta <span>- <?= $info['goal_title'] ?></span></h3>
						<img class="my-3" src="<?= $themePath ?>/assets/img/goals/<?= $info['goal_img'] ?>" alt="">
					</div>

					<div class="col-12">
						<h3 class="text-center my-4">Consultas</h3>
						<?php if (count($scheduleItems) == 0) { ?>
						<p class="text-center">Nenhum resultado encontrado</p>
						<?php } else { ?>
						<table class="consultas-table mt-4">
							<thead>
								<tr>
									<td>Data</td>
									<td>Tipo</td>
									<td>MetaFamily</td>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($scheduleItems as $key => $value) { ?>
									<tr>
										<td><?= Dates::brlDateFormat($value['start_at']) ?></td>
										<td><?= $value['category'] ?></td>
										<td><?= $value['instructor_pronoun'] . ' ' . $value['instructor'] ?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
						<?php } ?>
					</div>

					<div class="col-12">
						<h3 class="text-center my-4">Conteúdos</h3>
            <?php if (count($blogItems) == 0) { ?>
            <p class="text-center">Nenhum resultado encontrado</p>
            <?php } else { ?>
						<div class="row CG-item-area">
                <?php foreach ($blogItems as $key => $value) { ?>
                  <div class="col-12 col-md-6 mb-4">
    								<a href="<?= Config::BASE_URL . '/conteudo/' . $value['slug'] ?>"><div class="CG-item neo-card" style="height:100%;">
    									<div class="CG-item-img">
                        <div class="cover-100" style="background-image:url('<?= Theme::imageUrlFromSufix($value['img']) ?>');"></div>
    									</div>
    									<h3><?= $value['title'] ?></h3>
                      <p><?= $value['subtitle'] ?></p>
    									<div class="CG-tag">
    										<p><?php if ($value['id_category'] == 2) {echo $value['category'];} ?></p>
    									</div>
    								</div>
    								</a>
    							</div>
								<?php } ?>
                </div>
  						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php
require_once('footer.php');
?>
