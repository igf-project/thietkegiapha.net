<?php 
require_once(libs_path.'cls.cart.php');
if(!isset($obj_cart)) $obj_cart= new CLS_CART;
if(!isset($objmem)) $objmem=new CLS_MEMBER;

if(isset($_POST['order'])){
    $total =0;
    for ($i=0; $i <count($_SESSION['CART']) ; $i++) {
        $total += $_SESSION['CART'][$i]['quan']*$_SESSION['CART'][$i]['price'];
    }
    $objdata = new CLS_MYSQL;
    $totalprice = 0;
    $obj_cart->Username = isset($_POST['txt_username'])? addslashes($_POST['txt_username']):'';
    $obj_cart->Fullname =addslashes($_POST['txt_fullname']);
    $obj_cart->Phone =addslashes($_POST['txt_phone']);
    $obj_cart->Address =addslashes($_POST['txt_address']);
    $obj_cart->Email = addslashes($_POST['txt_email']);
    $obj_cart->Cdate = date("Y-m-d H:i:s");
    $obj_cart->TotalMoney = (int)$total;
    $obj_cart->isActive = 0;
    $obj_cart->Add_new();
    unset($_SESSION['CART']);
    ?>
    <script>
        alert('Đặt hàng thành công');
        $('#cart_number').html('0');
    </script>
    <?php
    echo "<script language=\"javascript\">window.location='".ROOTHOST."'</script>";
}


?>
<div class="row row-column">
    <div class="col-md-3 col-column">
        <?php include_once(MOD_PATH."mod_leftmenu/layout.php");?>
    </div>
    <div class="col-md-9 col-column">
        <div class="group-item">
            <form method="POST" action="">
                <h3 class="title-header"><?php echo LABEL_INFOPAY;?></h3>

                <?php if($objmem->isLogin()){
                    $thisUser=$objmem->getInfo('username');
                    $objmem->getList(" WHERE username ='$thisUser' ");
                    $rowmem = $objmem->Fetch_Assoc();
                    $fullname=$rowmem['first_name']." ".$rowmem['last_name'];
                    $phone=$rowmem['tel'];
                    $address=$rowmem['address'];
                    $email=$rowmem['email'];
                    ?>
                    <input type="hidden" class="form-control" id="txt_username" name="txt_username" value="<?php echo $thisUser ?>" readonly >
                    <div class="form-group">
                        <label for="date" class="col-sm-4 control-label"><?php echo F_FULLNAME;?></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="txt_fullname" name="txt_fullname" value="<?php echo $fullname ?>" readonly >
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label for="date" class="col-sm-4 control-label"><?php echo F_PHONE;?>*</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="txt_phone" name="txt_phone"  value="<?php echo $phone ?>" required="true">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label for="date" class="col-sm-4 control-label"><?php echo F_ADDRESS;?>*</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="txt_address" name="txt_address" required  value="<?php echo $address ?>" required="true">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label for="date" class="col-sm-4 control-label">Email*</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="txt_email" name="txt_email" required  value="<?php echo $email ?>" required="true">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                <?php } else{ ?>
                    <?php $notic1="1. Nếu có tài khoản, Quý khách vui lòng đăng nhập thành viên để được hưởng những chính sách ưu đãi nhất";
                    $notic2="2. Nếu chưa có tài khoản, để mua hàng ,Quý khách vui lòng nhập thông tin dưới đây, Essy.vn sẽ chủ động liên hệ với quý khách sau khi đặt hàng thành công: ";
                    ?>
                    <p><?php echo translateContent($notic1, LANG_TO);?></p>
                    <p><?php echo translateContent($notic2, LANG_TO);?></p>
                    <div class="form-group">
                        <label for="date" class="col-sm-4 control-label"><?php echo F_FULLNAME;?>*</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="txt_fullname" name="txt_fullname" value="" required="true">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label for="date" class="col-sm-4 control-label"><?php echo F_PHONE;?>*</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="txt_phone" name="txt_phone" required="true">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label for="date" class="col-sm-4 control-label"><?php echo F_ADDRESS;?>*</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="txt_address" name="txt_address" required="true">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label for="date" class="col-sm-4 control-label">Email*</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="txt_email" name="txt_email" required="true">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label for="date" class="col-sm-4 control-label"></label>

                        <div class="clearfix"></div>
                    </div>
                <?php }?>
                <div class="col-sm-8">
                    <input type="submit" name="order" class="btn btn-success pull-left" value="<?php echo F_SENDPAY;?>">
                </div>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>
