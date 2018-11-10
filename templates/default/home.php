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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $conf->Title;?></title>
    <link href="<?php echo ROOTHOST.THIS_TEM_PATH; ?>bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" media="all">
    <link href="<?php echo ROOTHOST.THIS_TEM_PATH;?>css/font-awesome.css" type="text/css" rel="stylesheet" media="all">
    <link href="<?php echo ROOTHOST.THIS_TEM_PATH; ?>css/style.css" type="text/css" rel="stylesheet" media="all">
    <link href="<?php echo ROOTHOST.THIS_TEM_PATH; ?>css/style-responsive.css" type="text/css" rel="stylesheet" media="all">
    <link href="<?php echo ROOTHOST.THIS_TEM_PATH;?>css/drop-menu.css?v=1" rel="stylesheet">
    <script src='<?php echo ROOTHOST.THIS_TEM_PATH;?>js/jquery-1.11.2.min.js'></script>
</head>
<body>
    <div class="wrapper">
        <div id="sb-site">
            <nav class="navbar" role="navigation" style="margin-bottom: 0px;">
                <div class="container header">
                    <div class="navitor row">
                        <div class='navbar-header'>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse-mainmenu" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="<?php echo ROOTHOST;?>"><img src="<?php echo ROOTHOST;?>images/root/logo.png"></a>
                        </div>
                        <div id="collapse-mainmenu" class="navbar-collapse collapse menu">
                            <?php $this->loadModule("navitor"); ?>
                        </div>
                    </div>
                </div>
                <div class="banner-home"><img src="<?php echo ROOTHOST;?>images/root/banner.jpg" class="img-responsive"></div>
            </nav>
            <div class="body">
                <?php $this->loadComponent();?>
            </div>
            <div class="footer">
                <?php $this->loadModule('footer') ?>
            </div>
        </div>
    </div>
    <script src='<?php echo ROOTHOST.THIS_TEM_PATH; ?>bootstrap/js/bootstrap.min.js'></script>
    <script src='<?php echo ROOTHOST;?>js/gfscript.min.js'></script>
</body>
</html>
<script>
    $(document).ready(function(){
        $('.navitor .dropdown .bulet-dropdown').click(function(){
            $(this).parent().find('.dropdown-menu').toggle();
            $(this).parent().toggleClass('nav-pos');
        })
    });
</script>