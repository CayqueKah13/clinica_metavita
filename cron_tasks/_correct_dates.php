<?php
/*
Run every hour
/usr/local/bin/php /home/viantico/public_html/cron_tasks/_correct_dates.php
*/

require_once __DIR__ . '/../source/autoload.php';

use \Source\Core\Database;
use \Source\Core\Dates;




$tables = array(
  '_changes_admins',
  '_changes_admins_x_permissions',
);


function update($table) {
  $database = new Database();
  $query = "SELECT changed_at FROM ".$table." WHERE date_correct IS NULL;";
  $items = $database->select($query);
  foreach ($items as $key => $value) {
    $date = $value['changed_at'];
    $newDate = Dates::correctDateFrom($date);
    $query = "UPDATE ".$table." SET date_correct=1, changed_at='".$newDate."' WHERE changed_at='".$date."';";
    $database->query($query);
  }
}

foreach ($tables as $key => $table) {
  update($table);
}

exit;

 ?>
