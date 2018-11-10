<?php
include_once(EXT_PATH.'cls.upload.php');
include(libs_path.'cls.prescription.php');
include(libs_path.'cls.gsick.php');
include (LIB_PATH."cls.mail.php");
$conf = new CLS_CONFIG();
$objUpload=new CLS_UPLOAD();
$objGsick=new CLS_GSICK();
$objPrescription=new CLS_PRESCRIPTION();
$message_ok='';
$err='';
if(isset($_POST['send_prescription'])){
	require_once(ext_path.'PHPMailer/class.phpmailer.php');
	require_once(ext_path.'PHPMailer/class.smtp.php');

	if(isset($_FILES['images_prescription']) AND $_FILES['images_prescription']['name']!=''){
		$path=PATH_FILE;
		$number = count($_FILES['images_prescription']['name']);
		for($i=0;$i<$number;$i++){
			$file[]=$objUpload->UploadFiles('images_prescription', $path,$i);
		}
		$anhdonthuoc = implode(',',$file);
	}
//    if(isset($_FILES['images_kqxetnghiem']) AND $_FILES['images_kqxetnghiem']['name']!=''){
//		$path=PATH_FILE;
//		$number = count($_FILES['images_kqxetnghiem']['name']);
//		for($i=0;$i<$number;$i++){
//			$file[]=$objUpload->UploadFiles('images_kqxetnghiem', $path,$i);
//		}
//		$anh_kqxetnghiem = implode(',',$file);
//	}
//    if(isset($_FILES['images_drug']) AND $_FILES['images_drug']['name']!=''){
//		$path=PATH_FILE;
//		$number = count($_FILES['images_drug']['name']);
//		for($i=0;$i<$number;$i++){
//			$file[]=$objUpload->UploadFiles('images_drug', $path,$i);
//		}
//		$anhthuockhac = implode(',',$file);
//	}

    /*Thông tin người liên hệ*/
    $first_name = addslashes($_POST['txt-firstname']);  // Tên
    $last_name = addslashes($_POST['txt-lastname']);    // Họ
    $address = addslashes($_POST['txt-address']);
    $email = addslashes($_POST['txt-email']);
    $phone = addslashes($_POST['txt-phone']);

	/*Thông tin bệnh nhân*/
	$name = addslashes($_POST['txt-name']);
	$age = addslashes($_POST['txt-age']);
	$clinic = addslashes($_POST['txt_noikham']);    // Địa chỉ khám
	$chandoan = addslashes($_POST['txt-chandoan']);
	$gender = addslashes($_POST['otp_gender']);
    $hoivedonthuoc = strip_tags($_POST['txt-hoivedonthuoc']);

	/*Thông tin không bắt buộc*/
	$benhkhac = addslashes($_POST['ten_benhkhac']);
	$thuockhac = addslashes($_POST['ten_thuockhac']);

    /*Body mail*/
	$noidung="<h1>Thông tin liên hệ:</h1>";
    /*Thông tin liên hệ*/
    if($last_name!="")
        $noidung.="<strong>Họ:</strong> ".$last_name."<br />";
    if($first_name!="")
        $noidung.="<strong>Tên:</strong> ".$first_name."<br />";
    if($address!="")
        $noidung.="<strong>Địa chỉ:</strong> ".$address."<br />";
    if($address!="")
        $noidung.="<strong>Email:</strong> ".$email."<br />";
    if($address!="")
        $noidung.="<strong>Số điện thoại:</strong> ".$phone."<br />";
	/*Thông tin bệnh nhân*/
    $noidung.="<h2 style='font-size: 16px;'>Thông tin bệnh nhân</h2>";
	if($name!="")
		$noidung.="<strong>Họ tên:</strong> ".$name."<br />";
	if($email!="")
		$noidung.="<strong>Tuổi:</strong> ".$age."<br />";
	if($phone!="")
		$noidung.="<strong>Địa chỉ khám:</strong> ".$clinic."<br />";
	if($chandoan!="")
		$noidung.="<strong>Chẩn đoán:</strong> ".$chandoan."<br />";
    if($gender==0){
        $noidung.="<strong>Giới tính:</strong> Nam<br />";
    }else{
        $noidung.="<strong>Giới tính:</strong> Nữ<br />";
    }
	if($hoivedonthuoc!="")
		$noidung.="<strong>Hỏi về đơn thuốc:</strong> ".$hoivedonthuoc."<br />";
	if($benhkhac!=""){
		$noidung.="<strong>Bệnh khác:</strong> ".$benhkhac."<br />";
	}
	if($thuockhac!=""){
		$noidung.="<strong>Các thuốc bệnh nhân đang sử dụng kèm:</strong> ".$thuockhac."<br />";
	}
	
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
}
?>
<script type="text/javascript">
	function show_info($number){
		$('#info'+$number).show(300);
	}
	function hidde_info($number){
		$('#info'+$number).hide(300);
	}
