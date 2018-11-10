<h3 class="title-modal">Trial</h3><?php
session_start();
include_once('../../includes/gfconfig.php');
include_once('../../includes/gfinnit.php');
include_once('../../libs/cls.mysql.php');
$id=$_GET['box_id'];
$sql="SELECT `trial` FROM tbl_service WHERE id='$id'";
$objdata=new CLS_MYSQL();
$objdata->Query($sql);
$row=$objdata->Fetch_Assoc();
echo $row['trial'];
unset($objdata);
?>
