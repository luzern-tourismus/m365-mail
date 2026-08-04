<?php

require_once __DIR__ . "/../../config.php";

$mail = new \LuzernTourismus\M365Mail\Mail\MailSend();
$mail->subject = 'test mail';
$mail->from = '';
$mail->to = '';
$mail->text = 'hello world';

//$mail->addAttachment('');

$mail->send();

