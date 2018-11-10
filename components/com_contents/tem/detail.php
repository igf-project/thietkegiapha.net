<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
if(isset($_GET['code'])){
	$code=addslashes($_GET['code']);
    /*Update view*/
    $obj->updateView($code);
}
else die("PAGE NOT FOUND");
$strWhere=' AND `code`="'.$code.'"';
$obj->getList($strWhere);
$row=$obj->Fetch_Assoc();
$intro=strip_tags(Substring($row['intro'], 0, 100));
$fulltext=html_entity_decode($row['fulltext']);
$list_parent = $obj_cate->getCatIDParent($row['cate_id']);
$link = ROOTHOST.$code.'.html';
?>
<div class="page page-content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="box-breadcrumb">
                    <ul class="breadcrumb">
                        <li><a href="<?php echo ROOTHOST;?>" title="Trang chủ"><i class="fa fa-home"></i>Trang chủ</a></li>
                        <?php $obj_cate->CreatPath($list_parent); ?>
                        <li class="active"><a href="<?php echo $link; ?>" title="<?php echo $row['title']; ?>"><?php echo $row['title'];?></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="detail-content">
                    <div class="box-item">
                        <h1><?php echo $row['title'];?></h1>
                        <p class="intro">
                            <?php echo $intro;?>
                        </p>
                        <div class="fulltext">
                            <?php echo $fulltext;?>
                        </div>
                    </div>
                </div>
                <div class="box-related">
                    <h2 class="title">Bài viết cùng chuyên mục</h2>
                    <ul class="list">
                        <?php
                        $strWhere=" AND cate_id=".$row['cate_id']." AND id<>".$row['id']." ORDER BY `order` DESC LIMIT 0,6";
                        $obj->getList($strWhere);
                        $i=0;
                        while($rows=$obj->Fetch_Assoc()){
                            $name = stripslashes($rows['title']);
                            $date = date("d/m/Y", strtotime($rows['cdate']));
                            $link=ROOTHOST.$rows['code'].".html";
                            echo'<li><i class="fa fa-circle" aria-hidden="true"></i><a href="'.$link.'" title="'.$name.'">'.$name.'</a><span class="date">(Ngày '.$date.')</span></li>';
                        }?>
                    </ul>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="mod list_cate">
                    <h2 class="mod_title">Danh mục tin tức</h2>
                    <ul class="list">
                        <li><i class="fa fa-angle-double-right" aria-hidden="true"></i><a href="" title="">Câu hỏi thường gặp</a></li>
                        <li><i class="fa fa-angle-double-right" aria-hidden="true"></i><a href="" title="">Câu hỏi thường gặp</a></li>
                        <li><i class="fa fa-angle-double-right" aria-hidden="true"></i><a href="" title="">Câu hỏi thường gặp</a></li>
                        <li><i class="fa fa-angle-double-right" aria-hidden="true"></i><a href="" title="">Câu hỏi thường gặp</a></li>
                        <li><i class="fa fa-angle-double-right" aria-hidden="true"></i><a href="" title="">Câu hỏi thường gặp</a></li>
                    </ul>
                </div>
                <div class="mod list_cate">
                    <h2 class="mod_title">Có thể bạn quan tâm</h2>
                    <ul class="list">
                        <li><i class="fa fa-angle-double-right" aria-hidden="true"></i><a href="" title="">Câu hỏi thường gặp</a></li>
                        <li><i class="fa fa-angle-double-right" aria-hidden="true"></i><a href="" title="">Câu hỏi thường gặp</a></li>
                        <li><i class="fa fa-angle-double-right" aria-hidden="true"></i><a href="" title="">Câu hỏi thường gặp</a></li>
                        <li><i class="fa fa-angle-double-right" aria-hidden="true"></i><a href="" title="">Câu hỏi thường gặp</a></li>
                        <li><i class="fa fa-angle-double-right" aria-hidden="true"></i><a href="" title="">Câu hỏi thường gặp</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
