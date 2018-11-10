<?php
defined("ISHOME") or die("Can not acess this page, please come back!");
$flag=false;
if(!isset($UserLogin)) $UserLogin=new CLS_USERS;
if($UserLogin->isAdmin()==true)
  $flag=true;
if($flag==false){
  echo ('<div id="action" style="background-color:#fff"><h4>Bạn không có quyền truy cập. <a href="index.php">Vui lòng quay lại trang chính</a></h4></div>');
  return false;
}
?>
<div id="action">
    <script language="javascript">
        function checkinput(){
            if($('#chk_user').val()=="0") {
                alert("Tên đăng nhập đã có trong hệ thống. Vui lòng nhập tên khác");
                $('#txt_username').focus();
                return false;
            }
            return true;
        }
        $(document).ready(function(){
            $("#txtusername").blur(function() {
                var username = $('#txtusername').val();  
                $.post("ajaxs/user/getuser.php", {username: username },function(result){
                    if(result=='0'){
                        $('#username_result').html('<img src="images/icon_true.png" width="20" align="middle"/> Tên có thể sử dụng');  
                        $('#chk_user').val('1');
                        return true;
                    }else{
                        $('#username_result').html('<img src="images/icon_false.png" width="20" align="middle"/> Tên đã tồn tại. Vui lòng nhập tên khác');  
                        $('#chk_user').val('0');
                        return false;
                    }  
                });  
            })
        });
    </script>
    <form id="frm_action" name="frm_action" method="post" action="">
        <div class="row">
            <div class="col-sm-6">
                <p>Các mục đánh dấu <font color="red">*</font> là thông tin bắt buộc</p>
                <span id="msgbox" style="display:none"></span>
                <input type="hidden" name="checkuser" id="checkuser" value="" />
                <input name="txttask" type="hidden" id="txttask" value="1" />
                <div class="form-group">
                    <label for="" class="col-sm-3 form-control-label">Tên đăng nhập*</label>
                    <div class="col-sm-9">
                        <input type="text" name="txtusername" class="form-control" id="txtusername" placeholder="">
                        <input type="hidden" name="chk_user" id="chk_user" value=""/>
                        <span id="username_result"></span>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 form-control-label">Mật khẩu*</label>
                    <div class="col-sm-9">
                        <input type="password" name="txtpassword" class="form-control" id="txtpassword" placeholder="">
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 form-control-label">Nhập lại mật khẩu*</label>
                    <div class="col-sm-9">
                        <input type="password" name="txtrepass" class="form-control" id="txtrepass" placeholder="">
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <h4>Thông tin người dùng</h4>
                <div class="form-group">
                    <label for="" class="col-sm-3 form-control-label">Họ & đệm*</label>
                    <div class="col-sm-9">
                        <input type="text" name="txtfirstname" class="form-control" id="txtfirstname" placeholder="">
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 form-control-label">Tên*</label>
                    <div class="col-sm-9">
                        <input type="text" name="txtlastname" class="form-control" id="txtlastname" placeholder="">
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 form-control-label">Ngày sinh*</label>
                    <div class="col-sm-9">
                        <input type="date" name="txtbirthday" class="form-control" id="txtbirthday" placeholder="">
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 form-control-label">Giới tính*</label>
                    <div class="col-sm-9">
                        <label class="radio-inline"><input type="radio" name="optgender" value="0" checked>Nam</label>
                        <label class="radio-inline"><input type="radio" name="optgender" value="1">Nữ</label>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 form-control-label">Địa chỉ</label>
                    <div class="col-sm-9">
                        <input type="text" name="txtaddress" class="form-control" id="txtaddress" placeholder="">
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 form-control-label">Điện thoại</label>
                    <div class="col-sm-9">
                        <input type="text" name="txtphone" class="form-control" id="txtphone" placeholder="">
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 form-control-label">Email</label>
                    <div class="col-sm-9">
                        <input type="text" name="txtemail" class="form-control" id="txtemail" placeholder="">
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 form-control-label">Điện thoại di động</label>
                    <div class="col-sm-9">
                        <input type="text" name="txtmobile" class="form-control" id="txtmobile" placeholder="">
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 form-control-label">Nhóm quyền</label>
                    <div class="col-sm-9">
                        <select name="cbo_gmember" id="cbo_gmember" class="form-control">
                            <option value="0">Chọn nhóm quyền</option>
                            <?php $obj_guser->getListGmem(0,0); ?>
                        </select>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 form-control-label">Tình trạng</label>
                    <div class="col-sm-9">
                        <label class="radio-inline"><input name="optactive" type="radio" value="1" checked>Active</label>
                        <label class="radio-inline"><input name="optactive" type="radio" value="0">Deactive</label>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
    </form>
</div>