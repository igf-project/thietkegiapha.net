<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
define('MAX_ROWS_ITEM', 12);
$group_code=$cata_code=$cata_name=$group_name=$categroup_name='';
if(isset($_GET['group_code'])){
    $group_code=addslashes($_GET['group_code']);
    $group_name=$obj->getNameGroupByCode($group_code);
}
if(isset($_GET['cata_code'])){
    $cata_code=addslashes($_GET['cata_code']);
    $cata_name=$obj->getNameCateByCode($cata_code);
}
if(isset($_GET['categroup_code'])){
    $categroup_code=addslashes($_GET['categroup_code']);
    $categroup_name=$obj->getNameCateGroupByCode($categroup_code);
}
if(isset($_GET['code'])){
    $code=addslashes($_GET['code']);
    $sql="SELECT name, id FROM tbl_catalog WHERE `code`='$code'";
    $objdata=new CLS_MYSQL();
    $objdata->Query($sql);
    $count=$objdata->Num_rows();
    if($count<1) {
        echo ' <div class="container"><h4 style="margin-top: 50px;margin-bottom: 50px">Dữ liệu đang được cập nhật. Vui lòng quay lại sau!</h4></div>';
        return false;
    }
    $row=$objdata->Fetch_Assoc();
    $cat_name=$row['name'];
    $cat_id=$row['id'];
    ?>
<?php
}
$strWhere="WHERE isactive=1";
if($cata_code!='') $strWhere.=" AND `cata_id`=(SELECT id FROM tbl_catalog WHERE `code`='$cata_code')";
else $strWhere.=" AND `group_id`=(SELECT id FROM tbl_group WHERE `code`='$group_code')";
?>

<?php
if($cata_name=='') echo '<h1 class="title-main">'.$group_name.'</h1>';?>
<?php if($cata_name!='') echo '<h1 class="title-main">'.$cata_name.'</h1>';?>
<div class="box-breadcrumb">
    <ul class="breadcrumb">
        <li><a href="<?php echo ROOTHOST;?>" title="Trang chủ">Trang chủ</a></li>
        <li><a href="<?php echo ROOTHOST;?>san-pham" title="Sản phẩm">Sản phẩm</a></li>
        <?php if($group_name!='') echo '<li class="active">'.$group_name.'</li>';?>
        <?php if($categroup_name!='') echo '<li class="active">'.$categroup_name.'</li>';?>
        <?php if($cata_name!='') echo '<li class="active">'.$cata_name.'</li>';?>
    </ul>
</div>
<div class="row row-column">
    <div class="col-md-3 col-sm-4 col-column">
        <?php include_once(MOD_PATH.'mod_leftmenu/layout.php');?>
    </div>
    <div class="col-md-9 col-sm-8 col-column">
        <div class="list-product">
            <div class="row row-custom">
                <?php
                $objdata=new CLS_MYSQL();
                $cur_page=isset($_POST['txtCurnpage'])? $_POST['txtCurnpage']: '1';
                $obj->getList($strWhere);
                $total_rows=$obj->Num_rows();
                $total_page=ceil($total_rows/MAX_ROWS_ITEM);
                $start=($cur_page-1)*MAX_ROWS_ITEM;
                $limit=" LIMIT ".$start.",".MAX_ROWS_ITEM."";
                $obj->getListItem2($strWhere, $limit, LANG_TO);
                ?>
            </div>
            <div class="text-center">
                <?php
                paging($total_rows, MAX_ROWS_ITEM, $cur_page);
                ?>
            </div>
        </div>
    </div>
</div>


<?php unset($objCata); unset($strWhere);?>