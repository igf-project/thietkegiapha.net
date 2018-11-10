<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$id="";
if(isset($_GET["id"]))
    $id=trim($_GET["id"]);
$obj->getList(" WHERE `id`='".$id."'");
$row=$obj->Fetch_Assoc();
$url=$row['link'];
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
            <input type="hidden" name="txtid" value="<?php echo $row['id'];?>">
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
                        <div class='form-group'>
                            <label class="col-sm-3 control-label"><strong>Link video</strong></label>
                            <div class="col-sm-6">
                                <input name="txt_link" type="text" id="txt_link" size="45" class='form-control' value="<?php echo $row['link'];?>" placeholder='Url video from youtube.com' />
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

                    <div class="clearfix"></div>
                </div>
            </div>
            <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;" />
        </form>
    </div>
</div>
<script>
    $('document').ready(function(){
        var url='<?php echo $url;?>';
        var formatStrUrlYoutube = url.toLowerCase().indexOf("youtube");
        var videoId = url.substring(url.indexOf("?v=") + 3);
        $.post('<?php echo ROOTHOST_ADMIN;?>ajaxs/get_info_video/getVideo.php',{videoId, url},function(response_data){
            $('#respon-video').html(response_data);
            $('#respon-video').toggleClass('show');
            $('#msg_link').html('');
            $('#txt_link_err').html('');
        });
        var mes='';
        return false;
    })
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