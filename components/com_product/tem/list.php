<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$code=isset($_GET['code']) ? addslashes($_GET['code']):'';
$active='';
?>
<nav class="box-cate menu-tab">
    <div class="container">
        <ul class="cate-service">
            <?php
            $sql="SELECT * FROM tbl_service_group ORDER BY `order` DESC LIMIT 0,8";
            $objdata=new CLS_MYSQL();
            $objdata->Query($sql);	$i=0;
            while($rows=$objdata->Fetch_Assoc()){
                $str=explode('.png',$rows['thumb']);
                $thum_hover=$str[0]."_hover.png";
                $i++;
                ?>
                <li><a class="act box-ic ic-<?php echo $i; if($i==1) echo ' active';?>" href="#<?php echo "service".$rows['id'];?>">
                        <div class="circle">
                            <span class="child-circle"></span>
                            <span class="ic" style="background: url('<?php echo $rows['thumb'];?>') no-repeat center center;"></span>
                            <span class="ic-hover" style="background: url('<?php echo $thum_hover;?>') no-repeat center center;"></span>
                        </div>
                        <span class="service-cate"><?php echo $rows['name'];?></span>
                    </a> </li>
            <?php } ?>
        </ul>
    </div>
</nav>
<div class="container" id="content-tab">
    <div class="list-product">
        <?php
        $sql="select * FROM tbl_service_group WHERE isactive=1 AND id IN (SELECT groupservice_id FROM tbl_product GROUP BY groupservice_id ASC) ORDER BY `id` ASC";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rw=$objdata->Fetch_Assoc()){
            $ids=$rw['id'];
            echo '<div class="box-item-group" id="service'.$ids.'">';
            $obj->getList("WHERE groupservice_id='$ids'");
            while($rows=$obj->Fetch_Assoc())
            {	$i++;
                $ids=$rows['id'];
                $code=$rows['code'];
                $title = Substring(stripslashes($rows['name']),0,10);
                $intro =Substring(stripslashes($rows['intro']),0,30);
                $img= getThumb($rows['thumb'], 'img-responsive img-product',$rows['name']);
                $url=ROOTHOST."project/".$code.'.html';
                ?>
                <div class="item">
                    <div class="row row row-fullheight">
                        <div class="col-md-7 left-side">
                            <a href="<?php echo $url;?>" title="<?php echo $rows['name'];?>"><?php echo $img;?></a>
                        </div>
                        <div class="col-md-5 right-side">
                            <h3 class="name-pro"><a href="<?php echo $url;?>" class="name txt-ellipsis" title="<?php echo $rows['name'];?>"><?php echo $title;?></a></h3>
                            <div class="txt-intro"><?php echo $intro;?></div>
                            <ul class="list-act">
                                <li>
                                    <a href="#">See related blogs...</a>
                                </li>
                                <li>
                                    <a href="#">See related service...</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php
            }
            echo '</div>';
        }
        ?>
    </div>
</div>
<script>
    $(document).ready(function () {
        var sections = $('.box-item-group')
            , nav = $('nav')
            , nav_height = nav.outerHeight();

        $(window).on('scroll', function () {
            var cur_pos = $(this).scrollTop();
            if (cur_pos >= 620) {
                $('nav').addClass('fixed');
                sections.each(function() {
                    var top = $(this).offset().top - nav_height,
                        bottom = top + $(this).outerHeight();

                    if (cur_pos >= top && cur_pos <= bottom) {
                        nav.find('a').removeClass('active');
                        sections.removeClass('active');

                        $(this).addClass('active');
                        nav.find('a[href="#'+$(this).attr('id')+'"]').addClass('active');
                    }
                });
            }
            else{
                $('nav').removeClass('fixed');
            }
        });

        nav.find('a').on('click', function () {
            var $el = $(this)
                , id = $el.attr('href');

            $('html, body').animate({
                scrollTop: $(id).offset().top - nav_height
            }, 500);

            return false;
        });
    });
</script>
