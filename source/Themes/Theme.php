<?php

namespace Source\Themes;

use \Source\Core\Helper;
use \Source\Core\Config;

class Theme {

  static function formatPagination($item, $currentIndex, $selectedPage, $numberOfItems) {
    if ($numberOfItems < 10) {
      // if there are less than 10 pages, show all items
      echo($item);
    } else {
      // Show first trimmed
      if ($selectedPage > 5 && $currentIndex == 0) {
        echo($item);
        echo "&nbsp; ... &nbsp;";
        return;
      }
      // Show last trimmed
      if ($currentIndex == $numberOfItems-1 && $selectedPage < $numberOfItems-4) {
        echo "&nbsp; ... &nbsp;";
        echo($item);
        return;
      }
      // Skip items after first (if needed)
      if ($currentIndex < $selectedPage-3 && ($currentIndex > 3 || $selectedPage > 5) && $currentIndex < $numberOfItems-7) {
        return;
      }
      // Skip items before last (if needed)
      if ($currentIndex > $selectedPage+1 && $selectedPage < $numberOfItems-4 && $currentIndex > 6) {
        return;
      }
      echo($item);
    }
  }




  static function imageUrlFromSufix($value) {
    $sufix = Helper::safeString($value);
    if ($sufix == "") {
      return Config::BASE_URL . '/arquivos/imagens/placeholder.png';
    } else {
      return Config::BASE_URL . '/arquivos/imagens/'. $sufix;
    }
  }



}
