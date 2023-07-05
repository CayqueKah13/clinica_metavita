<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Themes\Theme;
use \Source\Themes\AdminTheme;
use \Source\Controllers\FinancesController;
use \Source\Controllers\CustomerController;
use \Source\Core\Helper;
use \Source\Core\Config;
use \Source\Core\Session;
use \Source\Core\Dates;

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_FINANCES)) {
  Session::setErrorMessage("Acesso negado!");
  Helper::redirectToPage(Config::BASE_URL_ADMIN . "/dashboard");
  exit;
}



$id = Helper::safeInt($_GET['id']);
$item = FinancesController::getDetails($id);
if (Helper::safeInt($item['id']) == 0) {
  Session::setErrorMessage("Registro não encontrado!");
  Helper::redirectToPage(Config::BASE_URL_ADMIN . "/financeiro/financeiro");
  exit;
}

if ($item['id_group'] == 1) {
  $categoriesList = FinancesController::getExpensesCategoriesList();
} else {
  $categoriesList = FinancesController::getIncomeCategoriesList();
}
$paymentMethods = FinancesController::getAllPaymentMethods();

$customersList = CustomerController::getSearchList();

$repeatDaysList = FinancesController::getRepeatDaysList();

// var_dump($paymentMethods);
// exit;

// Show Header
$currentTab = "finances";
$breadcrumbs = array('Financeiro');
require_once('../header.php');

?>

<h4 class="h4-responsive mt-1">Editar Registro #<?= $id ?></h4>

<!-- First row -->
<div class="row">
  <div class="col-12 mb-4">
    <div class="card card-cascade narrower">
      <div class="card-body card-body-cascade">
        <h5><span class="badge red" style="background-color:#<?= $item['color'] ?>!important;"><?= Helper::uppercase($item['group']) ?></span></h5>
        <div class="row">

          <div class="col-md-12">
            <form class="text-center" method="post" action="_edit">
              <input type="hidden" name="id" value="<?= $item['id'] ?>">

              <div class="row">
                <div class="col-md-6">
                  <?php if ($item['id_group'] == 1) { ?>
                    <input type="hidden" name="payment_method" value="<?= $item['id_payment_method'] ?>">
                    <select class="mdb-select md-form" name="category" required>
                      <option disabled selected>Categoria</option>
                      <?php foreach ($categoriesList as $key => $value) { ?>
                        <option value="<?= $value['id'] ?>" <?php if ($value['id'] == $item['id_category']) { echo "selected"; } ?>><?= $value['title'] ?></option>
                      <?php } ?>
                    </select>
                  <?php } else { ?>
                    <input type="hidden" name="category" value="<?= $item['id_category'] ?>">
                    <select class="mdb-select md-form" name="payment_method" required>
                      <option disabled selected>Forma de Pagamento</option>
                      <?php foreach ($paymentMethods as $key => $value) { ?>
                        <option value="<?= $value['id'] ?>" <?php if ($value['id'] == $item['id_payment_method']) { echo "selected"; } ?>><?= $value['title'] ?></option>
                      <?php } ?>
                    </select>
                  <?php } ?>
                </div>
                <div class="col-md-6">
                  <div class="md-form">
                    <input type="text" id="input-date" class="form-control datepicker" name="date" value="<?= Dates::brlDateFormat($item['date']) ?>" required>
                    <label for="input-date">Data</label>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="md-form" style="margin-bottom:0px;">
                    <input type="text" id="input-title" class="form-control" name="title" value="<?= $item['title'] ?>">
                    <label for="input-title">Título</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="md-form">
                    <input type="text" id="input-price" class="form-control money" name="value" value="<?= $item['value'] ?>" required>
                    <label for="input-price">Valor R$</label>
                  </div>
                </div>
              </div>

              <!-- <div class="row">
                <div class="col-md-6">
                  <div class="md-form">
                    <input type="text" id="input-description" class="form-control" name="description" value="<?= $item['description'] ?>">
                    <label for="input-description">Descrição</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <select class="mdb-select md-form" name="customer" searchable="Buscar.." >
                    <option disabled selected>Cliente</option>
                    <option value="0" <?php if ($item['id_customer'] == 0) { echo "selected"; } ?>>Nenhum Cliente Vinculado</option>
                    <?php foreach ($customersList as $key => $value) { ?>
                      <option value="<?= $value['id'] ?>" <?php if ($value['id'] == $item['id_customer']) { echo "selected"; } ?>><?= $value['title'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div> -->

              <div class="md-form">
                <input type="text" id="input-description" class="form-control" name="description" value="<?= $item['description'] ?>">
                <label for="input-description">Descrição</label>
              </div>

              <!-- <select class="mdb-select md-form" name="repeat-day">
                <option disabled selected>Repetir Mensalmente</option>
                <option value="0" <?php if ($item['repeat_day'] == 0) { echo "selected"; } ?>>Não Repetir</option>
                <?php foreach ($repeatDaysList as $key => $value) { ?>
                  <option value="<?= $value ?>" <?php if ($value == $item['repeat_day']) { echo "selected"; } ?>>Repetir todo dia <?= $value ?></option>
                <?php } ?>
              </select> -->
              <input type="hidden" name="repeat-day" value="<?= $item['repeat_day'] ?>">



              <div class="row justify-content-center mb-4">
                <button class="btn btn-primary btn-rounded z-depth-0 waves-effect mt-4" type="submit">Atualizar <?= $item['group'] ?></button>
              </div>
            </form>
          </div>

        </div>
      </div>
      <?php if (Helper::safeInt($item['id_schedule_event']) > 0) { ?>
      <div class="card-footer">
        <a href="<?= Config::BASE_URL_ADMIN . '/agenda/editar?id=' . $item['id_schedule_event'] ?>">Detalhes do Agendamento</a>
      </div>
      <?php } ?>
    </div>
  </div>
</div>
<!-- First row -->










<!-- Delete Modal -->
<?= AdminTheme::dangerModal('delete-modal', 'Tem certeza que deseja excluir este Registro? Esta ação não poderá ser desfeita!', '_delete?id='.$id, 'Excluir Registro') ?>
<!-- Delete Modal -->

<hr class="mb-5">
<div class="row justify-content-between px-4 text-center">
  <a class="text-danger center mb-5" onclick="return $('#delete-modal').modal('show');" >Excluir Registro</a>
</div>




<?php
require_once('../footer.php');
?>
