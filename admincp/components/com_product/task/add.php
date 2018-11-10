<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$cur_date=date('Y-m-d');
$sql="SELECT count(*) as total FROM `tbl_product` where `cdate` LIKE'".$cur_date."%'";
$obj_sql=new CLS_MYSQL;
$obj_sql->Query($sql);
$r=$obj_sql->Fetch_Assoc();
$count=$r['total'];
$count++;
if(0<$count && $count<10)           
    $count='0'.$count;
$pro_code=SHOP_CODE.date('dmy').'-'.$count;
?>
<script language="javascript">
    function checkinput(){
        if($("#txt_name").val()==""){
            $("#txt_name_err").fadeTo(200,0.1,function(){
                $(this).html('Vui lòng nhập tên SP').fadeTo(900,1);
            });
            $("#txt_name").focus();
            return false;
        }
        if($("#txt_pro_code").val()==""){
            $("#txt_pro_code_err").fadeTo(200,0.1,function(){
                $(this).html('Vui lòng nhập mã SP').fadeTo(900,1);
            });
            $("#txt_pro_code").focus();
            return false;
        }
        if($("#cbo_group").val()==""){
            $("#cbo_group_err").fadeTo(200,0.1,function(){
                $(this).html('Vui lòng chọn Group sản phẩm').fadeTo(900,1);
            });
            $("#cbo_group").focus();
            return false;
        }
        return true;
    }
</script>
<div class="box-tabs">
    <ul class="nav nav-tabs" role="tablist">
        <li class="active">
            <a href="#info" role="tab" data-toggle="tab">
                <icon class="fa fa-sms"></icon>Thông tin chung
            </a>
        </li>
        <li>
            <a href="#seo" role="tab" data-toggle="tab">
                <i class="fa fa-contact"></i> Từ khóa seo
            </a>
        </li>
    </ul>
    <div id="action">
        <form id="frm_action" name="frm_action" method="post" action=""  enctype="multipart/form-data">
            <div class="tab-content">
                <div class="tab-pane fade active in" id="info">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="col-sm-3 form-control-label">Tên *</label>
                                <div class="col-sm-9">
                                    <input type="text" name="txt_name" class="form-control" id="txt_name" placeholder="">
                                    <div id="txt_name_err" class="mes-error"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="col-sm-3 form-control-label">Mã *</label>
                                <div class="col-sm-9">
                                    <input type="text" name="txt_pro_code" class="form-control" value="<?php echo $pro_code;?>" id="txt_pro_code" readonly>
                                    <div id="txt_name_code_err" class="mes-error"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="col-sm-3 form-control-label">Nhóm *</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="cbo_group" name="cbo_group">
                                        <option value="">Root</option>
                                        <?php $obj_cata->getListCate(0,0); ?>
                                    </select>
                                    <div id="cbo_group_err" class="mes-error"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="col-sm-3 form-control-label">Giá</label>
                            <div class="col-sm-9">
                                <input class="form-control" name="txt_oldprice" type="text" value='' required/>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="col-sm-3 form-control-label">Giá KM</label>
                            <div class="col-sm-9">
                                <input class="form-control" name="txt_curprice" type="text" value=''/>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="col-sm-3 form-control-label">Số lượng</label>
                            <div class="col-sm-9">
                                <input class="form-control" name="txt_quantity" min="0" type="number" value=''/>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="col-sm-3 form-control-label">Sp Hot</label>
                            <div class="col-sm-9">
                                <label class="radio-inline"><input name="opt_ishot" type="radio" id="radio" value="1" />Có</label>
                                <label class="radio-inline"><input name="opt_ishot" type="radio" id="radio2" value="0" checked='true' />Không</label>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="col-sm-3 form-control-label">Hiển thị</label>
                            <div class="col-sm-9">
                                <label class="radio-inline"><input name="opt_active" type="radio" value="1" checked='true' />Có</label>
                                <label class="radio-inline"><input name="opt_active" type="radio" value="0" />Không</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class='form-group'>
                                <label class="col-sm-3 control-label">Ảnh đại diện*</label>
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
                    </div>
                    <div class="form-group">
                        <label for="" class="form-control-label"> Mô tả ngắn</label>
                        <textarea name="txtintro" id="txtintro" cols="45" rows="5"></textarea>
                        <script language="javascript">
                            var oEdit1=new InnovaEditor("oEdit1");
                            oEdit1.width="100%";
                            oEdit1.height="150";
                            oEdit1.cmdAssetManager ="modalDialogShow('<?php echo ROOTHOST_ADMIN;?>admincp/extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
                            oEdit1.REPLACE("txtintro");
                        </script>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-control-label"> Nội dung</label>
                        <textarea name="txtfulltext" id="txtfulltext" cols="45" rows="5"></textarea>
                        <script language="javascript">
                            var oEdit2=new InnovaEditor("oEdit2");
                            oEdit2.width="100%";
                            oEdit2.height="400";
                            oEdit2.cmdAssetManager ="modalDialogShow('<?php echo ROOTHOST_ADMIN;?>admincp/extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
                            oEdit2.REPLACE("txtfulltext");
                        </script>
                    </div>
                </div>
                <div class="tab-pane fade" id="seo">
                    <div class='form-group'>
                        <label class="col-sm-3 control-label"><strong>Mô tả tiêu đề</strong></label>
                        <div class="col-sm-9">
                            <input name="txt_metatitle" type="text" id="txt_metatitle" class='form-control' value="" placeholder='' />
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class='form-group'>
                        <label class="col-sm-3 control-label"><strong>Từ khóa</strong></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="txt_metakey" id="txt_metakey" size="45"></textarea>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class='form-group'>
                        <label class="col-sm-3 control-label"><strong>Description</strong></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="txt_metadesc" id="txt_metadesc" size="45"></textarea>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </div>
            <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;" />
        </form>
    </div>
</div>