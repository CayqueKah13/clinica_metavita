<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Themes\Theme;
use \Source\Themes\AdminTheme;
use \Source\Controllers\ScheduleController;
use \Source\Controllers\CustomerController;
use \Source\Controllers\InstructorController;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;
use \Source\Core\Dates;

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_SCHEDULE)) {
  Session::setErrorMessage("Acesso negado!");
  Helper::redirectToPage(Config::BASE_URL_ADMIN . "/dashboard");
  exit;
}




$instructorID = Helper::safeInt($_GET['instructor']);
$items = ScheduleController::getCalendarEvents($instructorID);

$instructorsList = InstructorController::getSearchList();

// Show Header
$currentTab = "schedule";
$breadcrumbs = array('Agenda');
require_once('../header.php');

?>





<div class="card mb-5">

    <div class="card-body pt-0">
      <div class="mt-5">
        <p>Filtro</p>
        <form action="calendario" method="get" class="md-form">
          <select class="mdb-select mb-4" searchable="Buscar.." name="instructor">
            <option value="0" <?php if ($instructorID == 0) { echo "selected"; } ?>>Todos os Profissionais</option>
            <?php foreach ($instructorsList as $key => $value): ?>
              <option value="<?= $value['id'] ?>" <?php if ($instructorID == $value['id']) { echo "selected"; } ?>><?= $value['title'] ?></option>
            <?php endforeach; ?>
          </select>
          <button type="submit" class="btn btn-primary btn-block btn-sm px-0">Filtrar</button>
        </form>
      </div>
    </div>

</div>






<!-- Section: Calendar -->
<section>
  <p class="text-muted"><?= number_format(count($items), 0, '', '.') ?> Agendamentos Encontrados</p>
  <!-- Grid row -->
  <div class="row mb-5">
    <!-- Grid column -->
    <div class="col-md-12">
      <div id="calendar"></div>
    </div>
    <!-- Grid column -->
  </div>
  <!-- Grid row -->
</section>
<!-- /.Section: Calendar -->








<?php
require_once('../footer.php');
?>




<!--Custom scripts-->
<script>
// SideNav Initialization
$(".button-collapse").sideNav();

// var container = document.querySelector('.custom-scrollbar');
// Ps.initialize(container, {
//   wheelSpeed: 2,
//   wheelPropagation: true,
//   minScrollbarLength: 20
// });
$(document).ready(function () {
  $('#calendar').fullCalendar({
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay, listWeek'
    },
    defaultDate: '<?= date('Y-m-d') ?>',
    navLinks: true, // can click day/week names to navigate views
    editable: false,
    eventLimit: true, // allow "more" link when too many events
    events: [
      <?php foreach ($items as $key => $value) { ?>
        {
          title: '<?= $value['category'] . ' - ' . $value['instructor'] ?>',
          start: '<?= $value['start_at'] ?>T<?= $value['start_time'] ?>',
        },
      <?php } ?>
  ]
})
});

</script>
