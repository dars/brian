<?php
require_once "class/class.phpmailer.php";
$mail=new phpmailer();

$mail->Host="mail.number-media.com.tw";					// smtp host
$mail->CharSet="big5";
$mail->Username="service";							// 帳號
$mail->Password="25060603";						// 密碼
$mail->From="service@number-media.com.tw";					// 發信mail
$mail->FromName="System Administrator";						// 發信人
$mail->Subject=iconv('utf8','big5',"新增預約表單");	// 標題
$mail->Body=iconv('utf8','big5','測試信件~');
$mail->IsHTML("true");
$mail->AddAddress('dars94@gmail.com');
$mail->Send();