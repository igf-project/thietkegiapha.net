<?php
session_start();
include_once('../../includes/gfinnit.php');
include_once('../../includes/gfconfig.php');
include_once('../../includes/gffunction.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.member.php');
if(!isset($objmem))
    $objmem=new CLS_MEMBER();
$username=$objmem->getInfo('username');
if(isset($_GET['url'])){
    $url=$_GET['url'];
    ?>
    <div id="fb-root"></div>
    <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
    <fb:comments href="<?php echo $url;?>" num_posts="2" width="100%"></fb:comments>
    <script>FB.XFBML.parse();</script>
<?php
}
?>