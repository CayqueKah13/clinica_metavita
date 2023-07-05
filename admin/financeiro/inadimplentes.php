<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Themes\Theme;
use \Source\Themes\AdminTheme;
use \Source\Controllers\Controller;
use \Source\Controllers\FinancesController;
use \Source\Controllers\ScheduleController;
use \Source\Controllers\CustomerController;
use \Source\Controllers\InstructorController;
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

// filter infos
$categoriesList = ScheduleController::getCategoriesList();
$customersList = CustomerController::getSearchList();
$instructorsList = InstructorController::getSearchList();







// Show Header
$currentTab = "finances";
$breadcrumbs = array('Financeiro');
require_once('../header.php');

?>


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
        </div>
      </div>
    </div>
  </div>
</div>


<?php
require_once('../footer.php');
?>
