<?php
require_once __DIR__ . '/../../source/autoload.php';

use \Source\Core\Config;
use \Source\Core\Session;
use \Source\Themes\InstructorTheme;


Session::clearInstructorUser();


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
  <link href="<?= Config::BASE_URL_INSTRUCTOR ?>/_theme/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="<?= Config::BASE_URL_INSTRUCTOR ?>/_theme/css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="<?= Config::BASE_URL_INSTRUCTOR ?>/_theme/css/style.css" rel="stylesheet">

  <style>
  html,
  body,
  header,
  .view {
    height: 100%;
  }
  @media (min-width: 560px) and (max-width: 740px) {
    html,
    body,
    header,
    .view {
      height: 650px;
    }
  }
  @media (min-width: 800px) and (max-width: 850px) {
    html,
    body,
    header,
    .view  {
      height: 650px;
    }
  }
  .btn-login {
    background-color: <?= InstructorTheme::BASE_COLOR ?>!important;
    color: <?= InstructorTheme::LOGIN_CARD_COLOR ?>;
  }
  .login-page .md-form .form-control {
    color: <?= InstructorTheme::LOGIN_CARD_COLOR ?>!important;
    border-bottom: 1px solid <?= InstructorTheme::LOGIN_CARD_COLOR ?>!important;
  }
  label {
    color: <?= InstructorTheme::LOGIN_CARD_COLOR ?>!important;
  }
  /* input color */
  .login-page .md-form input[type=password]:focus:not([readonly]), .login-page .md-form input[type=text]:focus:not([readonly]) {
    border-bottom: 1px solid <?= InstructorTheme::BASE_COLOR ?>!important;
    box-shadow: 0 1px 0 0 <?= InstructorTheme::BASE_COLOR ?>!important;
  }
  .login-page .md-form input[type=password]:focus:not([readonly])+label, .login-page .md-form input[type=text]:focus:not([readonly])+label {
    color: <?= InstructorTheme::BASE_COLOR ?>!important;
  }
  /* input color */
  </style>
</head>

<body class="login-page" style="background-color:<?= InstructorTheme::LOGIN_BG_COLOR ?>;">

  <!-- Main Navigation -->
  <header>

    <!-- Intro Section -->
    <section class="view intro-2" style="background:url('<?= InstructorTheme::LOGIN_BG_IMAGE ?>') center center no-repeat;">
      <div class="h-100 d-flex justify-content-center align-items-center">
        <div class="container">
          <div class="row">
            <div class="col-xl-5 col-lg-6 col-md-10 col-sm-12 mx-auto mt-5">
