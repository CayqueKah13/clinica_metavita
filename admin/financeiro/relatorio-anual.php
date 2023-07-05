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



// $page = Helper::safeInt($_GET['page']);
// $groupID = Helper::safeInt($_GET['group']);
// $categoryID = Helper::safeInt($_GET['category']);
// $date1 = Helper::safeString($_GET['start']);
// $date2 = Helper::safeString($_GET['end']);
// $info = FinancesController::getList($page, $groupID, $categoryID, $date1, $date2);
//
// $expensesCategoriesList = FinancesController::getExpensesCategoriesList();
// $incomeCategoriesList = FinancesController::getIncomeCategoriesList();
// $allCategoriesList = FinancesController::getAllCategoriesList();

$items = FinancesController::getAnnualOverview();


// Show Header
$currentTab = "finances";
$breadcrumbs = array('Financeiro');
require_once('../header.php');

?>


<div class="container-fluid">
<?php foreach ($items as $key => $year) { ?>
<!-- Relatório Anual -->
<div class="row my-5 pb-3">
  <div class="col-lg-12 mx-auto white z-depth-1">
    <h4 class="h4-responsive mt-4 mb-3"><?= $year['title'] ?></h4>
    <div class="row">
      <div class="col-md-12 pb-3">
        <div class="table-responsive text-nowrap">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Mês</th>
                <th>Receitas</th>
                <th>Despesas</th>
                <th>Saldo</th>
                <th style="width:100px;">Detalhes</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($year['items'] as $key => $value): ?>
                <tr>
                  <td><?= $value['title'] ?></td>
                  <td><?= Helper::decimalToBrlMoney($value['income']) ?></td>
                  <td><?= Helper::decimalToBrlMoney($value['expenses']) ?></td>
                  <?php
                  $total = $value['income'] - $value['expenses'];
                  $color = "a0a0a0";
                  if ($total > 0) {
                    $color = "388e3c";
                  } elseif ($total < 0) {
                    $color = "ff3547";
                  }
                  ?>
                  <td style="color:#<?= $color ?>!important;">
                    <?= Helper::decimalToBrlMoney($total) ?>
                  </td>
                  <td>
                    <a href="<?= Config::BASE_URL_ADMIN ?>/financeiro/financeiro?start=<?= Dates::brlDateFormat($value['start']) ?>&end=<?= Dates::brlDateFormat($value['end']) ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Ver Detalhes"><i class="fas fa-search"></i></a>
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
<!-- Relatório Anual -->
<?php } ?>
</div>



<?php
require_once('../footer.php');
?>
