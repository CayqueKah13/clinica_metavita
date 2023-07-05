<?php

namespace Source\Controllers;

use \Source\Core\Config;
use \Source\Core\Helper;
use \Source\Core\Database;
use \Source\Core\Dates;
use \Source\Controllers\InstructorController;

class ScheduleController {

  const ITEMS_PER_PAGE = 5;

  public $message = "";

  // List Events
  static function getList($currentPage, $status, $categoryID, $customerID, $instructorID, $date1, $date2) {
    // conditions
    $where = "WHERE 1=1";
    $where .= " AND a.is_hidden IS NULL ";
    if ($status > 0) {
      $where .= " AND a.status = '".$status."' ";
    }
    if ($categoryID > 0) {
      $where .= " AND a.id_category = '".$categoryID."' ";
    }
    if ($customerID > 0) {
      $where .= " AND a.id_customer = '".$customerID."' ";
    }
    if ($instructorID > 0) {
      $where .= " AND a.id_instructor = '".$instructorID."' ";
    }
    // if ($searchDate != '') {
    //   $date = Dates::databaseDateFormat($searchDate);
    //   $where .= " AND a.start_at = '".$date."' ";
    // }
    if ($date1 != "") {
      $start = Dates::databaseDateFormat($date1);
      $where .= " AND a.start_at >= '".$start."' ";
    }
    if ($date2 != "") {
      $end = Dates::databaseDateFormat($date2);
      $where .= " AND a.start_at <= '".$end."' ";
    }
    // sorting
    // $where .= ' ORDER BY id DESC';
    $where .= ' ORDER BY start_at DESC, start_time ASC';

    // pagination link prefix
    // $paginationPrefix = "agenda?status=".$status.'&category='.$categoryID.'&customer='.$customerID.'&instructor='.$instructorID.'&date='.$searchDate;
    $paginationPrefix = "agenda?status=".$status.'&category='.$categoryID.'&customer='.$customerID.'&instructor='.$instructorID.'&start='.$date1.'&end='.$date2;


    // number of items per page
    $itemsPerPage = ScheduleController::ITEMS_PER_PAGE;

    // fetch info
    $info = Controller::getListInfo(['a.id', 'b.title as category', 'c.name as customer', 'c.img as customer_image', 'd.name as instructor', 'a.start_at', 'a.start_time', 'e.id as status_id', 'e.title as status_title'], 'schedule_events a LEFT JOIN schedule_events_categories b ON b.id = a.id_category LEFT JOIN customers c ON c.id = a.id_customer LEFT JOIN instructors d ON d.id = a.id_instructor LEFT JOIN schedule_events_status e ON e.id = a.status', $where, $currentPage, $itemsPerPage, $paginationPrefix);

    return $info;
  }

  static function getListForCustomer($customerID) {
    $database = new Database();
    $query = "SELECT SQL_CALC_FOUND_ROWS a.id, b.title as category, d.name as instructor, d.pronoun as instructor_pronoun, a.start_at, a.start_time, e.title as status_title, a.price FROM schedule_events a
    LEFT JOIN schedule_events_categories b ON b.id = a.id_category
    LEFT JOIN customers c ON c.id = a.id_customer
    LEFT JOIN instructors d ON d.id = a.id_instructor
    LEFT JOIN schedule_events_status e ON e.id = a.status
    WHERE a.id_customer = '".$customerID."' AND a.is_hidden IS NULL
    ORDER BY id DESC;";
    $items = $database->select($query);
    return $items;
  }

  static function getCalendarEvents($instructorID) {
    $instructorQuery = '';
    if ($instructorID > 0) {
      $instructorQuery = 'AND a.id_instructor = '.$instructorID;
    }

    $database = new Database();
    $query = "SELECT SQL_CALC_FOUND_ROWS a.id, b.title as category, d.name as instructor, d.pronoun as instructor_pronoun, a.start_at, a.start_time, e.title as status_title, a.price FROM schedule_events a
    LEFT JOIN schedule_events_categories b ON b.id = a.id_category
    LEFT JOIN customers c ON c.id = a.id_customer
    LEFT JOIN instructors d ON d.id = a.id_instructor
    LEFT JOIN schedule_events_status e ON e.id = a.status
    WHERE a.status != 4 ".$instructorQuery." AND a.is_hidden IS NULL
    ORDER BY a.start_at DESC;";
    $items = $database->select($query);
    return $items;
  }

