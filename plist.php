<?php
require_once('config.php');
$res = $db->get_results("SELECT * FROM property ORDER BY id DESC");
$total = $db->get_var("SELECT count(*) FROM property");
$data=new stdClass();
$data->totalProperty=$total;
$data->res=array();
if($total>0){
	foreach($res as $r){
		array_push($data->res,$r);
	}
}
echo json_encode($data);