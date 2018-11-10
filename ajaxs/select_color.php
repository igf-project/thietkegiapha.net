<link rel="stylesheet" href="templates/default/css/popup.css" type="text/css" />
<script type="text/javascript" src="templates/default/js/gf_jquery.js"></script>
<?php
if(isset($_POST['color'])){
	$ar_color=explode(',',$_POST['color']);	
	$code=$_POST['code'];
?>	
<div id='header' style="margin-bottom: 20px; height:22px;position: relative;width: 100%;background: url(templates/default/images/tab_ks.png)repeat-x;" >		
<div class="close" style="width: 24px; height: 26px; background:url('templates/default/images/fancybox.png')repeat scroll -43px 0px;display: inline; position: absolute; top: -2px; right: 0px;cursor: pointer; z-index: 1000;"></div>
</div>
	<div class='paging' id='choicecolor'>			
		<?php		
		for($i=0;$i<count($ar_color);$i++){
			if($ar_color[$i]=='') continue;
		?>
		<a href='javascript:return false;' style='background:url("<?php echo $ar_color[$i];?>") no-repeat center center /100%;' src='<?php echo $ar_color[$i];?>' code='<?php echo $code;?>'></a>
		<?php }?>
	</div>
<?php } ?>