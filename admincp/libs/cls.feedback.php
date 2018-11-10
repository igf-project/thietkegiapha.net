<?php
ini_set('display_errors', 1);
class CLS_FEEDBACK{
    private $pro=array(
        'ID'=>'-1',
        'Name'=>'',
        'Intro'=>'',
        'Thumb'=>'',
        'Address'=>'',
        'Order'=>'0',
        'isActive'=>'1');
    private $objmysql;
    public function CLS_FEEDBACK(){
        $this->objmysql=new CLS_MYSQL;
    }
    // property set value
    public function __set($proname,$value){
        if(!isset($this->pro[$proname])){
            echo ($proname.' is not member of CLS_PRODUCTS Class' );
            return;
        }
        $this->pro[$proname]=$value;
    }
    public function __get($proname){
        if(!isset($this->pro[$proname])){
            echo ($proname.' is not member of CLS_PRODUCTS Class' );
            return '';
        }
        return $this->pro[$proname];
    }
    public function getList($strwhere=""){
        $sql="SELECT * FROM tbl_feedback $strwhere";
        return $this->objmysql->Query($sql);
    }
    public function Num_rows(){
        return $this->objmysql->Num_rows();
    }
    public function Fetch_Assoc(){
        return $this->objmysql->Fetch_Assoc();
    }
    public function getCatName($catid) {
        $sql="SELECT name FROM tbl_feedback_group WHERE id='$catid'";
        $objdata=new CLS_MYSQL;
        $objdata->Query($sql);
        if($objdata->Num_rows()>0) {
            $r=$objdata->Fetch_Assoc();
            return $r['name'];
        }
    }
    public function listTable($strwhere="",$page){
        $star=($page-1)*MAX_ROWS;
        $leng=MAX_ROWS;
        $sql="SELECT tbl_feedback.* FROM tbl_feedback $strwhere ORDER BY `id` DESC LIMIT $star,$leng";
        //echo $sql;
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);	$i=0;
        while($rows=$objdata->Fetch_Assoc())
        {	$i++;
            $ids=$rows['id'];
            $address=$rows['address'];
            $title=Substring(stripslashes($rows['name']),0,10);
            echo "<tr name=\"trow\">";
            echo "<td width=\"30\" align=\"center\">$i</td>";
            echo "<td width=\"30\" align=\"center\"><label>";
            echo "<input type=\"checkbox\" name=\"chk\" id=\"chk\" 	 onclick=\"docheckonce('chk');\" value=\"$ids\" />";
            echo "</label></td>";
            echo "<td title=''>$title</td>";
            echo "<td title=''>$address</td>";
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
        }
    }
    public function Add_new(){
        $sql="INSERT INTO `tbl_feedback` (`name`, `intro`, `thumb`, `address`, `isactive`) VALUES ";
        $sql.="('".$this->Name."','".$this->Intro."','".$this->Thumb."','";
        $sql.=$this->Address."','".$this->isActive."')";
        return $this->objmysql->Exec($sql);
    }
    public function Update(){
        $sql="UPDATE `tbl_feedback` SET
				`name`='".$this->Name."',
				`address`='".$this->Address."',
				`intro`='".$this->Intro."',
				`thumb`='".$this->Thumb."'
		WHERE `id`='".$this->ID."'";
        return $this->objmysql->Exec($sql);
    }
    public function Delete($ids){
        $sql="DELETE FROM `tbl_feedback` WHERE `id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }
    public function setHot($ids){
        $sql="UPDATE `tbl_feedback` SET `ishot`=if(`ishot`=1,0,1) WHERE `id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }
    public function setActive($ids,$status=''){
        $sql="UPDATE `tbl_feedback` SET `isactive`='$status' WHERE `id` in ('$ids')";
        if($status=='')
            $sql="UPDATE `tbl_feedback` SET `isactive`=if(`isactive`=1,0,1) WHERE `id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }
    public function Order($arr_id,$arr_quan){
        $n=count($arr_id);
        for($i=0;$i<$n;$i++){
            $sql="UPDATE `tbl_feedback` SET `order`='".$arr_quan[$i]."' WHERE `id` = '".$arr_id[$i]."' ";
            $this->objmysql->Exec($sql);
        }
    }
    /* combo box*/
    function getListCbItem($getId='', $swhere='', $arrId=''){
        $sql="SELECT id, title as name, code FROM tbl_feedback WHERE ".$swhere." `isactive`='1' ORDER BY `name` ASC";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        if($objdata->Num_rows()<=0) return;
        while($rows=$objdata->Fetch_Assoc()){
            $id=$rows['id'];
            $name=$rows['name'];
            if(!$arrId){
                ?>
                <option value='<?php echo $rows['id'];?>' <?php if(isset($getId) && $id==$getId) echo "selected";?>><?php echo $name;?></option>
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