<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
?>
<div id="action">
    <script language="javascript">
        function checkinput(){
            if($("#txt_name").val()==""){
                $("#txt_name_err").fadeTo(200,0.1,function(){
                    $(this).html('Vui lòng nhập tên video').fadeTo(900,1);
                });
                $("#txt_name").focus();
                return false;
            }
            if($("#txt_link").val()==""){
                $("#txt_link_err").fadeTo(200,0.1,function(){
                    $(this).html('Vui lòng nhập Url video').fadeTo(900,1);
                });
                $("#txt_link").focus();
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
                            <label for="" class="col-sm-3 form-control-label">Tiêu đề</label>
                            <div class="col-sm-9">
                                <input type="text" name="txt_name" class="form-control" id="txt_name" placeholder="">
                                <div id="txt_name_err" class="mes-error"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class='form-group'>
                            <label class="col-sm-3 control-label"><strong>Link video</strong></label>
                            <div class="col-sm-6">
                                <input name="txt_link" type="text" id="txt_link" size="45" class='form-control' value="" placeholder='Url video from youtube.com' />
                                <div id="txt_link_err" class="mes-error"></div>
                                <span class="msg-notic " id="msg_link"></span>
                            </div>
                            <div class="col-sm-3">
                                <button class="btn btn-block" id="btn-video">Check Video</button>
                            </div>
                            <div class="clearfix"></div>
                            <div class="respon" id="respon-video"></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <p>Lưu ý: Sau khi pase link video từ youtube, cần "Check video" để kiểm tra video trả về từ Youtube là chính xác hay không</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;" />
        </form>
    </div>
    <script>
        $('#btn-video').click(function(){
            var url=$('#txt_link').val();

            var formatStrUrlYoutube = url.toLowerCase().indexOf("youtube");
            if (url!="" && formatStrUrlYoutube >= 0){
                var videoId = url.substring(url.indexOf("?v=") + 3);
                $.post('<?php echo ROOTHOST_ADMIN;?>ajaxs/get_info_video/getVideo.php',{videoId, url},function(response_data){
                    $('#respon-video').html(response_data);
                    $('#respon-video').toggleClass('show');
                    $('#msg_link').html('');
                    $('#txt_link_err').html('');
                });
                var mes='';
            }
            else {
                mes='Vui lòng nhập đường dẫn chính xác';
                $('#msg_link').html(mes);
                return false;
            }
            return false;
        })
    </script>
</div>