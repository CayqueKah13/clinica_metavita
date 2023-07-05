<?php
require __DIR__ . '/../../source/autoload.php';

use \Source\Controllers\BlogController;
use \Source\Core\Helper;
use \Source\Core\Session;
use \Source\Core\Tracker;

if (!Session::isAdminPermissionGranted(Session::ADMIN_PERMISSION_GALLERY)) {
  echo "failed";
  exit;
}


$itemID = Helper::safeInt($_POST['id']);

$status = BlogController::toggleStatus($itemID);

// Tracker::trackAdminEvent(Tracker::TRACK_ADMIN_EDIT_ADMIN, $itemID);

echo $status;

?>
