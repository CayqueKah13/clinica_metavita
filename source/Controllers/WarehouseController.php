<?php

namespace Source\Controllers;

use \Source\Core\Database;
use \Source\Core\Dates;
use \Source\Core\Helper;

class WarehouseController {

  const ITEMS_PER_PAGE = 5;

  public $message = "";





  // List Customers
  static function getList($currentPage, $search) {
    // conditions
    $where = "WHERE a.title LIKE '%".$search."%'";
    // sorting
    $where .= ' ORDER BY a.id DESC';

    // pagination link prefix
    $paginationPrefix = "estoque?search=".$search;

    // number of items per page
    $itemsPerPage = WarehouseController::ITEMS_PER_PAGE;

    // fetch info
    $info = Controller::getListInfo(['a.id', 'a.title', 'a.quantity'], 'warehouse_items', $where, $currentPage, $itemsPerPage, $paginationPrefix);

    return $info;
  }



  // Create
  function createNew($title) {
    // $database = new Database();
    //
    // $slug = Helper::slugFrom($title);
    // $query = "SELECT id FROM blog WHERE slug LIKE '".$slug."' ;";
    // $results = $database->select($query);
    // if (count($results) > 0) {
    //   $this->message = "Já existe um post com este título!";
    //   return null;
    // }
    //
    // $status = 2;// Inativo
    // $categoryID = 1;// Gratuito
    // $now = Dates::now();
    // $query = "INSERT INTO blog (`id_category`, `slug`, `title`, `status`, `created_at`) VALUES ('".$categoryID."', '".$slug."', '".$title."', '".$status."', '".$now."');";
    // $database->query($query);
    // $newID = $database->getLastInsertId();
    //
    // $this->message = "Conteúdo criado com sucesso!";
    // return $newID;
  }



  // Delete
  function delete($itemID) {
    // $database = new Database();
    // $query = "DELETE FROM blog WHERE id='".$itemID."' LIMIT 1;";
    // $database->query($query);
    // $this->message = "Conteúdo excluído com sucesso!";
    // return true;
  }


}
