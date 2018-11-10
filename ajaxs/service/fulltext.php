dfdfd<?php
session_start();
include_once('../../includes/gfconfig.php');
include_once('../../includes/gfinnit.php');
include_once('../../libs/cls.mysql.php');
$id=$_GET['box_id'];
$sql="SELECT fulltext FROM tbl_service WHERE id='$id'";
echo $sql;
$objdata=new CLS_MYSQL();
$objdata->Query($sql);
$row=$objdata->Fetch_Assoc();
echo $row['fulltext'];
unset($objdata);
?>
