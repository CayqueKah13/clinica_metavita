<?php

namespace Source\Controllers;

use \Source\Core\Database;
use \Source\Core\Dates;
use \Source\Core\Helper;

class FinancesController {

  const ITEMS_PER_PAGE = 15;

  public $message = "";





  // List Customers
  static function getList($currentPage, $groupID, $categoryID, $date1, $date2) {
    // conditions
    $where = "WHERE 1=1";
    if ($groupID > 0) {
      $where .= " AND a.id_group = '".$groupID."' ";
    }
    if ($categoryID > 0) {
      $where .= " AND a.id_category = '".$categoryID."' ";
    }
    if ($date1 != "") {
      $start = Dates::databaseDateFormat($date1);
      $where .= " AND a.date >= '".$start."' ";
    }
    if ($date2 != "") {
      $end = Dates::databaseDateFormat($date2);
      $where .= " AND a.date <= '".$end."' ";
    }
    // sorting
    $where .= ' ORDER BY a.date DESC';

    // pagination link prefix
    $paginationPrefix = "financeiro?group=".$groupID.'&category='.$categoryID.'&start='.$date1.'&end='.$date2;

    // number of items per page
    $itemsPerPage = FinancesController::ITEMS_PER_PAGE;

    // fetch info
    $info = Controller::getListInfo(['a.id', 'a.title', 'c.title as category', 'd.title as payment_method',  'b.id as id_group', 'b.color', 'a.value', 'a.date', 'a.total_installments', 'a.installment'], 'finances a LEFT JOIN finances_groups b ON b.id = a.id_group LEFT JOIN finances_categories c ON c.id = a.id_category LEFT JOIN finances_payment_methods d ON d.id = a.id_payment_method', $where, $currentPage, $itemsPerPage, $paginationPrefix);

    foreach ($info['items'] as $key => $value) {
      if ($value['installment'] > 0) {
        $info['items'][$key]['payment_method'] .= " (" . $value['installment'] . "/" . $value['total_installments'] . ")";
      }
    }

    return $info;
  }

  static function getListForScheduleEvent($scheduleEventID) {
    $database = new Database();
    $query = "SELECT a.id, a.title, c.title as category, d.title as payment_method, b.id as id_group, b.color, a.value, a.date, a.total_installments FROM finances a
    LEFT JOIN finances_groups b ON b.id = a.id_group
    LEFT JOIN finances_categories c ON c.id = a.id_category
    LEFT JOIN finances_payment_methods d ON d.id = a.id_payment_method
    WHERE a.id_schedule_event = '".$scheduleEventID."' AND a.id_parent IS NULL
    ORDER BY a.date DESC;";
    $items = $database->select($query);

    foreach ($items as $key => $value) {
      if ($value['total_installments'] > 0) {
        $paymentMethod = $value['total_installments'] . "x " . Helper::decimalToBrlMoney($value['value']);
        $items[$key]['payment_method'] = $value['payment_method'] . " (" . $paymentMethod . ")";
        $items[$key]['value'] = $value['value'] * $value['total_installments'];
      }
    }

    return $items;
  }


  static function getCustomersWithPendingPayments() {
    $today = Dates::today();
    $database = new Database();
    $query = "SELECT c.id, c.name, SUM(a.value) as total FROM finances a
    LEFT JOIN schedule_events b ON b.id = a.id_schedule_event
    LEFT JOIN customers c ON c.id = b.id_customer
    WHERE a.id_group = 2 AND a.is_confirmed = 0  AND a.date < '".$today."'
    GROUP BY c.id
    ORDER BY SUM(a.value) DESC, c.name ASC;";
    $items = $database->select($query);
    return $items;
  }


  // List Categories
  static function getExpensesCategoriesList() {
    return FinancesController::getCategoriesList(1);
  }

  static function getIncomeCategoriesList() {
    return FinancesController::getCategoriesList(2);
  }

  static function getCategoriesList($groupID) {
    $database = new Database();
    $query = "SELECT id, title FROM finances_categories WHERE id_group='".$groupID."' ORDER BY title;";
    $items = $database->select($query);
    return $items;
  }