  static function getListForInstructor($instructorID, $searchDate) {
    // conditions
    $where = "WHERE 1=1 AND a.is_hidden IS NULL";
    if ($instructorID > 0) {
      $where .= " AND a.id_instructor = '".$instructorID."' ";
    }
    if ($searchDate != '') {
      $date = Dates::databaseDateFormat($searchDate);
      $where .= " AND a.start_at = '".$date."' ";
    }
    // sorting
    // $where .= ' ORDER BY id DESC';
    $where .= ' ORDER BY start_at DESC, start_time ASC';

    // pagination link prefix
    $paginationPrefix = "";


    // number of items per page
    $itemsPerPage = 1000;// no limit
    $currentPage = 1;

    // fetch info
    $info = Controller::getListInfo(['a.id', 'b.title as category', 'c.name as customer', 'd.name as instructor', 'a.start_at', 'a.start_time', 'e.title as status_title'], 'schedule_events a LEFT JOIN schedule_events_categories b ON b.id = a.id_category LEFT JOIN customers c ON c.id = a.id_customer LEFT JOIN instructors d ON d.id = a.id_instructor LEFT JOIN schedule_events_status e ON e.id = a.status', $where, $currentPage, $itemsPerPage, $paginationPrefix);

    return $info;
  }

  static function getPendingInfoForInstructor($instructorID, $searchDate) {
    $database = new Database();
    $searchDate = Dates::databaseDateFormat($searchDate);
    $where = "";
    if ($instructorID > 0) {
      $where = " id_instructor=".$instructorID." AND ";
    }
    $query = "SELECT COUNT(*) as total, min(start_at) as reference_date FROM schedule_events WHERE ".$where." `status`=1 AND start_at < '".$searchDate."' AND a.is_hidden IS NULL GROUP BY `status`;";
    $items = $database->select($query);
    if (count($items) > 0) {
      return $items[0];
    } else {
      return null;
    }
  }


  static function getOverview() {
    $database = new Database();
    $today = Dates::today();
    $yesterday = Dates::dateFromReference($today, '-1 day');
    $sevenDaysAgo = Dates::dateFromReference($today, '-7 days');
    $thirtyDaysAgo = Dates::dateFromReference($today, '-30 days');

    $info = [
      ['title' => 'Hoje', 'items' => ScheduleController::getOverviewItems($today, $today)],
      ['title' => 'Ontem', 'items' => ScheduleController::getOverviewItems($yesterday, $yesterday)],
      ['title' => 'Últimos 7 dias', 'items' => ScheduleController::getOverviewItems($today, $sevenDaysAgo)],
      ['title' => 'Últimos 30 dias', 'items' => ScheduleController::getOverviewItems($today, $thirtyDaysAgo)],
      ['title' => 'Total', 'items' => ScheduleController::getOverviewItems($today, '')]
    ];
    return $info;
  }

  static function getOverviewItems($start, $end) {
    $database = new Database();
    $dateQuery = "1=1 AND is_hidden IS NULL";
    if ($start != '') {
      $dateQuery .= " AND start_at <= '".$start."'";
    }
    if ($end != '') {
      $dateQuery .= " AND start_at >= '".$end."'";
    }

    $query = "SELECT
    (SELECT COUNT(*) as total FROM schedule_events WHERE ".$dateQuery." AND `status`=1) as `Pendentes`,
    (SELECT COUNT(*) as total FROM schedule_events WHERE ".$dateQuery." AND `status`=4) as `Cancelados`,
    (SELECT COUNT(*) as total FROM schedule_events WHERE ".$dateQuery." AND `status`=5) as `Reagendados`,
    (SELECT COUNT(*) as total FROM schedule_events WHERE ".$dateQuery." AND `status`=2) as `Em Andamento`,
    (SELECT COUNT(*) as total FROM schedule_events WHERE ".$dateQuery." AND `status`=3) as `Concluídos`,
    (SELECT COUNT(*) as total FROM schedule_events WHERE ".$dateQuery.") as `Total`;";
    $items = $database->select($query);
    if (count($items) > 0) {
      return $items[0];
    } else {
      return null;
    }
  }















