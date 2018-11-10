<?php
if(isset($_POST['button-submit'])){
    include (LIB_PATH."cls.mail.php");
    $conf = new CLS_CONFIG();
    $message_ok='';
    $err='';

    $name = addslashes($_POST['txt-name']);
    $job = addslashes($_POST['txt-job']);
    $phone = addslashes($_POST['txt-phone']);
    $email = addslashes($_POST['txt-email']);
    $namsinh = (int)$_POST['txt-year-of-birth'];
    $ask = addslashes($_POST['txt-ask']);
    /*Send mail*/
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
    $title = 'Hướng dẫn khám bệnh';   //Tieu de gui mail
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
    $mail->MsgHTML($noidung);// noi dung chinh cua mail se nam o day.
    $mail->AddAddress($mTo, $nTo);

    // thuc thi lenh gui mail
    if(!$mail->Send()) {
        echo 'Có lỗi trong quá trình gửi mail. Xin vui lòng thử lại sau!.';
    } else {
        echo 'Mail của bạn đã được gửi đi hãy kiếm tra hộp thư đến để xác thực tài khoản. Xin cám ơn. ';
    }
}
?>
<div class="box-breadcrumb">
    <ul class="breadcrumb">
        <li><a href="<?php echo ROOTHOST;?>" title="Trang chủ">Trang chủ</a></li>
        <li class="active">Hướng dẫn khám bệnh</li>
    </ul>
</div>
<form class="col-md-8 col-sm-offset-2" name="frm-hdkhambenh" method="post" action="" role="form">
    <h1>Hướng dẫn khám bệnh</h1>
    <div class="form-group">
        <label>Tên</label>
        <input type="text" class="form-control" name="txt-name" required>
    </div>
    <div class="form-group">
        <label>Nghề nghiệp</label>
        <input type="text" class="form-control" name="txt-job" required>
    </div>
    <div class="form-group">
        <label>Điên thoại</label>
        <input type="phone" class="form-control" name="txt-phone" required>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" name="txt-email">
    </div>
    <div class="form-group">
        <label>Năm sinh</label>
        <input type="number" class="form-control" name="txt-year-of-birth" required>
    </div>
    <div class="form-group">
        <label>Hỏi bác sỹ</label>
        <textarea class="form-control" name="txt-ask" rows="5" required></textarea>
    </div>
    <div class="text-center"><button type="submit" name="button-submit" class="btn btn-success">Gửi yêu cầu</button> </div>
</form>
