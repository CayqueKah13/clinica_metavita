<?php
require_once __DIR__ . '/../../source/autoload.php';

use \Source\Core\Config;
use \Source\Core\Session;
use \Source\Core\Helper;
use \Source\Core\Tracker;

// Tracker::trackAdminEvent(Tracker::TRACK_ADMIN_LOGOUT);

Session::clearInstructorUser();

Session::setSuccessMessage('');
Session::setErrorMessage('');

Helper::redirectToPage(Config::BASE_URL_INSTRUCTOR . "/login/login");
exit;

?>