  // List Status
  static function getStatusList() {
    $database = new Database();
    $query = "SELECT id, title FROM schedule_events_status ORDER BY title;";
    $items = $database->select($query);
    return $items;
  }

  static function getPaymentStatusList() {
    $database = new Database();
    $query = "SELECT id, title FROM schedule_events_payments_status ORDER BY title;";
    $items = $database->select($query);
    return $items;
  }

  static function getCategoriesList() {
    $database = new Database();
    $query = "SELECT id, title FROM schedule_events_categories ORDER BY title;";
    $items = $database->select($query);
    return $items;
  }

  static function getRescheduleReasonsList() {
    $database = new Database();
    $query = "SELECT id, title FROM schedule_reschedule_reason ORDER BY title;";
    $items = $database->select($query);
    return $items;
  }





  // Details
  static function getDetails($id) {
    $database = new Database();
    $query = "SELECT a.id, a.id_category, a.id_customer, a.id_instructor, b.name as instructor_name, a.title, a.start_at, a.start_time, a.price, a.message, a.payment_status, a.status, c.title as category, a.rescheduled_to_id, d.title as reschedule_reason FROM schedule_events a
    LEFT JOIN instructors b ON b.id = a.id_instructor
    LEFT JOIN schedule_events_categories c ON c.id = a.id_category
    LEFT JOIN schedule_reschedule_reason d ON d.id = a.rescheduled_reason_id
    WHERE a.id='".$id."' LIMIT 1;";
    $items = $database->select($query);
    if (count($items) < 1) {
      return null;
    }
    $item = $items[0];
    $info = array(
      'id' => $item['id'],
      'id_category' => $item['id_category'],
      'id_customer' => $item['id_customer'],
      'id_instructor' => $item['id_instructor'],
      'instructor_name' => $item['instructor_name'],
      'title' => $item['title'],
      'start_at' => $item['start_at'],
      'start_time' => $item['start_time'],
      'price' => $item['price'],
      'message' => $item['message'],
      'payment_status' => $item['payment_status'],
      'status' => $item['status'],
      'category' => $item['category'],
      'rescheduled_to_id' => $item['rescheduled_to_id'],
      'reschedule_reason' => $item['reschedule_reason'],
    );
    return $info;
  }




  // Details
  function editDetails($id, $categoryID, $customerID, $instructorID, $title, $date, $hour, $price, $message, $paymentStatus, $status) {
    $date = Dates::databaseDateFormat($date);
    $hour = Dates::databaseHourFormat($hour);
    // $price = Helper::brlMoneyToDecimal($price);

    $database = new Database();

    // Check if the instructs is already in another event at this date time
    if ($status != 4) {
      // se a visita não estiver cancelada, verifica disponibilidade
      $query = "SELECT id FROM schedule_events WHERE id_instructor='".$instructorID."' AND start_at='".$date."' AND start_time='".$hour."' AND status!=4 AND id!=".$id.";";
      $results = $database->select($query);
      if (count($results) > 0) {
        $this->message = "O profissional já tem outro agendamento para este dia e horário";
        return null;
      }
    }

    $price = InstructorController::priceForScheduleCategory($instructorID, $categoryID);


    $query = "UPDATE schedule_events SET id_category='".$categoryID."', id_customer='".$customerID."', id_instructor='".$instructorID."',
    title='".$title."', start_at='".$date."', start_time='".$hour."', price='".$price."', message='".$message."',
    payment_status='".$paymentStatus."', status='".$status."' WHERE id='".$id."' LIMIT 1;";
    $database->query($query);
    return true;
  }




