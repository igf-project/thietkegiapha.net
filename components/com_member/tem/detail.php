abcc<?php
defined('ISHOME') or die('Can not access this page, please come back!');
if(isset($_GET['code'])){
    $code=addslashes($_GET['code']);
}
else{
    redirect404();
}
/*$sql="SELECT `tbl_tutorial`.`id`, `tbl_tutorial`.`name`, `tbl_tutorial`.`code`, `tbl_tutorial`.`sub_id`,`tbl_tutorial`.`intro`,`tbl_tutorial`.`fulltext`,`tbl_tutorial`.`thumb`, `tbl_subject`.`name` as `sub_name`
    FROM `tbl_tutorial`
    LEFT JOIN `tbl_subject` ON `tbl_subject`.`id`=`tbl_tutorial`.`sub_id` WHERE `tbl_tutorial`.`code`='$code'";
$objdata=new CLS_MYSQL();
$objdata->Query($sql);
$rows=$objdata->Fetch_Assoc();
$id=$rows['id'];
$name=$rows['name'];
$sub_id=$rows['sub_id'];*/
?>
<div class="page-content">
    <div class='container'>
        <div class='path'>Trang chủ » <?php echo $rows['sub_name'];?> » <?php echo $name;?></div>
        <div class="row">
            <div class="col-md-8 column-item">
                <div class="detail-content list-group-item">
                   <!-- <h3><?php /*echo $rows['name'];*/?></h3>
                    <?php /*echo getThumb($rows['thumb'], 'img-responsive img-thumb');*/?>
                    <p class="intro">
                        <?php /*echo $rows['intro'];*/?>
                    </p>
                    <span class="txt-fulltext">
                        <?php /*echo $rows['fulltext'];*/?>
                    </span>-->
                   Chức năng đang được xây dựng!
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-4 column-item col-right">
                <?php include_once(MOD_PATH.'mod_tutorial/layout.php');?>
                <div class="box-item">
                    <h2 class="title">Bài viết liên quan</h2>
                    <?php
                    $strWhere="WHERE sub_id='$sub_id'";
                    $obj->getListItemStyle($strWhere,"Limit 0,5");
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

