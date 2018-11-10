<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('COMS','customer');
define('OBJ','Khách hàng');
define('THIS_COM_PATH',COM_PATH.'com_'.COMS.'/');
// Begin Toolbar
require_once(libs_path.'cls.customer.php');
$obj=new CLS_CUSTOMER();
$title_manager="Danh sách ".OBJ;
if(isset($_GET['task']) && $_GET['task']=='add')
	$title_manager = "Thêm mới ".OBJ;
if(isset($_GET['task']) && $_GET['task']=='edit')
	$title_manager = "Sửa ".OBJ;

if(isset($_POST["cmdsave"])){
	$obj->Name= addslashes($_POST['txt_name']);
	$obj->Phone= addslashes($_POST['txt_phone']);
	$obj->Email= addslashes($_POST['txt_email']);
    $date=date('Y-m-d H:i:s');
    $obj->Cdate=$date;
    if(isset($_POST['txtid'])){
		$obj->ID=$_POST['txtid'];
		$obj->Update();
	}else{
		$obj->Add_new();
	}
	echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
}
//SEND MAIL
if(isset($_POST["txtaction"]) && $_POST["txtaction"]!=""){
	$_SESSION['customer_mail']=$_POST["txtids"];
	echo "<script language=\"javascript\">window.location='index.php?com=".COMS."&task=send_mail'</script>";
	
}
$task=isset($_GET['task'])? addslashes($_GET['task']):'list';
include_once(THIS_COM_PATH.'task/'.$task.'.php');
unset($obj); unset($task);	unset($objlang); unset($ids);
?>