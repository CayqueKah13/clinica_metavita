<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Themes\AdminTheme;
use \Source\Controllers\FinancesController;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;
use \Source\Core\Dates;

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_FINANCES)) {
  Session::setErrorMessage("Acesso negado!");
  Helper::redirectToPage(Config::BASE_URL_ADMIN . "/dashboard");
  exit;
}



$page = Helper::safeInt($_GET['page']);
$groupID = Helper::safeInt($_GET['group']);
$categoryID = Helper::safeInt($_GET['category']);
$date1 = Helper::safeString($_GET['start']);
$date2 = Helper::safeString($_GET['end']);
$info = FinancesController::getList($page, $groupID, $categoryID, $date1, $date2);

$expensesCategoriesList = FinancesController::getExpensesCategoriesList();
$incomeCategoriesList = FinancesController::getIncomeCategoriesList();
$allCategoriesList = FinancesController::getAllCategoriesList();
$paymentMethods = FinancesController::getAllPaymentMethods();


// Show Header
$currentTab = "finances";
$breadcrumbs = array('Financeiro');
require_once('../header.php');

?>


<!-- Modal Form -->
<div class="modal fade" id="modal-register-1" tabindex="-1" role="dialog" aria-labelledby="modal-register-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Cadastrar Despesa</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <form class="text-center" method="post" action="_register">
          <input type="hidden" name="group" value="1">

          <select class="mdb-select md-form" name="category" required>
            <option disabled selected>Categoria</option>
            <?php foreach ($expensesCategoriesList as $key => $value) { ?>
              <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
            <?php } ?>
          </select>

          <div class="md-form">
            <input type="text" id="input-title" class="form-control" name="title" required>
            <label for="input-title">Título</label>
          </div>

          <div class="md-form">
            <input type="text" id="input-date" class="form-control datepicker" name="date" required>
            <label for="input-date">Data</label>
          </div>

          <div class="md-form">
            <input type="text" id="input-price" class="form-control money" name="price" required>
            <label for="input-price">Valor R$</label>
          </div>

          <button class="btn btn-danger btn-rounded center z-depth-0 my-4 waves-effect" type="submit">Cadastrar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Form -->



<!-- Modal Form -->
<div class="modal fade" id="modal-register-2" tabindex="-1" role="dialog" aria-labelledby="modal-register-2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Cadastrar Receita</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <form class="text-center" method="post" action="_register">
          <input type="hidden" name="group" value="2">

          <input type="hidden" name="category" value="8">
          <select id="paymentoption" class="mdb-select md-form" name="payment_method" required>
            <option disabled selected>Forma de Pagamento</option>
            <?php foreach ($paymentMethods as $key => $value) { ?>
              <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
            <?php } ?>
          </select>

          <div id="installmentsoption" style="display:none;">
            <select class="mdb-select md-form" name="totalinstallments">
              <option disabled selected>Parcelas</option>
              <?php for ($i=2; $i <= 12; $i++) { ?>
                <option value="<?= $i ?>"><?= $i ?>x</option>
              <?php } ?>
            </select>
          </div>

          <div class="md-form">
            <input type="text" id="input-title" class="form-control" name="title">
            <label for="input-title">Título</label>
          </div>

          <div class="md-form">
            <input type="text" id="input-date" class="form-control datepicker" name="date" required>
            <label for="input-date">Data</label>
          </div>

          <div class="md-form">
            <input type="text" id="input-price" class="form-control money" name="price" required>
            <label for="input-price">Valor R$</label>
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
      <button type="button" class="btn btn-danger btn-lg btn-block px-0 mb-4" data-toggle="modal" data-target="#modal-register-1"><i class="fas fa-plus left"></i> Cadastrar Despesa</button>
      <button type="button" class="btn btn-dark-green btn-lg btn-block px-0" data-toggle="modal" data-target="#modal-register-2"><i class="fas fa-plus left"></i> Cadastrar Receita</button>
      <div class="mt-5">
        <small>Filtrar Resultados:</small>
        <form action="financeiro" method="get" class="md-form">
          <input type="hidden" name="page" value="1">

          <select class="mdb-select" name="group">
            <option value="0" <?php if ($groupID == 0) { echo "selected"; } ?>>Todos os Registros</option>
            <option value="1" <?php if ($groupID == 1) { echo "selected"; } ?>>Despesas</option>
            <option value="2" <?php if ($groupID == 2) { echo "selected"; } ?>>Receitas</option>
          </select>

          <select class="mdb-select md-form mb-0" name="category" searchable="Buscar.." required>
            <option disabled selected>Categoria</option>
            <option value="0" <?php if ($categoryID == 0) { echo "selected"; } ?>>Todas as Categorias</option>
            <?php foreach ($allCategoriesList as $key => $value) { ?>
              <option value="<?= $value['id'] ?>" <?php if ($categoryID == $value['id']) { echo "selected"; } ?>><?= $value['title'] ?></option>
            <?php } ?>
          </select>

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
                <th>Título</th>
                <th style="width:100px;">Valor</th>
                <th style="width:100px;">Data</th>
                <th style="width:100px;">Editar</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($info['items'] as $key => $value): ?>
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
                    <a href="editar?id=<?= $value['id'] ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?= AdminTheme::pagination($info); ?>
      </div>
    </div>
  </div>
  <!-- Second column -->

</div>
<!-- First row -->



<div class="container text-center">
  <a class="btn btn-primary px-5" href="relatorio-anual"><i class="fas fa-search left"></i> Relatório Detalhado</a>
</div>



<?php
require_once('../footer.php');
?>


<script type="text/javascript">
  $("#paymentoption").change(function(){
    let valor = $(this).val();
    if (valor == 7) {
      $('#installmentsoption').show();
    } else {
      $('#installmentsoption').hide();
    }
  })
</script>
