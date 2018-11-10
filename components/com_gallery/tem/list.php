<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
include_once(LIB_PATH.'cls.gallery.php');
$obj=new CLS_GALLERY();
$album_id='';
$first_album='';
?>
<div class="page page-gallery">
    <div class="container">
        <div id="gallery" class="list-gallery">
            <div class="row">
                <div class="box-breadcrumb">
                    <ul class="breadcrumb">
                        <li><a href="<?php echo ROOTHOST;?>" title="Trang chủ"><i class="fa fa-home"></i>Trang chủ</a></li>
                        <li class="active"><a href="<?php echo ROOTHOST;?>mau-pha-do" title="Mẫu phả đồ">Mẫu phả đồ</a></li>
                    </ul>
                </div>
                <h1>Mẫu phả đồ</h1>
                <?php
                $strWhere='';
                $cur_page=isset($_GET['page'])? $_GET['page']: '1';
                $total_rows=$obj->getCount($strWhere);
                $start=($cur_page-1)*MAX_ROWS_NEWS;
                $limit=" LIMIT $start,".MAX_ROWS_NEWS;
                $obj->getList($strWhere, $limit);
                while ($row = $obj->Fetch_Assoc()) {
                    $thumb = getThumb(ROOTHOST.PATH_GALLERY.$row['link'],'img-responsive thumb',$row['name']);
                    echo '<div class="col-sm-3 box-gallery">';
                    echo '<div class="inner">';
                    echo '<a href="'.ROOTHOST.PATH_GALLERY.$row['link'].'" title="'.$row['name'].'" class="item">'.$thumb.'<div class="view-detail"><span>Xem chi tiết</span></div></a>';
                    echo '</div>';
                    echo '<div class="name">'.$row['name'].'</div>';
                    echo '</div>';
                }
                ?>
                <div class="clearfix"></div>
                <div class="text-center">
                    <?php
                    paging($total_rows, MAX_ROWS_NEWS, $cur_page);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<link href="<?php echo ROOTHOST.THIS_TEM_PATH; ?>plugins/gallery/css/simplelightbox.css" type="text/css" rel="stylesheet" media="all">
<script src='<?php echo ROOTHOST.THIS_TEM_PATH;?>plugins/gallery/js/simple-lightbox.js'></script>
<script>
    $(function(){
        $('#gallery .item').simpleLightbox();
    });
</script>

