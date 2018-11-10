<?php 
include("helper.php");
require_once(libs_path."cls.albumgallery.php");
$obj = new CLS_ALBUMGALLERY();
?>
<div class="module<?php echo " ".$r['class'];?>">
	<?php if($r['viewtitle']==1){?>
	<h3 class="title" title="<?php echo $r['title'];?>"><?php echo $r['title'];?></h3>
    <?php }
	include(MOD_PATH."mod_$MOD/brow/".$theme.".php");
	?>
</div>
<?php
unset($obj); unset($r);
?>