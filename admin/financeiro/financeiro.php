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
use \Source\Core\Database;




if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_FINANCES)) {
  Session::setErrorMessage("Acesso negado!");
  Helper::redirectToPage(Config::BASE_URL_ADMIN . "/dashboard");
  exit;
}


$year = Helper::safeInt($_GET['ano']);
$month = Helper::safeInt($_GET['mes']);




$database = new Database();
// total incomes [group 2]
$query = "SELECT SUM(value) as total FROM finances WHERE id_group=2 AND is_confirmed=1;";
$results = $database->select($query);
$totalIncome = $results[0]['total'] ?? "0.00";
// total expenses [group 1]
$query = "SELECT SUM(value) as total FROM finances WHERE id_group=1 AND is_confirmed=1;";
$results = $database->select($query);
$totalExpenses = $results[0]['total'] ?? "0.00";

$totalBalance = $totalIncome - $totalExpenses;



if ($year == 0) {
  $year = Dates::thisYear();
}
if ($month == 0) {
  $month = Dates::thisMonth();
}
$monthDescription = Dates::monthName($month);


$reference = $year.'-'.$month.'-'.'01';
$firstDay = Dates::firstDayOfMonthFrom($reference);
$lastDay = Dates::lastDayOfMonthFrom($reference);
// var_dump($today);
// var_dump($firstDay);
// var_dump($lastDay);


$query = "SELECT SQL_CALC_FOUND_ROWS a.id, a.title, c.title as category, d.title as payment_method, b.id as id_group, b.color, a.value, a.date, a.total_installments, a.installment, a.is_confirmed, f.name as customer FROM finances a
LEFT JOIN finances_groups b ON b.id = a.id_group
LEFT JOIN finances_categories c ON c.id = a.id_category
LEFT JOIN finances_payment_methods d ON d.id = a.id_payment_method
LEFT JOIN schedule_events e ON e.id = a.id_schedule_event
LEFT JOIN customers f ON f.id = e.id_customer
WHERE a.date >= '".$firstDay."' AND a.date <= '".$lastDay."'
ORDER BY a.date;";
$results = $database->select($query);



$incomesNotConfirmed = [];
$incomesConfirmed = [];
$expensesNotConfirmed = [];
$expensesConfirmed = [];

$totalIncome = 0;
$currentIncome = 0;
$totalExpenses = 0;
$currentExpenses = 0;

foreach ($results as $key => $value) {
  $price = $value['value'];
  $item = [
    'id' => $value['id'],
    'date' => $value['date'],
    'title' => $value['title'],
    'customer' => $value['customer'],
    'value' => $price,
  ];
  if ($value['id_group'] == 2) {
    // income
    $totalIncome += $price;
    if ($value['is_confirmed'] == 1) {
      $currentIncome += $price;
      array_push($incomesConfirmed, $item);
    } else {
      array_push($incomesNotConfirmed, $item);
    }
  } else {
    // expense
    $totalExpenses += $price;
    if ($value['is_confirmed'] == 1) {
      $currentExpenses += $price;
      array_push($expensesConfirmed, $item);
    } else {
      array_push($expensesNotConfirmed, $item);
    }
  }
}





$info = [
  'total_balance' => $totalBalance,
  'current_month' => [
    'title' => $monthDescription.' '.$year,
    'total_income' => $totalIncome,
    'current_income' => $currentIncome,
    'total_expenses' => $totalExpenses,
    'current_expenses' => $currentExpenses,
  ]
];

$currentMonth = $info['current_month'];

// Current Month Incomes
if ($currentMonth['total_income'] > 0) {
  $info['current_month']['income_progress'] = Helper::safeInt($currentMonth['current_income'] / $currentMonth['total_income'] * 100);
} else {
  $info['current_month']['income_progress'] = 0;
}
$info['current_month']['income_preview'] = $currentMonth['total_income'] - $currentMonth['current_income'];


