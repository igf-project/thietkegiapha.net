<?php
defined("ISHOME") or die("Can't acess this page, please come back!")
?>
<div id="action">
    <script language="javascript">
        function checkinput(){
            if($("#txtname").val()=="")
            {
                $("#txtname_err").fadeTo(200,0.1,function()
                { 
                    $(this).html('Vui lòng nhập tên').fadeTo(900,1);
                });
                $("#txtname").focus();
                return false;
            }
            return true;
        }
    </script>
    <form id="frm_action" name="frm_action" method="post" action="">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-sm-3 form-control-label">Tiêu đề*</label>
                    <div class="col-sm-9">
                        <input type="text" name="txtname" class="form-control" id="txtname" placeholder="">
                        <div id="txt_name_err" class="mes-error"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 form-control-label">Nhóm người dùng</label>
                    <div class="col-sm-9">
                        <select name="cbo_parid" id="cbo_parid" class="form-control">
                            <option value="0" selected="selected">Root</option>
                            <?php $obj->getListGmem(0,0); ?>
                        </select>
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $("#cbo_parid").select2();
                            });
                        </script>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 form-control-label">Nổi bật</label>
                    <div class="col-sm-9">
                        <label class="radio-inline"><input type="radio" value="1" name="optactive" checked >Có</label>
                        <label class="radio-inline"><input type="radio" value="0" name="optactive">Không</label>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group">
            <label for="" class="form-control-label">Mô tả</label>
            <textarea name="txtdesc" id="txtdesc" class="form-control"></textarea>
            <script language="javascript">
                var oEdit1=new InnovaEditor("oEdit1");
                oEdit1.width="100%";
                oEdit1.height="300";
                oEdit1.cmdAssetManager ="modalDialogShow('<?php echo ROOTHOST_ADMIN;?>extensions/editor/innovar/assetmanager/assetmanager.php',640,865)";
                oEdit1.REPLACE("txtdesc");
            </script>
        </div>
        
        <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
    </form>
</div>