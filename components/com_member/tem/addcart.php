<?php
$id=0;
if(isset($_GET['id'])){
	$id=$_GET['id'];
}
$flag=false;
if(isset($_SESSION['CART'])){
	$n=count($_SESSION['CART']);
	for($i=0;$i<$n;$i++){
		if($_SESSION['CART'][$i]['ID']==$id){
			$_SESSION['CART'][$i]['QUA']+=1;
			$flag=true; break;
		}
	}
}else{
	$_SESSION['CART']=array();
}
if($flag==false){
	$item=array('ID'=>$id,'QUA'=>1,'NOTE'=>'');
	$_SESSION['CART'][count($_SESSION['CART'])]=$item;
}
//header('location:'.ROOTHOST.'gio-hang.html');
?>
<script type='text/javascript'>
	window.location='<?php echo ROOTHOST.'gio-hang.html';?>'
</script>