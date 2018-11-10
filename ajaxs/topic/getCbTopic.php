<?php
session_start();
include_once('../../includes/gfinnit.php');
include_once('../../includes/gfconfig.php');
include_once('../../includes/gffunction.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.member.php');
include_once('../../libs/cls.topic.php');
include_once('../../libs/cls.software.php');
if(!isset($objmem))
    $objmem=new CLS_MEMBER();
if($objmem->isLogin()){
    if(isset($_GET['val'])){
        $val=(int)$_GET['val'];
    }
?>
<div class='form-group'>
    <label class="col-sm-3 control-label"><strong>Thuộc Topic</strong></label>
    <div class="col-sm-9">
        <select name="cbo_topic" id="cbo_topic" class="clearfix form-control">
            <?php
            $objCbTopic=new CLS_TOPIC();
            $objCbTopic->getListCbItem("WHERE `tbl_topic`.`sub_id`='$val'");
            ?>
        </select>
    </div>
    <div class="clearfix"></div>
</div>
<div class='form-group'>
    <label class="col-sm-3 control-label"><strong>Phần mềm sử dụng</strong></label>
    <div class="col-sm-9">
        <select name="cbo_software" id="cbo_software" class="clearfix form-control">
            <?php
            $objSof=new CLS_SOFTWARE();
            $objSof->getListCbItem("WHERE `tbl_software`.`sub_id`='$val'");
            ?>
        </select>
    </div>
    <div class="clearfix"></div>
</div>
<?php
    unset($objCbTopic);
    unset($objSof);
    unset($val);
    unset($objmem);
}

?>