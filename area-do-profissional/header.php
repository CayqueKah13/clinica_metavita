<?php

use \Source\Core\Config;
use \Source\Core\Session;
use \Source\Core\Helper;
use \Source\Themes\InstructorTheme;

Session::isInstructorPermissionGranted();
$instructorUser = Session::getInstructorUser();
if (Helper::safeInt($instructorUser->id) == 0) {
  Session::setErrorMessage("Sessão Expirada!");
  Helper::redirectToPage(Config::BASE_URL_INSTRUCTOR . "/login/login");
  exit;
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="robots" content="noindex" />
  <title><?= InstructorTheme::TITLE ?></title>
  <link rel="shortcut icon" href="<?= InstructorTheme::FAV_ICON ?>"/>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="<?= Config::BASE_URL_INSTRUCTOR ?>/_theme/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= Config::BASE_URL_INSTRUCTOR ?>/_theme/css/addons/dropzone.css">
  <link rel="stylesheet" href="<?= Config::BASE_URL_INSTRUCTOR ?>/_theme/css/mdb.min.css">
  <!-- FullCalendar -->
  <link rel="stylesheet" href="<?= Config::BASE_URL_ADMIN ?>/_theme/js/fullcalendar-3.10.0/fullcalendar.min.css">
  <!-- Datatables  -->
  <link rel="stylesheet" href="<?= Config::BASE_URL_INSTRUCTOR ?>/_theme/css/addons/datatables.min.css">
  <!-- Custom styles -->
  <link href="<?= Config::BASE_URL_INSTRUCTOR ?>/_theme/css/style.css" rel="stylesheet">
  <link href="<?= Config::BASE_URL_INSTRUCTOR ?>/_theme/css/admin-style.css" rel="stylesheet">

  <style media="screen">
  #slide-out {background-image: url('<?= InstructorTheme::MENU_BG ?>');}
  .black-skin .side-nav .collapsible li .collapsible-header.active {background-color: <?= InstructorTheme::BASE_COLOR ?>!important;}
  .black-skin .side-nav .collapsible li .collapsible-header:hover {background-color: <?= InstructorTheme::BASE_COLOR ?>!important;}
  .black-skin .side-nav .collapsible li .collapsible-body a:hover, .black-skin .side-nav .collapsible li .collapsible-body a.active, .black-skin .side-nav .collapsible li .collapsible-body a:active {color: <?= InstructorTheme::BASE_COLOR ?>!important;}
  .spinner {border-color: <?= InstructorTheme::BASE_COLOR ?>!important;}
  .btn-active {background-color: <?= InstructorTheme::BASE_COLOR ?>!important;}
  </style>

</head>

<body class="fixed-sn black-skin">

   <!--Main Navigation-->
   <header>

    <!-- Sidebar navigation -->
    <div id="slide-out" class="side-nav sn-bg-4 fixed">
      <ul class="custom-scrollbar">
        <!-- Logo -->
        <li class="logo-sn waves-effect py-3">
          <div class="text-center">
            <a id="side-brand" href="<?= Config::BASE_URL_INSTRUCTOR ?>/dashboard" class="pl-0"><img src="<?= InstructorTheme::MENU_LOGO ?>"></a>
          </div>
        </li>
        <!--/. Logo -->

        <!-- Side navigation links -->
        <li>
          <ul class="collapsible collapsible-accordion">

            <hr class="menu-separator">
            <p class="menu-title">Geral</p>
            <?= InstructorTheme::sideMenuItem('dashboard', 'dashboard', $currentTab, 'fa-chart-line', 'Dashboard') ?>

            <?php
            if (Session::isInstructorPermissionGranted()) {
              echo InstructorTheme::sideMenuItem('clientes/clientes', 'customers', $currentTab, 'fa-users', 'Pacientes');
            }
            ?>

            <?php
            if (Session::isInstructorPermissionGranted()) {
              echo InstructorTheme::sideMenuItem('agenda/agenda', 'schedule', $currentTab, 'fa-calendar-day', 'Agenda');
            }
            ?>

          </ul>
        </li>
        <!--/. Side navigation links -->
      </ul>
      <div class="sidenav-bg mask-strong"></div>
    </div>
    <!--/. Sidebar navigation -->

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg scrolling-navbar double-nav">
      <!-- SideNav slide-out button -->
      <div class="float-left">
        <a href="#" data-activates="slide-out" class="button-collapse"><i class="fas fa-bars"></i></a>
      </div>
      <!-- Breadcrumb-->
      <ol class="breadcrumb d-inline-flex pt-0 mr-auto">
        <li class="breadcrumb-item">Área do Profissional</li>
        <?php foreach ($breadcrumbs as $key => $value) { ?>
          <li class="breadcrumb-item active"><?php echo($value);?></li>
        <?php } ?>
      </ol>
      <a class="nav-link waves-effect" onclick="return $('#logout-modal').modal('show');">Sair</a>
    </nav>
    <!-- /.Navbar -->

  </header>
  <!--Main Navigation-->

  <!-- Main layout -->
  <main>
    <div class="container-fluid">



<!-- Logout Modal -->
 <?= InstructorTheme::dangerModal('logout-modal', 'Tem certeza que deseja sair?', Config::BASE_URL_INSTRUCTOR.'/login/logout', 'Sair') ?>
<!-- Logout Modal -->
