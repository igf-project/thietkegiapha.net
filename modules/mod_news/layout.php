<?php 
include("helper.php");
require_once(libs_path."cls.category.php");
require_once(libs_path."cls.content.php");
$obj_cate = new CLS_CATE();
$obj = new CLS_CONTENTS();
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