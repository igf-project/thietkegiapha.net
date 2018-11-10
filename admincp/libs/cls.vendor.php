<?php
ini_set('display_errors', 1);
class CLS_VENDOR{
    private $pro=array(
        'ID'=>'-1',
        'Par_ID'=>'-1',
        'Name'=>'',
        'Code'=>'',
        'Intro'=>'',
        'Address'=>'',
        'Phone'=>'',
        'Fax'=>'',
        'Logo'=>'',
        'Website'=>'',
        'Email'=>'',
        'Author'=>'',
        'isActive'=>'1');
    private $objmysql;
    public function CLS_VENDOR(){
        $this->objmysql=new CLS_MYSQL;
    }
    // property set value
    public function __set($proname,$value){
        if(!isset($this->pro[$proname])){
            echo ($proname.' is not member of CLS_VENDOR Class' );
            return;
        }
        $this->pro[$proname]=$value;
    }
    public function __get($proname){
        if(!isset($this->pro[$proname])){
            echo ($proname.' is not member of CLS_VENDOR Class' );
            return '';
        }
        return $this->pro[$proname];
    }
    public function getList($strwhere=""){
        $sql="SELECT * FROM tbl_vendor WHERE isactive=1 $strwhere";
        return $this->objmysql->Query($sql);
    }
    public function Num_rows(){
        return $this->objmysql->Num_rows();
    }
    public function Fetch_Assoc(){
        return $this->objmysql->Fetch_Assoc();
    }
    public function getListCate($parid=0,$level=0){
        $sql="SELECT vendor_id,par_id,name FROM tbl_vendor WHERE `par_id`='$parid' AND `isactive`='1' ";
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
            $id=$rows['vendor_id'];
            $parid=$rows['par_id'];
            $name=$rows['name'];
            echo "<option value='$id'>$char $name</option>";
            $nextlevel=$level+1;
            $this->getListCate($id,$nextlevel);
        }
    }
    public function listTable($strwhere="",$page=1,$parid=0,$level=0,$rowcount){
        $star=($page-1)*MAX_ROWS;
        $leng=MAX_ROWS;
        $sql="SELECT * FROM tbl_vendor WHERE 1=1 $strwhere AND par_id=$parid ORDER BY `vendor_id` DESC LIMIT $star,$leng";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);	$i=0;
        while($rows=$objdata->Fetch_Assoc()){
            $str_space="";
            if($level!=0){  
                for($i=0;$i<$level;$i++)
                    $str_space.="&nbsp;&nbsp;&nbsp;"; 
                $str_space.="|---";
            }
            $i++;
            $ids=$rows['vendor_id'];
            $title=Substring(stripslashes($rows['name']),0,10);
            echo "<tr name=\"trow\">";
            echo "<td width=\"30\" align=\"center\">$i</td>";
            echo "<td width=\"30\" align=\"center\"><label>";
            echo "<input type=\"checkbox\" name=\"chk\" id=\"chk\" 	 onclick=\"docheckonce('chk');\" value=\"$ids\" />";
            echo "</label></td>";
            echo "<td title=''>$str_space $title</td>";
            $order=$rows['order'];
            echo "<td width=\"50\" align=\"center\"><input type=\"text\" name=\"txt_order\" id=\"txt_order\" value=\"$order\" size=\"4\" class=\"order\"></td>";
            echo "<td align=\"center\">";
            echo "<a href=\"index.php?com=".COMS."&amp;task=active&amp;id=$ids\">";
            showIconFun('publish',$rows['isactive']);
            echo "</a>";
            echo "</td>";
            echo "<td align=\"center\">";
            echo "<a href=\"index.php?com=".COMS."&amp;task=edit&amp;id=$ids\">";
            showIconFun('edit','');
            echo "</a>";
            echo "</td>";
            echo "<td align=\"center\">";
            echo "<a href=\"javascript:detele_field('index.php?com=".COMS."&amp;task=delete&amp;id=$ids')\" >";
            showIconFun('delete','');
            echo "</a>";

            echo "</td>";
            echo "</tr>";
            $nextlevel=$level+1;
            $this->listTable($strwhere,$page,$ids,$nextlevel,$rowcount);
        }
    }
    public function Add_new(){
        $sql="INSERT INTO `tbl_vendor` (`par_id`,`name`,`code`,`intro`,`address`,`phone`,`fax`,`logo`,`website`,`email`,`author`,`isactive`) VALUES ";
        $sql.="('".$this->Par_ID."','".$this->Name."','".$this->Code."','".$this->Intro."','".$this->Address."','".$this->Phone."','".$this->Fax."','".$this->Logo."','".$this->Website."','".$this->Email."','".$this->Author."','".$this->isActive."')";
        return $this->objmysql->Exec($sql);
    }
    public function Update(){
        $sql="UPDATE `tbl_vendor` SET
        `par_id`='".$this->Par_ID."',
        `name`='".$this->Name."',
        `code`='".$this->Code."',
        `intro`='".$this->Intro."',
        `address`='".$this->Address."',
        `phone`='".$this->Phone."',
        `fax`='".$this->Fax."',
        `logo`='".$this->Logo."',
        `website`='".$this->Website."',
        `email`='".$this->Email."',
        `isactive`='".$this->isActive."' 
        WHERE `vendor_id`='".$this->ID."'";
        return $this->objmysql->Exec($sql);
    }
    public function Delete($ids){
        $sql="DELETE FROM `tbl_vendor` WHERE `vendor_id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }
    public function setHot($ids){
        $sql="UPDATE `tbl_vendor` SET `ishot`=if(`ishot`=1,0,1) WHERE `vendor_id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }
    public function setActive($ids,$status=''){
        $sql="UPDATE `tbl_vendor` SET `isactive`='$status' WHERE `vendor_id` in ('$ids')";
        if($status=='')
            $sql="UPDATE `tbl_vendor` SET `isactive`=if(`isactive`=1,0,1) WHERE `vendor_id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }
    public function Order($arr_id,$arr_quan){
        $n=count($arr_id);
        for($i=0;$i<$n;$i++){
            $sql="UPDATE `tbl_vendor` SET `order`='".$arr_quan[$i]."' WHERE `vendor_id` = '".$arr_id[$i]."' ";
            $this->objmysql->Exec($sql);
        }
    }
    /* combo box*/
    function getListCbItem($getId='', $swhere='', $arrId=''){
        $sql="SELECT vendor_id, name, code FROM tbl_vendor WHERE ".$swhere." `isactive`='1' ORDER BY `name` ASC";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        if($objdata->Num_rows()<=0) return;
        while($rows=$objdata->Fetch_Assoc()){
            $id=$rows['vendor_id'];
            $name=$rows['name'];
            if(!$arrId){
                ?>
                <option value='<?php echo $rows['vendor_id'];?>' <?php if(isset($getId) && $id==$getId) echo "selected";?>><?php echo $name;?></option>
                <?php
            }else{?>
            <option value='<?php echo $id;?>' <?php if(isset($arrId) and in_array($id, $arrId)) echo "selected";?>><?php echo $name;?></option>
            <?php
        }
        ?>


        <?php
    }
}
}
?>