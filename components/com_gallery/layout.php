<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
if(!isset($objmem))
    $objmem=new CLS_MEMBER();
    include_once(LIB_PATH.'cls.albumgallery.php');
    $obj=new CLS_ALBUMGALLERY();
    $com=isset($_GET['com'])? $_GET['com']:'';
    $viewtype=isset($_GET['viewtype'])? addslashes($_GET['viewtype']):'list';
	$arr=array('list', 'block', 'seach', 'detail');
    include_once('tem/'.$viewtype.'.php');
    unset($viewtype); unset($com); unset($arr);unset($obj);
?>
