<?php

namespace Source\Core;

use \Source\Core\Config;
use \Source\Core\Database;
use \Source\Core\Dates;
use \Source\Core\Helper;
use \Source\Core\Session;

class Tracker {

  // Admin Events
  // admins
  const TRACK_ADMIN_NEW_PASSWORD = 1;
  const TRACK_ADMIN_LOGIN = 2;
  const TRACK_ADMIN_RECOVER_PASSWORD = 3;
  const TRACK_ADMIN_LOGOUT = 4;
  const TRACK_ADMIN_REGISTER_ADMIN = 5;
  const TRACK_ADMIN_EDIT_ADMIN = 6;
  const TRACK_ADMIN_DELETE_ADMIN = 7;
  const TRACK_ADMIN_DELETE_SCHEDULE_EVENT = 8;





  // Track Admin
  static function trackAdminEvent($event, $value = null) {
    $admUser = Session::getAdminUser();
    $id = Helper::safeInt($admUser->id);
    $now = Dates::now();

    $eventID = Helper::safeInt($event);
    $eventValue = Helper::safeInt($value);
    if ($eventValue == 0) {
      $eventValue = 'NULL';
    }

    $database = new Database();
    $query = "INSERT INTO _tracks_admin (id_admin, id_event, event_value, created_at) VALUES ('".$id."', '".$eventID."', ".$eventValue.", '".$now."');;";
    $database->query($query);
  }

}
