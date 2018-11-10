<?php
class CLS_GUSER{
	private $pro=array(
		'ID'=>'-1',
		'ParID'=>'0',
		'Name'=>'',
		'Intro'=>'',
		'isAdmin'=>'1',
		'isActive'=>1
		);
	private $objmysql=NULL;
	public function CLS_GUSER(){
		$this->objmysql=new CLS_MYSQL;
	}
	// property set value
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo ($proname.' is not member of CLS_GUSER Class' );
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo ($proname.' is not member of CLS_GUSER Class' );
			return '';
		}
		return $this->pro[$proname];
	}
	public function getList($where='',$limit=''){
		$sql='SELECT * FROM `tbl_guser` '.$where.' ORDER BY `name` '.$limit;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	function getListGmem($parid=0,$level=0){
        $sql="SELECT * FROM tbl_guser WHERE `par_id`='$parid' AND `isactive`='1' ";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $char="";
        if($level!=0){
            for($i=0;$i<$level;$i++)
                $char.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; 
            $char.="|---";
        }
        if($objdata->Num_rows()<=0) return;
        while($rows=$objdata->Fetch_Assoc()){
            $id=$rows['guser_id'];
            $parid=$rows['par_id'];
            $title=$rows['name'];
            echo "<option value='$id'>$char $title</option>";
            $nextlevel=$level+1;
            $this->getListGmem($id,$nextlevel);
        }
    }
	function listTableGmem($strwhere="",$page,$parid,$level){
		$star=($page-1)*MAX_ROWS;
		$leng=MAX_ROWS;
		$sql="SELECT * FROM `tbl_guser` WHERE `par_id`=\"$parid\" ".$strwhere ." LIMIT $star,$leng";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$str_space="";
		if($level!=0){
			for($i=1;$i<$level;$i++)
				$str_space.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			$str_space.="|--- ";
		}
		while($rows=$objdata->Fetch_Assoc()){
			$id=$rows['guser_id'];
			$parid=$rows['par_id'];
			$name=$rows['name'];
			$intro= stripslashes(uncodeHTML($rows['intro']));
			echo "<tr name=\"trow\">";
			echo "<td width=\"30\" align=\"center\"><label>";
			echo "<input type=\"checkbox\" name=\"chk\" id=\"chk\" onclick=\"docheckonce('chk');\" value=\"$id\" />";
			echo "</label></td>";
			echo "<td width=\"50\" align=\"center\">$parid</td>";
			echo "<td nowrap=\"nowrap\"><a href=\"index.php?com=".COMS."&amp;task=edit&amp;id=$id\">$str_space$name</a></td>";
			echo "<td nowrap=\"nowrap\">$intro &nbsp;</td>";
			echo "<td width=\"50\" align=\"center\">";
			echo "<a href=\"index.php?com=".COMS."&amp;task=active&amp;id=$id\">";
			showIconFun('publish',$rows["isactive"]);
			echo "</a>";

			echo "</td>";
			echo "<td width=\"50\" align=\"center\">";			
			echo "<a href=\"index.php?com=".COMS."&amp;task=edit&amp;id=$id\">";
			showIconFun('edit','');
			echo "</a>";
			echo "</td>";
			echo "<td width=\"50\" align=\"center\">";
			echo "<a href=\"javascript:detele_field('index.php?com=".COMS."&amp;task=delete&amp;id=$id')\">";
			showIconFun('delete','');
			echo "</a>";			
			echo "</td>";
			echo "</tr>";
			$this->listTableGmem($strwhere,$page,$id,$level+1);
		}
	}
	function setActive($ids,$status=''){
		$sql="UPDATE `tbl_guser` SET `isactive`='$status' WHERE `guser_id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_guser` SET `isactive`=if(`isactive`=1,0,1) WHERE `guser_id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	function Add_new(){
		$sql="INSERT INTO `tbl_guser`(`par_id`,`name`,`intro`,`isadmin`,`isactive`) VALUES ";
		$sql.=" (\"".$this->pro["ParID"]."\",\"".$this->pro["Name"]."\",\"".$this->pro["Intro"]."\",\"".$this->pro["isAdmin"]."\",\"".$this->pro["isActive"]."\") ";
		return $this->objmysql->Query($sql);
	}
	function Update(){
		$sql="UPDATE `tbl_guser` SET `par_id`=\"".$this->pro["ParID"]."\",`name`=\"".$this->pro["Name"]."\",`intro`=\"".$this->pro["Intro"]."\",`isadmin`=\"".$this->pro["isAdmin"]."\",`isactive`=\"".$this->pro["isActive"]."\" ";
		$sql.=" WHERE `guser_id`=\"".$this->pro["ID"]."\"";
		return $this->objmysql->Query($sql);
	}
	function Delete($id){
		$sql="DELETE FROM `tbl_guser` WHERE `guser_id` in ('$id')";
		return $this->objmysql->Query($sql);
	}
}
?>