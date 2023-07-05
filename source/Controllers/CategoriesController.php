<?php

namespace Source\Controllers;

use \Source\Core\Config;
use \Source\Core\Helper;
use \Source\Core\Database;
use \Source\Core\Dates;

class CategoriesController {

  const SCHEDULE_EVENTS_CATEGORIES = 1;
  const EXPENSES_CATEGORIES = 2;



  public $message = "";


  static function titleFrom($key) {
    switch ($key) {
      case CategoriesController::SCHEDULE_EVENTS_CATEGORIES: return "Tipo de Agendamento";
      case CategoriesController::EXPENSES_CATEGORIES: return "Categoria de Despesa";
      default: return "";
    }
  }

  static function tableNameFrom($key) {
    switch ($key) {
      case CategoriesController::SCHEDULE_EVENTS_CATEGORIES: return "schedule_events_categories";
      case CategoriesController::EXPENSES_CATEGORIES: return "finances_categories";
      default: return "";
    }
  }









  // List Events Categories
  static function getList($key) {

    $table = CategoriesController::tableNameFrom($key);

    $database = new Database();
    $query = "SELECT id, title FROM ".$table." ORDER BY title;";

    switch ($key) {
      case CategoriesController::EXPENSES_CATEGORIES:
        $query = "SELECT id, title FROM ".$table." WHERE id_group = 1 ORDER BY title;";
        break;
      default: break;
    }

    $items = $database->select($query);
    return $items;
  }

  // Create
  function createNew($title, $key) {
    $table = CategoriesController::tableNameFrom($key);

    $database = new Database();
    // check
    $query = "SELECT id FROM ".$table." WHERE title LIKE '".$title."';";
    $results = $database->select($query);
    if (count($results) > 0) {
      $this->message = "Já existe uma categoria com este título";
      return null;
    }

    // Create
    $query = "INSERT INTO ".$table." (`title`) VALUES ('".$title."');";
    switch ($key) {
      case CategoriesController::EXPENSES_CATEGORIES:
        $query = "INSERT INTO ".$table." (`id_group`, `title`, `color`, `highlighted`) VALUES (1, '".$title."', 'a0a0a0', 0);";
        break;
      default: break;
    }
    $database->query($query);
    $newID = $database->getLastInsertId();
    $this->message = "Categoria criada com sucesso!";
    return $newID;
  }



  // Delete
  function delete($itemID, $key) {
    $table = CategoriesController::tableNameFrom($key);
    $database = new Database();


    switch ($key) {
      case CategoriesController::SCHEDULE_EVENTS_CATEGORIES:
        // verifica se existe algum evento com essa categoria
        $query = "SELECT id FROM schedule_events WHERE id_category='".$itemID."';";
        $results = $database->select($query);
        if (count($results) > 0) {
          $this->message = "Ainda existem agendamentos vinculados à esta categoria. Altere para poder excluir.";
          return false;
        }
        break;

      case CategoriesController::EXPENSES_CATEGORIES:
        // verifica se existe algum registro financeiro com essa categoria
        $query = "SELECT id FROM finances WHERE id_category='".$itemID."';";
        $results = $database->select($query);
        if (count($results) > 0) {
          $this->message = "Ainda existem lançamentos vinculados à esta categoria. Altere para poder excluir.";
          return false;
        }
        break;

      default: break;
    }

    // deleta
    $query = "DELETE FROM ".$table." WHERE id = '".$itemID."' LIMIT 1;";
    $database->query($query);

    $this->message = "Categoria removida com sucesso!";
    return true;
  }


}
