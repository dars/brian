<?php
if(!empty($_GET['file'])){
	header('Content-Type: application/force-download');
	header('Content-disposition: attachment; filename="'.basename($_GET['file']).'"');
	readfile("files/excel/".$_GET['file']);
	exit();
}
require_once "config.php";
require_once "class/PHPExcel.php";
require_once "class/PHPExcel/IOFactory.php";
$foo='';
if(!empty($_POST['foo'])){
	$foo = $_POST['foo'];
}
$query="SELECT a.*,b.name as pname FROM contact as a LEFT JOIN property as b ON a.property_id = b.id";
if(!empty($foo)){
	$query.=" WHERE a.property_id=".$foo;
}
$res = $db->get_results($query);
$xls=new PHPExcel();
$xlsd=new PHPExcel_Worksheet_Drawing();
$xls->getProperties()->setCreator("索取資料、預約看屋清單");
$xls->setActiveSheetIndex(0);
$xls->getActiveSheet()->setCellValue('A1','ID');
$xls->getActiveSheet()->setCellValue('B1','建案名稱');
$xls->getActiveSheet()->setCellValue('C1','預算');
$xls->getActiveSheet()->setCellValue('D1','坪數');
$xls->getActiveSheet()->setCellValue('E1','房數');
$xls->getActiveSheet()->setCellValue('F1','聯絡姓名');
$xls->getActiveSheet()->setCellValue('G1','聯絡電話');
$xls->getActiveSheet()->setCellValue('H1','聯絡email');
$xls->getActiveSheet()->setCellValue('I1','所在縣市');
$xls->getActiveSheet()->setCellValue('J1','車位');
$xls->getActiveSheet()->setCellValue('K1','購屋時間');
$xls->getActiveSheet()->setCellValue('L1','看屋時間');
$xls->getActiveSheet()->setCellValue('M1','用途');
$xls->getActiveSheet()->setCellValue('N1','建立日期');
$xls->getActiveSheet()->setCellValue('O1','備註');
$num=2;
foreach($res as $r){
	$xls->getActiveSheet()->setCellValue('A'.$num,$r->id);
	$xls->getActiveSheet()->setCellValue('B'.$num,$r->pname);
	$xls->getActiveSheet()->setCellValue('C'.$num,$r->budget1.'萬~'.$r->budget2.'萬');
	$xls->getActiveSheet()->setCellValue('D'.$num,$r->ping1.'坪~'.$r->ping2.'坪');
	$xls->getActiveSheet()->setCellValue('E'.$num,$r->rooms1.'房~'.$r->rooms2.'房');
	$xls->getActiveSheet()->setCellValue('F'.$num,$r->name);
	$xls->getActiveSheet()->setCellValue('G'.$num,$r->tel);
	$xls->getActiveSheet()->setCellValue('H'.$num,$r->email);
	$xls->getActiveSheet()->setCellValue('I'.$num,cityRender($r->city));
	if($r->car == 1){
		$car='有';
	}else{
		$car='無';
	}
	$xls->getActiveSheet()->setCellValue('J'.$num,$car);
	$xls->getActiveSheet()->setCellValue('K'.$num,planRender($r->plan));
	$xls->getActiveSheet()->setCellValue('L'.$num,$r->year."/".$r->month."/".$r->day." ".$r->time);
	$xls->getActiveSheet()->setCellValue('M'.$num,usesRender($r->uses,$r->other));
	$xls->getActiveSheet()->setCellValue('N'.$num,$r->created);
	$xls->getActiveSheet()->setCellValue('O'.$num,$r->content);
	$num++;
}
$tmp_name=date('Ymd');
$xls->getActiveSheet()->setTitle($tmp_name);
$xls->setActiveSheetIndex(0);

$xlsw= PHPExcel_IOFactory::createWriter($xls, 'Excel5');
$fname=date('YmdHis').".xls";
$xlsw->save("files/excel/".$fname);
echo $fname;

function planRender($value){
	if($value == 1){
		return "急需";
	}else if($value == 2){
		return "三個月至半年";
	}else if($value == 3){
		return "半年至一年";
	}else if($value == 4){
		return "一年以上";
	}
}
function usesRender($value,$other){
	if($value == 1){
		return "首次購屋";
	}else if($value == 2){
		return "換屋";
	}else if($value == 3){
		return "投資置產";
	}else if($value == 4){
		return "工作變更";
	}else if($value == 5){
		return "轉換環境";
	}else if($value == 6){
		return "新婚成家";
	}else if($value == 7){
		return "租約到期";
	}else if($value == 8){
		return "子女求學";
	}else if($value == 9){
		return $other;
	}
}
function cityRender($value){
	switch($value){
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


exit();