</script>
<h1>Thông tin bệnh cần tư vấn</h1>
<div id="message" class="col-md-12"><?php if($err!='') echo $err;?></div>
<p>Thông tin đơn thuốc cần tư vấn - Hãy gửi thông tin về tình trạng cơ thể & đơn thuốc tương ứng cho chúng tôi để được tư vấn chính xác & hiệu quả nhất quá trình điều trị của bạn.</p>
<form id='frm-prescription' class="frm frm-prescription" name="frm-prescription" role="form" method="post" action="" enctype="multipart/form-data">
	<h2>Thông tin người liên hệ</h2>
    <div class="row">
        <?php if(isset($_SESSION['MEMBER_LOGIN_'.md5($_SERVER['HTTP_HOST'])])){?>
            <div class="col-sm-6 form-group">
                <label>Họ</label>
                <input type="hidden" class="form-control" name="txt-mem_id" value="<?php echo $_SESSION['MEMBER_LOGIN_'.md5($_SERVER['HTTP_HOST'])]['mem_id']?>">
                <input type="text" class="form-control" name="txt-lastname" value="<?php echo $_SESSION['MEMBER_LOGIN_'.md5($_SERVER['HTTP_HOST'])]['lastname'].' '.$_SESSION['MEMBER_LOGIN_'.md5($_SERVER['HTTP_HOST'])]['firstname'];?>" required>
            </div>
            <div class="col-sm-6 form-group">
                <label>Tên</label>
                <input type="text" class="form-control" name="txt-firstname" value="<?php echo $_SESSION['MEMBER_LOGIN_'.md5($_SERVER['HTTP_HOST'])]['firstname'].' '.$_SESSION['MEMBER_LOGIN_'.md5($_SERVER['HTTP_HOST'])]['firstname'];?>" required>
            </div>
            <div class="col-sm-6 form-group">
                <label>Địa chỉ</label>
                <input type="text" class="form-control" name="txt-address" value="<?php echo $_SESSION['MEMBER_LOGIN_'.md5($_SERVER['HTTP_HOST'])]['address']?>" required>
            </div>
            <div class="col-sm-6 form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="txt-email" value="<?php echo $_SESSION['MEMBER_LOGIN_'.md5($_SERVER['HTTP_HOST'])]['email'];?>" required>
            </div>
            <div class="col-sm-6 form-group">
                <label>Số điện thoại</label>
                <input type="phone" class="form-control" name="txt-phone" value="<?php echo $_SESSION['MEMBER_LOGIN_'.md5($_SERVER['HTTP_HOST'])]['phone'];?>">
            </div>
        <?php }else{?>
            <div class="col-sm-6 form-group">
                <label>Họ</label>
                <input type="text" class="form-control" name="txt-lastname" value="" required>
            </div>
            <div class="col-sm-6 form-group">
                <label>Tên</label>
                <input type="text" class="form-control" name="txt-firstname" value="" required>
            </div>
            <div class="col-sm-6 form-group">
                <label>Địa chỉ</label>
                <input type="text" class="form-control" name="txt-address" value="" required>
            </div>
            <div class="col-sm-6 form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="txt-email" value="" required>
            </div>
            <div class="col-sm-6 form-group">
                <label>Số điện thoại</label>
                <input type="text" class="form-control" name="txt-phone" value="">
            </div>
        <?php } ?>
    </div>
    <h2>Thông tin bệnh nhân</h2>
	<div class="row">
        <div class="col-sm-6 form-group">
            <label>Tên bệnh nhân</label>
            <input type="text" class="form-control" name="txt-name" required>
        </div>
        <div class="col-sm-6 form-group">
            <label>Tuổi</label>
            <input type="text" class="form-control" name="txt-age" required>
        </div>
        <div class="col-sm-6 form-group">
            <label>Địa chỉ khám</label>
            <input type="text" class="form-control" name="txt_noikham" placeholder="Bệnh viện hoặc phòng khám tư..." required>
        </div>
        <div class="col-sm-6 form-group">
            <label>Chẩn đoán</label>
            <input type="text" class="form-control" name="txt-chandoan" placeholder="Tên bệnh chẩn đoán được ghi trong đơn thuốc hoặc bệnh án" required>
        </div>
        <div class="col-sm-6">
            <label>Giới tính</label>
            <div class="form-group">
                <label class="radio-inline"><input type="radio" name="otp_gender" value="0" checked>Nam</label>
                <label class="radio-inline"><input type="radio" name="otp_gender" value="1">Nữ</label>
            </div>
        </div>
        <div class="col-sm-6 form-group">
            <label>Ảnh đơn thuốc</label>
            <input type="file" name="images_prescription[]" multiple="multiple" required>
        </div>
        <div class="col-sm-12 form-group">
            <label>Hỏi về đơn thuốc</label>
            <textarea class="form-control" name="txt-hoivedonthuoc" row="5"></textarea>
        </div>
	</div>
	<h2>Thông tin thêm (không bắt buộc)</h2>
    <p>Để thông tin tư vấn được đầy đủ và chính xác nhất, bạn nên trả lời các câu hỏi sau đây. Bạn hãy cố gắng trả lời đầy đủ nhé!</p>
    <p style="font-style: italic">(Bạn hãy đánh đấu “X” vào các mục bạn lựa chọn và Điền thông tin vào dấu “…..” để hoàn thành các thông tin bên dưới nhé!)</p>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label>Tình trạng sức khỏe hiện tại(Có thể chọn nhiều phương án)</label>
                <div class="checkbox">
                    <label><input type="checkbox" name="tinhtrangsuckhoe" value="0">Mang thai</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="tinhtrangsuckhoe" value="1">Cho con bú</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="tinhtrangsuckhoe" data-toggle="collapse" data-target="#info1" value="2">Bệnh mắc kèm</label>
                    <div id="info1" class="collapse">
                        <textarea name="ten_benhkhac" class="form-control" rows="3" placeholder=""></textarea>
                        <p style="font-style: italic">(Nếu có thể bạn hãy đính kèm ảnh kết quả xét nghiệm gần đây nhất, đặc biệt, với bệnh nhân suy thận, chỉ số Creatinin huyết thanh là bao nhiêu:………, cân nặng:……..kg)</p>
                        <input type="file" name="images_kqxetnghiem[]" class="form-control" multiple>
                    </div>
                </div>
			</div>
        </div>
        <div class="col-sm-6">
			<div class="form-group">
				<label>Các thuốc bệnh nhân đang sử dụng kèm:</label>
				<div class="radio">
					<label><input type="radio" onclick="hidde_info(1)" name="thuockhac" value="0">Không</label>
				</div>
				<div class="radio">
					<label><input type="radio" name="thuockhac" onclick="show_info(1)" value="1">Có</label>
				</div>
				<div id="info1" class="collapse">
					<textarea rows="3" class="form-control" name="ten_thuockhac" placeholder="Tên các loại thuốc"></textarea>
					<p style="font-style: italic">(Nếu có thể bạn hãy đính kèm ảnh đơn thuốc/ vỏ thuốc bệnh nhân đang dùng kèm)</p>
					<input type="file" name="images_drug[]" class="form-control" multiple>
				</div>
			</div>
		</div>
	</div><br/><br/>
	<div class="text-center"><button type="submit" name="send_prescription" class="btn btn-primary">Gửi yêu cầu</button></div>
</form>