  static function getAllCategoriesList() {
    $database = new Database();
    $query = "SELECT id, title FROM finances_categories ORDER BY title;";
    $items = $database->select($query);
    return $items;
  }

  static function getAllPaymentMethods() {
    $database = new Database();
    $query = "SELECT id, title, fixed_value, relative_value FROM finances_payment_methods ORDER BY title;";
    $items = $database->select($query);
    foreach ($items as $key => $value) {
      $description = '';
      $fixedValue = $value['fixed_value'];
      if ($fixedValue > 0) {
        $description .= Helper::decimalToBrlMoney($fixedValue);
      }
      $relativeValue = $value['relative_value'];
      if ($relativeValue > 0) {
        if ($fixedValue > 0) {
          $description .= ' + ';
        }
        $description .= number_format($relativeValue, 2, '.', '') . '%';
      }
      $title = $value['title'];
      if ($description != '') {
        $title .= ' ('.$description.')';
      }
      $items[$key]['description'] = $title;
    }
    return $items;
  }

  static function getRepeatDaysList() {
    $items = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25];
    return $items;
  }


  static function getAnnualOverview() {
    $years = [2020];
    $info = array();
    foreach ($years as $key => $year) {
      $item = [
        'title' => $year,
        'items' => FinancesController::getAnnualOverviewItems($year)
      ];
      array_push($info, $item);
    }
    return $info;
  }

  static function getAnnualOverviewItems($year) {
    $database = new Database();

    $months = [1,2,3,4,5,6,7,8,9,10,11,12];
    $items = array();

    $finalStart = '';
    $finalEnd = '';
    $finalExpenses = 0.0;
    $finalIncome = 0.0;

    foreach ($months as $key => $value) {
      $month = Helper::addZeroPrefixIfNeeded($value);
      $start = $year.'-'.$month.'-01';
      $end = Dates::lastDayOfMonthFrom($start);

      if ($key == 0) {
        $finalStart = $start;
      }
      $finalEnd = $end;

      $info = FinancesController::getOverviewItem($start, $end, Helper::monthNameFrom($value));
      $finalExpenses += $info['expenses'];
      $finalIncome += $info['income'];
      array_push($items, $info);
    }


    // Add Total
    $info = FinancesController::getOverviewItem($finalStart, $finalEnd, 'Total');
    array_push($items, $info);

    return $items;
  }

  static function getOverviewPreview() {
    // $today = Dates::today();
    // $yesterday = Dates::dateFromReference($today, '-1 month');
    //
    // $end = Dates::lastDayOfMonthFrom($start);

    $items = [
      FinancesController::getOverviewItem('2020-06-01', '2020-06-30', 'Este mês'),
      FinancesController::getOverviewItem('2020-05-01', '2020-05-30', 'Mês passado')
    ];

    // $items = FinancesController::getOverviewItem('2020-05-01', '2020-05-30', 'Mês passado');
    return $items;
  }

  static function getOverviewItem($start, $end, $title) {
    $database = new Database();
    // Expenses
    $expenses = $database->select("SELECT SUM(a.value) as total FROM finances a WHERE a.id_group=1 AND a.date >= '".$start."' AND a.date <= '".$end."';")[0]['total'];
    $expenses = number_format($expenses, 2, '.', '');
    // Income
    $income = $database->select("SELECT SUM(a.value) as total FROM finances a WHERE a.id_group=2 AND a.date >= '".$start."' AND a.date <= '".$end."';")[0]['total'];
    $income = number_format($income, 2, '.', '');

    $info = [
      'title' => $title,
      'start' => $start,
      'end' => $end,
      'expenses' => $expenses,
      'income' => $income
    ];
    return $info;
  }














  // Details
  static function getDetails($id) {
    $database = new Database();
    $query = "SELECT a.id, a.id_group, a.total_installments, a.installment, a.id_payment_method, b.title as `group`, b.color, a.id_category, a.id_supplier,
    a.id_customer, a.id_schedule_event, a.title, a.description, a.value, a.date, a.repeat_day, a.is_confirmed FROM finances a
    LEFT JOIN finances_groups b ON b.id = a.id_group
    WHERE a.id='".$id."' LIMIT 1;";
    $items = $database->select($query);
    if (count($items) < 1) {
      return null;
    }
    $item = $items[0];
    $info = array(
      'id' => $item['id'],
      'id_group' => $item['id_group'],
      'id_payment_method' => $item['id_payment_method'],
      'group' => $item['group'],
      'color' => $item['color'],
      'id_category' => $item['id_category'],
      'id_supplier' => $item['id_supplier'],
      'id_customer' => $item['id_customer'],
      'id_schedule_event' => $item['id_schedule_event'],
      'title' => $item['title'],
      'description' => $item['description'],
      'value' => $item['value'],
      'date' => $item['date'],
      'total_installments' => $item['total_installments'],
      'installment' => $item['installment'],
      'repeat_day' => $item['repeat_day'],
      'is_confirmed' => $item['is_confirmed']
    );
    return $info;
  }







  // Details
  static function editDetails($id, $categoryID, $paymentMethod, $customerID, $title, $description, $value, $date, $repeatDay, $isConfirmed = 0, $supplierID = 0) {
    $database = new Database();

    $value = Helper::brlMoneyToDecimal($value);
    $date = Dates::databaseDateFormat($date);
    $supplierID = Helper::safeInt($supplierID);

    $query = "UPDATE finances SET id_category='".$categoryID."', id_supplier='".$supplierID."', id_payment_method='".$paymentMethod."', id_customer='".$customerID."', title='".$title."',
    description='".$description."', `value`='".$value."', `date`='".$date."', repeat_day='".$repeatDay."', is_confirmed='".$isConfirmed."' WHERE id='".$id."' LIMIT 1;";
    $database->query($query);
    return true;
  }




  // Create
  function createNew($groupID, $paymentMethod, $categoryID, $title, $value, $date, $supplierID = 0) {
    $database = new Database();

    $value = Helper::brlMoneyToDecimal($value);
    $date = Dates::databaseDateFormat($date);

    $supplierID = Helper::safeInt($supplierID);

    $now = Dates::now();
    $query = "INSERT INTO finances (`id_group`, `id_payment_method`, `id_category`, `id_supplier`, `title`, `value`, `date`, `created_at`) VALUES ('".$groupID."', '".$paymentMethod."', '".$categoryID."', '".$supplierID."', '".$title."', '".$value."', '".$date."', '".$now."');";
    $database->query($query);
    $newID = $database->getLastInsertId();

    $this->message = "Registro Financeiro criado com sucesso!";
    return $newID;
  }


  function createNewIncomeWithInstallments($title, $value, $date, $totalInstallments, $eventID = 0) {
    // Trata os parâmetros
    $groupID = 2;// Grupo de Receita
    $categoryID = 8;// Categoria Padrão de Receita
    $paymentMethod = 7;// Método de pagamento de Crédito Parcelado
    $value = Helper::brlMoneyToDecimal($value);
    $installmentValue = $value/$totalInstallments; // Valor de cada Parcela
    $date = Dates::databaseDateFormat($date);


    $database = new Database();
    $now = Dates::now();

    // Cria registro parent
    $query = "INSERT INTO finances (`id_group`, `id_payment_method`, `id_category`, `id_schedule_event`, `title`, `value`, `date`, `total_installments`, `installment`, `created_at`)
    VALUES ('".$groupID."', '".$paymentMethod."', '".$categoryID."', '".$eventID."', '".$title."', '".$installmentValue."', '".$date."', '".$totalInstallments."', 1, '".$now."');";
    $database->query($query);
    $parentID = $database->getLastInsertId();

    $lastInstallmentDate = $date;
    for ($i=2; $i <= $totalInstallments; $i++) {
      // adiciona 30 dias à data da última parcela
      $newDate = Dates::addDaysToDate($lastInstallmentDate, 30);
      $lastInstallmentDate = $newDate;
      // pega o próximo dia útil da data
      $nextBusinessDay = Dates::nextBusinessDateFrom($newDate);

      $query = "INSERT INTO finances (`id_group`, `id_payment_method`, `id_category`, `id_schedule_event`, `title`, `value`, `date`, `id_parent`, `total_installments`, `installment`, `created_at`)
      VALUES ('".$groupID."', '".$paymentMethod."', '".$categoryID."', '".$eventID."', '".$title."', '".$installmentValue."', '".$nextBusinessDay."', '".$parentID."', '".$totalInstallments."', '".$i."', '".$now."');";
      $database->query($query);
    }
    $this->message = "Registros Financeiros criado com sucesso!";

    if ($eventID > 0) {
      // Altera status do pagamento no evento da agenda para CONFIRMADO
      $query = "UPDATE schedule_events SET payment_status=2 WHERE id='".$eventID."' LIMIT 1;";
      $database->query($query);
      $this->message = "Pagamento registrado com sucesso!";
    }

    return $parentID;
  }


  function registerScheduleEventPayment($eventID, $paymentMethod, $categoryID, $title, $value, $date) {
    $database = new Database();

    $value = Helper::brlMoneyToDecimal($value);
    $date = Dates::databaseDateFormat($date);
    $now = Dates::now();
    $groupID = 2;// Receita

    // Cria registro financeiro
    $query = "INSERT INTO finances (`id_group`, `id_payment_method`, `id_category`, `id_schedule_event`, `title`, `value`, `date`, `created_at`)
    VALUES ('".$groupID."', '".$paymentMethod."', '".$categoryID."', '".$eventID."', '".$title."', '".$value."', '".$date."', '".$now."');";
    $database->query($query);
    $newID = $database->getLastInsertId();

    // Altera status do pagamento no evento da agenda para CONFIRMADO
    $query = "UPDATE schedule_events SET payment_status=2 WHERE id='".$eventID."' LIMIT 1;";
    $database->query($query);

    $this->message = "Pagamento registrado com sucesso!";
    return $newID;
  }



  // Delete
  function delete($itemID) {
    if (Helper::safeInt($itemID) == 0) {
      return false;
    }
    $database = new Database();

    // verifica se o registro está vinculado a algum agendamento
    $query = "SELECT id_schedule_event, id_parent, total_installments FROM finances WHERE id='".$itemID."' LIMIT 1;";
    $items = $database->select($query);
    $item = $items[0];
    $scheduleEventID = Helper::safeInt($item['id_schedule_event']);
    $parentID = Helper::safeInt($item['id_parent']);
    $totalInstallments = Helper::safeInt($item['total_installments']);

    // Deleta o próprio registro
    $query = "DELETE FROM finances WHERE id='".$itemID."' LIMIT 1;";
    $database->query($query);


    // Deleta demais parcelas
    if ($totalInstallments > 0) {
      if ($parentID > 0) {
        // Deleta irmãos se tiver
        $query = "DELETE FROM finances WHERE id_parent='".$parentID."';";
        $database->query($query);
        // Deleta pai se tiver
        $query = "DELETE FROM finances WHERE id='".$parentID."';";
        $database->query($query);
      } else {
        // Deleta Filhos se tiver
        $query = "DELETE FROM finances WHERE id_parent='".$itemID."';";
        $database->query($query);
      }

    }


    // se foi o último registro deste evento, troca o status de pagamento para pendente
    if ($scheduleEventID > 0) {
      $query = "SELECT id FROM finances WHERE id_schedule_event='".$scheduleEventID."';";
      $items = $database->select($query);
      if (count($items) == 0) {
        $newScheduleEventPaymentStatus = 1;// pendente
        $query = "UPDATE schedule_events SET payment_status='".$newScheduleEventPaymentStatus."' WHERE id='".$scheduleEventID."' LIMIT 1;";
        $database->query($query);
      }
    }

    $this->message = "Registro Financeiro excluído com sucesso!";
    return true;
  }


}
