<?php

namespace Source\Core;

use \Source\Models\Admin;
use \Source\Models\Customer;
use \Source\Models\Instructor;
use \Source\Core\Dates;

class Auth {

  // Security Token Reasons
  const STR_ADMIN_NEW_PASSWORD = 1;
  const STR_INSTRUCTOR_NEW_PASSWORD = 2;




  public $message = "";


  // Password encryption
  static function password_encryption($password) {
    $blowFish_hash_format = "$2y$13$";
    $salt = Auth::generatePasswordSalt(22);
    $formatting_blowfish_with_salt = $blowFish_hash_format . $salt;
    $hash = crypt($password, $formatting_blowfish_with_salt);
    return $hash;
  }

  static function generatePasswordSalt($length) {
    $unique_random_string = md5(uniqid(mt_rand(), true));
    $base64_string = base64_encode($unique_random_string);
    $modified_base64_string = str_replace('+', '.', $base64_string);
    $salt = substr($modified_base64_string, 0, $length);
    return $salt;
  }

  static function passwordCheck($password, $existing_hash) {
    $hash = crypt($password, $existing_hash);
    return ($hash === $existing_hash);
  }


  // Security token
  static function createSecurityToken($reason, $reference) {
    $token = bin2hex(openssl_random_pseudo_bytes(40));
    $now = Dates::now();
    $database = new Database();
    $query = "INSERT INTO security_tokens (reason, reference, token, created_at) VALUES ('".$reason."', '".$reference."', '".$token."', '".$now."');";
    $database->query($query);
    return $token;
  }

  function securityTokenReference($token, $reason) {
    $database = new Database();
    $query = "SELECT reference, created_at FROM security_tokens WHERE token LIKE '".$token."' AND reason='".$reason."' AND used_at IS NULL;";
    $results = $database->select($query);
    if (count($results) > 0) {
      $item = $results[0];

      // check if passed 24 hours
      $date = $item['created_at'];
      $days = Dates::daysPassedSince($date);
      if ($days > 0) {
        $this->message = "Token Expirado";
        return false;
      }

      $reference = Helper::safeInt($item['reference']);
      return  $reference;
    } else {
      $this->message = "Token Inválido";
      return false;
    }
  }

  function setSecurityTokenUsed($token, $reason) {
    $database = new Database();
    $now = Dates::now();
    $query = "UPDATE security_tokens SET used_at = '".$now."' WHERE token LIKE '".$token."' AND reason = '".$reason."' LIMIT 1;";
    $database->query($query);
  }









  // Admin Login
  function adminSignIn($email, $password) {
  	$database = new Database();

  	$query = "SELECT `id`, `name`, `password` FROM admins WHERE `email`='". $email ."' AND `status`=1 ORDER BY `status`;";
  	$items = $database->select($query);

  	if (count($items) > 0) {
      $item = $items[0];
      if (Auth::passwordCheck($password, $item["password"])) {
        $id = Helper::safeInt($item['id']);
        $admin = new Admin($id);
        $admin->name = Helper::safeString($item['name']);
        Session::setAdminUser($admin);
        $this->message = "Olá, " . $admin->getFirstName() . "!";
        return true;
  		} else {
        $this->message = "Credenciais Inválidas";
        return false;
  		}
  	} else {
  		$this->message = "Credenciais Inválidas";
      return false;
  	}
  }

  static function confirmAdminPassword($email, $password) {
  	$database = new Database();

  	$query = "SELECT `id`, `name`, `password` FROM admins WHERE `email`='". $email ."' AND `status`=1 ORDER BY `status`;";
  	$items = $database->select($query);
  	if (count($items) > 0) {
      $item = $items[0];
      if (Auth::passwordCheck($password, $item["password"])) {
        return true;
  		} else {
        return false;
  		}
  	} else {
      return false;
  	}
  }






  // Customer Login
  function customerSignIn($cpf, $bornAt) {
  	$database = new Database();

    $bornAt = Dates::databaseDateFormat($bornAt);

  	$query = "SELECT `id`, `name`, `email`, `cpf`, `img`, `phone` FROM customers WHERE `cpf`='". $cpf ."' AND `born_at`='". $bornAt ."' AND `status`=1 ORDER BY `status`;";
  	$items = $database->select($query);

  	if (count($items) > 0) {
      $item = $items[0];
      $id = Helper::safeInt($item['id']);
      $customer = new Customer($id);
      $customer->name = Helper::safeString($item['name']);
      $customer->email = Helper::safeString($item['email']);
      $customer->cpf = Helper::safeString($item['cpf']);
      $customer->img = Helper::safeString($item['img']);
      $customer->phone = Helper::safeString($item['phone']);
      Session::setCustomerUser($customer);
      $this->message = "Olá, " . $customer->getFirstName() . "!";
      return true;

  	} else {
  		$this->message = "Credenciais Inválidas";
      return false;
  	}
  }




  // Instructor Login
  function instructorSignIn($email, $password) {
  	$database = new Database();

  	$query = "SELECT `id`, `name`, `password`, `is_editor` FROM instructors WHERE `email`='". $email ."' AND `status`=1 ORDER BY `status`;";
  	$items = $database->select($query);

  	if (count($items) > 0) {
      $item = $items[0];
      if (Auth::passwordCheck($password, $item["password"])) {
        $id = Helper::safeInt($item['id']);
        $instructor = new Instructor($id);
        $instructor->name = Helper::safeString($item['name']);
        $instructor->isEditor = Helper::safeInt($item['is_editor']);
        Session::setInstructorUser($instructor);
        $this->message = "Olá, " . $instructor->getFirstName() . "!";
        return true;
  		} else {
        $this->message = "Credenciais Inválidas";
        return false;
  		}
  	} else {
  		$this->message = "Credenciais Inválidas";
      return false;
  	}
  }




}
