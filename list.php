<?php
require_once "config.php";
/* 取得資料 */
if(!empty($_REQUEST['limit'])){
	$sort="id";
	$dir="DESC";
	$type=1;
	if(!empty($_REQUEST['sort'])){
		$sort=$_REQUEST['sort'];
	}
	if(!empty($_REQUEST['dir'])){
		$dir=$_REQUEST['dir'];
	}
	$query = "SELECT a.*,b.name as pname FROM contact as a LEFT JOIN property as b ON a.property_id=b.id";
	if(!empty($_POST['property_id'])){
		$query.=" WHERE property_id = ".$_POST['property_id'];
	}
	$query.=" ORDER BY a.".$sort." ".$dir." LIMIT ".$_REQUEST['start'].",".$_REQUEST['limit'];
	$res=$db->get_results($query);
	$total=$db->get_var("SELECT count(*) FROM contact");
	$data=new stdClass();
	$data->totalProperty=$total;
	$data->res=array();
	if($total>0){
		foreach($res as $r){
			array_push($data->res,$r);
		}
	}
	echo json_encode($data);
}