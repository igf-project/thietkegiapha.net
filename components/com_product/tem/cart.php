<?php 
require_once(libs_path.'cls.cart.php');
if(!isset($obj_cart)) $obj_cart= new CLS_CART;
if(!isset($objmem)) $objmem=new CLS_MEMBER;
?>
<div class="row row-column">
    <div class="col-md-3 col-column">
        <?php include_once(MOD_PATH."mod_leftmenu/layout.php");?>
    </div>
    <div class="col-md-9 col-column">
        <div id="box-cart" class="page-content group-item">
    <?php
        if(isset($_SESSION['CART']) && $_SESSION['CART']!=''){
            $num = count($_SESSION['CART']);
            ?>

            <form id="frm_boxcart" name="frm_boxcart"  method="post" class="frm" action="#">
                <h3 class="title-header"><?php echo LABEL_LISTCART;?></h3>
                <div id="tbl_cart"></div>
            </form>
            <div class="clear"></div>

            </div>
            <script>
                $(document).ready(function(){
                    $('#tbl_cart').load('<?php echo ROOTHOST.'ajaxs/product/cart_list.php';?>');
                })
            </script>
            <?php
            }else{echo "Chưa có sản phẩm nào";}
        ?>
    </div>

</div>
