<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Controllers\CustomerController;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Tracker;

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_CUSTOMERS)) {
  echo "failed";
  exit;
}


$itemID = Helper::safeInt($_POST['id']);

$status = CustomerController::toggleStatus($itemID);

// Tracker::trackAdminEvent(Tracker::TRACK_ADMIN_EDIT_ADMIN, $itemID);

echo $status;

?>
