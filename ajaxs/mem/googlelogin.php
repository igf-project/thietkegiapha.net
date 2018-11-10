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
	if(isset($value['id'])) $gid=$value['id'];
	if($gid=='false' || $gid==false) echo 'Không tìm thấy Google ID đăng nhập !';
	else{
		// check nếu có tk thì đăng nhập ko thì đăng ký mới tk theo info fb
		$sql="SELECT * FROM tbl_member WHERE `username`='{$value['emails'][0]['value']}' ";
		$objdata->Query($sql);
		if($objdata->Num_rows()==1){
			$r=$objdata->Fetch_Assoc();
			$username=$r['username'];
			$password=md5(sha1($username));
			$objmem->LOGIN($username,$password);

		}else{
			// đk mới tk
			$objmem->Username=$value['emails'][0]['value'];
			$objmem->Password=md5(sha1($objmem->Username));
			$objmem->Firstname=$value['name']['givenName']." ".$value['name']['familyName'];
			// $objmem->Lastname=$value['last_name'];
			$objmem->Driver='google';
			$objmem->Email=$value['emails'][0]['value'];
			$objmem->Uid=$value['id'];
			$objmem->Avatar=$value['image']['url'];
			$objmem->Joindate=time();
			$objmem->isActive=1;
			if(!$objmem->Addnew()){
				echo "Register failse!";
			}
			// đăng nhập lại bằng tk vừa đk
			$sql="SELECT * FROM tbl_member WHERE uid='$gid' AND driver='google' ";
			$objdata->Query($sql);
			$r=$objdata->Fetch_Assoc();
			$username=$r['username'];
			$password=md5(sha1($username));
			$objmem->LOGIN($username,$password);
		}
	}
}else{
	echo 'Không tìm thấy Google ID đăng nhập';
}
?>