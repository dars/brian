<?php
require_once('config.php');
$db->query("DELETE FROM property WHERE id=".$_POST['id']);
$db->query("DELETE FROM contact WHERE property_id=".$_POST['id']);
echo '{success:true}';