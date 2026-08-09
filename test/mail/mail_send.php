<?php

require_once __DIR__ . "/../../config.php";

$filename = 'C:\test\icon.jpg';
$contentId = 'logo';

$html = new \Nemundo\Html\Document\HtmlDocument();
$body = new \Nemundo\Html\Document\Body($html);

$p = new \Nemundo\Html\Paragraph\Paragraph($body);
$p->content = 'Hallo';

$img = new \Nemundo\Html\Image\Img($body);
$img->src = 'cid:' . $contentId;


$mail = new \LuzernTourismus\M365Mail\Mail\MailSend();
$mail->subject = 'test mail';
$mail->from = '';
$mail->to ='';
$mail->text = $html->getHtml();

$mail->addInlineImage($filename, $contentId);

//$mail->addAttachment('');

$mail->send();

