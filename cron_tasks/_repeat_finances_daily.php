<?php
/*
Run every hour
/usr/local/bin/php /home/viantico/public_html/cron_tasks/_repeat_finances_daily.php
*/

require_once __DIR__ . '/../source/autoload.php';

use \Source\Core\Database;
use \Source\Core\Dates;
use \Source\Core\Helper;


$today = Dates::now();
$yesterday = date('Y-m-d', strtotime($today. ' -1 day'));
$yesterdayMonthFirstDay = date('Y-m-01', strtotime($yesterday));
$yesterdayMonthLastDay = date('Y-m-t', strtotime($yesterday));
$yesterdayDay = date('d', strtotime($yesterday));
$nextDate = date('Y-m-d', strtotime($yesterday. ' +1 month'));

$database = new Database();
$query = "SELECT a.id, a.id_group, a.id_category, a.id_supplier, a.id_payment_method, a.title, a.description, a.value, a.date, a.repeat_day, a.id_parent FROM finances a
WHERE a.id_group = 1 AND a.repeat_day='".$yesterdayDay."' AND a.date >= '".$yesterdayMonthFirstDay."' AND a.date <= '".$yesterdayMonthLastDay."';";
$items = $database->select($query);


foreach ($items as $key => $item) {
  $idParent = Helper::safeInt($item['id_parent']);
  if ($idParent == 0) {
    $idParent = Helper::safeInt($item['id']); // this is the first so it is the parent for next
  }

  $idGroup = Helper::safeInt($item['id_group']);
  $idCategory = Helper::safeInt($item['id_category']);
  $supplierID = Helper::safeInt($item['id_supplier']);
  $idPaymentMethod = Helper::safeInt($item['id_payment_method']);
  $title = Helper::safeString($item['title']);
  $description = Helper::safeString($item['description']);
  $value = $item['value'];
  $repeatDay = Helper::safeInt($item['repeat_day']);
  $isConfirmed = 0;

  $query = "INSERT INTO finances (id_group, id_category, id_supplier, id_payment_method, title, description, value, `date`, repeat_day, id_parent, is_confirmed)
  VALUES ('".$idGroup."', '".$idCategory."', '".$supplierID."', '".$idPaymentMethod."', '".$title."', '".$description."', '".$value."', '".$nextDate."', '".$repeatDay."', '".$idParent."', '".$isConfirmed."');";
  $database->query($query);
}

exit;




 ?>
