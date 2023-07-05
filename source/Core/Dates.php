<?php

namespace Source\Core;

use DateTime;

class Dates {

  static function now() {
    date_default_timezone_set('UTC');
    return date("Y-m-d H:i:s", strtotime('-3 hours'));
  }

  static function today() {
    date_default_timezone_set('UTC');
    return date("Y-m-d", strtotime('-3 hours'));
  }

  static function thisTime() {
    date_default_timezone_set('UTC');
    return date("H:i:s", strtotime('-3 hours'));
  }

  static function yesterday() {
    return date("Y-m-d", strtotime('-1 day', strtotime(Dates::today())));
  }

  static function thisMonth() {
    date_default_timezone_set('UTC');
    return date("m", strtotime('-3 hours'));
  }

  static function thisYear() {
    date_default_timezone_set('UTC');
    return date("Y", strtotime('-3 hours'));
  }


  static function secondsPassedSince($date) {
    $timeFirst  = strtotime($date);
    $timeSecond = strtotime(Dates::now());
    $differenceInSeconds = $timeSecond - $timeFirst;
    return $differenceInSeconds;
  }

  static function secondsRemainingTo($date) {
    $timeFirst  = strtotime($date);
    $timeSecond = strtotime(Dates::now());
    $differenceInSeconds = $timeFirst - $timeSecond;
    return $differenceInSeconds;
  }

  static function daysPassedSince($date) {
    $seconds = Dates::secondsPassedSince($date);
    return Helper::safeInt($seconds / (60*60*24));
  }

  static function correctDateFrom($date) {
    return date("Y-m-d H:i:s", strtotime('-3 hours', strtotime($date)));
  }

  static function dateFromReference($date, $addTime) {
    return date("Y-m-d", strtotime($addTime, strtotime($date)));
  }

  static function databaseDateFormat($date) {
    // convert 30/01/2020 to 2020-01-30
    $date = Helper::safeString($date);
    $dateObj = \DateTime::createFromFormat("d/m/Y", $date);
    if (!$dateObj) {
        return '';
    }
    $newDate = $dateObj->format("Y-m-d");
    return $newDate;
  }

  static function brlDateFormat($date) {
    // convert 2020-01-30 to 30/01/2020
    $date = Helper::safeString($date);
    $dateObj = \DateTime::createFromFormat("Y-m-d", $date);
    if (!$dateObj) {
        return '';
    }
    $newDate = $dateObj->format("d/m/Y");
    return $newDate;
  }

  static function databaseHourFormat($date) {
    // convert 30/01/2020 to 2020-01-30
    $date = Helper::safeString($date);
    $dateObj = \DateTime::createFromFormat("H:i", $date);
    if (!$dateObj) {
        return '';
    }
    $newDate = $dateObj->format("H:i:s");
    return $newDate;
  }

  static function brlHourFormat($date) {
    // convert 2020-01-30 to 30/01/2020
    $date = Helper::safeString($date);
    $dateObj = \DateTime::createFromFormat("H:i:s", $date);
    if (!$dateObj) {
        return '';
    }
    $newDate = $dateObj->format("H:i");
    return $newDate;
  }

  static function monthFrom($date) {
    // convert 2020-01-30 to 30/01/2020
    $date = Helper::safeString($date);
    $dateObj = \DateTime::createFromFormat("Y-m-d", $date);
    if (!$dateObj) {
        return '';
    }
    $newDate = $dateObj->format("m");
    return $newDate;
  }


  static function lastDayOfMonthFrom($date) {
    return date("Y-m-t", strtotime($date));
  }

  static function firstDayOfMonthFrom($date) {
    return date("Y-m-01", strtotime($date));
  }

  static function addDaysToDate($date, $days) {
    $old_date = $date;
    $next_due_date = date('Y-m-d', strtotime($old_date. ' +'.$days.' days'));
    return $next_due_date;
  }

  static function nextBusinessDateFrom($date) {
    $date = Helper::safeString($date);
    $dateObj = \DateTime::createFromFormat("Y-m-d", $date);
    if (!$dateObj) {
        return $date;
    }
    $dayOfWeek = $dateObj->format("w");
    if ($dayOfWeek == 6) {
      // Sábado
      return Dates::addDaysToDate($date, 2);
    } else if ($dayOfWeek == 0) {
      // Domingo
      return Dates::addDaysToDate($date, 1);
    }
    return $date;
  }


  static function monthName($month) {
    switch ($month) {
      case 1: return 'Janeiro';
      case 2: return 'Fevereiro';
      case 3: return 'Março';
      case 4: return 'Abril';
      case 5: return 'Maio';
      case 6: return 'Junho';
      case 7: return 'Julho';
      case 8: return 'Agosto';
      case 9: return 'Setembro';
      case 10: return 'Outubro';
      case 11: return 'Novembro';
      case 12: return 'Dezembro';

      default: break;
    }
  }

}
