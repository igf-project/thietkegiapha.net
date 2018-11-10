<div class="page page-album">
    <div class="container">
        <?php
        defined("ISHOME") or die("Can't acess this page, please come back!");
        if(isset($_GET['code'])){
            $code=addslashes($_GET['code']);
            $ar_code = explode('-',$code);
            $Album_ID = end($ar_code);
            $info_album = $obj->getInfo(" AND `id`='$Album_ID'");
            ?>
            <div class="gallery row">
                <div class="box-breadcrumb">
                    <ul class="breadcrumb">
                        <li><a href="<?php echo ROOTHOST;?>" title="Trang chủ"><i class="fa fa-home"></i>Trang chủ</a></li>
                        <li><a href="<?php echo ROOTHOST;?>mau-pha-do" title="Mẫu phả đồ">Mẫu phả đồ</a></li>
                        <li class="active"><a href="<?php echo ROOTHOST.'mau-pha-do/'.$info_album['name'];?>" title="Mẫu phả đồ"><?php echo $info_album['name'] ?></a></li>
                    </ul>
                </div>
                <?php
                $sql="SELECT * FROM `tbl_gallery` WHERE album_id=$Album_ID ORDER BY `id`";
                $objdata=new CLS_MYSQL();
                $objdata->Query($sql);
                if($objdata->Num_rows()>0){
                    while ($row = $objdata->Fetch_Assoc()) {
                        $thumb = getThumb(ROOTHOST.PATH_GALLERY.$row['link'],'img-responsive thumb',$row['name']);
                        echo '<div class="col-sm-4 box-gallery">';
                        echo '<div class="inner">';
                        echo '<a href="'.ROOTHOST.PATH_GALLERY.$row['link'].'" title="'.$row['name'].'" class="item">'.$thumb.'<div class="view-detail"><span>Xem chi tiết</span></div></a>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
        <?php }
        else die("PAGE NOT FOUND");
        ?>
    </div>
</div>
<link href="<?php echo ROOTHOST.THIS_TEM_PATH; ?>plugins/gallery/css/simplelightbox.css" type="text/css" rel="stylesheet" media="all">
<script src='<?php echo ROOTHOST.THIS_TEM_PATH;?>plugins/gallery/js/simple-lightbox.js'></script>
<script>
    $(function(){
        $('.gallery .item').simpleLightbox();
    });
</script>
