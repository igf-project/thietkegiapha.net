<?php
$id=0;
if(isset($_GET['id'])){
	$id=$_GET['id'];
}
$new_cart=array();
if(isset($_SESSION['CART'])){
	$n=count($_SESSION['CART']);
	for($i=0;$i<$n;$i++){
		if($_SESSION['CART'][$i]['ID']!=$id){
			$new_cart[count($new_cart)]=$_SESSION['CART'][$i];
		}
	}
	$_SESSION['CART']=$new_cart;
}
//header('location:'.ROOTHOST.'gio-hang.html');
?>
<script type='text/javascript'>
	window.location='<?php echo ROOTHOST.'gio-hang.html';?>'
</script>