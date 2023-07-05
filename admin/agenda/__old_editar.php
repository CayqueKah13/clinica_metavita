<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Themes\Theme;
use \Source\Themes\AdminTheme;
use \Source\Controllers\ScheduleController;
use \Source\Controllers\CustomerController;
use \Source\Controllers\InstructorController;
use \Source\Controllers\FinancesController;
use \Source\Core\Helper;
use \Source\Core\Config;
use \Source\Core\Session;
use \Source\Core\Dates;

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_SCHEDULE)) {
  Session::setErrorMessage("Acesso negado!");
  Helper::redirectToPage(Config::BASE_URL_ADMIN . "/dashboard");
  exit;
}



$id = Helper::safeInt($_GET['id']);
$item = ScheduleController::getDetails($id);
if (Helper::safeInt($item['id']) == 0) {
  Session::setErrorMessage("Agendamento não encontrado!");
  Helper::redirectToPage(Config::BASE_URL_ADMIN . "/agenda/agenda");
  exit;
}
$statusList = ScheduleController::getStatusList();
$paymentStatusList = ScheduleController::getPaymentStatusList();
$categoriesList = ScheduleController::getCategoriesList();
$customersList = CustomerController::getSearchList();
$instructorsList = InstructorController::getSearchList();

$customerID = Helper::safeInt($item['id_customer']);
$customer = CustomerController::getDetails($customerID);


$incomeCategoriesList = FinancesController::getIncomeCategoriesList();
$financesList = FinancesController::getListForScheduleEvent($id);
$paymentMethods = FinancesController::getAllPaymentMethods();

// Show Header
$currentTab = "schedule";
$breadcrumbs = array('Agenda');
require_once('../header.php');

?>

<h4 class="h4-responsive mt-1">Editar Agendamento #<?= $id ?></h4>

