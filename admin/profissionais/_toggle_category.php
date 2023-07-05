<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Controllers\InstructorController;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Tracker;

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_INSTRUCTORS)) {
  echo "failed";
  exit;
}


$itemID = Helper::safeInt($_POST['item']);
$categoryID = Helper::safeInt($_POST['id']);

$status = InstructorController::toggleCategory($itemID, $categoryID);

// Tracker::trackAdminEvent(Tracker::TRACK_ADMIN_EDIT_ADMIN, $itemID);

echo $status;

?>
