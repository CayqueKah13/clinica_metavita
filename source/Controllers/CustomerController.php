<?php

namespace Source\Controllers;

use \Source\Core\Config;
use \Source\Core\Helper;
use \Source\Core\Database;
use \Source\Core\Auth;
use \Source\Core\Dates;
use \Source\Support\Mailer;

class CustomerController {

  const ITEMS_PER_PAGE = 5;

  public $message = "";

  // List Customers
  static function getList($currentPage, $search, $status, $month = 0) {
    // conditions
    $where = "WHERE name LIKE '%".$search."%'";
    if ($status > 0) {
      $where .= " AND status = '".$status."' ";
    }
    // if ($date1 != "") {
    //   $start = Dates::databaseDateFormat($date1);
    //   $where .= " AND born_at >= '".$start."' ";
    // }
    // if ($date2 != "") {
    //   $end = Dates::databaseDateFormat($date2);
    //   $where .= " AND born_at <= '".$end."' ";
    // }
    if ($month > 0) {
      $where .= " AND MONTH(born_at) = '".$month."' ";
    }
    // sorting
    $where .= 'ORDER BY id DESC';

    // pagination link prefix
    $paginationPrefix = "clientes?status=".$status.'&search='.$search;

    // number of items per page
    $itemsPerPage = CustomerController::ITEMS_PER_PAGE;

    // fetch info
    $info = Controller::getListInfo(['id', 'name', 'email', 'phone', 'born_at', 'message', 'img', 'status'], 'customers', $where, $currentPage, $itemsPerPage, $paginationPrefix);

    return $info;
  }

  static function getListForInstructor($instructorID, $currentPage, $search, $status, $month = 0) {
    // conditions
    $where = "WHERE a.name LIKE '%".$search."%'";
    if ($status > 0) {
      $where .= " AND a.status = '".$status."' ";
    }
    // if ($date1 != "") {
    //   $start = Dates::databaseDateFormat($date1);
    //   $where .= " AND born_at >= '".$start."' ";
    // }
    // if ($date2 != "") {
    //   $end = Dates::databaseDateFormat($date2);
    //   $where .= " AND born_at <= '".$end."' ";
    // }
    if ($month > 0) {
      $where .= " AND MONTH(a.born_at) = '".$month."' ";
    }
    // sorting
    $where .= 'GROUP BY a.id ORDER BY a.id DESC';

    // pagination link prefix
    $paginationPrefix = "clientes?status=".$status.'&search='.$search;

    // number of items per page
    $itemsPerPage = CustomerController::ITEMS_PER_PAGE;

    // fetch info
    $info = Controller::getListInfo(['a.id', 'a.name', 'a.email', 'a.phone', 'a.born_at', 'a.message', 'a.img', 'a.status'], 'customers a INNER JOIN schedule_events b ON b.id_customer = a.id AND b.id_instructor = '.$instructorID.' ', $where, $currentPage, $itemsPerPage, $paginationPrefix);

    return $info;
  }

  static function getSearchList() {
    $database = new Database();
    $query = "SELECT id, name, img, email, cpf FROM customers WHERE status=1 ORDER BY name;";
    $items = $database->select($query);
    $info = array();
    foreach ($items as $key => $value) {
      $cpf = Helper::safeString($value['cpf']);
      if ($cpf == '') {
        $cpf = 'CPF não cadastrado';
      }
      $title = $value['name'] . ' (' . $cpf . ')';
      $item = array(
        'id' => $value['id'],
        'img' => $value['img'],
        'title' => $title
      );
      array_push($info, $item);
    }
    return $info;
  }

  // List Monthly Birthday Customers
  static function getMonthBirthdayList() {
    $thisMonth = Dates::thisMonth();
    
    $database = new Database();
    $query = "SELECT id, name, img, born_at FROM customers WHERE status=1 ORDER BY name;";
    $items = $database->select($query);
    $info = array();
    foreach ($items as $key => $value) {
      if ($thisMonth != Dates::monthFrom($value['born_at'])) {
        continue;
      }
      
      $item = array(
        'id' => $value['id'],
        'img' => $value['img'],
        'born_at' => $value['born_at'],
        'name' => $value['name']
      );
      array_push($info, $item);
    }
    return $info;
  }




  static function getSearchListForInstructor($instructorID) {
    $database = new Database();
    $query = "SELECT SQL_CALC_FOUND_ROWS a.id, a.name, a.img, a.email, a.cpf FROM customers a
    INNER JOIN schedule_events b ON b.id_customer = a.id AND b.id_instructor = ".$instructorID." GROUP BY a.id ORDER BY a.name DESC;";
    $items = $database->select($query);
    $info = array();
    foreach ($items as $key => $value) {
      $cpf = Helper::safeString($value['cpf']);
      if ($cpf == '') {
        $cpf = 'CPF não cadastrado';
      }
      $title = $value['name'] . ' (' . $cpf . ')';
      $item = array(
        'id' => $value['id'],
        'img' => $value['img'],
        'title' => $title
      );
      array_push($info, $item);
    }
    return $info;
  }



