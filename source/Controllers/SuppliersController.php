<?php

namespace Source\Controllers;

use \Source\Core\Config;
use \Source\Core\Helper;
use \Source\Core\Database;
use \Source\Core\Auth;
use \Source\Core\Dates;

class SuppliersController {

  const ITEMS_PER_PAGE = 5;

  public $message = "";



  // List Instructors
  static function getList($currentPage, $search) {
    // conditions
    $where = "WHERE name LIKE '%".$search."%' ";
    // sorting
    $where .= 'ORDER BY id DESC';

    // pagination link prefix
    $paginationPrefix = "fornecedores?search=".$search;

    // number of items per page
    $itemsPerPage = SuppliersController::ITEMS_PER_PAGE;

    // fetch info
    $info = Controller::getListInfo(['id', 'name', 'email', 'cnpj'], 'suppliers', $where, $currentPage, $itemsPerPage, $paginationPrefix);

    return $info;
  }

  static function getSearchList() {
    $database = new Database();
    $query = "SELECT id, name FROM suppliers ORDER BY name;";
    $items = $database->select($query);
    $info = array();
    foreach ($items as $key => $value) {
      $item = array(
        'id' => $value['id'],
        'title' => $value['name']
      );
      array_push($info, $item);
    }
    return $info;
  }




  // Details
  static function getDetails($id) {
    $database = new Database();
    $query = "SELECT id, name, email, phone, cnpj FROM suppliers WHERE id='".$id."' LIMIT 1;";
    $items = $database->select($query);
    if (count($items) < 1) {
      return null;
    }
    $item = $items[0];

    $info = array(
      'id' => $item['id'],
      'name' => $item['name'],
      'email' => $item['email'],
      'phone' => $item['phone'],
      'cnpj' => $item['cnpj']
    );
    return $info;
  }



  // Details
  static function editDetails($id, $name, $email, $phone, $cnpj) {
    $database = new Database();
    $query = "UPDATE suppliers SET name='".$name."', email='".$email."', phone='".$phone."', cnpj='".$cnpj."' WHERE id='".$id."' LIMIT 1;";
    $database->query($query);
    return true;
  }




  // Create
  function createNew($name) {
    $database = new Database();

    $now = Dates::now();
    $query = "INSERT INTO suppliers (`name`, `created_at`) VALUES ('".$name."', '".$now."');";
    $database->query($query);
    $newID = $database->getLastInsertId();

    $this->message = "Fornecedor criado com sucesso!";
    return $newID;
  }



  // Delete
  function delete($itemID) {
    $database = new Database();
    $query = "DELETE FROM suppliers WHERE id='".$itemID."' LIMIT 1;";
    $database->query($query);
    $this->message = "Fornecedor excluído com sucesso!";
    return true;
  }

}
