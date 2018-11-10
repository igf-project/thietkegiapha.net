<?php
class CLS_CATE{
	private $objmysql=null;
	public function CLS_CATE(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function getList($where=''){
		$sql="SELECT * FROM `tbl_category` WHERE isactive=1 ".$where;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function getCount($where=""){
		$sql="SELECT COUNT(*) as 'number' FROM `tbl_category` WHERE isactive=1 ".$where;
		$objdata = new CLS_MYSQL();
		$objdata->Query($sql);
		$rows = $objdata->Fetch_Assoc();
		return $rows['number'];
	}
	public function getInfo($where=''){
		$sql="SELECT * FROM `tbl_category`  WHERE `isactive`=1 ".$where;
		$objdata = new CLS_MYSQL();
		$objdata->Query($sql);
		$rows = $objdata->Fetch_Assoc();
		return $rows;
	}
	function getCatIDChild($where='',$parid){
		$sql="SELECT * FROM `tbl_category` WHERE isactive=1 $where AND par_id='$parid' ";
		$objdata=new CLS_MYSQL();
		$this->result=$objdata->Query($sql);
		$str='';
		if($objdata->Num_rows()>0) {
			while ($rows=$objdata->Fetch_Assoc()) {
				$str.=$rows['cate_id'].",";
				$str.=$this->getCatIDChild('',$rows['cate_id']);
			}
		}
		return rtrim($str,",");
	}
	public function getNameById($cate_id){
		$objdata=new CLS_MYSQL;
		$sql="SELECT `name` FROM `tbl_category`  WHERE isactive=1 AND `cate_id` = '$cate_id'"; 
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		return $row['name'];
	}
	public function getCatIDParent($parid){
		$sql="SELECT * FROM `tbl_category` WHERE isactive=1 AND cate_id='$parid' ";
		$objdata=new CLS_MYSQL();
		$this->result=$objdata->Query($sql);
		$str='';
		if($objdata->Num_rows()>0) {
			while ($rows=$objdata->Fetch_Assoc()) {
				$str.=$rows['cate_id'].',';
				$str.=$this->getCatIDParent($rows['par_id']);
			}
		}
		return rtrim($str,',');
	}
	// Creat đường dẫn
	public function CreatPath($cate_id){
		$sql="SELECT cate_id,name,code FROM `tbl_category` WHERE isactive=1 AND cate_id IN($cate_id)";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		if($objdata->Num_rows()>0){
			while ($rows = $objdata->Fetch_Assoc()) {
				echo '<li><a href="'.ROOTHOST.$rows["code"].'" title="'.$rows["name"].'">'.$rows["name"].'</a></li>';
			}
		}
	}
	/* combo box*/
    function getListCbCategory($getId='', $swhere=''){
        $sql="SELECT cate_id, name FROM tbl_category WHERE ".$swhere." `isactive`='1' ORDER BY `name` ASC";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        if($objdata->Num_rows()<=0) return;
        while($rows=$objdata->Fetch_Assoc()){
            $id=$rows['cate_id'];
            $name=$rows['name'];
            ?>
            <option value='<?php echo $rows['cate_id'];?>' <?php if(isset($getId) && $id==$getId) echo "selected";?>><?php echo $name;?></option>
        <?php
        }
    }
}
?>