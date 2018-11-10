<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$id="";
if(isset($_GET["id"]))
  $id=trim($_GET["id"]);
$obj->getList(" AND `id`='".$id."'");
$row=$obj->Fetch_Assoc();
$author = $obj_user->getNameById($row['author']);
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
    <div class="box-tabs">
        <ul class="nav nav-tabs" role="tablist">
            <li class="active">
                <a href="#info" role="tab" data-toggle="tab">
                    Thông tin
                </a>
            </li>
            <li>
                <a href="#seo" role="tab" data-toggle="tab">
                    Seo
                </a>
            </li>
        </ul>
        <form id="frm_action" name="frm_action" method="post" action=""  enctype="multipart/form-data">
            <input type="hidden" name="txtid" value="<?php echo $row['id'];?>">
            <div class="tab-content">
                <div class="tab-pane fade active in" id="info">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="col-sm-3 form-control-label">Tiêu đề*</label>
                                <div class="col-sm-9">
                                    <input type="text" name="txt_name" class="form-control" id="txt_name" placeholder="" value="<?php echo $row['title'];?>">
                                    <div id="txt_name_err" class="mes-error"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="col-sm-3 form-control-label">Tác giả</label>
                                <div class="col-sm-9">
                                    <input type="text" name="txt_author" class="form-control" id="txt_author" readonly value="<?php echo $author;?>">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="col-sm-3 form-control-label">Nhóm tin*</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="cbo_cata" name="cbo_cata">
                                        <option value="0" title="Top">Root</option>
                                        <?php $obj_cate->getListCate(0,0); ?>
                                        <script language="javascript">
                                            cbo_Selected('cbo_cata','<?php echo $row['cate_id'];?>');
                                            $(document).ready(function() {
                                                $("#cbo_cata").select2();
                                            });
                                        </script>
                                    </select>
                                    <div id="txt_cata_err" class="mes-error"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class='form-group'>
                                <label class="col-sm-3 control-label"><strong>Hình ảnh*</strong></label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <input name="txtthumb" type="text" id="file-thumb" size="45" class='form-control' value="<?php echo $row['thumb'];?>" placeholder='' />
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
                            <label for="" class="col-sm-3 form-control-label">Hot</label>
                                <div class="col-sm-9">
                                    <label class="radio-inline">
                                        <input type="radio" value="1" name="opt_ishot" <?php echo $row['ishot']==1 ? 'checked':'';?>>Có
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="0" name="opt_ishot" <?php echo $row['ishot']==0 ? 'checked':'';?>>Không
                                    </label>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
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
                    </div>
                    <div class="form-group">
                        <label for="" class="form-control-label"> Tóm tắt</label>
                        <textarea name="txt_intro" id="txt_intro" style="min-height: 80px" class="form-control"><?php echo $row['intro'];?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-control-label"> Nội dung</label>
                        <textarea name="txt_fulltext" id="txt_fulltext" cols="45" rows="5"><?php echo $row['fulltext'];?></textarea>
                        <script language="javascript">
                            var oEdit1=new InnovaEditor("oEdit1");
                            oEdit1.width="100%";
                            oEdit1.height="400";
                            oEdit1.cmdAssetManager ="modalDialogShow('<?php echo ROOTHOST_ADMIN;?>extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
                            oEdit1.REPLACE("txt_fulltext");
                        </script>
                    </div>
                </div>
                <div class="tab-pane fade" id="seo">
                    <div class='form-group'>
                        <label class="col-sm-3 control-label"><strong>Mô tả tiêu đề</strong></label>
                        <div class="col-sm-9">
                            <input name="txt_metatitle" type="text" id="txt_metatitle" class='form-control' value="<?php echo $row['meta_title'];?>" placeholder='' />
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class='form-group'>
                        <label class="col-sm-3 control-label"><strong>Từ khóa</strong></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="txt_metakey" id="txt_metakey" size="45"><?php echo $row['meta_key'];?></textarea>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class='form-group'>
                        <label class="col-sm-3 control-label"><strong>Description</strong></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="txt_metadesc" id="txt_metadesc" size="45"><?php echo $row['meta_desc'];?></textarea>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;" />
            </form>
        </div>
        <script>
            $(document).ready(function() {
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