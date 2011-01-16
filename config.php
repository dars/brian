<?php
session_start();
include_once "ez_sql/ez_sql_core.php";
include_once "ez_sql/ez_sql_mysql.php";
$db = new ezSQL_mysql('root','root','brian','localhost');
$db->query("SET CHARACTER SET utf8");
?>