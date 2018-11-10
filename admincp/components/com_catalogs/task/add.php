
<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
?>
<div id="action">
    <script language="javascript">
        function checkinput(){
            if($("#txt_name").val()==""){
                $("#txt_name_err").fadeTo(200,0.1,function(){
                    $(this).html('Vui lòng nhập tên nhóm').fadeTo(900,1);
                });
                $("#txt_name").focus();
                return false;
            }
            return true;
        }
    </script>
    <div class="box-tabs">
        <form id="frm_action" name="frm_action" method="post" action=""  enctype="multipart/form-data">
            <div class="tab-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="col-sm-3 form-control-label">Tên nhóm*</label>
                            <div class="col-sm-9">
                                <input type="text" name="txt_name" class="form-control" id="txt_name" placeholder="">
                                <div id="txt_name_err" class="mes-error"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="col-sm-3 form-control-label">Nhóm cha*</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="cbo_group" name="cbo_group">
                                    <option value="">Root</option>
                                    <?php $obj->getListCate(0,0); ?>
                                </select>
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        $("#cbo_group").select2();
                                    });
                                </script>
                                <div id="cbo_group_err" class="mes-error"></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-6">
                        <div class='form-group'>
                            <label class="col-sm-3 control-label">Hình ảnh*</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <input name="txtthumb" type="text" id="file-thumb" size="45" class='form-control' value="" placeholder='' />
                                    </div>
                                    <div class="col-sm-3">
                                        <a class="btn btn-success" href="#" onclick="OpenPopup('extensions/upload_image.php');"><b style="margin-top: 15px">Chọn</b></a>
                                    </div>
                                    <div id="txt_thumb_err" class="mes-error"></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="col-sm-3 form-control-label">Hiển thị</label>
                            <div class="col-sm-9">
                                <label class="radio-inline"><input type="radio" value="1" name="opt_isactive" checked>Có</label>
                                <label class="radio-inline"><input type="radio" value="0" name="opt_isactive">Không</label>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="" class="form-control-label"> Mô tả</label>
                        <textarea name="txtintro" id="txtintro" cols="85" rows="20"></textarea>
                        <script language="javascript">
                            var oEdit1=new InnovaEditor("oEdit1");
                            oEdit1.width="100%";
                            oEdit1.height="300";
                            oEdit1.cmdAssetManager ="modalDialogShow('<?php echo ROOTHOST_ADMIN;?>extensions/editor/innovar/assetmanager/assetmanager.php',640,865)";
                            oEdit1.REPLACE("txtintro");
                        </script>
                    </div>
                </div>
            </div>
            <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;" />
        </form>
    </div>
</div>