// Current Month Expenses
if ($currentMonth['total_expenses'] > 0) {
  $info['current_month']['expenses_progress'] = Helper::safeInt($currentMonth['current_expenses'] / $currentMonth['total_expenses'] * 100);
} else {
  $info['current_month']['expenses_progress'] = 0;
}
$info['current_month']['expenses_preview'] = $currentMonth['total_expenses'] - $currentMonth['current_expenses'];













// List Info
$currentPage = 1;
// conditions
$where = "WHERE 1=1";
// sorting
$where .= ' ORDER BY a.id DESC ';

// pagination link prefix
$paginationPrefix = "";

// number of items per page
$itemsPerPage = 5;

// fetch info
$fields = ['a.id', 'a.title', 'c.title as category', 'd.title as payment_method', 'f.title as event_category', 'g.name as instructor_name',  'b.id as id_group', 'b.color', 'a.value', 'a.date', 'a.total_installments', 'a.installment', 'a.is_confirmed'];
$from = "finances a
LEFT JOIN finances_groups b ON b.id = a.id_group
LEFT JOIN finances_categories c ON c.id = a.id_category
LEFT JOIN finances_payment_methods d ON d.id = a.id_payment_method
LEFT JOIN schedule_events e ON e.id = a.id_schedule_event
LEFT JOIN schedule_events_categories f ON f.id = e.id_category
LEFT JOIN instructors g ON g.id = e.id_instructor";
$info2 = Controller::getListInfo($fields, $from, $where, $currentPage, $itemsPerPage, $paginationPrefix);
foreach ($info2['items'] as $key => $value) {
  if ($value['installment'] > 0) {
    $info2['items'][$key]['payment_method'] .= " (" . $value['installment'] . "/" . $value['total_installments'] . ")";
  }
  // receita ou despesa atrasada
  if ($value['is_confirmed'] == 0 && Dates::daysPassedSince($value['date']) > 0) {
    $info2['items'][$key]['is_highlighted'] = 1;
  }
}



// Customers with pending payments
$customersWithPendingPayments = FinancesController::getCustomersWithPendingPayments();





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


<?php function itemsTableFrom($items) {  ?>
<div class="table-responsive text-nowrap">
  <table class="table table-hover">
    <thead>
      <tr>
        <th style="width:100px;">Data</th>
        <th>Título</th>
        <th style="width:100px;">Valor</th>
        <th style="width:100px;">Detalhes</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($items as $key => $value): ?>
        <tr>
          <td><?= Dates::brlDateFormat($value['date']) ?></td>
          <td>
            <?= $value['title'] ?>
          </br>
            <span style="color:#a0a0a0;"><?= $value['customer'] ?></span>
          </td>
          <td style="color:#<?= $value['color'] ?>!important;" ><?= Helper::decimalToBrlMoney($value['value']) ?></td>
          <td>
            <a href="editar?id=<?= $value['id'] ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Ver Detalhes do Pagamento"><i class="fas fa-search"></i></a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php } ?>







<!-- Modal Incomes -->
<div class="modal fade" id="modal-incomes" tabindex="-1" role="dialog" aria-labelledby="modal-incomes" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" style="max-width: 700px;" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Entradas<br> <small class="text-muted small"><?= $info['current_month']['title'] ?></small> </h4>
      </div>
      <div class="modal-body mx-0 px-2">
        <ul class="nav md-pills nav-justified pills-primary">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#panel11" role="tab">Recebidas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#panel12" role="tab">Previstas</a>
          </li>
        </ul>
        <!-- Tab panels -->
        <div class="tab-content pt-0 pl-0 pr-0">
          <!--Panel 1-->
          <div class="tab-pane fade in show active" id="panel11" role="tabpanel">
            <?php itemsTableFrom($incomesConfirmed); ?>
          </div>
          <!--/.Panel 1-->

          <!--Panel 2-->
          <div class="tab-pane fade" id="panel12" role="tabpanel">
            <?php itemsTableFrom($incomesNotConfirmed); ?>
          </div>
          <!--/.Panel 2-->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm btn-block" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Incomes -->






