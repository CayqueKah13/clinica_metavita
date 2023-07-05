<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Themes\AdminTheme;
use \Source\Controllers\CategoriesController;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;
use \Source\Core\Dates;

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_ADMINS)) {
  Session::setErrorMessage("Acesso negado!");
  Helper::redirectToPage(Config::BASE_URL_ADMIN . "/dashboard");
  exit;
}



// $page = Helper::safeInt($_GET['page']);
// $search = Helper::safeString($_GET['search']);
// $status = Helper::safeInt($_GET['status']);
// $month = Helper::safeInt($_GET['month']);
// $info = CustomerController::getList($page, $search, $status, $month);
//
// $statusList = CustomerController::getStatusList();
// $pronounList = CustomerController::getPronounList();

$keys = [CategoriesController::SCHEDULE_EVENTS_CATEGORIES, CategoriesController::EXPENSES_CATEGORIES];


// Show Header
$currentTab = "categories";
$breadcrumbs = array('Categorias');
require_once('../header.php');

?>




<?php foreach ($keys as $index => $key) { ?>
  <!-- Modal Form -->
  <div class="modal fade" id="modal-register-<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="modal-register-<?= $key ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-title w-100 font-weight-bold">Cadastrar <?= CategoriesController::titleFrom($key) ?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body mx-3">
          <form class="text-center" method="post" action="_register">
            <input type="hidden" name="key" value="<?= $key ?>">
            <div class="md-form">
              <input type="text" id="input-title" class="form-control" name="title" required>
              <label for="input-title">Título</label>
            </div>
            <button class="btn btn-dark-green btn-rounded center z-depth-0 my-4 waves-effect" type="submit">Cadastrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Form -->
<?php } ?>




<?php foreach ($keys as $index => $key) { ?>
  <?php foreach (CategoriesController::getList($key) as $i => $value): ?>
    <!-- Delete Modal -->
    <?= AdminTheme::dangerModal('delete-modal-'.$key.'-'.$value['id'], 'Tem certeza que deseja excluir "'.$value['title'].'" como "'.CategoriesController::titleFrom($key).'"? Esta ação não poderá ser desfeita!', '_delete?id='.$value['id'].'&key='.$key, 'Excluir') ?>
    <!-- Delete Modal -->
  <?php endforeach; ?>
<?php } ?>





<!-- <hr class="mb-5">
<div class="row justify-content-between px-4 text-center">
  <a class="text-danger center mb-5" onclick="return $('#delete-modal').modal('show');" >Excluir Paciente</a>
</div> -->








<?php foreach ($keys as $index => $key) { ?>
<!-- First row -->
<div class="row my-5 pb-3">

  <!-- Second column -->
  <div class="col-12 mx-auto white z-depth-1">
    <div class="row mb-0">
      <div class="col-md-12 pb-0 mb-0">
        <div class="table-responsive text-nowrap">
          <table class="table table-hover">
            <thead>
              <tr>
                <th style="width:30px;"></th>
                <th><?= CategoriesController::titleFrom($key) ?></th>
                <th style="width:30px;"><button class="btn btn-sm btn-dark-green my-0" data-toggle="modal" data-target="#modal-register-<?= $key ?>"> <span class="fas fa-plus"></span> </button></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach (CategoriesController::getList($key) as $i => $value): ?>
                <tr>
                  <td class="line-height-32"><?= $value['id'] ?></td>
                  <td class="line-height-32"><?= $value['title'] ?></td>
                  <td class="line-height-32"> <button class="btn btn-sm btn-danger" onclick="return $('#delete-modal-<?= $key ?>-<?= $value['id'] ?>').modal('show');" > <span class="fas fa-trash"></span> </button> </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- Second column -->

</div>
<!-- First row -->
<?php } ?>




<?php
require_once('../footer.php');
?>
