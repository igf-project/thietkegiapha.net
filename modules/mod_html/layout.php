<?php include("helper.php");?>
<div class="module<?php echo " ".$r['class'];?>">
	<?php if($r['viewtitle']==1){?>
	<h3 class="title" title="<?php echo $r['title'];?>"><?php echo $r['title'];?></h3>
    <?php }
    echo stripslashes($r['content']);
	?>
</div>
<?php
unset($obj); unset($r);
?>