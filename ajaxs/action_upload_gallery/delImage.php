<?php
include_once('../../includes/gfinnit.php');
//include_once('../../includes/function.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.gallery.php');
$obj=new CLS_MYSQL();
$objGa=new CLS_GALLERY();
$imgId=isset($_POST['imgId'])? $_POST['imgId']: '';
$par_id='';
$type='';
if(isset($_POST['par_id'])){
	$par_id=(int)$_POST['par_id'];
	$type='2';
}
if(isset($_POST['food_id'])){
    $par_id=(int)$_POST['food_id'];
    $type='3';
}
if(isset($_POST['position_id'])){
	$par_id=(int)$_POST['position_id'];
	$type='1';
}
//var_dump($par_id);
?>
<?php
$objGa->parId=$par_id;
$objGa->Type=$type;
$sql="SELECT * FROM `tbl_gallery` WHERE `par_id`=$par_id AND `type`=$type";
$obj->Query($sql);
$obj->Num_rows();
$row=$obj->Fetch_Assoc();
$arrImg=explode(", ", $row['arr_path']);
if(($key = array_search($imgId, $arrImg)) !== false) {
    unset($arrImg[$key]);
	$link="'".ROOTHOST.PATH_GALLERY.$imgId."'";
	if(is_file($link)){
		echo $link;
        unlink($link);
	}

}
if(count($arrImg) > 0){
    $arrImgUpdate=implode(', ', $arrImg);
    /*update lại sau khi xóa phần tử trong mảng*/
    $objGa->arrPath="'".$arrImgUpdate."'";
    $objGa->Update();
}
else{   // xóa cả toàn bộ ảnh của position or tour
    $objGa->Delete($par_id);
}
$objGa->getListGallery("WHERE `par_id`=$par_id AND `type`=$type", PATH_GALLERY);
unset($obj);
unset($objGa);
?>
<script>
    /*del image*/
    $('#respon-img .del-item').click(function(){
        if(confirm("Bạn có muốn chắc xóa ảnh này")){
            var imgId=$(this).attr('value');
            var par_id=$('#par_id').val();
            $.post('<?php echo ROOTHOST;?>ajaxs/action_upload_gallery/delImage.php',{imgId, par_id},function(response_data){
               // $('#respon-img').append(response_data);
				//alert(response_data);
            });
            var parent= $(this).parent();
            parent.remove();
        }
        else return false;
    });
</script>

