<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	$id='';
	if(isset($_GET['id']))
		$id=(int)$_GET['id'];
    $arr=array(10);
    if(isset($_GET['id']))
        $id=$_GET['id'];
    if(in_array($id, $arr))
        echo "<script language=\"javascript\">alert('Đây là nhóm tin hiển thị trong trang chủ không được xóa!')</script>";
    else
	$obj->Delete($id);
	echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
?>