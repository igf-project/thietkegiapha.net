<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
include_once(EXT_PATH.'cls.upload.php');
$objUpload=new CLS_UPLOAD();
if(!$objmem) $objmem=new CLS_MEMBER();
if(isset($_POST['save'])){
    $thongbao='';
    $objmem->UserName = $_SESSION['MEMBER_LOGIN_'.md5($_SERVER['HTTP_HOST'])]['username'];
    $objmem->FirstName = addslashes($_POST['txt_firstname']);
    $objmem->LastName = addslashes($_POST['txt_lastname']);
    $objmem->Birthday = date('Y-m-d',$_POST['txt_birthday']);
    $objmem->Gender = (int)$_POST['txt_gender'];
    $objmem->Address = addslashes($_POST['txt_address']);
    $objmem->Phone = addslashes($_POST['txt_phone']);
    $objmem->Email = addslashes($_POST['txt_email']);
    if(isset($_FILES['fileImg'])){
        $path=BASEVIRTUAL0;
        $objmem->Avatar = $objUpload->UploadFile('fileImg', $path);
    }else{
        $objmem->Avatar = addslashes($_POST['url_image']);
    }
    if($objmem->Update()){
        $thongbao='Cập nhật thành công!';
    }else{
        $thongbao='Cập nhật không thành công!';
    }
}
if($objmem->isLogin()==true){
    $thisUser=$objmem->getInfo('username');
    $objmem->getList("WHERE `username`='$thisUser'");
    $row=$objmem->Fetch_Assoc();
    $first=$row['firstname'];
    $last=$row['lastname'];
?>
<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-3 column-item">
                <?php include_once(MOD_PATH.'mod_member/layout.php');?>
            </div>
            <div class="col-md-9 column-item">
                <div class="box-content">
                    <div class="frm-control">
                        <h3 class="h3-header">Cập nhật thông tin cá nhân</h3>
                        <div id="thongbao"><?php echo $thongbao; ?></div>
                        <div class="clearfix"></div>
                    </div>
                    <form style="margin-top: 15px" id="frm_action" name="frm_action" method="post" action=""  class="form-horizontal" enctype="multipart/form-data">
                        <input name="txtid" type="hidden" value="<?php echo $row['mem_id'];?>">
                            <div class='form-group'>
                                <label class="col-sm-3 control-label"><strong>Tên</strong></label>
                                <div class="col-sm-9">
                                    <input name="txt_firstname" type="text" id="txt_firstname" size="45" class='form-control' value="<?php echo $first;?>" placeholder='' />
                                </div>
                            </div>

                            <div class='form-group'>
                                <label class="col-sm-3 control-label"><strong>Họ</strong></label>
                                <div class="col-sm-9">
                                    <input name="txt_lastname" type="text" id="txt_lastname" size="45" class='form-control' value="<?php echo $last;?>" placeholder='' />
                                </div>
                            </div>

                            <div class='form-group'>
                                <label class="col-sm-3 control-label"><strong>Ngày sinh</strong></label>
                                <div class="col-sm-9">
                                    <input name="txt_birthday" type="date" id="txt_birthday" size="45" class='form-control' value="<?php echo $row['birthday'];?>" placeholder='' />
                                </div>
                            </div>

                            <div class='form-group'>
                                <label class="col-sm-3 control-label"><strong>Giới tính</strong></label>
                                <div class="col-sm-9">
                                    <input name="txt_gender" type="radio" size="45" class='' value="0" placeholder='' <?php echo $row['gender']==0? 'checked':'';?>>Nam
                                    <input name="txt_gender" type="radio" size="45" class='' value="1" placeholder='' <?php echo $row['gender']==1? 'checked':'';?>>Nữ
                                </div>
                            </div>
                            <div class='form-group'>
                                <label class="col-sm-3 control-label"><strong>Địa chỉ</strong></label>
                                <div class="col-sm-9">
                                    <input name="txt_address" type="text" id="txt_address" size="45" class='form-control' value="<?php echo $row['address'];?>" placeholder='' />
                                </div>
                            </div>
                        <div class='form-group'>
                            <label class="col-sm-3 control-label"><strong>Phone</strong></label>
                            <div class="col-sm-9">
                                <input name="txt_phone" type="number" id="txt_phone" size="45" class='form-control' value="<?php echo $row['phone'];?>" placeholder='' />
                            </div>
                        </div>
                        <div class='form-group'>
                            <label class="col-sm-3 control-label"><strong>Email</strong></label>
                            <div class="col-sm-9">
                                <input name="txt_email" type="email" id="txt_email" size="45" class='form-control' value="<?php echo $row['email'];?>" placeholder='' />
                            </div>
                        </div>
                         <div class='form-group'>
                            <label class="col-sm-3 control-label"><strong>Ảnh đại diện</strong></label>
                            <div class="col-sm-9">
                                <input name="fileImg" type="file" id="file-thumb" size="45" class='form-control' placeholder='' />
                                <input name="url_image" type="hidden" value="<?php echo $row['avatar'];?>"/>
                                <div id="show-img">
                                    <img class="img-display" src="<?php echo $row['avatar']!='' ? $row['avatar'] : ROOTHOST.AVATAR_DEFAULT;?>">
                                </div>
                            </div>
                        </div>
                        </div><br><br>
                        <div class="text-center"><input type="submit" name="save" id="save" value="Save"></div>
                </form>
            </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
<?php }?>
<script>
    $(document).ready(function() {
        /* load thumb when select File*/
        $("input#file-thumb").change(function(e) {

            for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
                var file = e.originalEvent.srcElement.files[i];
                var img = document.createElement("img");
                var reader = new FileReader();
                reader.onloadend = function() {
                    img.src = reader.result;
                }
                reader.readAsDataURL(file);
                $('#show-img').addClass('show-img');
                $('#show-img').html(img);
            }
        });
    });
</script>