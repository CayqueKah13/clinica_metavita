<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Themes\Theme;
use \Source\Themes\AdminTheme;
use \Source\Controllers\Controller;
use \Source\Controllers\FinancesController;
use \Source\Controllers\ScheduleController;
use \Source\Controllers\CustomerController;
use \Source\Controllers\InstructorController;
use \Source\Controllers\SuppliersController;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Config;
use \Source\Core\Dates;

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_FINANCES)) {
  Session::setErrorMessage("Acesso negado!");
  Helper::redirectToPage(Config::BASE_URL_ADMIN . "/dashboard");
  exit;
}



$currentPage = Helper::safeInt($_GET['page']);
$filterID = Helper::safeInt($_GET['filter']);
$date1 = Helper::safeString($_GET['start']);
$date2 = Helper::safeString($_GET['end']);
$categoryID = Helper::safeInt($_GET['category']);
$customerID = Helper::safeInt($_GET['customer']);
$instructorID = Helper::safeInt($_GET['instructor']);
// $info = FinancesController::getList($page, $groupID, $categoryID, $date1, $date2);



// conditions
$where = "WHERE 1=1";

if ($date1 != "") {
  $start = Dates::databaseDateFormat($date1);
  $where .= " AND a.date >= '".$start."' ";
}
if ($date2 != "") {
  $end = Dates::databaseDateFormat($date2);
  $where .= " AND a.date <= '".$end."' ";
}

if ($categoryID > 0) {
  $where .= " AND e.id_category = '".$categoryID."' ";
}

if ($customerID > 0) {
  $where .= " AND e.id_customer = '".$customerID."' ";
}

if ($instructorID > 0) {
  $where .= " AND e.id_instructor = '".$instructorID."' ";
}


$allItemsWhere = $where;

switch ($filterID) {
    case 0:
    //Todos os Registros
    break;

    case 1:
    //Entradas
    $where .= " AND a.id_group = 2 ";
    break;

    case 2:
    //Entradas Recebidas
    $where .= " AND a.id_group = 2 AND a.is_confirmed = 1 ";
    break;

    case 3:
    //Entradas Não Recebidas
    $where .= " AND a.id_group = 2 AND a.is_confirmed = 0 ";
    break;

    case 4:
    //Saídas
    $where .= " AND a.id_group = 1 ";
    break;

    case 5:
    //Saídas Pagas
    $where .= " AND a.id_group = 1 AND a.is_confirmed = 1 ";
    break;

    case 6:
    //Saídas Não Pagas
    $where .= " AND a.id_group = 1 AND a.is_confirmed = 0 ";
    break;

  default: break;
}


// sorting
$where .= ' ORDER BY a.id DESC ';

// pagination link prefix
$paginationPrefix = "lancamentos?filter=".$filterID.'&category='.$categoryID.'&customer='.$customerID.'&instructor='.$instructorID.'&start='.$date1.'&end='.$date2;

// number of items per page
$itemsPerPage = 15;

// fetch info
$fields = ['a.id', 'a.title', 'c.title as category', 'd.title as payment_method', 'f.title as event_category', 'g.name as instructor_name',  'b.id as id_group', 'b.color', 'a.value', 'a.date', 'a.total_installments', 'a.installment', 'a.is_confirmed'];
$from = "finances a
LEFT JOIN finances_groups b ON b.id = a.id_group
LEFT JOIN finances_categories c ON c.id = a.id_category
LEFT JOIN finances_payment_methods d ON d.id = a.id_payment_method
LEFT JOIN schedule_events e ON e.id = a.id_schedule_event
LEFT JOIN schedule_events_categories f ON f.id = e.id_category
LEFT JOIN instructors g ON g.id = e.id_instructor";

$info = Controller::getListInfo($fields, $from, $where, $currentPage, $itemsPerPage, $paginationPrefix);

foreach ($info['items'] as $key => $value) {
  if ($value['installment'] > 0) {
    $info['items'][$key]['payment_method'] .= " (" . $value['installment'] . "/" . $value['total_installments'] . ")";
  }
  // receita ou despesa atrasada
  if ($value['is_confirmed'] == 0 && Dates::daysPassedSince($value['date']) > 0) {
    $info['items'][$key]['is_highlighted'] = 1;
  }
}




// All items
$allItemsInfo = Controller::getListInfo($fields, $from, $allItemsWhere, -1, $itemsPerPage, $paginationPrefix);
$entradas = 0; // Entradas
$entradasRecebidas = 0; // Entradas Recebidas
$saidas = 0; // Saídas
$saidasPagas = 0; // Saídas Pagas
foreach ($allItemsInfo['items'] as $key => $item) {
  $isConfirmed = $item['is_confirmed'];
  $value = $item['value'];
  if ($item['id_group'] == 1) {
    // despesa
    $saidas += $value;
    if ($isConfirmed == 1) {
      $saidasPagas += $value;
    }
  } else {
    // receita
    $entradas += $value;
    if ($isConfirmed == 1) {
      $entradasRecebidas += $value;
    }
  }
}

















// modal infos
$expensesCategoriesList = FinancesController::getExpensesCategoriesList();
$paymentMethods = FinancesController::getAllPaymentMethods();
$suppliersList = SuppliersController::getSearchList();