<!-- First row -->
<div class="row">
  <div class="col-12 mb-4">
    <div class="card card-cascade narrower">
      <div class="card-body card-body-cascade">
        <h5 class="text-center">Detalhes do Agendamento</h5>
        <div class="row">

          <div class="col-md-12">
            <form class="text-center" method="post" action="_edit">
              <input type="hidden" name="id" value="<?= $item['id'] ?>">

              <div class="row">
                <div class="col-md-6">
                  <select class="mdb-select md-form" name="category" required>
                    <option disabled selected>Categoria</option>
                    <?php foreach ($categoriesList as $key => $value) { ?>
                      <option value="<?= $value['id'] ?>" <?php if ($value['id'] == $item['id_category']) { echo "selected"; } ?>><?= $value['title'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-md-6">
                  <select class="mdb-select md-form" name="status" required>
                    <option disabled selected>Status</option>
                    <?php foreach ($statusList as $key => $value) { ?>
                      <option value="<?= $value['id'] ?>" <?php if ($value['id'] == $item['status']) { echo "selected"; } ?>><?= $value['title'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>


              <div class="row">
                <div class="col-md-6">
                  <select class="mdb-select md-form" name="customer" required>
                    <option disabled selected>Cliente</option>
                    <?php foreach ($customersList as $key => $value) { ?>
                      <option value="<?= $value['id'] ?>" <?php if ($value['id'] == $item['id_customer']) { echo "selected"; } ?>><?= $value['title'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-md-6">
                  <select class="mdb-select md-form" name="instructor" required>
                    <option disabled selected>Profissional</option>
                    <?php foreach ($instructorsList as $key => $value) { ?>
                      <option value="<?= $value['id'] ?>" <?php if ($value['id'] == $item['id_instructor']) { echo "selected"; } ?>><?= $value['title'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>


              <div class="row">
                <div class="col-md-6">
                  <div class="md-form">
                    <input type="text" id="input-date" class="form-control datepicker" name="date" value="<?= Dates::brlDateFormat($item['start_at']) ?>" required>
                    <label for="input-date">Data</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="md-form">
                    <input type="time" id="input-time" class="form-control" name="time" value="<?= Dates::brlHourFormat($item['start_time']) ?>" required>
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
                  <select class="mdb-select md-form" name="payment_status" disabled>
                    <option disabled selected>Status do Pagamento</option>
                    <?php foreach ($paymentStatusList as $key => $value) { ?>
                      <option value="<?= $value['id'] ?>" <?php if ($value['id'] == $item['payment_status']) { echo "selected"; } ?>><?= $value['title'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>


              <div class="md-form" style="margin-bottom:0px;">
                <input type="text" id="input-title" class="form-control" name="title" value="<?= $item['title'] ?>">
                <label for="input-title">Descrição</label>
              </div>

              <!-- <div class="md-form">
                <textarea type="text" id="input-message" class="md-textarea form-control" name="message" rows="3"><?= $item['message'] ?></textarea>
                <label for="input-message">Observações</label>
              </div> -->
              <input type="hidden" name="message" value="<?= $item['message'] ?>">

              <div class="row justify-content-center mb-4">
                <button class="btn btn-primary btn-rounded z-depth-0 waves-effect mt-4" type="submit">Atualizar</button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- First row -->





















<!-- Modal Form -->
<div class="modal fade" id="modal-register-2" tabindex="-1" role="dialog" aria-labelledby="modal-register-2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Cadastrar Pagamento</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <form class="text-center" method="post" action="_register_payment">
          <input type="hidden" name="id" value="<?= $id ?>">

          <input type="hidden" name="category" value="8">
          <select class="mdb-select md-form" name="payment_method" required>
            <option disabled selected>Forma de Pagamento</option>
            <?php foreach ($paymentMethods as $key => $value) { ?>
              <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
            <?php } ?>
          </select>

          <div class="md-form">
            <input type="text" id="input-title" class="form-control" name="title" value="<?php
            foreach ($categoriesList as $key => $value) {
              if ($value['id'] == $item['id_category']) { echo $value['title']; }
            }?>">
            <label for="input-title">Título</label>
          </div>

          <div class="md-form">
            <input type="text" id="input-date" class="form-control datepicker" name="date" value="<?= date('d/m/Y') ?>" required>
            <label for="input-date">Data</label>
          </div>

          <div class="md-form">
            <input type="text" id="price" class="form-control money" name="price"  value="<?= Helper::numbersOnly($item['price']) ?>" required>
            <label for="price">Valor R$</label>
          </div>

          <button class="btn btn-dark-green btn-rounded center z-depth-0 my-4 waves-effect" type="submit">Cadastrar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Form -->

<?php foreach ($financesList as $key => $value): ?>
  <?= AdminTheme::dangerModal('delete-payment-'.$value['id'], 'Tem certeza que deseja excluir este Pagamento? Esta ação não poderá ser desfeita!', '_delete_payment?ref='.$id.'&id='.$value['id'], 'Excluir Pagamento') ?>
<?php endforeach; ?>

<!-- Payment row -->
<div class="row">
  <div class="col-12 mb-4">
    <div class="card card-cascade narrower">
      <div class="card-body card-body-cascade pt-4">
        <h5 class="text-center pb-4">Detalhes do Pagamento</h5>
        <?php if (count($financesList) == 0) { ?>
        <p class="text-muted text-center">Nenhum registro financeiro encontrado para este agendamento</p>
        <?php } else { ?>
        <div class="row">
          <div class="col-md-12 pb-3">
            <div class="table-responsive text-nowrap">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Título</th>
                    <th style="width:100px;">Valor</th>
                    <th style="width:100px;">Data</th>
                    <th style="width:100px;">Excluir</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($financesList as $key => $value): ?>
                    <tr>
                      <td>
                        <?= $value['title'] ?>
                      </br>
                      <span style="color:#a0a0a0;">
                        <?php if ($value['id_group'] == 1) { ?>
                        <?= $value['category'] ?>
                        <?php } else { ?>
                        <?= $value['payment_method'] ?>
                        <?php } ?>
                      </span>
                      </td>
                      <td style="color:#<?= $value['color'] ?>!important;" ><?= Helper::decimalToBrlMoney($value['value']) ?></td>
                      <td><?= Dates::brlDateFormat($value['date']) ?></td>
                      <td>
                        <!-- <a href="_delete_payment?id=<?= $value['id'] ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Excluir"><i class="fas fa-trash"></i></a> -->
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-payment-<?= $value['id'] ?>"><i class="fas fa-trash"></i></button>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <?php } ?>

        <div class="row justify-content-center">
          <button class="btn btn-dark-green btn-rounded z-depth-0 waves-effect mt-4" data-toggle="modal" data-target="#modal-register-2">Cadastrar Pagamento</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Payment row -->







<!-- Second Row -->
<div class="row">
  <div class="col-12 mb-4">
    <div class="card card-cascade narrower">
      <div class="card-body card-body-cascade">
        <h5 class="text-center">Detalhes do Paciente</h5>
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

            <a href="<?= Config::BASE_URL_ADMIN ?>/clientes/editar?id=<?= $customerID ?>">Editar Paciente</a>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- Second Row -->









<!-- Delete Modal -->
<?= AdminTheme::dangerModal('delete-modal', 'Tem certeza que deseja excluir este Agendamento? Esta ação não poderá ser desfeita!', '_delete?id='.$id, 'Excluir Agendamento') ?>
<!-- Delete Modal -->

<hr class="mb-5">
<div class="row justify-content-between px-4 text-center">
  <a class="text-danger center mb-5" onclick="return $('#delete-modal').modal('show');" >Excluir Agendamento</a>
</div>




<?php
require_once('../footer.php');
?>
