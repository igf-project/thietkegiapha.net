<?php
$objmem=new CLS_MEMBER;
if($objmem->isLogin())
    $objmem->Logout();
echo "<script language=\"javascript\">alert('Đăng xuất thành công!')</script>";
echo "<script language=\"javascript\">window.location='".ROOTHOST."trang-chu'</script>";
?>