<!-- Modal Expenses -->
<div class="modal fade" id="modal-expenses" tabindex="-1" role="dialog" aria-labelledby="modal-expenses" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" style="max-width: 700px;" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Saídas<br> <small class="text-muted small"><?= $info['current_month']['title'] ?></small> </h4>
      </div>
      <div class="modal-body mx-0 px-2">
        <ul class="nav md-pills nav-justified pills-primary">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#panel13" role="tab">Pagas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#panel14" role="tab">Previstas</a>
          </li>
        </ul>
        <!-- Tab panels -->
        <div class="tab-content pt-0 pl-0 pr-0">
          <!--Panel 1-->
          <div class="tab-pane fade in show active" id="panel13" role="tabpanel">
            <?php itemsTableFrom($expensesConfirmed); ?>
          </div>
          <!--/.Panel 1-->

          <!--Panel 2-->
          <div class="tab-pane fade" id="panel14" role="tabpanel">
            <?php itemsTableFrom($expensesNotConfirmed); ?>
          </div>
          <!--/.Panel 2-->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm btn-block" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Expenses -->










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























<!-- Saldo Atual -->
<div class="col-xl-12 col-md-12 mb-xl-0 mb-4">
  <div class="card info-color pt-3 pb-3 mb-5">
    <div class="text-center">
      <h2 class="font-weight-bold white-text mb-0" style="font-size: 30pt;"> <small style="font-size: 12pt;">R$</small> <?= Helper::decimalToBrlMoney($info['total_balance'], false) ?></h2>
      <p class="white-text mb-0">Saldo Atual</p>
    </div>
  </div>
</div>
<!-- Saldo Atual -->
<hr>







<div class="card mb-4 px-5 pb-3">
  <div class="row text-center">
    <div class="center">
      <form action="visao-geral" method="get">
        <div class="row">
          <select class="mdb-select colorful-select dropdown-info mx-2 md-form md-dropdown mb-0" name="mes">
            <option value="" disabled selected>Mês</option>
            <?php foreach ([1,2,3,4,5,6,7,8,9,10,11,12] as $key => $value): ?>
              <option value="<?= $value ?>" <?php if ($month == $value) {echo "selected";} ?>><?= Dates::monthName($value) ?></option>
            <?php endforeach; ?>
          </select>

          <select class="mdb-select colorful-select dropdown-info mx-2 md-form md-dropdown  mb-0" name="ano">
            <option value="" disabled selected>Ano</option>
            <?php foreach ([2020,2021,2022,2023,2024,2025] as $key => $value): ?>
              <option value="<?= $value ?>" <?php if ($year == $value) {echo "selected";} ?>><?= $value ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Atualizar</button>
      </form>
    </div>
  </div>
</div>





