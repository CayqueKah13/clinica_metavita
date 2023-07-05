<?php
require __DIR__ . '/../source/autoload.php';

use \Source\Core\Config;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Dates;
use \Source\Controllers\InstructorController;
use \Source\Controllers\ScheduleController;
use \Source\Themes\InstructorTheme;



// Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_ADMINS);

if (!Session::isInstructorPermissionGranted()) {
  Session::setErrorMessage("Acesso negado!");
  Helper::redirectToPage(Config::BASE_URL_INSTRUCTOR . "/login/login");
  exit;
}


// Today Schedule
$instructorUser = Session::getInstructorUser();
$instructorID = $instructorUser->id;
$searchDate = Dates::brlDateFormat(Dates::today());
$info = ScheduleController::getListForInstructor($instructorID, $searchDate);
$pendingScheduleInfo = ScheduleController::getPendingInfoForInstructor($instructorID, $searchDate);



// Show Header
$currentTab = "dashboard";
$breadcrumbs = array('Dashboard');
require_once('header.php');

$details = InstructorController::getDetails($instructorUser->id);

?>


<h2 class="mt-2 mb-5">Bem vindo, <?= $details['pronoun'] . ' ' . $instructorUser->getFirstName() ?>!</h2>




<!-- Agendamentos Pendentes -->
<?php if ($pendingScheduleInfo['total'] > 0) { ?>
<a href="<?= Config::BASE_URL_INSTRUCTOR ?>/agenda/agenda?status=1&date=<?= Dates::brlDateFormat($pendingScheduleInfo['reference_date']) ?>">
  <div class="card text-center mb-4 pt-4 pb-3 red accent-2 white-text">
    <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
    <h4 class="h4-responsive">Você tem agendamentos pendentes em dias anteriores</h4>
  </div>
</a>
<?php } ?>
<!-- Agendamentos Pendentes -->



<!-- Agenda de Hoje -->
<div class="container-fluid">
  <div class="row my-5 pb-3">
    <h4 class="h4-responsive mt-4 mb-3">Agendamentos de Hoje (<?= count($info['items']) ?>)</h4>
    <div class="col-lg-12 mx-auto white z-depth-1">
      <div class="row">
        <div class="col-md-12 pb-3">
          <?php if (count($info['items']) == 0) { ?>
            <p class="text-center mt-4">Nenhum resultado encontrado</p>
          <?php } else { ?>
          <div class="table-responsive text-nowrap">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Categoria</th>
                  <th>Cliente</th>
                  <th>Profissional</th>
                  <th>Data</th>
                  <th>Status</th>
                  <th style="width:100px;">Detalhes</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($info['items'] as $key => $value): ?>
                  <tr>
                    <td><?= $value['category'] ?></td>
                    <td><?= $value['customer'] ?></td>
                    <td><?= $value['instructor'] ?></td>
                    <td><?= Dates::brlDateFormat($value['start_at']) . ' - ' . Dates::brlHourFormat($value['start_time']) ?></td>
                    <td><?= $value['status_title'] ?></td>
                    <td>
                      <a href="<?= Config::BASE_URL_INSTRUCTOR ?>/agenda/editar?id=<?= $value['id'] ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-search"></i></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Agenda de Hoje -->




<?php
require_once('footer.php');
?>
