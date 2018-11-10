<?php
include_once('../../includes/gfinnit.php');
include_once('../../includes/gfconfig.php');
include_once('../../includes/gffunction.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.lessionpart.php');
$obj=new CLS_LESSIONPART();
$keyword=isset($_GET['txt']) ? $_GET['txt']:'';
$course_id=isset($_GET['course_id']) ? $_GET['course_id']:'';
$strWhere="WHERE `tbl_lession_part`.`cour_id`='$course_id'";
if(isset($_GET['txt']) AND $_GET['txt']==''){
    $obj->getListItem($strWhere);
}
else{
    echo '<ul>';
    $obj->getLession("WHERE course_id='$course_id' AND `tbl_lession`.`title` like '%$keyword%'");
    echo '</ul>';
}

unset($obj);
?>