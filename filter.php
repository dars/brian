<?php
require_once('config.php');
$query = "SELECT id,name FROM property ORDER BY id DESC";
$res = $db->get_results($query);
$data=new stdClass();
$data->root = array();
foreach($res as $r){
	array_push($data->root,$r);
}
echo json_encode($data);