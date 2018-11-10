<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('COMS','product');
define('OBJ','Sản phẩm');
define('THIS_COM_PATH',COM_PATH.'com_'.COMS.'/');
// Begin Toolbar
require_once(libs_path.'cls.catalogs.php');
require_once(libs_path.'cls.product.php');
include_once(EXT_PATH.'cls.upload.php');
$obj_cata=new CLS_CATALOGS();
$obj=new CLS_PRODUCT();
$objUpload=new CLS_UPLOAD();
$title_manager="Danh sách ".OBJ;
if(isset($_GET['task']) && $_GET['task']=='add')
	$title_manager = "Thêm mới ".OBJ;
if(isset($_GET['task']) && $_GET['task']=='edit')
	$title_manager = "Sửa ".OBJ;
	
require_once("includes/toolbar.php");
// End toolbar
if(isset($_POST["cmdsave"])){
	$obj->Cata_ID=(int)$_POST['cbo_group'];
	$obj->Name= addslashes($_POST['txt_name']);
	$obj->Pro_Code= addslashes($_POST['txt_pro_code']);
	$obj->Code= un_unicode(addslashes($_POST['txt_name']));
	$obj->Old_price = (int)$_POST['txt_oldprice'];
	$obj->Cur_price = isset($_POST['txt_curprice']) ? (int)$_POST['txt_curprice'] : '';
	$obj->Intro=addslashes($_POST['txtintro']);
	$obj->Fulltext=	addslashes($_POST['txtfulltext']);
	$obj->Quantity=	(int)$_POST['txt_quantity'];
    $date=date('Y-m-d H:i:s');
    /*upload thumb*/
    if(isset($_POST["txtthumb"]))
        $obj->Thumb=addslashes($_POST["txtthumb"]);

    if(isset($_POST['txtid'])){
        $obj->ID=(int)$_POST['txtid'];
        $obj->Mdate=$date;
        $obj->isHot=(int)$_POST['opt_ishot'];
		$obj->ID=$_POST['txtid'];
		$obj->Update();
	}else{
        $obj->isHot=(int)$_POST['opt_ishot'];
        $obj->isActive=(int)$_POST['opt_active'];
        $obj->Cdate=$date;
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
unset($obj); unset($task);	unset($objUpload); unset($ids);
?>