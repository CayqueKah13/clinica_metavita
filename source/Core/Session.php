<?php

namespace Source\Core;

class Session {

  const ADMIN_USER_KEY = "adm-user-key";
  const ADMIN_LAST_EMAIL_KEY = "adm-last-email-key";
  const MESSAGE_SUCCESS_KEY = "msg-success-key";
  const MESSAGE_ERROR_KEY = "msg-error-key";
  const CUSTOMER_USER_KEY = "customer-user-key";
  const INSTRUCTOR_USER_KEY = "instructor-user-key";
  const INSTRUCTOR_LAST_EMAIL_KEY = "instructor-last-email-key";

  const ADMIN_PERMISSION_ADMINS = 1;
  const ADMIN_PERMISSION_INSTRUCTORS = 2;
  const ADMIN_PERMISSION_CUSTOMERS = 3;
  const ADMIN_PERMISSION_SCHEDULE = 4;
  const ADMIN_PERMISSION_GALLERY = 5;
  const ADMIN_PERMISSION_FINANCES = 6;



  // Admin User
  static function setAdminUser($item) {
    $_SESSION[Session::ADMIN_USER_KEY] = serialize($item);
  }

  static function getAdminUser() {
    return unserialize($_SESSION[Session::ADMIN_USER_KEY]);
  }

  static function clearAdminUser() {
    $_SESSION[Session::ADMIN_USER_KEY] = null;
  }

  static function setAdmLastEmail($value) {
    $_SESSION[Session::ADMIN_LAST_EMAIL_KEY] = $value;
  }
  static function getAdmLastEmail() {
  	return $_SESSION[Session::ADMIN_LAST_EMAIL_KEY];
  }




  // Instructor User
  static function setInstructorUser($item) {
    $_SESSION[Session::INSTRUCTOR_USER_KEY] = serialize($item);
  }

  static function getInstructorUser() {
    return unserialize($_SESSION[Session::INSTRUCTOR_USER_KEY]);
  }

  static function clearInstructorUser() {
    $_SESSION[Session::INSTRUCTOR_USER_KEY] = null;
  }

  static function setInstructorLastEmail($value) {
    $_SESSION[Session::INSTRUCTOR_LAST_EMAIL_KEY] = $value;
  }
  static function getInstructorLastEmail() {
  	return $_SESSION[Session::INSTRUCTOR_LAST_EMAIL_KEY];
  }









  // Customer User
  static function setCustomerUser($customer) {
    $_SESSION[Session::CUSTOMER_USER_KEY] = serialize($customer);
  }

  static function getCustomerUser() {
    return unserialize($_SESSION[Session::CUSTOMER_USER_KEY]);
  }

  static function clearCustomerUser() {
    $_SESSION[Session::CUSTOMER_USER_KEY] = null;
  }






  // Messages
  static function setSuccessMessage($message) {
    $_SESSION[Session::MESSAGE_SUCCESS_KEY] = $message;
  }
  static function successMessage() {
  	$msg = $_SESSION[Session::MESSAGE_SUCCESS_KEY];
  	$_SESSION[Session::MESSAGE_SUCCESS_KEY] = "";
  	return $msg;
  }

  static function setErrorMessage($message) {
    $_SESSION[Session::MESSAGE_ERROR_KEY] = $message;
  }
  static function errorMessage() {
    $msg = $_SESSION[Session::MESSAGE_ERROR_KEY];
  	$_SESSION[Session::MESSAGE_ERROR_KEY] = "";
  	return $msg;
  }

  static function toastMessages() {
    // Show success alert
    $successMessage = Session::successMessage();
    if (Helper::safeString($successMessage) != "") {
      echo "toastr.success('".$successMessage."');";
    }
    // Show success alert
    $errorMessage = Session::errorMessage();
    if (Helper::safeString($errorMessage) != "") {
      echo "toastr.error('".$errorMessage."');";
    }
  }




  // Check Admin Permissions
  static function isAdminPermissionGranted($key) {
    $admUser = Session::getAdminUser();
    $id = Helper::safeInt($admUser->id);
    if ($id == 0) {
      return false;
    }
    $database = new Database();
    // check if admin is still active
    $query = "SELECT id FROM admins WHERE id='".$id."' AND status=1 LIMIT 1;";
    $items = $database->select($query);
    if (count($items) == 0) {
      Session::setAdminUser(null);
      return null;
    }
    // check specific permission
    $query = "SELECT id_admin FROM admins_x_permissions WHERE id_admin='".$id."' AND id_permission='".$key."' LIMIT 1;";
    $items = $database->select($query);
    if (count($items) > 0) {
      return true;
    } else {
      return false;
    }
  }




  // Check Instructor Permissions
  static function isInstructorPermissionGranted() {
    $instructorUser = Session::getInstructorUser();
    $id = Helper::safeInt($instructorUser->id);
    if ($id == 0) {
      Session::setInstructorUser(null);
      return null;
    }
    $database = new Database();
    // check if instructor is still active
    $query = "SELECT id FROM instructors WHERE id='".$id."' AND status=1 LIMIT 1;";
    $items = $database->select($query);
    if (count($items) == 0) {
      Session::setInstructorUser(null);
      return null;
    }
    return true;
  }

  static function isInstructorEditor() {
    $instructorUser = Session::getInstructorUser();
    $id = Helper::safeInt($instructorUser->id);
    $database = new Database();
    // check if instructor is still active
    $query = "SELECT id FROM instructors WHERE id='".$id."' AND status=1 AND is_editor=1 LIMIT 1;";
    $items = $database->select($query);
    if (count($items) == 0) {
      return null;
    }
    return true;
  }



}