<!-- Mês Atual -->
<!-- <p class="text-muted text-center"><?= $info['current_month']['title'] ?></p> -->
<div class="row">

  <!-- Grid column -->
  <div class="col-xl-6 col-md-6 mb-xl-0 mb-4">
    <a data-toggle="modal" data-target="#modal-incomes">
      <div class="card card-cascade cascading-admin-card">
        <div class="admin-up">
          <i class="fas fa-arrow-up success-color mr-3 z-depth-2"></i>
          <div class="data">
            <p class="text-uppercase">Entradas <?= $info['current_month']['title'] ?></p>
            <h4 class="font-weight-bold dark-grey-text"><?= Helper::decimalToBrlMoney($info['current_month']['total_income']) ?></h4>
            <p class="text-muted">Total Recebido <?= Helper::decimalToBrlMoney($info['current_month']['current_income']) ?></p>
          </div>
        </div>
        <div class="card-body card-body-cascade">
          <div class="progress mb-3">
            <div class="progress-bar bg-success accent-2" role="progressbar" style="width: <?= $info['current_month']['income_progress'] ?>%" aria-valuenow="<?= $info['current_month']['income_progress'] ?>" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <p class="card-text">Progresso Atual: <?= $info['current_month']['income_progress'] ?>%</p>
          <p class="card-text">Ainda Previsto <?= Helper::decimalToBrlMoney($info['current_month']['income_preview']) ?></p>
        </div>
      </div>
    </a>
  </div>
  <!-- Grid column -->



  <!-- Grid column -->
  <div class="col-xl-6 col-md-6 mb-xl-0 mb-4">
    <a data-toggle="modal" data-target="#modal-expenses">
      <div class="card card-cascade cascading-admin-card">
        <div class="admin-up">
          <i class="fas fa-arrow-down danger-color lighten-1 mr-3 z-depth-2"></i>
          <div class="data">
            <p class="text-uppercase">Saídas <?= $info['current_month']['title'] ?></p>
            <h4 class="font-weight-bold dark-grey-text"><?= Helper::decimalToBrlMoney($info['current_month']['total_expenses']) ?></h4>
            <p class="text-muted">Total Pago <?= Helper::decimalToBrlMoney($info['current_month']['current_expenses']) ?></p>
          </div>
        </div>
        <div class="card-body card-body-cascade">
          <div class="progress mb-3">
            <div class="progress-bar red accent-2" role="progressbar" style="width: <?= $info['current_month']['expenses_progress'] ?>%" aria-valuenow="<?= $info['current_month']['expenses_progress'] ?>" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <p class="card-text">Progresso Atual: <?= $info['current_month']['expenses_progress'] ?>%</p>
          <p class="card-text">Ainda Previsto <?= Helper::decimalToBrlMoney($info['current_month']['expenses_preview']) ?></p>
        </div>
      </div>
    </a>
  </div>
  <!-- Grid column -->

</div>
<!-- Mês Atual -->
<hr class="mb-5">












<div class="row px-2 mb-2">
  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-register-1"><i class="fas fa-plus left"></i> Cadastrar Despesa</button>
  <button type="button" class="btn btn-dark-green" data-toggle="modal" data-target="#modal-register-2"><i class="fas fa-plus left"></i> Cadastrar Receita</button>
</div>





<div class="row">
  <div class="col-12">
    <div class="px-2 pt-2 white z-depth-1 mb-5">
      <h4 class="h4-responsive mt-4 mb-3">Últimos Lançamentos</h4>
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
                <?php foreach ($info2['items'] as $key => $value): ?>
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
          <div class="text-center">
            <a href="lancamentos" class="btn btn-sm btn-primary">Ver Todos os Lançamentos</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>









<div class="row">
  <div class="col-12">
    <div class="px-2 pt-2 white z-depth-1 mb-5">
      <h4 class="h4-responsive mt-4 mb-3">Inadimplentes</h4>
      <div class="row">
        <div class="col-md-12 pb-3">
          <div class="table-responsive text-nowrap">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Paciente</th>
                  <th style="width:100px;">Valor</th>
                  <th style="width:100px;">Detalhes</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($customersWithPendingPayments as $key => $value): ?>
                  <?php if ($key >= 5 ) {continue;} ?>
                <tr>
                  <td><?= $value['name'] ?></td>
                  <td><?= Helper::decimalToBrlMoney($value['total']) ?></td>
                  <td>
                    <a href="lancamentos?end=<?= Dates::brlDateFormat(Dates::yesterday()) ?>&filter=3&customer=<?= $value['id'] ?>" class="btn btn-primary btn-sm"><i class="fas fa-search"></i></a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <div class="text-center">
            <a href="inadimplentes" class="btn btn-sm btn-primary">Ver Todos os Inadimplentes</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>







<?php
require_once('../footer.php');
?>
