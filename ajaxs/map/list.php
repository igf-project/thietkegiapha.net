<?php
include_once('../../includes/gfinnit.php');
include_once('../../includes/gfconfig.php');
include_once('../../includes/gffunction.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.showroom.php');

if(isset($_GET['val'])){
    $objRoom=new CLS_SHOWROOM();
    $value=(int)$_GET['val'];
	//$value=28;
    $objRoom->getMap($value);
}
?>
