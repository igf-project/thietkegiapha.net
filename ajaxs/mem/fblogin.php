<?php
session_start();
include_once('../../includes/gfinnit.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.member.php');
$objmem=new CLS_MEMBER;
$objdata=new CLS_MYSQL;
if(isset($_POST['value'])){
	$value=$_POST['value'];
	if(isset($value['id'])) $fbid=$value['id'];
	if($fbid=='false' || $fbid==false) echo 'Không tìm thấy Facebook ID đăng nhập !';
	else{
		$sql="SELECT * FROM tbl_member WHERE uid='$fbid' AND driver='facebook' ";
		$objdata->Query($sql);
		if($objdata->Num_rows()==1){
			$r=$objdata->Fetch_Assoc();
			$objmem->setUserLogin($r);
			$objmem->setActionTime();
			$objmem->setInfoLogin($r['username']);
		}else{
			$objmem->UserName=$value['email'];
			$objmem->Password=md5(sha1($value['email']));
			$objmem->FirstName=$value['first_name'];
			$objmem->LastName=$value['last_name'];
			$objmem->Driver='facebook';
			$objmem->Uid=$value['id'];
			$objmem->Avatar='https://graph.facebook.com/'.$fbid.'/picture?type=large';
			$objmem->Joindate=date('Y-m-d H-i-s');
			if(!$objmem->Add_new()){
				echo "Register failse!";
			}
			$sql="SELECT * FROM tbl_member WHERE uid='$fbid' AND driver='facebook' ";
			$objdata->Query($sql);
			$r=$objdata->Fetch_Assoc();
			$objmem->setUserLogin($r);
			$objmem->setActionTime();
			$objmem->setInfoLogin($value['email']);
		}
	}
}else{
	echo 'Không tìm thấy Facebook ID đăng nhập';
}
?>