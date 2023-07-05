<?php
/*
Run every minute
/usr/local/bin/php /home/viantico/public_html/cron_tasks/_send_email_queue.php
*/

require_once __DIR__ . '/../source/autoload.php';

use \Source\Support\Mailer;


Mailer::sendEmailQueue();
// Mailer::sendEmailFromDefaultPHP('developer.roberto@icloud.com', 'Bem vindo ao Painel', 'chegou certo? 11:40');
exit;


 ?>