// filter infos
$categoriesList = ScheduleController::getCategoriesList();
$customersList = CustomerController::getSearchList();
$instructorsList = InstructorController::getSearchList();


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

          <select class="mdb-select md-form" name="supplier" searchable="Buscar..">
            <option disabled selected>Fornecedor</option>
            <?php foreach ($suppliersList as $key => $value) { ?>
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






<div class="row px-2 mb-5">
  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-register-1"><i class="fas fa-plus left"></i> Cadastrar Despesa</button>
  <button type="button" class="btn btn-dark-green" data-toggle="modal" data-target="#modal-register-2"><i class="fas fa-plus left"></i> Cadastrar Receita</button>
</div>







<!-- First row -->
<div class="row my-b mt-5 pb-3">

  <!-- First column -->
  <div class="col-lg-3 mx-0 px-0 mb-4">
    <div class="card-body pt-0">
      <div class="mt-0">
        <form action="lancamentos" method="get" class="md-form mt-0">
          <input type="hidden" name="page" value="1">


          <div class="mb-2">
            <small>Filtros de Lançamentos</small>
          </div>
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

          <select class="mdb-select" name="filter">
            <option value="0" <?php if ($filterID == 0) { echo "selected"; } ?>>Todos os Lançamentos</option>
            <option value="1" <?php if ($filterID == 1) { echo "selected"; } ?>>Entradas</option>
            <option value="2" <?php if ($filterID == 2) { echo "selected"; } ?>>Entradas Recebidas</option>
            <option value="3" <?php if ($filterID == 3) { echo "selected"; } ?>>Entradas Não Recebidas</option>
            <option value="4" <?php if ($filterID == 4) { echo "selected"; } ?>>Saídas</option>
            <option value="5" <?php if ($filterID == 5) { echo "selected"; } ?>>Saídas Pagas</option>
            <option value="6" <?php if ($filterID == 6) { echo "selected"; } ?>>Saídas Não Pagas</option>
          </select>


          <div class="mt-4">
            <small>Filtros de Agendamentos</small>
          </div>
          <select class="mdb-select md-form" name="category" required>
            <option value="0" <?php if ($categoryID == 0) {echo "selected";} ?>>Todas as Categorias</option>
            <?php foreach ($categoriesList as $key => $value) { ?>
              <option value="<?= $value['id'] ?>" <?php if ($categoryID == $value['id']) {echo "selected";} ?>><?= $value['title'] ?></option>
            <?php } ?>
          </select>

          <select class="mdb-select md-form" searchable="Buscar.." name="customer" required>
            <option value="0" <?php if ($customerID == 0) {echo "selected";} ?>>Todos os Pacientes</option>
            <?php foreach ($customersList as $key => $value) { ?>
              <option value="<?= $value['id'] ?>" data-icon="<?= Theme::imageUrlFromSufix($value['img']) ?>" class="rounded-circle" <?php if ($customerID == $value['id']) {echo "selected";} ?>><?= $value['title'] ?></option>
            <?php } ?>
          </select>

          <select class="mdb-select md-form" searchable="Buscar.." name="instructor" required>
            <option value="0" <?php if ($instructorID == 0) {echo "selected";} ?>>Todos os Profissionais</option>
            <?php foreach ($instructorsList as $key => $value) { ?>
              <option value="<?= $value['id'] ?>" <?php if ($instructorID == $value['id']) {echo "selected";} ?>><?= $value['title'] ?></option>
            <?php } ?>
          </select>

          <button type="submit" class="btn btn-primary btn-block btn-sm px-0">Filtrar</button>
        </form>
      </div>
    </div>
  </div>
  <!-- First column -->




  <div class="col-lg-9 mb-5">

    <div class="card mb-4">
      <div class="card-header white-text primary-color">
        <h5 class="font-weight-500 my-1">Resumo <small style="font-size: 10pt;">baseado nos filtros aplicados</small> </h5>
      </div>
      <div class="card-body">
        <div class="table-responsive text-nowrap">
          <table class="table">
            <tbody>
              <tr><td>Entradas</td><td style="width:10px;"><?= Helper::decimalToBrlMoney($entradas) ?></td></tr>
              <tr><td>Entradas Recebidas</td><td style="width:10px;"><?= Helper::decimalToBrlMoney($entradasRecebidas) ?></td></tr>
              <tr><td>Entradas Não Recebidas</td><td style="width:10px;"><?= Helper::decimalToBrlMoney($entradas - $entradasRecebidas) ?></td></tr>
              <tr><td>Saídas</td><td style="width:10px;"><?= Helper::decimalToBrlMoney($saidas) ?></td></tr>
              <tr><td>Saídas Pagas</td><td style="width:10px;"><?= Helper::decimalToBrlMoney($saidasPagas) ?></td></tr>
              <tr><td>Saídas Não Pagas</td><td style="width:10px;"><?= Helper::decimalToBrlMoney($saidas - $saidasPagas) ?></td></tr>
            </tbody>
          </table>
        </div>

      </div>
    </div>

  </div>

</div>
<!-- First row -->





<div class="px-2 pt-2 white z-depth-1 mb-5">
  <h4 class="h4-responsive mt-4 mb-3"><?= $info['countTitle'] ?></h4>
  <div class="row">
    <div class="col-md-12 pb-3">
      <div class="table-responsive text-nowrap">
        <table class="table table-hover">
          <thead>
            <tr>
              <th style="width:5px;"></th>
              <th style="width:100px;">Data</th>
              <th>Título</th>
              <th>Profissional</th>
              <th style="width:100px;">Valor</th>
              <th style="width:100px;">Editar</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($info['items'] as $key => $value): ?>
              <tr <?php if ($value['is_highlighted'] == 1) { echo 'style="background-color: #ffe8bb;"'; } ?>>
                <td style="color:#<?= $value['color'] ?>!important;"> <span class="fas fa-circle"></span> </td>
                <td><?= Dates::brlDateFormat($value['date']) ?></td>
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
                <td><?= $value['instructor_name'] ?></td>
                <td style="color:#<?= $value['color'] ?>!important;" ><?= Helper::decimalToBrlMoney($value['value']) ?></td>

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
