<?php
ini_set('display_errors',0);
$COM='member';
include_once(EXT_PATH.'cls.upload.php');
$objUpload=new CLS_UPLOAD();
?>
<div class='content'>
	<?php
	$viewtype='';
    $obj=new CLS_MEMBER();
	if(isset($_GET['viewtype'])){
		$viewtype=addslashes($_GET['viewtype']);
	}
	if(is_file(COM_PATH.'com_'.$COM.'/tem/'.$viewtype.'.php'))
		include_once('tem/'.$viewtype.'.php');

    if(isset($_POST['cmdsave'])){
        if(!$objmem) $objmem=new CLS_MEMBER();
            if($objmem->isLogin()==true){
                $thisUser=$objmem->getInfo('username');
            $obj->FirstName=addslashes($_POST['txt_firstname']);
            $obj->LastName=addslashes($_POST['txt_lastname']);
            $obj->Birthday=addslashes($_POST['txt_birthday']);
            $obj->Gender=addslashes($_POST['txt_gender']);
            $obj->Address=addslashes($_POST['txt_address']);
            $obj->Phone=(int)$_POST['txt_phone'];
            $obj->Email=addslashes($_POST['txt_email']);
            $path=PATH_THUMB;
            if(isset($_POST['txtid'])){
                /*upload thumb*/
                if(isset($_FILES['fileImg']) AND $_FILES['fileImg']['name']!=''){
                    $obj->Avata=ROOTHOST.$objUpload->UploadFile('fileImg', $path);
                }
                else $obj->Avata=$_POST['url_image'];
                $obj->Username=$thisUser;
                $obj->Update();
            }
            else{
                /*upload thumb*/
                if(isset($_FILES['fileImg']) AND $_FILES['fileImg']['name']!=''){
                    $obj->Avata=ROOTHOST.$objUpload->UploadFile('fileImg', $path);
                }
                else $obj->Avata='';
                $obj->Add_new();
            }
                echo "<script language=\"javascript\">window.location='".ROOTHOST."member/profiles'</script>";
        }
    }
	unset($viewtype); unset($obj); unset($COM);
	?>
	</div>
</div>

</div>