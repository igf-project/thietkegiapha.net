<?php
ini_set('display_errors',1);
$conf = new CLS_CONFIG();
$conf->load_config();
// $this->updateVisited();
$MEMBER_LOGIN=new CLS_MEMBER;
$MEMBER_LOGIN->setActionTime();
?>
<!DOCTYPE html>
<html lang='vi'>
<head>
    <meta name="google" content="notranslate" />
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="<?php echo $conf->Meta_key;?>">
    <meta name="description" content="<?php echo $conf->Meta_desc;?>">
    <meta name="author" content="IGF TEAM">
    <meta property="og:author" content='IGF JSC' />
    <meta property="og:locale" content='vi_VN'/>
    <meta property="og:title" content="<?php echo $conf->Title;?>"/>
    <meta property="og:keywords" content='<?php echo $conf->Meta_key;?>' />
    <meta property='og:description' content='<?php echo $conf->Meta_desc;?>' />
    <meta property="og:image" content=""/>
    <meta property="fb:admins" content="100004363125235"/>
    <meta name="google-site-verification" content="1FU6AL-nlbSGyiWIQrQQCTc-C-22b7ixN9sQlid1fs0" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?php echo $conf->Title;?></title>
    <link rel="shortcut icon" href="<?php echo ROOTHOST.THIS_TEM_PATH;?>images/logo.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?php echo ROOTHOST.THIS_TEM_PATH;?>images/logo.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo ROOTHOST.THIS_TEM_PATH;?>images/logo.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo ROOTHOST.THIS_TEM_PATH;?>images/logo.ico" type="image/x-icon">
    <link href="<?php echo ROOTHOST.THIS_TEM_PATH; ?>bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" media="all">
    <link href="<?php echo ROOTHOST.THIS_TEM_PATH; ?>css/style.css" type="text/css" rel="stylesheet" media="all">
    <!-- <link href="<?php echo ROOTHOST.THIS_TEM_PATH; ?>css/style-responsive.css" type="text/css" rel="stylesheet" media="all"> -->
    <link href="<?php echo ROOTHOST.THIS_TEM_PATH;?>css/font-awesome.css" type="text/css" rel="stylesheet" media="all">
    <link href="<?php echo ROOTHOST.THIS_TEM_PATH; ?>css/slide-boostrap.css" type="text/css" rel="stylesheet" media="all">
    <link href="<?php echo ROOTHOST.THIS_TEM_PATH;?>css/swiper.css" rel="stylesheet">
    <link href="<?php echo ROOTHOST.THIS_TEM_PATH;?>css/owl/owl.carousel.min.css" rel="stylesheet">
    <script src='<?php echo ROOTHOST.THIS_TEM_PATH;?>js/jquery-1.11.2.min.js'></script>
    <script src="<?php echo ROOTHOST.THIS_TEM_PATH;?>js/swiper.min.js"></script>
    <script src="<?php echo ROOTHOST.THIS_TEM_PATH;?>js/owl/owl.carousel.min.js"></script>
    <script src='<?php echo ROOTHOST;?>js/gfscript.js'></script>
    <script src='<?php echo ROOTHOST.THIS_TEM_PATH;?>js/function.js'></script>
    <script src='<?php echo ROOTHOST.THIS_TEM_PATH;?>js/main.js'></script>
    <script src = "https://plus.google.com/js/client:platform.js" async defer></script>
