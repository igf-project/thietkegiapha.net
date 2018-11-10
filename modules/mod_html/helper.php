<?php
	$MOD='html';
	$obj=new CLS_MODULE;
	$obj->getList('AND `tbl_modules`.`id`='.$rows["id"],0);
	$r=$obj->Fetch_Assoc();
	$theme = 'default';
	if($r['theme']!='') 
	$theme = $r['theme'];
?>
