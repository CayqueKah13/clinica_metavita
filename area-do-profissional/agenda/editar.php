<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Themes\Theme;
use \Source\Themes\InstructorTheme;
use \Source\Controllers\ScheduleController;
use \Source\Controllers\CustomerController;
use \Source\Controllers\InstructorController;
use \Source\Core\Helper;
use \Source\Core\Config;
use \Source\Core\Session;
use \Source\Core\Dates;

if (!Session::isInstructorPermissionGranted()) {
  Session::setErrorMessage("Acesso negado!");
  Helper::redirectToPage(Config::BASE_URL_INSTRUCTOR . "/dashboard");
  exit;
}

$instructorUser = Session::getInstructorUser();
$instructorID = $instructorUser->id;//Helper::safeInt($_GET['instructor']);

$id = Helper::safeInt($_GET['id']);
$item = ScheduleController::getDetails($id);
if (Helper::safeInt($item['id']) == 0 || Helper::safeInt($item['id_instructor']) != $instructorID) {
  Session::setErrorMessage("Agendamento não encontrado!");
  Helper::redirectToPage(Config::BASE_URL_INSTRUCTOR . "/agenda/agenda");
  exit;
}
$statusList = ScheduleController::getStatusList();
$paymentStatusList = ScheduleController::getPaymentStatusList();
$categoriesList = ScheduleController::getCategoriesList();


$customersList = CustomerController::getSearchListForInstructor($instructorID);
$instructorsList = InstructorController::getSearchList();


$customerID = Helper::safeInt($item['id_customer']);
$customer = CustomerController::getDetails($customerID);


$isEditor = Session::isInstructorEditor();
$disabledForm = "";
if (!$isEditor) {
  $disabledForm = " disabled ";
}

// Show Header
$currentTab = "schedule";
$breadcrumbs = array('Agenda');
require_once('../header.php');

?>

<h4 class="h4-responsive mt-1">Detalhes do Agendamento #<?= $id ?></h4>

