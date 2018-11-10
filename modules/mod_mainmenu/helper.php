<?php
	$MOD='mainmenu';
	$obj=new CLS_MODULE;
	$obj->getList('AND `tbl_modules`.`id`='.$rows["id"],0);
	$r=$obj->Fetch_Assoc();
	$theme = 'brow1';
	if($r['theme']!='') 
		$theme=$r['theme'];
?>