<?php
class CLS_GALLERY{
	private $objmysql=NULL;
	public function CLS_GALLERY(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function getListAlbum($where='',$limit=''){
		$sql="SELECT * FROM `tbl_album` ".$where.' ORDER BY id DESC'.$limit;
		return $this->objmysql->Query($sql);
	}
	public function getList($where='',$limit=''){
		$sql="SELECT * FROM `tbl_gallery` WHERE isactive=1 ".$where.' ORDER BY `id` ASC '.$limit;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function getCount($where=""){
		$sql="SELECT COUNT(*) as 'number' FROM `tbl_album` WHERE isactive=1 ".$where;
		$objdata = new CLS_MYSQL();
		$objdata->Query($sql);
		$rows = $objdata->Fetch_Assoc();
		return $rows['number'];
	}
	public function getInfo($where=''){
		$sql="SELECT * FROM `tbl_album`  WHERE `isactive`=1 ".$where;
		$objdata = new CLS_MYSQL();
		$objdata->Query($sql);
		$rows = $objdata->Fetch_Assoc();
		return $rows;
	}
	function listAlbum($curid=0) {
		$sql="SELECT id,name FROM tbl_album WHERE isactive=1 ORDER BY id DESC";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		while($rows=$objdata->Fetch_Assoc()){
			if($rows['id']== $curid)
				echo '<option value="'.$rows['id'].'" selected="selected">'.$rows['name'].'</option>';
			else echo '<option value="'.$rows['id'].'">'.$rows['name'].'</option>';
		}
	}
    function getThumbByAlbum($album_id){
        $sql="SELECT * FROM `tbl_gallery` WHERE album_id='$album_id'";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $rows=$objdata->Fetch_Assoc();
        $img=$rows['link'];
        if($img!=''){
            $img = strpos($img,'http')!==false?$img:ROOTHOST_FRONTEND.PATH_GALLERY_REVIEW.$img;

        }
        else $img=THUMB_DEFAULT;
        $img = '<img src="'.$img.'" height="45" width="80"/>';
        return $img;
    }	
    public function getListGallery($strwhere="", $path=""){
        $sql="SELECT * FROM `tbl_gallery` ".$strwhere."";
        //var_dump($sql);
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()){
            $id=$rows['id'];
            $path=$rows['link'];
            $name=Substring(stripslashes($rows['name']),0,4);
            $url="index.php?com=gallery&task=delete&id='$id'";
            ?>
            <div class="info-item">
                <img src="<?php echo ROOTHOST.PATH_GALLERY.$path;?>" width="150px">
                <div class="name"><?php echo $name;?></div>
                <div class="del-item" value="<?php echo $id;?>" title="Xóa"></div>
                <div class="edit-item" value="<?php echo $id;?>" title="Đổi tên"></div>
            </div>
           <?php
        }
    }
}
?>