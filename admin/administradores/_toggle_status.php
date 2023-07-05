<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Controllers\AdminController;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Tracker;

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_ADMINS)) {
  echo "failed";
  exit;
}


$adminID = Helper::safeInt($_POST['id']);

$status = AdminController::toggleStatus($adminID);

Tracker::trackAdminEvent(Tracker::TRACK_ADMIN_EDIT_ADMIN, $adminID);

echo $status;

?>
