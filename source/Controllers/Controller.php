<?php

namespace Source\Controllers;

use \Source\Core\Database;

class Controller {


  static function getListInfo($fields, $table, $where, $currentPage, $itemsPerPage, $paginationPrefix) {
    if ($currentPage == 0) {
      $currentPage = 1;
    }
    $start = ($currentPage-1) * $itemsPerPage;

    $items = array();

    // Select List
    $database = new Database();
    $query = "SELECT SQL_CALC_FOUND_ROWS ";
    foreach ($fields as $key => $value) {
      if ($key > 0) {
        $query .= ', ';
      }
      $query .= $value;
    }
    $query .= ' FROM ' . $table;
    $query .= ' ' . $where;
    if ($currentPage != -1) {
      $query .= ' LIMIT '.$start.','.$itemsPerPage.';';
    }
    // var_dump($query);
    // exit;
    $items = $database->select($query);

    // Pagination
    $total = $database->select("SELECT FOUND_ROWS() as 'nrtotal';");
    $totalItems = $total[0]['nrtotal'];
    $numberOfPages = ceil($totalItems/$itemsPerPage);
    $paginationItems = array();
    for ($i=0; $i < $numberOfPages; $i++) {
      $link = $paginationPrefix."&page=".($i+1);
      array_push($paginationItems, array('link' => $link, 'page' => $i+1));
    }

    $countTitle = 'Nenhum Resultado encontrado';
    if ($totalItems == 1) {
      $countTitle = '1 Resultado encontrado';
    } else if ($totalItems > 1) {
      $countTitle = number_format($totalItems, 0, '', '') . ' Resultados encontrados';
    }

    // return info
    $info = array(
      'items' => $items,
      'totalItems' => $totalItems,
      'numberOfPages' => $numberOfPages,
      'paginationItems' => $paginationItems,
      'currentPage' => $currentPage,
      'countTitle' => $countTitle
    );

    return $info;
  }







}
