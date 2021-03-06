<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('COMS','users');
// Begin Toolbar
require_once(LAG_PATH.'vi/lang_default.php');
require_once(libs_path.'cls.users.php');
require_once(libs_path.'cls.guser.php');

if(!isset($objlag)) $objlag=new LANG_DEFAULT;

$title_manager = 'Quản lý người dùng';
if(isset($_GET['task']) && $_GET['task']=='add')
	$title_manager = 'Thêm mới người dùng';
if(isset($_GET['task']) && $_GET['task']=='edit')
	$title_manager = 'Sửa thông tin người dùng';
if(isset($_GET['task']) && $_GET['task']=='changepass')
	$title_manager = 'Đổi mật khẩu';	

require_once('includes/toolbar.php');
// End toolbar
$obj_guser = new CLS_GUSER();
$obj = new CLS_USERS();
if(isset($_POST['cmdsave']) && !isset($_POST['txtnewpass'])){
	$obj->UserName=addslashes($_POST['txtusername']);
	$obj->FirstName=addslashes($_POST['txtfirstname']);
	$obj->LastName=addslashes($_POST['txtlastname']);
	$obj->Birthday=date('Y-m-d',strtotime($_POST['txtbirthday']));
	$obj->Gender=addslashes($_POST['optgender']);
	$obj->Address=addslashes($_POST['txtaddress']);
	$obj->Phone=addslashes($_POST['txtphone']);
	$obj->Mobile=addslashes($_POST['txtmobile']);
	$obj->Email=addslashes($_POST['txtemail']);
	$obj->Gmember=addslashes($_POST['cbo_gmember']);
	$obj->isActive=(int)$_POST['optactive'];
	if(isset($_POST['txtid'])){
		$obj->ID=(int)$_POST['txtid'];
		$obj->Update();
	}else{
		$obj->Password= addslashes($_POST['txtpassword']);
		$obj->Add_new();
	}
	echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
}
if(isset($_POST['txtaction'])){
	$ids=$_POST['txtids'];
	$ids=str_replace(",","','",$ids);
	switch ($_POST['txtaction']){
		case 'public': 		$obj->setActive($ids,1); 	break;
		case 'unpublic': 	$obj->setActive($ids,0); 	break;
		case 'edit': 	
			$id=explode("','",$ids);
			echo "<script language=\"javascript\">window.location='index.php?com=".COMS."&task=edit&id=".$id[0]."'</script>";
			exit();
			break;
		case 'delete': 		$obj->Delete($ids); 		break;
	}
	echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
}

define('THIS_COM_PATH',COM_PATH.'com_'.COMS.'/');
if(isset($_GET['task']))
	$task=$_GET['task'];
if(!is_file(THIS_COM_PATH.'task/'.$task.'.php'))
	$task='list';
include(THIS_COM_PATH.'task/'.$task.'.php'); 
unset($obj); unset($objlag);
?>