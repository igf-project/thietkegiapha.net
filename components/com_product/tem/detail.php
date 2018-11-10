<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
if(isset($_GET['code'])){
    $code=addslashes($_GET['code']);
    /*Update view*/
}
else die("PAGE NOT FOUND");
?>
<?php
$strWhere='WHERE `tbl_product`.`code`="'.$code.'"';
$obj->getList($strWhere);
$row=$obj->Fetch_Assoc();
$product_id=$ids=$row['id'];
$group=$row['groupservice_id'];
$code_name=$row['name_code'];
$title = Substring(stripslashes($row['name']),0,10);
$intro =$row['intro']!==''? Substring(stripslashes($row['intro']),0,100):NO_UPDATED;
$fulltext=html_entity_decode($row['fulltext']);
$img= getThumb($row['thumb'], 'img-responsive img-product',$row['name']);
$price=getFomatPrice($row['price']);
$url_page=ROOTHOST.'project/'.$code.'.html';

?>
<!--<div class="box-breadcrumb">
    <ul class="breadcrumb">
        <li><a href="<?php /*echo ROOTHOST;*/?>" title="Trang chủ">Trang chủ</a></li>
        <li><a href="<?php /*echo ROOTHOST;*/?>san-pham" title="Sản phẩm">Sản phẩm</a></li>
        <li class="active"><?php /*echo $title;*/?></li>
    </ul>
</div>-->
<div class="detail-product">
        <?php
        if($row['video']!=''){
            $arr=explode('v=',$row['video']);
            if(count($arr)>=2){
                $video_id=$arr[1];
                ?>
                <div class="video-pro">
                    <div class="container">
                        <iframe width="100%" height="540" src="https://www.youtube.com/embed/<?php echo $video_id;?>">
                        </iframe>
                    </div>
                </div>
           <?php  }
         }
        else echo '<img src="'.ROOTHOST.PATH_THUMB.$row['img'].'" class="img-responsive img-detail"/>'?>
</div>
<div class="container page-content">

    <div class="row">
        <div class="col-md-8 col-sm-8 detail-content">
            <div class="box-item">
                <h1>
                    <?php echo $title;?>
                </h1>
                <p class="intro">
                    <?php echo $intro;?>
                </p>
            </div>
            <!--<div class="product-relater list-product">
                <div class="container">
                    <div class="box-title">
                        <h3>Project Other</h3>
                    </div>
                    <div class="row row-custom">
                        <?php
/*                        $strWhere="WHERE `isactive`='1' AND `groupservice_id`='$group' AND id NOT IN($ids)";
                        $obj->getListItem($strWhere, " LIMIT 0,6");
                        */?>
                    </div>
                </div>
            </div>
            <div class="product-relater list-product">
                <div class="container">
                    <div class="box-title">
                        <h3>News Relater</h3>
                    </div>
                    <div class="row row-custom">
                        <?php
/*                        $strWhere="WHERE `isactive`='1' AND `groupservice_id`='$group' AND id NOT IN($ids)";
                        $obj->getListItem($strWhere, " LIMIT 0,6");
                        */?>
                    </div>
                </div>
            </div>-->
        </div>
        <div class="col-md-4 col-sm-4">
            <?php include_once(MOD_PATH.'mod_product/layout.php');?>

        </div>
    </div>
</div>

<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.7&appId=825527060821418";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>