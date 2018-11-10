<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$objCon=new CLS_CONTENTS();
include_once(LIB_PATH.'cls.showroom.php');
$objRoom=new CLS_SHOWROOM();
?>
<div class="box-about">
    <div class="container">
        <?php
        $objCon->getList("WHERE id='1'");
        while($rows=$objCon->Fetch_Assoc()){
            $img=getThumbNews($rows['thumb'],'img-responsive');
            $url=ROOTHOST."tin-tuc/".$rows['code'].".html";
            ?>
        <div class="row"><div class="col-md-1"></div>
            <div class="col-md-4 col-sm-5 hidden-xs col-thumb">
                <?php echo $img;?>
            </div>
            <div class="col-md-7 col-sm-7">
                <h3 class="title-main">
                    <?php echo $rows['title'];?>
                </h3>
                <div class="txt"><?php echo html_entity_decode(Substring($rows['intro'], 0, 170));?></div>
                <div class="box-btn">
                    <a href="<?php echo $url;?>" class="btn btn-frm">Đọc thêm</a>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
</div>

<div class="box box-user-about">
    <div class="container">
        <?php
        $objCon->getList("WHERE id='2'");
        while($rows=$objCon->Fetch_Assoc()){
        $img=getThumbNews($rows['thumb'],'img-responsive');
            $url=ROOTHOST."tin-tuc/".$rows['code'].".html";
        ?>
        <div class="row"><div class="col-md-1"></div>
            <div class="col-md-7 col-sm-7">
                <h3 class="title-main">
                    <?php echo $rows['title'];?>
                </h3>
                <div class="txt"><?php echo html_entity_decode(Substring($rows['intro'], 0, 140));?></div>
                <div class="box-btn">
                    <a href="<?php echo $url;?>" class="btn btn-frm">Đọc thêm</a>
                </div>
            </div>
            <div class="col-md-4 col-sm-5">
                <?php echo $img;?>
            </div>
        </div>
        <?php } ?>
    </div>
</div>


<div class="box box-showroom">
    <div class="container">
        <h3 class="title-main">
           Hệ thống nhà hàng
        </h3>
        <div class="row">
            <?php
            $objRoom->getListItem();
            ?>
        </div>
    </div>
</div>