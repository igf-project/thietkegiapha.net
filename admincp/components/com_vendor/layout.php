<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('COMS','vendor');
define('OBJ','Nhà cung cấp (hãng, nhà sản xuất)');
define('THIS_COM_PATH',COM_PATH.'com_'.COMS.'/');
// Begin Toolbar
require_once(libs_path.'cls.vendor.php');
include_once(EXT_PATH.'cls.upload.php');
$obj=new CLS_VENDOR();
$objUpload=new CLS_UPLOAD();
$title_manager="Danh sách ".OBJ;
if(isset($_GET['task']) && $_GET['task']=='add')
	$title_manager = "Thêm mới ".OBJ;
if(isset($_GET['task']) && $_GET['task']=='edit')
	$title_manager = "Sửa ".OBJ;
	
require_once("includes/toolbar.php");
// End toolbar
if(isset($_POST["cmdsave"])){	
	$obj->Par_ID=(int)$_POST['cbo_group'];	
	$obj->Name= addslashes($_POST['txt_name']);
	$obj->Code= un_unicode(addslashes($_POST['txt_name']));
	$obj->Intro= addslashes($_POST['txtintro']);
	$obj->Address= addslashes($_POST['txt_address']);
	$obj->Phone= addslashes($_POST['txt_phone']);
	$obj->Fax= addslashes($_POST['txt_fax']);
	$obj->Website= addslashes($_POST['txt_website']);
	$obj->Email= addslashes($_POST['txt_email']);
	$obj->Author= $_SESSION[MD5($_SERVER['HTTP_HOST']).'_USERID'];
	$obj->isActive= (int)$_POST['opt_isactive'];
    if(isset($_POST["txtthumb"]))
        $obj->Logo=addslashes($_POST["txtthumb"]);

    if(isset($_POST['txtid'])){
		$obj->ID=$_POST['txtid'];
		$obj->Update();
	}else{
		$obj->Add_new();
	}
	echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
}
if(isset($_POST["txtaction"]) && $_POST["txtaction"]!=""){
	$ids=$_POST["txtids"];
	$ids=str_replace(",","','",$ids);
	switch ($_POST["txtaction"]){
		case "public": 		$obj->setActive($ids,1); 		break;
		case "unpublic": 	$obj->setActive($ids,0); 		break;
		case "edit": 	
			$id=explode("','",$ids);
			echo "<script language=\"javascript\">window.location='index.php?com=".COMS."&task=edit&id=".$id[0]."'</script>";
			exit();
			break;
		case "order"	: include(THIS_COM_PATH."task/order.php"); break;
		case "delete": 		$obj->Delete($ids); 		break;
	}
	echo "<script language=\"javascript\">window.location.href='index.php?com=".COMS."'</script>";
}
if(isset($_GET['task']))
	$task=$_GET['task'];
if(!is_file(THIS_COM_PATH.'task/'.$task.'.php')){
	$task='list';
}
include_once(THIS_COM_PATH.'task/'.$task.'.php');
unset($obj); unset($task);	unset($objlang); unset($ids);
?>