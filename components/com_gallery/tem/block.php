
<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$album_code=isset($_GET['code']) ? addslashes($_GET['code']):'';
$album_id=isset($_GET['album_id']) ? addslashes($_GET['album_id']):'';
?>

<link rel="stylesheet" type="text/css" href="<?php echo ROOTHOST.THIS_TEM_PATH; ?>css/simplelightbox.css">
<link rel="stylesheet" href="<?php echo ROOTHOST.THIS_TEM_PATH; ?>css/demo.css">
<div id='fb-root'></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = '//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.6&appId=825527060821418';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<script>
    function submitFrm(value){
        $('#frm_cate').submit();
    }
   /* $('document').ready(function(){
        scrollToBox('box-gallery');
    })*/
</script>


<div class="box-gallery" id="box-gallery">
    <div class="container">
        <div class="box-breadcrumb">
            <ul class="breadcrumb">
                <li><a href="<?php echo ROOTHOST;?>" title="Trang chủ">Trang chủ</a></li>
                <li><a href="<?php echo ROOTHOST;?>thu-vien/thu-vien-anh" title="Thư viện ảnh">Thư viện ảnh</a></li>
                <li><?php echo $obj->getNameAlbumById($album_id);?></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-4">
                <?php include_once(MOD_PATH.'mod_gallery/layout.php');?>
            </div>
            <div class="col-md-9 col-sm-8 gallery">
            <div class="row">
                <?php
                $cur_page=isset($_POST['txtCurnpage'])? $_POST['txtCurnpage']: '1';
                $sql_ga="SELECT * FROM `tbl_gallery` INNER JOIN `tbl_album` ON tbl_gallery.album_id=tbl_album.id WHERE `tbl_gallery`.`isactive`=1  AND `tbl_gallery`.`album_id`='$album_id'";
                $objmysql=new CLS_MYSQL();
                $objmysql->Query($sql_ga);
                $total_rows=$objmysql->Num_rows();
                $total_page=ceil($total_rows/MAX_ROWS_GALLERY);
                $start=($cur_page-1)*MAX_ROWS_GALLERY;
                $sql_ga.=" LIMIT ".$start.",".MAX_ROWS_GALLERY."";
                $objmysql->Query($sql_ga);
                $url="";
                WHILE($rows=$objmysql->Fetch_Assoc()){?>
                    <div class="col-md-4 col-sm-4 col-xs-6 col-item">
                        <a href="<?php echo ROOTHOST.PATH_GALLERY.$rows['link'];?>" class="item">
                            <img src="<?php echo ROOTHOST.PATH_GALLERY.$rows['link'];?>" alt="" class="img-responsive"
                                 title='<?php echo $rows['name'];?>'>
                            <div class="name-image" >
                                <?php echo $rows['name'];?>
                            </div>
                        </a>
                    </div>
                <?php }?>
            </div>
                <div class="text-center">
                    <?php
                    paging($total_rows, MAX_ROWS_GALLERY, $cur_page);
                    ?>
                </div>
        </div>
    </div>
</div>
<script src="<?php echo ROOTHOST.THIS_TEM_PATH;?>js/simple-lightbox.js"></script>
<script>
    $(function(){
        $('.gallery a').simpleLightbox();
    });
</script>


