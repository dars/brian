<?php
require_once('config.php');
require_once('class/ThumbLib.inc.php');
$option = array('jpegQuality'=>80);
$head_img='';
$file_name='';
if(!empty($_FILES['img']['tmp_name'])){
	$thumb = PhpThumbFactory::create($_FILES['img']['tmp_name'],$option);
	$thumb->resize(1024,0);
	$file_width = $thumb->getMaxWidth();
	$file_name = date('YmdHis').rand(11,99).".".strtolower($thumb->getFormat());
	$thumb->save('files/images/'.$file_name);
}
if($_POST['id'] != ''){
	$query="UPDATE property SET ";
	if(strlen($file_name)>0){
		$query.=" img='".$file_name."',";
	}
	$query.=" name='".$db->escape($_POST['name'])."',";
	$query.=" keyword='".$db->escape($_POST['keyword'])."',";
	$query.=" description='".$db->escape($_POST['description'])."',";
	$query.=" email='".$db->escape($_POST['email'])."'";
	$query.=" WHERE id=".$db->escape($_POST['id']);
	$db->query($query);
	echo '{success:true}';
}else{
	$query="INSERT INTO property(name,img,keyword,description,email)VALUES(";
	$query.="'".$db->escape($_REQUEST['name'])."',";
	$query.="'".$file_name."',";
	$query.="'".$db->escape($_REQUEST['keyword'])."',";
	$query.="'".$db->escape($_REQUEST['description'])."',";
	$query.="'".$db->escape($_REQUEST['email'])."')";
	$db->query($query);
	echo '{success:true}';
}