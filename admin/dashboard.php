<?php
require __DIR__ . '/../source/autoload.php';

use \Source\Themes\AdminTheme;
use \Source\Core\Config;
use \Source\Core\Session;
use \Source\Core\Helper;
use \Source\Core\Dates;
use \Source\Controllers\ScheduleController;
use \Source\Controllers\FinancesController;
use \Source\Controllers\CustomerController;

// use \Source\Support\Mailer;
// Mailer::sendEmailQueue();

$admUser = Session::getAdminUser();
$id = Helper::safeInt($admUser->id);
if ($id == 0) {
  Session::setErrorMessage("Acesso negado!");
  Helper::redirectToPage(Config::BASE_URL_ADMIN . "/login/login");
  exit;
}


// Today Schedule
$searchDate = Dates::brlDateFormat(Dates::today());
$pendingScheduleInfo = ScheduleController::getPendingInfoForInstructor(0, $searchDate);
$scheduleOverview = ScheduleController::getOverview();
$financesOverview = FinancesController::getOverviewPreview();



// Month Birthday Customers
$birthdayCustomers = CustomerController::getMonthBirthdayList();


// Show Header
$currentTab = "dashboard";
$breadcrumbs = array('Dashboard');
require_once('header.php');

?>


<h2 class="mt-2 mb-5">Bem vindo, <?= $admUser->getFirstName() ?>!</h2>


<?php if (Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_SCHEDULE)) { ?>
<!-- Agendamentos Pendentes -->
<?php if ($pendingScheduleInfo['total'] > 0) { ?>
<a href="<?= Config::BASE_URL_ADMIN ?>/agenda/agenda?status=1&date=<?= Dates::brlDateFormat($pendingScheduleInfo['reference_date']) ?>">
  <div class="card text-center mb-4 pt-4 pb-3 red accent-2 white-text">
    <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
    <h4 class="h4-responsive">Agendamentos pendentes em dias anteriores</h4>
  </div>
</a>
<?php } ?>
<!-- Agendamentos Pendentes -->



<!-- Visão Geral Agendamentos -->
<div class="container-fluid">
  <h4 class="h4-responsive mt-4">Visão Geral de Agendamentos</h4>
  <p class="text-muted">Dados de datas futuras não fazem parte deste relatório.</p>
  <div class="row mb-5 pb-3">
    <div class="col-lg-12 mx-auto white z-depth-1">
      <div class="row">
        <div class="col-md-12 pb-3">
          <div class="table-responsive text-nowrap">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Período</th>
                  <?php foreach ($scheduleOverview[0]['items'] as $key => $value): ?>
                    <th><?= $key ?></th>
                  <?php endforeach; ?>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($scheduleOverview as $key => $value): ?>
                  <tr>
                    <td><?= $value['title'] ?></td>
                    <?php foreach ($value['items'] as $key => $value): ?>
                      <th><?= $value ?></th>
                    <?php endforeach; ?>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Visão Geral Agendamentos -->
<?php } ?>










<?php if (Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_FINANCES)) { ?>
<!-- Relatório Financeiro -->
<div class="container-fluid">
  <h4 class="h4-responsive mt-4 mb-3">Resumo Financeiro</h4>
  <div class="row mb-5 pb-3">
    <div class="col-lg-12 mx-auto white z-depth-1">
      <div class="row">
        <div class="col-md-12 pb-3">
          <div class="table-responsive text-nowrap">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Mês</th>
                  <th>Receitas</th>
                  <th>Despesas</th>
                  <th>Saldo</th>
                  <th style="width:100px;">Detalhes</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($financesOverview as $key => $value): ?>
                  <tr>
                    <td><?= $value['title'] ?></td>
                    <td><?= Helper::decimalToBrlMoney($value['income']) ?></td>
                    <td><?= Helper::decimalToBrlMoney($value['expenses']) ?></td>
                    <td><?= Helper::decimalToBrlMoney($value['income'] - $value['expenses']) ?></td>
                    <td>
                      <a href="<?= Config::BASE_URL_ADMIN ?>/financeiro/financeiro?start=<?= Dates::brlDateFormat($value['start']) ?>&end=<?= Dates::brlDateFormat($value['end']) ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Ver Detalhes"><i class="fas fa-search"></i></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Relatório Financeiro -->
<?php } ?>






<!-- Aniversariantes -->
<div class="col-lg-12 mx-auto white z-depth-1 py-2">
    <h4 class="h4-responsive mt-4 mb-3">Aniversariantes do mês</h4>
    <div class="row">
      <div class="col-md-12 pb-3">
        <div class="table-responsive text-nowrap">
          <table class="table table-hover">
            <thead>
              <tr>
                <th style="width:32px;"></th>
                <th>Nome</th>
                <th>Nascimento</th>
                <th>Whatsapp</th>
                <th style="width:100px;">Observações</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($birthdayCustomers as $key => $value): ?>
                <tr>
                  <td class="pr-0"><?= AdminTheme::avatarThumb($value['img'], $value['name']) ?></td>
                  <td class="line-height-32"><?= $value['name'] ?></td>
                  <td class="line-height-32">
                    <?php if (Helper::safeString($value['born_at']) != '') { ?>
                      <?= Dates::brlDateFormat($value['born_at']) ?>
                    <?php } else { ?>
                      <p>-</p>
                    <?php } ?>
                  </td>
                  <td class="line-height-32">
                    <?php if (Helper::safeString($value['phone']) != '') { ?>
                      <a style="color:#007bff!important;" target="_blank" href="<?= Config::WHATSAPP_URL ?><?= Helper::numbersOnly($value['phone']); ?>" ><?= $value['phone'] ?></a>
                    <?php } else { ?>
                      <p>-</p>
                    <?php } ?>
                  </td>
                  <td>
                    <a href="#" class="btn <?php if (Helper::safeString($value['message']) != '') { echo "btn-default"; } else { echo "btn-light"; } ?> btn-sm" data-toggle="modal" data-target="#modal-info-<?= $value['id'] ?>">
                      <i class="fas fa-search"></i>
                    </a>
                  </td>
                  
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<!-- Aniversariantes -->










<div class="mt-5 mb-5">
  <p class="text-center">-</p>
</div>


<?php
require_once('footer.php');
?>
