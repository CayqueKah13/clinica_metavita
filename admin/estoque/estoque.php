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
$currentTab = "warehouse";
$breadcrumbs = array('Controle de Estoque');
require_once('../header.php');

?>

<h2>Controle de Estoque</h2>


<?php
require_once('../footer.php');
?>
