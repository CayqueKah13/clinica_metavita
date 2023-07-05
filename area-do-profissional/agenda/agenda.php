<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Themes\InstructorTheme;
use \Source\Controllers\ScheduleController;
use \Source\Controllers\CustomerController;
use \Source\Controllers\InstructorController;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;
use \Source\Core\Dates;

if (!Session::isInstructorPermissionGranted()) {
  Session::setErrorMessage("Acesso negado!");
  Helper::redirectToPage(Config::BASE_URL_INSTRUCTOR . "/dashboard");
  exit;
}



$page = Helper::safeInt($_GET['page']);
$status = Helper::safeInt($_GET['status']);
$categoryID = Helper::safeInt($_GET['category']);
$customerID = Helper::safeInt($_GET['customer']);
$instructorUser = Session::getInstructorUser();
$instructorID = $instructorUser->id;//Helper::safeInt($_GET['instructor']);
$searchDate = Helper::safeString($_GET['date']);
$date1 = Helper::safeString($_GET['start']);
$date2 = Helper::safeString($_GET['end']);
$info = ScheduleController::getList($page, $status, $categoryID, $customerID, $instructorID, $date1, $date2);


$statusList = ScheduleController::getStatusList();
$categoriesList = ScheduleController::getCategoriesList();
$customersList = CustomerController::getSearchListForInstructor($instructorID);
$instructorsList = InstructorController::getSearchList();

// Show Header
$currentTab = "schedule";
$breadcrumbs = array('Agenda');
require_once('../header.php');

?>


<!-- Modal Form -->
<div class="modal fade" id="modal-register" tabindex="-1" role="dialog" aria-labelledby="modal-register" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Novo Agendamento</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <form class="text-center" method="post" action="_register">

          <select class="mdb-select md-form" name="category" required>
            <option disabled selected>Categoria</option>
            <?php foreach ($categoriesList as $key => $value) { ?>
              <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
            <?php } ?>
          </select>

          <select class="mdb-select md-form" searchable="Buscar.." name="customer" required>
            <option disabled selected>Cliente</option>
            <?php foreach ($customersList as $key => $value) { ?>
              <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
            <?php } ?>
          </select>

          <div class="row">
            <div class="col-md-6">
              <div class="md-form">
                <input type="text" id="input-date" class="form-control datepicker" name="date" required>
                <label for="input-date">Data</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="md-form">
                <input type="time" id="input-time" class="form-control" name="time" required>
                <label for="input-time">Hora</label>
              </div>
            </div>
          </div>

          <button class="btn btn-dark-green btn-rounded center z-depth-0 my-4 waves-effect" type="submit">Cadastrar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Form -->







<!-- First row -->
<div class="row my-5 pb-3">

  <!-- First column -->
  <div class="col-lg-3 mx-auto mb-4">
    <div class="card-body pt-0">
      <?php if (Session::isInstructorEditor()) { ?>
        <button type="button" class="btn btn-dark-green btn-lg btn-block px-0" data-toggle="modal" data-target="#modal-register"><i class="fas fa-plus left"></i> Cadastrar</button>
      <?php } ?>
      

      <div class="mt-5">
        <small>Filtrar Resultados:</small>
        <form action="agenda" method="get" class="md-form">
          <input type="hidden" name="page" value="1">

          <select class="mdb-select mb-4" name="status">
            <option value="0" <?php if ($status == 0) { echo "selected"; } ?>>Todos os Status</option>
            <?php foreach ($statusList as $key => $value): ?>
              <option value="<?= $value['id'] ?>" <?php if ($status == $value['id']) { echo "selected"; } ?>><?= $value['title'] ?></option>
            <?php endforeach; ?>
          </select>

          <select class="mdb-select mb-4" name="category">
            <option value="0" <?php if ($categoryID == 0) { echo "selected"; } ?>>Todas as Categorias</option>
            <?php foreach ($categoriesList as $key => $value): ?>
              <option value="<?= $value['id'] ?>" <?php if ($categoryID == $value['id']) { echo "selected"; } ?>><?= $value['title'] ?></option>
            <?php endforeach; ?>
          </select>

          <select class="mdb-select mb-4" searchable="Buscar.." name="customer">
            <option value="0" <?php if ($customerID == 0) { echo "selected"; } ?>>Todos os Pacientes</option>
            <?php foreach ($customersList as $key => $value): ?>
              <option value="<?= $value['id'] ?>" <?php if ($customerID == $value['id']) { echo "selected"; } ?>><?= $value['title'] ?></option>
            <?php endforeach; ?>
          </select>

          <!-- <div class="md-form">
            <input type="text" id="input-date" class="form-control datepicker" name="date" value="<?= $searchDate ?>">
            <label for="input-date">Data</label>
          </div> -->

          <div class="row">
            <div class="col-md-6">
              <div class="md-form mt-0">
                <input type="text" id="input-date-1" class="form-control datepicker" name="start" value="<?= $date1 ?>">
                <label for="input-date-1">De</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="md-form mt-0">
                <input type="text" id="input-date-2" class="form-control datepicker" name="end" value="<?= $date2 ?>">
                <label for="input-date-2">Até</label>
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-primary btn-block btn-sm px-0">Filtrar</button>
        </form>
      </div>
    </div>
  </div>
  <!-- First column -->

  <!-- Second column -->
  <div class="col-lg-8 mx-auto white z-depth-1">
    <h4 class="h4-responsive mt-4 mb-3"><?= $info['countTitle'] ?></h4>
    <div class="row">
      <div class="col-md-12 pb-3">
        <div class="table-responsive text-nowrap">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Categoria</th>
                <th>Paciente</th>
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
                    <a href="editar?id=<?= $value['id'] ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Detalhes"><i class="fas fa-search"></i></a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?= InstructorTheme::pagination($info); ?>
      </div>
    </div>
  </div>
  <!-- Second column -->

</div>
<!-- First row -->


<div class="container text-center">
  <a class="btn btn-primary px-5" href="calendario"><i class="fas fa-search left"></i> Ver Calendário</a>
</div>


<?php
require_once('../footer.php');
?>