  // Create
  function createNew($categoryID, $customerID, $instructorID, $title, $date, $hour) {
    $date = Dates::databaseDateFormat($date);
    $hour = Dates::databaseHourFormat($hour);
    $database = new Database();

    // Check if the instructs is already in another event at this date time
    $query = "SELECT id FROM schedule_events WHERE id_instructor='".$instructorID."' AND is_hidden IS NULL AND start_at='".$date."' AND start_time='".$hour."' AND status!=4;";
    $results = $database->select($query);
    if (count($results) > 0) {
      $this->message = "O profissional já tem outro agendamento para este dia e horário";
      return null;
    }

    $price = InstructorController::priceForScheduleCategory($instructorID, $categoryID);

    // Create Event
    $status = 1;// ativo
    $now = Dates::now();
    $query = "INSERT INTO schedule_events (`id_category`, `id_customer`, `id_instructor`, `title`, `start_at`, `start_time`, `status`, `price`, `created_at`)
    VALUES ('".$categoryID."', '".$customerID."', '".$instructorID."', '".$title."', '".$date."', '".$hour."', '".$status."', '".$price."', '".$now."');";
    $database->query($query);
    $newID = $database->getLastInsertId();
    $this->message = "Evento criado com sucesso!";
    return $newID;
  }

  function createFakeEvent($customerID, $instructorID) {
    $database = new Database();
    // Create Event
    $status = 4;// cancelado
    $categoryID = 0;// sem categoria
    $title = 'Agendamento Criado pelo Sistema ao cadastrar paciente';
    $date = Dates::today();
    $hour = Dates::thisTime();
    $price = 0.00;
    $now = Dates::now();
    $query = "INSERT INTO schedule_events (`id_category`, `id_customer`, `id_instructor`, `title`, `start_at`, `start_time`, `status`, `price`, `created_at`, `is_hidden`)
    VALUES ('".$categoryID."', '".$customerID."', '".$instructorID."', '".$title."', '".$date."', '".$hour."', '".$status."', '".$price."', '".$now."', 1);";
    $database->query($query);
    $newID = $database->getLastInsertId();
    $this->message = "Evento criado com sucesso!";
    return $newID;
  }



  // Delete
  function delete($itemID) {
    $database = new Database();
    $query = "DELETE FROM schedule_events WHERE id='".$itemID."' LIMIT 1;";
    $database->query($query);
    $this->message = "Evento excluído com sucesso!";
    return true;
  }








  function rescheduleEvent($id, $date, $hour, $reason, $description) {
    $date = Dates::databaseDateFormat($date);
    $hour = Dates::databaseHourFormat($hour);
    $database = new Database();


    $item = ScheduleController::getDetails($id);
    $instructorID = $item['id_instructor'];
    $categoryID = $item['id_category'];
    $customerID = $item['id_customer'];
    $instructorID = $item['id_instructor'];
    $title = '';



    // Check if the instructs is already in another event at this date time
    $query = "SELECT id FROM schedule_events WHERE id_instructor='".$instructorID."' AND is_hidden IS NULL AND start_at='".$date."' AND start_time='".$hour."' AND status!=4;";
    $results = $database->select($query);
    if (count($results) > 0) {
      $this->message = "O profissional já tem outro agendamento para este dia e horário";
      return null;
    }

    $price = InstructorController::priceForScheduleCategory($instructorID, $categoryID);

    // Create Event
    $status = 1;// ativo
    $now = Dates::now();
    $query = "INSERT INTO schedule_events (`id_category`, `id_customer`, `id_instructor`, `title`, `start_at`, `start_time`, `status`, `price`, `created_at`)
    VALUES ('".$categoryID."', '".$customerID."', '".$instructorID."', '".$title."', '".$date."', '".$hour."', '".$status."', '".$price."', '".$now."');";
    $database->query($query);
    $newID = $database->getLastInsertId();
    $this->message = "Evento reagendado com sucesso!";



    // change current event status
    $newStatus = 5; // reagendada
    $query = "UPDATE schedule_events SET status='".$newStatus."', rescheduled_to_id='".$newID."', rescheduled_reason_id='".$reason."', message='".$description."' WHERE id='".$id."' LIMIT 1;";
    $database->query($query);


    return $newID;
  }


}
