<style>
    #menus{
        display: none;
    }
    .title-header{
        background-color: #eee;
        padding: 20px;
        font-size: 24px;
        margin-top: 0px;
        margin-bottom: 20px;
    }
    .page-content-wrapper .page-content {
        min-height: 700px;
    }
</style>
<h2 class="title-header" title="Gửi tin tới khách hàng">Gửi tin tới khách hàng</h2>
<?php
if(isset($_GET['task'])) $task=$_GET['task'];
require_once(libs_path.'cls.category.php');
require_once(libs_path.'cls.content.php');
require_once(libs_path.'cls.mail.php');
if (!isset($objmysql)) $objmysql=new CLS_MYSQL;
include_once('../'.EXT_PATH."PHPMailer/class.phpmailer.php");
$tmp_box="";$tmp_mailto="";$list_mail=array();$message="";

if(isset($_POST['sl_box']) AND $_POST['sl_box'] !="all") {
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    $_SESSION['BOX_ID']=$_POST['sl_box'];
}

$tmp_box=isset($_SESSION['BOX_ID'])? $_SESSION['BOX_ID']:'';
//lay mail nguoi gui
$conf = new CLS_CONFIG();
$conf->getList();
if ($conf->Num_rows()>0) {
    $row_conf=$conf->Fetch_Assoc();
    $email_conf=$row_conf['email'];
    $email_exp=explode(',,|', $email_conf);
    $email_from=$email_exp[0];
    // echo $email_from;
    // echo "<pre>";
    // print_r($row_conf);
    // echo "</pre>";
}

