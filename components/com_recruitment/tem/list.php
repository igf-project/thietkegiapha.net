<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$code=isset($_GET['code']) ? addslashes($_GET['code']):'';
?>
<div class="slider-career">
    <div class="container text-center">
        <h2>Các bạn kỹ sư</h2>
        <p>Thời điểm tiếp cận công nghệ xây dựng đã đến gần</p>
        <button class="btn btn-send" id="btn-send">Gửi thông tin của bạn cho chúng tôi</button>
    </div>
</div>
<div class="page-content list-cruitment">
    <div class="container">
       <!-- <div class="box-breadcrumb">
            <ul class="breadcrumb">
                <li><a href="<?php /*echo ROOTHOST;*/?>" title="Trang chủ">Trang chủ</a></li>
                <li><a href="<?php /*echo ROOTHOST;*/?>tuyen-dung" title="Tin tức">Tuyển dụng</a></li>
                <li><?php /*echo $obj->getNameCateByCode($code);*/?></li>
            </ul>
        </div>-->
        <div class="career-slogan">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="box-item col-md-8">
                    <h2 class="title-main">
                        Its what we do together that sets us apart
                    </h2>
                    <p class="slogan">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book
                    </p>
                </div>
                <div class="col-md-2"></div>
            </div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="box-item col-md-10">
                    <h2 class="title-main">
                        Its what we do together that sets us apart
                    </h2>
                    <p class="slogan">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book
                    </p>
                </div>
                <div class="col-md-1"></div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="list-item col-md-10">
                <div class="row">
                    <?php
                    $strWhere='';
                    $limit='';
                    $cur_page=isset($_POST['txtCurnpage'])? $_POST['txtCurnpage']: '1';
                    $total_rows=$obj->countContent($strWhere);
                    $start=($cur_page-1)*MAX_ROWS_NEWS;
                    $limit=" LIMIT $start,".MAX_ROWS_NEWS;
                    $obj->getListItem($strWhere, $limit);
                    ?>
                </div>
                <div class="text-center">
                    <?php
                    paging($total_rows, MAX_ROWS_NEWS, $cur_page);
                    ?>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>

            <div class="clearfix"></div>

        </div>

    </div>
<div class="box-slider-career">
    <div id="slider-main" class="swiper-container">
        <div class="swiper-wrapper">
            <?php
            $sql="SELECT * FROM tbl_slider WHERE isactive=1 AND type=1";
            $objdata=new CLS_MYSQL();
            $objdata->Query($sql);
            WHILE($rows=$objdata->Fetch_Assoc()){?>
                <div class="swiper-slide">
                    <img src="<?php echo $rows['link'];?>" title=""/>
                </div>
            <?php }?>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        <!-- Add Arrows -->
        <div class="swiper-button-next btn-next"></div>
        <div class="swiper-button-prev btn-prev"></div>
    </div>

<script type="text/javascript">
    $(document).ready(function(){
        slider_main();
    });
</script>
</div>
<div class="our-team">
    <h2 class="title-main">Our Team</h2>
    <div class="container">
        <div class="content-slider">

        <button class="btn-control prev-control prev-team"><i class="fa fa-angle-left"></i></button>
        <button class="btn-control next-control next-team"><i class="fa fa-angle-right"></i></button>
            <div id="slider_team" class="owl-carousel">

                <?php
                $sql="SELECT * FROM tbl_team ORDER BY `order` DESC LIMIT 0,8";
                $objdata=new CLS_MYSQL();
                $objdata->Query($sql);
                while($rows=$objdata->Fetch_Assoc()){
                    $img= getThumb($rows['thumb'], 'img-responsive thumb-avatar',$rows['name']);
                    ?>
                    <div class="item">
                        <?php echo $img;?>
                        <p class="name"> <?php echo $rows['name'];?></p>
                    </div>
                <?php }
                ?>
            </div>
            <script>
                $(document).ready(function(){
                    slider_team();
                });
            </script>
        </div>
        </div>

</div>
</div>
<script>
    $(document).ready(function(){
    $('#btn-send').click(function(){
        $.get('<?php echo ROOTHOST;?>ajaxs/career/frm.php',function(response_data){
            $('#myModal').modal('show');
            $('#myModalLabel').html('Send profile for us');
            $('#data-frm').html(response_data);
        })
    });
    });
</script>