<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$flag=0;
$com=isset($_GET['com'])? $_GET['com']:'';
if($com=='product'){
    $viewtype=isset($_GET['viewtype'])? $_GET['viewtype']:'';
    if($viewtype=='detail') $flag=1;
}
$arr=array('recruitment');
if(!in_array($com,$arr) && $flag==0){?>
<div id="slide-main">
    <div id="slider-main" class="slider-main swiper-container">
        <div class="swiper-wrapper">
            <?php
            $sql="SELECT * FROM tbl_slider WHERE isactive=1 AND type=0";
            $objdata=new CLS_MYSQL();
            $objdata->Query($sql);
            WHILE($rows=$objdata->Fetch_Assoc()){?>
            <div class="swiper-slide">
                <div class="content">
                    <div class="container">
                        <h2><?php echo $rows['slogan'];?></h2>
                        <p><?php echo $rows['intro'];?></p>
                    </div>

                </div>
                <img src="<?php echo $rows['link'];?>" title=""/>
            </div>
            <?php }?>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination show-mobile"></div>
        <!-- Add Arrows -->
        <div class="swiper-button-next btn-next"></div>
        <div class="swiper-button-prev btn-prev"></div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        slider_main();
    });
</script>
<?php }
?>