</head>
<body>
    <div class="wrapper">
        <div id="sb-site" class="body">
            <div class="header">
                <nav class="navbar navbar-inverse navbar-static-top" role="navigation" style="margin-bottom: 0px;">
                    <div class="container">
                        <div class="navitor row" style="position: relative;">
                            <ul class="main-menu nav navbar-nav ">
                                <li><a href="<?php echo ROOTHOST;?>" title=""><span>Trang chủ</span></a></li>
                                <li><a href="" title=""><span>Giới thiệu</span></a></li>
                                <li><a href="<?php echo ROOTHOST;?>huong-dan-don-thuoc" title=""><span>Hướng dẫn đơn thuốc</span></a></li>
                                <li><a href="<?php echo ROOTHOST;?>ho-so-y-te-ca-nhan" title=""><span>Hồ sơ y tế cá nhân</span></a></li>
                                <li><a href="<?php echo ROOTHOST;?>an-toan-dung-thuoc" title=""><span>An toàn dùng thuốc</span></a></li>
                                <li><a href="<?php echo ROOTHOST;?>tim-phong-kham" title=""><span>Tìm phòng khám</span></a></li>
                            </ul>
                            <!-- login -->
                            <div class="box-btn-user pull-right">
                                <?php if($MEMBER_LOGIN->isLogin()){ ?>
                                <ul class="nav">
                                    <li class="menu-more act-user">
                                        <div class="btn-group">
                                            <div class="action dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <?php $avatar=$MEMBER_LOGIN->getAvarByUser($MEMBER_LOGIN->getInfo('username'));?>
                                                <img src="<?php echo $avatar;?>" alt="" class="icon-user img-circle"><span class="email"><?php echo $MEMBER_LOGIN->getInfo('username');?></span>
                                            </div>
                                            <ul class="dropdown-menu pull-right">
                                                <li></li>
                                                <li><a href="<?php echo ROOTHOST;?>thong-tin-ca-nhan"><i class="fa fa-info-circle"></i> Thông tin tài khoản</a></li>
                                                <li class='driver'></li>
                                                <li id='nav_logout'><a href="#" rel='nofollow,noindex'><i class="fa fa-power-off"></i> Đăng xuất</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                                <?php
                            }else{?>
                            <a href="#" class="act-mem nav_login"><span>Đăng nhập</span></a> /
                            <a href="#" class="act-mem nav_registry"><span>Đăng ký</span></a>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div class="body">
            <div class="container">
            <?php $this->loadComponent();?>
            </div>
        </div>
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-item">
                        <img src='<?php echo ROOTHOST.THIS_TEM_PATH;?>images/logo.png' class="img-logo-foot"></a>
                    </div>

                    <div class="col-sm-4 col-item">
                        <h3 class="title">Address</h3>
                        <ul>
                            <li>
                                <i class="fa fa-home"></i> <?php echo $conf->Address;?>
                            </li>
                            <li>
                                <i class="fa fa-phone"></i> <?php echo $conf->Phone;?>
                            </li>
                            <li>
                                <i class="fa fa-mail-reply-all"></i> <?php echo $conf->Email;?>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-item">
                        <h3 class="title">Đăng ký nhận tin</h3>
                        <form class="form-inline frm-mail">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="exampleInputAmount" placeholder="Email của bạn">
                                    <div class="input-group-addon">
                                        <input type="submit" class="btn btn-primary" value="Submit">
                                    </div>
                                </div>
                            </div>

                        </form>
                        <ul class="list-inline box-social">
                            <?php
                            if($conf->Facebook!=='') echo '<li><a target="_blank" href="'.$conf->Facebook.'"><i class="fa fa-facebook-f"></i></a> </li>';
                            if($conf->Twitter!=='') echo '<li><a target="_blank" href="'.$conf->Twitter.'"><i class="fa fa-twitter"></i></a> </li>';
                            if($conf->Gplus!=='') echo '<li><a target="_blank" href="'.$conf->Gplus.'"><i class="fa fa-google-plus"></i></a> </li>';
                            if($conf->Youtube!=='') echo '<li><a target="_blank" href="'.$conf->Youtube.'"><i class="fa fa-youtube"></i></a> </li>';
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src='<?php echo ROOTHOST.THIS_TEM_PATH; ?>bootstrap/js/bootstrap.min.js'></script>
<script src="<?php echo ROOTHOST; ?>js/login_fb.js"></script>

<div class="modal fade" id='popup_openlearn' role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="data-frm">
                <p>One fine body&hellip;</p>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</body>
</html>
<script>
    $(document).ready(function(){
        $('.nav_registry').click(function(){
            $('#popup_openlearn').modal('show');
            $('#popup_openlearn .modal-footer').hide();
            $('#popup_openlearn').removeClass('modal-login');
            $('#popup_openlearn .modal-body').html('Loadding');
            $('#popup_openlearn .modal-header h4').html('Đăng ký');
            $.get('<?php echo ROOTHOST;?>ajaxs/mem/frm_register.php',function(req){
                $('#popup_openlearn .modal-body').html(req);
            })
        })
        $('.nav_login').click(function(){
            $('#popup_openlearn').modal('show');
            $('#popup_openlearn').addClass('modal-login');
            $('#popup_openlearn .modal-footer').hide();
            $('#popup_openlearn .modal-body').html('Loadding');
            $('#popup_openlearn .modal-header h4').html('Đăng nhập');
            $.get('<?php echo ROOTHOST;?>ajaxs/mem/frm_login.php',function(req){
                $('#popup_openlearn .modal-body').html(req);
            })
        });
        $('.addcart').click(function(){
            var food_id = $(this).attr('ids');
            url='<?php echo ROOTHOST;?>ajaxs/product/addcart.php';
            $.post(url,{'food_id':food_id},function(rep){
                $('#cart-number').html(rep);
            })
            $.get('<?php echo ROOTHOST."ajaxs/product/getname.php";?>',{food_id},function(message){
                if(message)
                    $('#notification').fadeIn('slow').html(message);
                window.setTimeout(function(){
                    $('#notification').fadeOut('slow');
                },1500);
            });
        })
        $('#nav_logout').click(function(){
            $.get('<?php echo ROOTHOST;?>ajaxs/mem/logout.php',function(req){
                location.href='<?php echo ROOTHOST;?>';
                return false;
            })
        });
        $('.menu-more .label').click(function(){
            $('#sub-menu').toggle();
        });
    });
</script>