  // List Status
  static function getStatusList() {
    $database = new Database();
    $query = "SELECT id, title FROM customers_status ORDER BY title;";
    $items = $database->select($query);
    return $items;
  }

  static function getGoalsList() {
    $database = new Database();
    $query = "SELECT id, title FROM customers_goals ORDER BY id;";
    $items = $database->select($query);
    return $items;
  }

  static function getPronounList() {
    $items = [
      'Sr.',
      'Sra.'
    ];
    return $items;
  }




  // Toggle Status
  static function toggleStatus($customerID) {
    $database = new Database();
    $query = "SELECT status FROM customers WHERE id='".$customerID."' LIMIT 1;";
    $items = $database->select($query);
    if (count($items) > 0) {
      $item = $items[0];
      $status = $item['status'];
      if ($status == 1) {
        $status = 2;
      } else {
        $status = 1;
      }
      $query = "UPDATE customers SET status='".$status."' WHERE id='".$customerID."' LIMIT 1;";
      $database->query($query);
      return $status;
    }
    return null;
  }





  // Details
  static function getDetails($id) {
    $database = new Database();
    $query = "SELECT id, name, email, img, phone, pronoun, cpf, born_at, address, complement, zipcode, id_goal, message, secondary_message, status FROM customers WHERE id='".$id."' LIMIT 1;";
    $items = $database->select($query);
    if (count($items) < 1) {
      return null;
    }
    $item = $items[0];
    $info = array(
      'id' => $item['id'],
      'name' => $item['name'],
      'email' => $item['email'],
      'img' => $item['img'],
      'phone' => $item['phone'],
      'pronoun' => $item['pronoun'],
      'cpf' => $item['cpf'],
      'born_at' => $item['born_at'],
      'address' => $item['address'],
      'complement' => $item['complement'],
      'zipcode' => $item['zipcode'],
      'id_goal' => $item['id_goal'],
      'message' => $item['message'],
      'secondary_message' => $item['secondary_message'],
      'status' => $item['status']
    );
    return $info;
  }

  static function getProfileInfo($id) {
    $database = new Database();
    $query = "SELECT a.id, a.name, a.email, a.img, a.phone, a.pronoun, a.cpf, a.born_at, a.id_goal, a.status, b.title as goal_title, a.message, b.img as goal_img FROM customers a
    LEFT JOIN customers_goals b ON b.id = a.id_goal
    WHERE a.id='".$id."' AND a.status=1 LIMIT 1;";

    $items = $database->select($query);
    if (count($items) < 1) {
      return null;
    }
    $item = $items[0];
    $info = array(
      'id' => $item['id'],
      'name' => $item['name'],
      'email' => $item['email'],
      'img' => $item['img'],
      'phone' => $item['phone'],
      'pronoun' => $item['pronoun'],
      'cpf' => $item['cpf'],
      'born_at' => $item['born_at'],
      'id_goal' => $item['id_goal'],
      'message' => $item['message'],
      'status' => $item['status'],
      'goal_title' => $item['goal_title'],
      'goal_img' => $item['goal_img']
    );
    return $info;
  }

  static function getCustomerID($email) {
    $database = new Database();
    $query = "SELECT id FROM customers WHERE email='".$email."' LIMIT 1;";
    $items = $database->select($query);
    if (count($items) < 1) {
      return null;
    }
    $item = $items[0];
    return $item['id'];
  }




  // Details
  static function editDetails($id, $name, $email, $phone, $pronoun, $cpf, $bornAt, $goalID, $status, $message = "", $secondaryMessage = "", $address = "", $complement = "", $zipcode = "") {
    $database = new Database();
    $query = "UPDATE customers SET name='".$name."', email='".$email."', phone='".$phone."', pronoun='".$pronoun."', cpf='".$cpf."', born_at='".$bornAt."', id_goal='".$goalID."', message='".$message."', secondary_message='".$secondaryMessage."', address='".$address."', complement='".$complement."', zipcode='".$zipcode."', status='".$status."' WHERE id='".$id."' LIMIT 1;";
    $database->query($query);
    return true;
  }




  // Create
  function createNew($name, $email, $pronoun) {
    $database = new Database();

    $query = "SELECT id FROM customers WHERE email LIKE '".$email."' ;";
    $results = $database->select($query);
    if (count($results) > 0) {
      $this->message = "Já existe um Paciente com este email!";
      return null;
    }

    $status = 1;// ativo
    $now = Dates::now();
    $query = "INSERT INTO customers (`name`, `email`, `pronoun`, `status`, `created_at`) VALUES ('".$name."', '".$email."', '".$pronoun."', '".$status."', '".$now."');";
    $database->query($query);
    $newID = $database->getLastInsertId();

    $this->message = "Paciente criado com sucesso!";
    return $newID;
  }



  // Delete
  function delete($customerID) {
    $database = new Database();
    $query = "DELETE FROM customers WHERE id='".$customerID."' LIMIT 1;";
    $database->query($query);
    $this->message = "Paciente excluído com sucesso!";
    return true;
  }


}
