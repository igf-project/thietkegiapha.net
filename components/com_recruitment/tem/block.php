<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
include_once(LIB_PATH.'cls.content.php');
$objCon=new CLS_CONTENTS();
?>
<div class="box box-list-news list-news">
    <div class="container">
        <div class="box-title">
            <?php
            $strWhere=" WHERE id!='0'";
            include_once(LIB_PATH.'cls.category.php');
            $objCate=new CLS_CATE();
            $objCate->getList($strWhere);
            $count=$objCate->Num_rows();?>
            <ul class="list-inline list-cate<?php echo $count;?>">
                <?php

                while($rows=$objCate->Fetch_Assoc()){
                    $name = $rows['name'];
                    $url=ROOTHOST."tin-tuc/".$rows['code'];
                    echo '<li><a href="'.$url.'"><i class="fa fa-star" aria-hidden="true"></i> '.$name.'</a></li>';
                }
                ?>
            </ul>
        </div>
        <div class="row">
            <?php
            $strWhere="WHERE `id` not in(1,2)";
            $cur_page=isset($_POST['txtCurnpage'])? $_POST['txtCurnpage']: '1';
            $total_rows=$objCon->countContent($strWhere);
            $start=($cur_page-1)*MAX_ROWS_NEWS;
            $strWhere.=" LIMIT $start,".MAX_ROWS_NEWS;
            $objCon->getList($strWhere);
            $i=0;
            while($rows=$objCon->Fetch_Assoc()){
                $i++;
                $date = date("d/m/Y", strtotime($rows['cdate']));
                $img=getThumbNews($rows['thumb'],'img-responsive');
                $url=ROOTHOST."tin-tuc/".$rows['code'].".html";
                /*if($i!=3){*/
                ?>
                <div class="col-md-6 ">
                    <div class="item">
                        <div class="row">
                            <div class="col-md-5">
                                <?php echo $img;?>
                            </div>
                            <div class="col-md-7">
                                <div class="col-content">
                                    <h3 class="slogan"><a href="<?php echo $url;?>" title="<?php echo $rows['title'];?>"><?php echo $rows['title'];?></a></h3>
                                    <span class="date">Ngày <?php echo $date;?></span>
                                    <div class="txt"><?php echo html_entity_decode($rows['intro']);?></div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-default btn-frm">chi tiết</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <?php /*}else{*/?>
            <div class="col-md-6">
                <div class="hot-news">
                    <?php /*echo $img;*/?>
                </div>
            </div>
           --><?php /*}*/?>
            <?php }?>
        </div>
        <div class="text-center">
            <?php
            paging($total_rows, MAX_ROWS_NEWS, $cur_page);
            ?>
        </div>
    </div>
</div>

<!--<script>
    var widthBox=$('.hot-news').outerWidth();
    $('.hot-news img').css('height', widthBox);
    $('.list-news .item').css('height', widthBox/2 -15);
</script>-->
