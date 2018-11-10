<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
if(!isset($objmem))
    $objmem=new CLS_MEMBER();
define('COMS', 'recruitment');
define('TITLE', 'Tuyển dụng');
    $com=isset($_GET['com'])? $_GET['com']:'';
    $viewtype=isset($_GET['viewtype'])? addslashes($_GET['viewtype']):'list';
	$arr=array('list', 'block', 'seach', 'detail');
	if($com!=COMS OR in_array($viewtype, $arr)==false OR !is_file(COM_PATH.'com_'.$com.'/tem/'.$viewtype.'.php')){ //Check
        die('PAGE NOT FOUND!');
    }
    include_once(LIB_PATH.'cls.recruitment.php');
	include_once(EXT_PATH.'cls.upload.php');
    $obj=new CLS_RECRUITMENT();
    include_once('tem/'.$viewtype.'.php');

    unset($viewtype); unset($com); unset($arr);unset($obj);
?>

