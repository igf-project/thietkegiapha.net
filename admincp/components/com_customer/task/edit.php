<?php
	defined("ISHOME") or die("Can't acess this page, please come back!");
require_once("includes/toolbar.php");
	$id="";
	if(isset($_GET["id"]))
		$id=trim($_GET["id"]);
	$obj->getList(" WHERE `id`='".$id."'");
	$row=$obj->Fetch_Assoc();
?>
<div id="action">
    <script language="javascript">
        function checkinput(){
            if($("#txt_name").val()==""){
                $("#txt_name_err").fadeTo(200,0.1,function(){
                    $(this).html('Vui lòng nhập tên bài viết').fadeTo(900,1);
                });
                $("#txt_name").focus();
                return false;
            }
            return true;
        }
    </script>
        <form id="frm_action" name="frm_action" method="post" action=""  enctype="multipart/form-data">
            <input type="hidden" name="txtid" value="<?php echo $row['id'];?>">
                <div class='form-group'>
                    <label class="col-sm-3 control-label"><strong>Họ và tên</strong></label>
                    <div class="col-sm-9">
                        <input name="txt_name" type="text" id="txt_name" class='form-control' value="<?php echo $row['name'];?>" placeholder='' />
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class='form-group'>
                    <label class="col-sm-3 control-label"><strong>Phone</strong></label>
                    <div class="col-sm-9">
                        <input name="txt_phone" type="text" id="txt_phone" class='form-control' value="<?php echo $row['phone'];?>" placeholder='' />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class='form-group'>
                    <label class="col-sm-3 control-label"><strong>Email</strong></label>
                    <div class="col-sm-9">
                        <input name="txt_email" type="text" id="txt_email" class='form-control' value="<?php echo $row['email'];?>" placeholder='' />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;" />
        </form>
    </div>
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