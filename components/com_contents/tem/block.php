<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$strWhere='';
$code=isset($_GET['code']) ? addslashes($_GET['code']):'';
$info_cate = $obj_cate->getInfo(" AND `code`='$code'");
$link_cate = ROOTHOST.stripslashes($info_cate['code']);
$strWhere.=" AND cate_id=".$info_cate['cate_id'];
?>
<div class="page page-content">
    <div class="container">
        <div class="box-breadcrumb">
            <ul class="breadcrumb">
                <li><a href="<?php echo ROOTHOST;?>" title="Trang chủ"><i class="fa fa-home"></i>Trang chủ</a></li>
                <li><a href="<?php echo ROOTHOST;?>tin-tuc" title="Tin tức">Tin tức</a></li>
                <li class="active"><a href="<?php echo $link_cate ;?>"><?php echo $info_cate['name'];?></a></li>
            </ul>
        </div>
        <h1><?php echo $info_cate['name'];?></h1>
        <div class="row list-content">
            <?php
            $max_rows=MAX_ROWS_NEWS;
            $cur_page=1;
            if(isset($_GET['page'])) $cur_page=(int)$_GET['page'];
            $start=($cur_page-1)*$max_rows;
            $total_rows=$obj->countContent($strWhere);
            if($total_rows>0){
                $obj->getList($strWhere);
                while($rows=$obj->Fetch_Assoc()){
                    $date = date("d/m/Y", strtotime($rows['cdate']));
                    $img = getThumb($rows['thumb'],'img-responsive thumb');
                    $link = ROOTHOST.$rows['code'].".html";
                    $author = $obj->getAuthorById($rows['author']);
                    ?>
                    <div class="item col-sm-6">
                        <a href="<?php echo $link;?>" title="<?php echo $rows['title'];?>"><?php echo $img;?></a>
                        <h3 class="name"><a href="<?php echo $link;?>" title="<?php echo $rows['title'];?>" class="name"><?php echo $rows['title'];?> </a></h3>
                        <p class="txt">
                            <?php echo Substring($rows['intro'], 0, 30);?>
                        </p>
                    </div>
                    <?php 
                }?>
                <div class="text-center">
                    <?php
                    paging($total_rows, MAX_ROWS_NEWS, $cur_page);
                    ?>
                </div>
                <?php 
            }?>
        </div>
    </div>
</div>
</div>