<!-- First row -->
<div class="row">
  <div class="col-12 mb-4">
    <div class="card card-cascade narrower">
      <div class="card-body card-body-cascade">
        <!-- <h5 class="text-center">Detalhes do Agendamento</h5> -->
        <div class="row">

          <div class="col-md-12">
            <form class="text-center" method="post" action="_edit">
              <input type="hidden" name="id" value="<?= $item['id'] ?>">

              <div class="row">
                <div class="col-md-6">
                  <select class="mdb-select md-form" name="category" required <?= $disabledForm ?>>
                    <option disabled selected>Categoria</option>
                    <?php foreach ($categoriesList as $key => $value) { ?>
                      <option value="<?= $value['id'] ?>" <?php if ($value['id'] == $item['id_category']) { echo "selected"; } ?>><?= $value['title'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-md-6">
                  <select class="mdb-select md-form" name="status" required <?= $disabledForm ?>>
                    <option disabled selected>Status</option>
                    <?php foreach ($statusList as $key => $value) { ?>
                      <option value="<?= $value['id'] ?>" <?php if ($value['id'] == $item['status']) { echo "selected"; } ?>><?= $value['title'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>


              <select class="mdb-select md-form" name="customer" required <?= $disabledForm ?>>
                <option disabled selected>Cliente</option>
                <?php foreach ($customersList as $key => $value) { ?>
                  <option value="<?= $value['id'] ?>" <?php if ($value['id'] == $item['id_customer']) { echo "selected"; } ?>><?= $value['title'] ?></option>
                <?php } ?>
              </select>


              <div class="row">
                <div class="col-md-6">
                  <div class="md-form">
                    <input type="text" id="input-date" class="form-control datepicker" name="date" value="<?= Dates::brlDateFormat($item['start_at']) ?>" required <?= $disabledForm ?>>
                    <label for="input-date">Data</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="md-form">
                    <input type="time" id="input-time" class="form-control" name="time" value="<?= Dates::brlHourFormat($item['start_time']) ?>" required <?= $disabledForm ?>>
                    <label for="input-time">Hora</label>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="md-form">
                    <input type="text" id="input-price" class="form-control money" name="price" value="<?= Helper::numbersOnly($item['price']) ?>" disabled>
                    <label for="input-price">Valor R$</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <select class="mdb-select md-form" name="payment_status" required disabled>
                    <option disabled selected>Status do Pagamento</option>
                    <?php foreach ($paymentStatusList as $key => $value) { ?>
                      <option value="<?= $value['id'] ?>" <?php if ($value['id'] == $item['payment_status']) { echo "selected"; } ?>><?= $value['title'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>


              <div class="md-form" style="margin-bottom:0px;">
                <input type="text" id="input-title" class="form-control" name="title" value="<?= $item['title'] ?>" <?= $disabledForm ?>>
                <label for="input-title">Descrição</label>
              </div>

              <div class="md-form">
                <textarea type="text" id="input-message" class="md-textarea form-control" name="message" rows="3" <?= $disabledForm ?>><?= $item['message'] ?></textarea>
                <label for="input-message">Observações</label>
              </div>

              
              <?php if ($isEditor) { ?>
                <div class="row justify-content-center mb-4">
                  <button class="btn btn-primary btn-rounded z-depth-0 waves-effect mt-4" type="submit">Atualizar</button>
                </div>
              <?php } ?>

            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- First row -->



<h4 class="h4-responsive mt-1">Detalhes do Paciente</h4>

<!-- Second Row -->
<div class="row" style="margin-bottom:100px;">
  <div class="col-12 mb-4">
    <div class="card card-cascade narrower">
      <div class="card-body card-body-cascade">
        <div class="row">

          <div class="col-md-12">
            <form class="text-center" >
              <div class="row">
                <div class="col-md-3">
                  <select class="mdb-select md-form" name="pronoun" disabled>
                    <option selected><?= $customer['pronoun'] ?></option>
                  </select>
                </div>
                <div class="col-md-9">
                  <div class="md-form" style="margin-bottom:0px;">
                    <input type="text" id="input-name" class="form-control" name="name" value="<?= $customer['name'] ?>" disabled>
                    <label for="input-name">Nome</label>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="md-form"  style="margin-bottom:0px;">
                    <input type="email" id="input-email" class="form-control" name="email" value="<?= $customer['email'] ?>" disabled>
                    <label for="input-email">Email</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="md-form"  style="margin-bottom:0px;">
                    <input type="text" id="input-phone" class="form-control phone_with_ddd" name="phone" value="<?= $customer['phone'] ?>" disabled>
                    <label for="input-phone">Telefone</label>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="md-form"  style="margin-bottom:0px;">
                    <input type="text" id="input-cpf" class="form-control cpf" name="cpf" value="<?= $customer['cpf'] ?>" disabled>
                    <label for="input-cpf">CPF</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="md-form">
                    <input type="text" id="input-date" class="form-control date" name="born" value="<?= Dates::brlDateFormat($customer['born_at']) ?>" disabled>
                    <label for="input-date">Data de Nascimento</label>
                  </div>
                </div>
              </div>

              <div class="md-form">
                <textarea type="text" id="input-message" class="md-textarea form-control" name="message" rows="3" disabled><?= $customer['message'] ?></textarea>
                <label for="input-message">Observações</label>
              </div>

            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- Second Row -->








<!-- Delete Modal -->
<!-- <?= InstructorTheme::dangerModal('delete-modal', 'Tem certeza que deseja excluir este Agendamento? Esta ação não poderá ser desfeita!', '_delete?id='.$id, 'Excluir Agendamento') ?> -->
<!-- Delete Modal -->

<!-- <hr class="mb-5">
<div class="row justify-content-between px-4 text-center">
  <a class="text-danger center mb-5" onclick="return $('#delete-modal').modal('show');" >Excluir Agendamento</a>
</div> -->




<?php
require_once('../footer.php');
?>
