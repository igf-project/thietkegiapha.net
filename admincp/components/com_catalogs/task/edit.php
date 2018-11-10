<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$id="";
if(isset($_GET["id"]))
    $id=trim($_GET["id"]);
$obj->getList(" WHERE `cata_id`='".$id."'");
$row=$obj->Fetch_Assoc();
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
            <input type="hidden" name="txtid" value="<?php echo $row['cata_id'];?>">
            <div class="tab-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="col-sm-3 form-control-label">Tên nhóm*</label>
                            <div class="col-sm-9">
                                <input type="text" name="txt_name" class="form-control" id="txt_name" placeholder="" value="<?php echo $row['name'];?>">
                                <div id="txt_name_err" class="mes-error"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="col-sm-3 form-control-label">Nhóm cha</label>
                            <div class="col-sm-9">
                                <select name="cbo_group" class="form-control" id="cbo_group">
                                    <option value="0" title="Top">Root</option>
                                    <?php $obj->getListCate(0,0); ?>
                                    <script language="javascript">
                                        cbo_Selected('cbo_group','<?php echo $row['par_id'];?>');
                                        $(document).ready(function() {
                                            $("#cbo_group").select2();
                                        });
                                    </script>
                                </select>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-6">
                        <div class='form-group'>
                            <label class="col-sm-3 control-label">Ảnh đại diện*</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <input name="txtthumb" type="text" id="file-thumb" size="45" class='form-control' value="<?php echo $row['thumb'] ?>" placeholder='' />
                                    </div>
                                    <div class="col-sm-3">
                                        <a class="btn btn-success" href="#" onclick="OpenPopup('extensions/upload_image.php');"><b style="margin-top: 15px">Chọn</b></a>
                                    </div>
                                    <div id="txt_thumb_err" class="mes-error"></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="col-sm-3 form-control-label">Hiển thị</label>
                            <div class="col-sm-9">
                                <label class="radio-inline"><input type="radio" value="1" name="opt_isactive" <?php echo $row['isactive']==1 ? 'checked':'';?>>Có</label>
                                <label class="radio-inline"><input type="radio" value="0" name="opt_isactive" <?php echo $row['isactive']==0 ? 'checked':'';?>>Không</label>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-sm-12">
                        <label for="" class="form-control-label"> Mô tả ngắn</label>
                        <textarea name="txtintro" id="txtintro" cols="45" rows="5"><?php echo $row['intro'] ?></textarea>
                        <script language="javascript">
                            var oEdit2=new InnovaEditor("oEdit2");
                            oEdit2.width="100%";
                            oEdit2.height="100";
                            oEdit2.cmdAssetManager ="modalDialogShow('<?php echo ROOTHOST_ADMIN;?>admincp/extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
                            oEdit2.REPLACE("txtintro");
                            document.getElementById("idContentoEdit2").style.height="300px";
                        </script>
                    </div>
                </div>
            </div>
            <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;" />
        </form>
    </div>
</div>
