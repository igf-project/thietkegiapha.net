<script>
    function showTrial(box_id){
        $.get('<?php echo ROOTHOST;?>ajaxs/service/trial.php',{box_id},function(response_data){
            $('#myModal').modal('show');
            $('#myModalLabel').html('Trial');
            $('#data-frm').html(response_data);
        })
    }
    function showContent(id){
        $('#txt-fulltext-'+id).toggle();
    }
</script>
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
            </a>
        </li>
        <?php } ?>
    </ul>
    </div>
</nav>
<div class="container" id="content-tab">
    <div class="list-service">
    <?php
    $sql="select * FROM tbl_service_group WHERE isactive=1 AND id IN (SELECT group_id FROM tbl_service GROUP BY group_id ASC) ORDER BY `id` ASC";
    $objdata=new CLS_MYSQL();
    $objdata->Query($sql);
    while($rw=$objdata->Fetch_Assoc()){
        $ids=$rw['id'];
        echo '<div class="box-item-group" id="service'.$ids.'">';
        $obj->getList("WHERE group_id='$ids'");
        while($rows=$obj->Fetch_Assoc()){
            $i++;
            $id=$rows['id'];
            $date = date("d/m/Y", strtotime($rows['cdate']));
            $img=getThumbNews($rows['thumb'],'img-responsive thumb-service');
            $url=ROOTHOST."service/".$rows['code'].".html";
            $intro=Substring($rows['intro'],0,50);
            $fulltext=$rows['fulltext'];
            $file=$rows['file'];
            $trial=$rows['trial'];
            $url_blog=ROOTHOST.'related-blog/'.$rows['code'];
            $url_service=ROOTHOST.'/related-service/'.$rows['code'];
            /*if($i!=3){*/
            $flag=$rows['type']==1? 'flag-en.png':'flag-vi.png';
            ?>
       <!-- <a href="<?php /*echo $url;*/?>" title="<?php /*echo $rows['title'];*/?>">-->
            <div class="item">
                <h3 class="name"><?php echo $rows['title'];?><span class="flag"><img src="<?php echo ROOTHOST.THIS_TEM_PATH."images/".$flag;?>"> </span> </h3>
                <?php echo $img;?>
                <div class="txt">
                    <?php echo $intro;?>
                    <div class="list-act">
                        <ul class="list-inline list-link">
                            <li>
                                <span onclick="showContent(<?php echo $ids;?>)">Show more</span>
                            </li>
                            <li>
                                <a href="<?php echo $url_blog;?>" title="See related blogs">See related blogs...</a>
                            </li>
                            <li>
                                <a href="<?php echo $url_service;?>" title="See related project">See related project...</a>
                            </li>
                        </ul>
                        <ul class="list-inline list-trailer">
                            <li>
                                <a href="<?php echo ROOTHOST."contact";?>" title="Contact"><i class="fa fa-question" aria-hidden="true"></i></a>
                            </li>
                            <li>
                                <?php if($file!='') echo '<a href="'.ROOTHOST.PATH_FILE.$file.'"><i class="fa fa-download" aria-hidden="true"></i></a>';?>
                            </li>
                            <li>
                                <?php if($trial!='') echo '<span onclick="showTrial('.$id.')">Trial</span>';?>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div id="txt-fulltext-<?php echo $id;?>" class="txt-fulltext"><?php echo $fulltext;?></div>
            </div>

        <?php }
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
