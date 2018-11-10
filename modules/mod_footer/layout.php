<?php 
include("helper.php");
$conf = new CLS_CONFIG();
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