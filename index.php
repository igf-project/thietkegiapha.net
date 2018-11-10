<?php
ob_start();
session_start();
$ips=array('1.55.101.232', '42.113.156.73');
/*if(!in_array($_SERVER['REMOTE_ADDR'],$ips)){
    die("The system upgrade. Please come back later.");
}*/
define('ext_path','extensions/');
define('incl_path','includes/');
define('libs_path','libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinnit.php');
require_once(incl_path.'gffunction.php');
// include libs
require_once(libs_path.'cls.mysql.php');
require_once(libs_path.'cls.template.php');
require_once(libs_path.'cls.menuitem.php');
require_once(libs_path.'cls.content.php');
require_once(libs_path.'cls.category.php');
require_once(libs_path.'cls.module.php');
require_once(libs_path.'cls.configsite.php');
require_once(libs_path.'cls.member.php');
require_once(libs_path.'cls.albumgallery.php');

$tmp=new CLS_TEMPLATE();
$tmp_name=$tmp->Load_defaul_tem();
$this_tem_path=TEM_PATH.$tmp_name.'/';
define('ISHOME',true);
define('THIS_TEM_PATH',$this_tem_path);
$tmp->WapperTem();
?>