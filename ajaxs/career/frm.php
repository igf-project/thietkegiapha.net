<?php
session_start();
include_once('../../includes/gfconfig.php');
include_once('../../includes/gfinnit.php');
include_once('../../libs/cls.mysql.php');
?>
<div id="BoxRegister" class='frm row'>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Gửi thông tin của bạn cho chúng tôi</h4>
        <p>Nhập nội dung gửi thông tin của bạn, chúng tôi sẽ liên hệ với bạn sớm nhất</p>
    </div>
	<form class="book-frm frm-register">
		<div class='col-md-2'></div>
		<div class='col-md-8'>
			<div class="form-group"><div class='row'>
				<div class='col-md-6'>
					<input type="text" id='last_name' id='last_name' class="form-control" placeholder="Họ">
				</div>
				<div class='col-md-6'>
					<input type="text" id='first_name' id='first_name' class="form-control" placeholder="Tên">
				</div>
			</div></div>
			<div class="form-group">
				<input name="txt_email" type="email" id='username' class="form-control" placeholder="Email">
			</div>
            <div class="form-group">
                <input name="txt_phone" id='txt_phone' class="form-control" placeholder="Số điện thoại">
            </div>
            <div class="form-group">
                <input name="txt_school" id='txt_school' class="form-control" placeholder="Tốt nghiệp trường">
            </div>
            <div class="form-group">
                <input name="txt_chuyennganh" id='txt_chuyennganh' class="form-control" placeholder="Chuyên ngành">
            </div>
			<div class="form-group">
				<button type="button" class="btn btn-success btn-login btn-block" id='btn_register'>Gửi đi</button>
			</div>
		</div>
		<div class='col-md-2'></div>
	</form>
</div>
<script>
$(document).ready(function(){
	$('#btn_register').click(function(){
		if(!checkinput()) return;
		var data={};
		data['first_name']=$('#first_name').val();
		data['last_name']=$('#last_name').val();
		data['username']=$('#username').val();
		data['password']=$('#password').val();
		$.post('<?php echo ROOTHOST;?>ajaxs/mem/register.php',{'pdata':data},function(req){
			$('#popup_openlearn .modal-body').html('Loadding');
			if(req!=''){
				alert('Bạn đã đăng ký không thành công!');
			}else{
				$('#popup_openlearn').modal('hide');
				alert('Đăng ký thành công! Hãy đăng nhập ngay hôm nay');
				$('#popup_openlearn').modal('show');
				$('#popup_openlearn .modal-footer').hide();	
				$('#popup_openlearn .modal-header h4').html('Sing In');
				$('#popup_openlearn .modal-body p').html('Loadding');
				$.get('<?php echo ROOTHOST;?>ajaxs/mem/frm_login.php',function(req){
					$('#popup_openlearn .modal-body').html(req);
				})
			}
			
		});
	});
	function checkinput(){
		var user=$('#username').val().trim();
		if(user=='' || user.length<=3){
			alert('Username không được để trống và phải lớn hơn 3 ký tự');
			return false;
		}else if($('#password').val().trim()=='' || $('#password').val()!=$('#repassword').val()){
			alert('Mật khẩu không được để trống và phải được gõ lại chính xác');
			return false;
		}
		return true;
	}
});
</script>