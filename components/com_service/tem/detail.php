<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
if(isset($_GET['code'])){
	$code=addslashes($_GET['code']);
    /*Update view*/
    $obj->updateView($code);

}
else die("PAGE NOT FOUND");
    $strWhere='WHERE `code`="'.$code.'"';
    $obj->getList($strWhere);
    $row=$obj->Fetch_Assoc();
    $intro=strip_tags(Substring($row['intro'], 0, 100));
    $fulltext=html_entity_decode($row['fulltext']);
?>
<div class="page-content detail-news">
    <div class="container">
      <!--  <div class="box-breadcrumb">
            <ul class="breadcrumb">
                <li><a href="<?php /*echo ROOTHOST;*/?>" title="Trang chủ">Trang chủ</a></li>
                <li><a href="<?php /*echo ROOTHOST;*/?>tin-tuc" title="Tin tức">Tin tức</a></li>
                <li><?php /*echo $row['title'];*/?></li>
            </ul>
        </div>-->
        <div class="row">
            <div class="col-md-8">
                <div class="detail-content">

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
                        <div class="author">
                            Tác giả: <?php echo $row['author'];?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="mod list-category">
                    <h3 class="title">
                        List category
                    </h3>
                    <ul>
                        <?php
                        $sql="SELECT * FROM tbl_category WHERE isactive=1";
                        $objdata=new CLS_MYSQL();
                        $objdata->Query($sql);
                        while($rows=$objdata->Fetch_Assoc()){
                            $title=Substring($rows["name"], 0 , 50);
                            ?>
                            <li>
                                <a href="<?php echo $url;?>" title="<?php echo $title;?>"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> <?php echo $title;?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="mod list-latest-news">
                    <h3 class="title">
                        Lastest news
                    </h3>
                    <ul class="latest-post">
                        <?php
                        $sql="SELECT * FROM tbl_content WHERE isactive=1 AND ishot=1";
                        $objdata=new CLS_MYSQL();
                        $objdata->Query($sql);
                        if($objdata->Num_rows()<1) echo 'Dữ liệu đang được cập nhật';
                        while($rows=$objdata->Fetch_Assoc()){
                            $title=Substring($rows["name"], 0 , 50);
                            $date=$rows['cdate'];
                            $author=$rows['author'];
                            $img= getThumb($rows['thumb'], 'img-responsive thumb',$rows['name']);
                            ?>
                            <li>
                                <a href="<?php echo $url;?>">
                                    <?php echo $img;?>
                                </a>
                                <div class="recent-post-details">
                                    <a class="post-title" href="<?php echo $url;?>"><?php echo $title;?></a>
                                    <ul class="list-inline">
                                        <li><span class="txt-time"><i class="fa fa-clock-o"></i> <?php echo $date;?></span></li>
                                        <li> <span class="txt-author"><i class="fa fa-user"></i> <?php echo $author;?></span></li>
                                    </ul>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <div class="news-relater">
    <div class="container">
        <h3 class="title">Bài viết liên quan</h3>
        <div class="row">
                <?php
                $strWhere="WHERE `code` NOT IN ('$code') LIMIT 0,6";
                $obj->getList($strWhere);
                $i=0;
                while($rows=$obj->Fetch_Assoc()){
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
                                <a href="<?php echo $url;?>" title="<?php echo $rows['title'];?>"><?php echo $img;?></a>
                            </div>
                            <div class="col-md-7">
                                <div class="col-content">
                                    <h3 class="name"><a href="<?php echo $url;?>" title="<?php echo $rows['title'];?>"><?php echo $rows['title'];?></a></h3>
                                    <span class="date">Ngày <?php echo $date;?></span>
                                    <div class="txt"><?php echo html_entity_decode($rows['intro']);?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
    </div>
</div>
</div>
