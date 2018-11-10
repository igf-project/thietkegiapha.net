<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
if(isset($_GET['code'])){
    $code=addslashes($_GET['code']);
}
else die("PAGE NOT FOUND");
$strWhere='WHERE `tbl_recruitment`.`code`="'.$code.'"';
$obj->getList($strWhere);
$row=$obj->Fetch_Assoc();
$intro=strip_tags(Substring($row['intro'], 0, 100));
$fulltext=html_entity_decode($row['fulltext']);
?>
<div class="slider-career">
    <div class="container text-center">
        <h2>Các bạn kỹ sư</h2>
        <p>Thời điểm tiếp cận công nghệ xây dựng đã đến gần</p>
        <button class="btn btn-send">Gửi thông tin của bạn cho chúng tôi</button>
    </div>
</div>
<div class="detail-career">
    <div class="container">
        <!--<div class="box-breadcrumb">
            <ul class="breadcrumb">
                <li><a href="<?php /*echo ROOTHOST;*/?>" title="Trang chủ">Trang chủ</a></li>
                <li><a href="<?php /*echo ROOTHOST;*/?>tin-tuc" title="Tin tức">Tin tức</a></li>
                <li><a href="<?php /*echo ROOTHOST;*/?>" title="Trang chủ"><?php /*echo $row['title'];*/?></a></li>
            </ul>
        </div>-->
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <div class="box-item">
                    <h3 class="title">
                        <?php echo $row['title'];?>
                    </h3>
                    <p class="intro">
                        <?php echo $intro;?>
                    </p>
                    <div class="fulltext">
                        <?php echo $fulltext;?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="mod mod-career">
                    <h3 class="title">Career Other</h3>
                   <?php
                   $sql="SELECT `tbl_recruitment`.`id`, `tbl_recruitment`.`code`, `tbl_recruitment`.`ishot`, `tbl_recruitment`.`edate`, `tbl_recruitment`.`showroom_id`,
                        `tbl_recruitment`.`title`, `tbl_recruitment`.`intro`, `tbl_recruitment`.`author`
                        FROM `tbl_recruitment`  ORDER BY `tbl_recruitment`.`id` DESC LIMIT 0,6";
                   $objdata=new CLS_MYSQL();
                   $objdata->Query($sql);
                   while($rows=$objdata->Fetch_Assoc()):
                       $url=ROOTHOST."career/".$rows['code'].".html";
                       $ishot=$rows['ishot'];
                       $date = date("d/m/Y", strtotime($rows['edate']));
                       $title=Substring($rows['title'], 0, 20);
                       ?>
                       <div class="item">
                           <h3 class="name">
                               <a class="" href="<?php echo $url;?>" title="<?php echo $rows['title'];?>"><?php echo $title;?></a>
                               <?php if($ishot==1) {?><img src="<?php echo ROOTHOST."images/icon-hot.gif";?>" class="ic-hot"/><?php } ?>
                           </h3>
                           <span class="date"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $date;?></span>
                       </div>
                   <?php endwhile;?>
                </div>
            </div>
        </div>
    </div>
</div>
