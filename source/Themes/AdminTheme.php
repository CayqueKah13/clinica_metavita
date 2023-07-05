<?php

namespace Source\Themes;

use \Source\Core\Config;
use \Source\Core\Helper;
use \Source\Themes\Theme;

class AdminTheme {

  // Admin Theme
  const TITLE = "MetaVita - Admin";
  const BASE_COLOR = "#064288";
  const FAV_ICON = Config::BASE_URL_ADMIN . "/_theme/img/fav_icon.png";
  const LOGIN_BG_IMAGE = Config::BASE_URL_ADMIN . "/_theme/img/admin-bg-2.jpg";
  const LOGIN_BG_COLOR = "#000000";
  const LOGIN_CARD_BG_COLOR = "rgba(40,40,40,0.5)";
  const LOGIN_CARD_COLOR = "#ffffff";
  const MENU_LOGO = "";
  // const MENU_BG = Config::BASE_URL_ADMIN . "/_theme/img/menu-bg.jpg";
  const MENU_BG = "";







  // Layout Methods
  static function dangerModal($modalID, $modalMessage, $modalLink, $modalAction) {
    return '<div class="modal fade top" id="'.$modalID.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-frame modal-top" role="document">
    <div class="modal-content">
    <div class="modal-body">
    <div class="row d-flex justify-content-center align-items-center">
    <p class="pt-3 pr-2">'.$modalMessage.'</p>
    <a type="button" href="'.$modalLink.'"  class="btn btn-danger">'.$modalAction.'</a>
    </div>
    </div>
    </div>
    </div>
    </div>';
  }



  static function sideMenuItem($sufix, $tab, $currentTab, $iconName, $title, $externalLink = false) {
    $item = '<li><a href="'.Config::BASE_URL_ADMIN.'/'.$sufix.'" class="collapsible-header waves-effect ';
    if ($externalLink == true) {
      $item = '<li><a href="'.$sufix.'" target="_blank" class="collapsible-header waves-effect ';
    }
    if ($tab == $currentTab) {
      $item .= 'active';
    }
    $item .= '"><i class="fas '.$iconName.'"></i>'.$title.'</a></li>';
    return $item;
  }



  static function avatarThumb($img, $title) {
    $i = Helper::safeString($img);
    if ($i == "") {
      $letter = strtoupper(Helper::safeString(substr($title, 0, 1)));
      $color = AdminTheme::colorForLetterThumb($letter);
      return '<div class="avatar-placeholder '.$color.' darken-3">'.$letter.'</div>';
    } else {
      $url = Theme::imageUrlFromSufix($img);
      return '<div class="avatar-32" style="background-image: url(\''.$url.'\');"></div>';
    }
  }

  static function colorForLetterThumb($letter) {
    $letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
     'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'X', 'W', 'Y', 'Z'];
    $colors = ['yellow', 'green', 'red', 'brown', 'blue'];
    $info = [];
    $counter = 0;
    foreach ($letters as $key => $value) {
      if ($counter+1 == count($colors)) {
        $counter = 0;
      }
      $info[$value] = $colors[$counter];
      $counter += 1;
    }
    $color = $info[$letter];
    if (Helper::safeString($color) == '') {
      return $colors[0];
    } else {
      return $color;
    }
  }



  // Pagination
  static function pagination($info) {
    $numberOfPages = $info['numberOfPages'];
    $pages = $info['paginationItems'];
    $page = $info['currentPage'];
    if ($numberOfPages > 1) {
      echo '<nav class="my-2 d-flex justify-content-center"><ul class="pagination pg-blue mb-0">';
      $numberOfPages = count($pages);
      foreach ($pages as $key => $item) {
        $class = ($item['page'] == $page) ? 'active' : '';
        $currentItem = '<li class="page-item '.$class.'"><a href="'.$item['link'].'" class="page-link">'.$item['page'].'</a></li>';
        Theme::formatPagination($currentItem, $key, $page, $numberOfPages);
      }
      echo '</ul></nav>';
    }

  }








}
