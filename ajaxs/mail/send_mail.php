<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/14/16
 * Time: 1:51 AM
 */
session_start();
include_once('../../includes/gfinnit.php');
include_once('../../includes/gfconfig.php');
include_once('../../includes/gffunction.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.configsite.php');
include_once('../../libs/cls.member.php');
$objmember = new CLS_MEMBER();
$conf = new CLS_CONFIG();

$conf->getList();
$row=$conf->Fetch_Assoc();
$arr_email=explode(",,|",$row['email']);
$email_admin=$arr_email[0];
$nFrom = "Thuoc.com.vn";    //mail duoc gui tu dau, thuong de ten cong ty ban
$mFrom =$email_admin;  //dia chi email cua ban
$mPass ='msivitywijgbavbi';       //mat khau email cua ban   define('SMTP_PASS_AUT','gfygwbpanhfxucpx');
$nTo = $email_admin; //Ten nguoi nhan
$mTo = $email_admin;   //dia chi nhan mail
$mail = new PHPMailer();
$title = 'Tư vấn khách hàng';   //Tieu de gui mail
$mail->isSMTP();

$mail->CharSet  = "utf-8";
$mail->SMTPDebug  = 0;   // enables SMTP debug information (for testing)
$mail->SMTPAuth   = true;    // enable SMTP authentication
$mail->Host       = "smtp.gmail.com";    // sever gui mail.

$mail->SMTPSecure = "tls";         //If SMTP requires TLS encryption then set it
$mail->Port = 587;    //Set TCP port to connect to
// xong phan cau hinh bat dau phan gui mail
$mail->Username   = $mFrom;  // khai bao dia chi email
$mail->Password   = $mPass;              // khai bao mat khau
$mail->SetFrom($mFrom, $nFrom);
$mail->AddReplyTo($email_admin, 'Thuoc.com.vn'); //khi nguoi dung phan hoi se duoc gui den email nay
$mail->Subject    = $title;// tieu de email

$final_msg = preparehtmlmail($noidung);

$mail->MsgHTML($noidung);// noi dung chinh cua mail se nam o day.
$mail->AddAddress($mTo, $nTo);

// thuc thi lenh gui mail
if(!$mail->Send()) {
    echo 'Có lỗi trong quá trình gửi mail. Xin vui lòng thử lại sau!.';
} else {
    echo 'Mail của bạn đã được gửi đi hãy kiếm tra hộp thư đến để xác thực tài khoản. Xin cám ơn. ';
}