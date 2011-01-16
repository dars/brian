<?php
date_default_timezone_set("Asia/Taipei");
require_once "class/class.phpmailer.php";
require_once "config.php";
header('Content-Type:text/html;charset=utf-8');
header('pragma:no-cache');
header('Cache-Control:no-cache');
function insert($table, $data) {
	global $db;
	$fields = array_keys($data);
	//echo "INSERT INTO $table (`" . implode('`,`',$fields) . "`) VALUES ('".implode("','",$data)."')";
	//exit();
	return $db->query("INSERT INTO $table (`" . implode('`,`',$fields) . "`) VALUES ('".implode("','",$data)."')");
}
if(!empty($_POST['name'])){
	$arData=array();
	$arData['property_id'] = $db->escape($_POST['property_id']);
	$arData['budget1'] = $db->escape($_POST['budget1']);
	$arData['budget2'] = $db->escape($_POST['budget2']);
	$arData['name'] = $db->escape($_POST['name']);
	$arData['ping1'] = $db->escape($_POST['ping1']);
	$arData['ping2'] = $db->escape($_POST['ping2']);
	$arData['tel'] = $db->escape($_POST['tel']);
	$arData['rooms1'] = $db->escape($_POST['rooms1']);
	$arData['rooms2'] = $db->escape($_POST['rooms2']);
	$arData['email'] = $db->escape($_POST['email']);
	$arData['car'] = $db->escape($_POST['car']);
	$arData['city'] = $db->escape($_POST['city']);
	$arData['plan'] = $db->escape($_POST['plan']);
	$arData['year'] = $db->escape($_POST['year']);
	$arData['month'] = $db->escape($_POST['month']);
	$arData['day'] = $db->escape($_POST['day']);
	$arData['time'] = $db->escape($_POST['time']);
	$arData['uses'] = $db->escape($_POST['uses']);
	$arData['other'] = $db->escape($_POST['other']);
	$arData['content'] = $db->escape($_POST['content']);
	$arData['created'] = date('Y-m-d H:i:s');
	insert('contact',$arData);
	echo "預約看屋資料送出完成";
	/* send mail*/
	$res = $db->get_row("SELECT * FROM property WHERE id=".$_POST['property_id']);
	
	$mail=new phpmailer();
	$mail->Host="mail.number-media.com.tw";					// smtp host
	$mail->CharSet="big5";
	$mail->Username="service";							// 帳號
	$mail->Password="25060603";						// 密碼
	$mail->From="service@number-media.com.tw";					// 發信mail
	$mail->FromName="System Administrator";						// 發信人
	$mail->IsHTML("true");
	$mail->Subject=iconv('utf8','big5',$res->name." - 新增預約表單");	// 標題
	$mail_body="
	<table>
		<tr>
			<th>購屋預算</th>
			<td>".$db->escape($_POST['budget1'])."萬~".$db->escape($_POST['budget2'])."萬</td>
			<th>真實姓名</th>
			<td>".$db->escape($_POST['name'])."</td>
		</tr>
		<tr>
			<th>需求坪數</th>
			<td>".$db->escape($_POST['ping1'])."坪~".$db->escape($_POST['ping2'])."坪</td>
			<th>聯絡電話</th>
			<td>".$db->escape($_POST['tel'])."</td>
		</tr>
		<tr>
			<th>需求房間數</th>
			<td>".$db->escape($_POST['rooms1'])."房~".$db->escape($_POST['rooms2'])."房</td>
			<th>E-mail</th>
			<td>".$db->escape($_POST['email'])."</td>
		</tr>
		<tr>
			<th>車位需求</th>
			<td>".trans_car($db->escape($_POST['car']))."</td>
			<th>所在縣市</th>
			<td>".trans_city($db->escape($_POST['city']))."</td>
		</tr>
		<tr>
			<th>預購屋時間</th>
			<td colspan=3>".trans_plan($db->escape($_POST['plan']))."</td>
		</tr>
		<tr>
			<th>希望看屋時間</th>
			<td colspan=3>".$db->escape($_POST['year'])."/".$db->escape($_POST['month'])."/".$db->escape($_POST['day'])." ".$db->escape($_POST['time'])."</td>
		</tr>
		<tr>
			<th>購屋用途</th>
			<td colspan=3>".trans_uses($db->escape($_POST['uses']))."</td>
		</tr>
		<tr>
			<th colspan=4>您的其他需求或意見</th>
		</tr>
		<tr>
			<td colspan=4>".nl2br($db->escape($_POST['content']))."</td>
		</tr>
	</table>
";
	$mail->Body=iconv('utf8','big5',$mail_body);
	$mail->IsHTML("true");
	$mail->AddAddress($res->email);
	$mail->Send();
}
function trans_car($num){
	if($num == 1){
		return "有";
	}else{
		return "無";
	}
}
function trans_plan($num){
	switch($num){
		case 1:
			return "急需";
			break;
		case 2:
			return "三個月至半年";
			break;
		case 3:
			return "半年至一年";
			break;
		case 4:
			return "一年以上";
			break;
	}
}
function trans_uses($num){
	switch($num){
		case 1:
			return "首次購屋";
			break;
		case 2:
			return "換屋";
			break;
		case 3:
			return "投資置產";
			break;
		case 4:
			return "工作變更";
			break;
		case 5:
			return "轉換環境";
			break;
		case 6:
			return "新婚成家";
			break;
		case 7:
			return "租約到期";
			break;
		case 8:
			return "子女求學";
			break;
		case 9:
			return "其他 ";
			break;
	}
}
function trans_city($num){
	switch($num){
		case 1:
			return "基隆市";
			break;
		case 2:
			return "台北市";
			break;
		case 3:
			return "台北縣";
			break;
		case 4:
			return "宜蘭縣";
			break;
		case 5:
			return "桃園縣";
			break;
		case 6:
			return "新竹縣";
			break;
		case 7:
			return "新竹市";
			break;
		case 8:
			return "苗栗縣";
			break;
		case 9:
			return "台中市";
			break;
		case 10:
			return "台中縣";
			break;
		case 11:
			return "彰化縣";
			break;
		case 12:
			return "南投縣";
			break;
		case 13:
			return "雲林縣";
			break;
		case 14:
			return "嘉義市";
			break;
		case 15:
			return "台南市";
			break;
		case 16:
			return "台南縣";
			break;
		case 17:
			return "高雄市";
			break;
		case 18:
			return "高雄縣";
			break;
		case 19:
			return "屏東縣";
			break;
		case 20:
			return "花蓮縣";
			break;
		case 21:
			return "台東縣";
			break;
		case 22:
			return "澎湖縣";
			break;
		case 23:
			return "金門縣";
			break;
		case 24:
			return "連江縣";
			break;
	}
}