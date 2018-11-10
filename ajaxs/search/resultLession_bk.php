<?php
include_once('../../includes/gfinnit.php');
include_once('../../includes/gfconfig.php');
include_once('../../includes/gffunction.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.lessionpart.php');
$obj=new CLS_LESSIONPART();
$keyword=isset($_GET['txt']) ? $_GET['txt']:'';
$strWhere='';
$link=$_GET['link'];
$strWhere.="WHERE `tbl_lession`.`title` like '%$keyword%'";
if(isset($_GET['txt']) AND $_GET['txt']==''){
    $strWhere=$_GET['strWhere'];
    $obj->getListItem($strWhere);
}
echo '<ul>';
$obj->getLession($strWhere);
echo '</ul>';
unset($obj);
?>