if(isset($_POST['cmdsend'])){
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    // lấy danh sách mail người tới
    $txt_difmail=isset($_POST['txt_difmail']) ? trim($_POST['txt_difmail']) :"";
    $txt_subject=isset($_POST['txt_subject']) ? trim($_POST['txt_subject']) :"";
    $txt_content=isset($_POST['txt_content']) ? trim($_POST['txt_content']) :"";
    $arr_mail=$_POST['cbo_mail'];
    $count=count($arr_mail);
    $email_to="";
    $objMailer=new CLS_MAILER();
    $email_admin=SMTP_USER;
    for ($i=0; $i <$count ; $i++) {

        if($arr_mail[$i] !="") {
            $nFrom = SMTP_COMPANY;    //mail duoc gui tu dau, thuong de ten cong ty ban
            $mFrom =$email_admin;  //dia chi email cua ban
            $mPass =SMTP_PASS;       //mat khau email cua ban   define('SMTP_PASS_AUT','gfygwbpanhfxucpx');
            $nTo = $email_admin; //Ten nguoi nhan
            $mTo = $arr_mail[$i];   //dia chi nhan mail
            $mail = new PHPMailer();
            $title = SMTP_COMPANY_SHORT." - ".$txt_subject."> \r\n";   //Tieu de gui mail
            $mail->isSMTP();

            $mail->CharSet  = "utf-8";
            $mail->SMTPDebug  = 0;   // enables SMTP debug information (for testing)
            $mail->SMTPAuth   = true;    // enable SMTP authentication
            $mail->Host       = "smtp.gmail.com";    // sever gui mail.

            $mail->SMTPSecure = "tls";         //If SMTP requires TLS encryption then set it
            $mail->Port = 587;    //Set TCP port to connect to
            // xong phan cau hinh bat dau phan gui mail
            $mail->Username   = $mFrom;  // khai bao dia chi email
            $mail->Password   = $mPass;              // khai bao mat khau
            $mail->SetFrom($mFrom, $nFrom);
            $mail->AddReplyTo($email_admin, $nFrom); //khi nguoi dung phan hoi se duoc gui den email nay
            $mail->Subject    = $title;// tieu de email

            $mail->MsgHTML($txt_content);// noi dung chinh cua mail se nam o day.
            $mail->AddAddress($mTo, $nTo);

            // thuc thi lenh gui mail
            if(!$mail->Send()) {
                $message.=$mTo.' - Gửi lỗi<br/>';
            } else {
                $message.=$mTo.' - Gửi thành công<br/>';
            }
        }

        echo "<script language=\"javascript\">alert('Gửi mail list thành công!')</script>";
        echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
    }
}
?>
<form id="frm_sendmail" name="frm_sendmail" method="POST" action="#" class="col-md-8">
    <div class="form-group">
        <label for="" class="col-sm-4 form-control-label">Nhóm Box chuyên mục*</label>
        <div class="col-sm-8">
            <select name="sl_box" class="form-control" id="sl_box" onchange="document.frm_sendmail.submit();">
                <option value="all">Mời chọn nhóm chuyên mục</option>
                <?php
                if(!isset($obj_cate)) $obj_cate=new CLS_CATEGORY();
                echo $obj_cate->getListCate();
                ?>
                <script language="javascript">
                    cbo_Selected('sl_box','<?php echo $tmp_box;?>');
                </script>
            </select>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-4 form-control-label">Bài viết thuộc nhóm chuyên mục*</label>
        <div class="col-sm-8">
            <select  class="form-control"  id="sl_post" name="sl_post">
                <option value="">Mời chọn bài viết</option>
                <?php
                if(!isset($objcontent)) $objcontent=new CLS_CONTENTS;
                $objcontent->getList(" WHERE `cate_id`=$tmp_box");
                while($row=$objcontent->Fetch_Assoc()){ ?>
                    <option value="<?php echo $row['id'] ;?>">&nbsp;&nbsp;&nbsp;<?php echo trim($row['title']) ;?></option>
                <?php }?>
            </select>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-4 form-control-label">Tiêu đề thư*</label>
        <div class="col-sm-8">
            <input name="txt_subject" type="text" id="txt_subject" class="form-control" value=""/>
        </div>
        <div class="clearfix"></div>
    </div>
    <?php
    if(isset($_SESSION['customer_mail'])){?>
        <div class="form-group">
            <label for="" class="col-sm-4 form-control-label">Danh sách gửi*</label>
            <div class="col-sm-8">
                <select id="ms" multiple="multiple" class="" name="cbo_mail[]">
                    <?php
                    $arr=explode(',',substr($_SESSION['customer_mail'],0,-1));
                    foreach($arr as $rw){
                        $name=$obj->getNameByID($rw);
                        if($name!='') echo '<option value="'.$name.'" selected="true">'.$name.'</option>';
                    }
                    ?>
                </select>
                <link rel="stylesheet" href="<?php echo ROOTHOST.THIS_TEM_ADMIN_PATH."css/multiple-select.css";?>" />
                <script src="<?php echo ROOTHOST.THIS_TEM_ADMIN_PATH."js/multiple-select.js";?>"></script>
                <script>
                    $(function() {
                        $('#ms').change(function() {
                            console.log($(this).val());
                        }).multipleSelect({
                            width: '100%'
                        });
                    });
                </script>
            </div>
            <div class="clearfix"></div>
        </div>
    <?php }?>
    <div id="respon">
        <div class="form-group">
            <label for="" class="form-control-label"> Nội dung</label>
            <textarea name="txt_content" id="txt_content" cols="45" rows="5"></textarea>
            <script language="javascript">
                var oEdit3=new InnovaEditor("oEdit3");
                oEdit3.width="100%";
                oEdit3.height="100";
                oEdit3.cmdAssetManager ="modalDialogShow('<?php echo ROOTHOST;?>extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
                oEdit3.REPLACE("txt_content");
            </script>
        </div>
    </div>


    <div class="form-group">
        <label for="" class="col-sm-4 form-control-label"></label>
        <div class="col-sm-8">
            <input type="submit" name="cmdsend" id="cmdsend"  class="btn btn-primary" value="Gửi mail">
            <input type="reset" name="cmdreset" id="cmdreset"  class="btn btn-default" value="Huỷ bỏ">
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
</form>

<script type="text/javascript">
    $(document).ready(function(){
        var arr=[];
        var sl_post=document.forms['frm_sendmail'].sl_post;
        $("#sl_post").change(function(){
            var index_post=sl_post.selectedIndex;
            var post_id=sl_post[index_post].value;
            $.get('<?php echo ROOTHOST ;?>ajaxs/load_post.php',{'id_post':post_id},function(data){
                var getData=$.parseJSON(data);
                $("#txt_subject").val(getData['0']['title_post']);
                var content=getData['0']['content_post'];
                var iframe = document.getElementById('idContentoEdit3');
                iframe = iframe.contentWindow || ( iframe.contentDocument.document || iframe.contentDocument);
                iframe.document.write(content);


            });

        });

    });
</script>

