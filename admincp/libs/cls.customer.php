<?php
ini_set('display_errors', 1);
class CLS_CUSTOMER{
    private $pro=array(
        'ID'=>'-1',
        'Name'=>'',
        'Phone'=>'',
        'Email'=>'',
        'Cdate'=>'',
        'isActive'=>'1');
    private $objmysql;
    public function CLS_CUSTOMER(){
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
        $sql="SELECT * FROM tbl_customer_info $strwhere";
        return $this->objmysql->Query($sql);
    }
    public function Num_rows(){
        return $this->objmysql->Num_rows();
    }
    public function Fetch_Assoc(){
        return $this->objmysql->Fetch_Assoc();
    }
    public function getNameByID($catid) {
        $sql="SELECT `email` FROM tbl_customer_info WHERE id='$catid' GROUP BY `email`";
        $objdata=new CLS_MYSQL;
        $objdata->Query($sql);
        if($objdata->Num_rows()==1) {
            $r=$objdata->Fetch_Assoc();
            return $r['email'];
        }
        else return '';
    }
    public function listTable($strwhere="",$page){
        $star=($page-1)*MAX_ROWS;
        $leng=MAX_ROWS;
        $sql="SELECT tbl_customer_info.* FROM tbl_customer_info $strwhere ORDER BY `cdate` DESC LIMIT $star,$leng";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);	$i=0;
        while($rows=$objdata->Fetch_Assoc())
        {	$i++;
            $ids=$rows['id'];
            $title=Substring(stripslashes($rows['name']),0,10);
            $email=$rows['email'];
            $phone=$rows['phone']!=''? $rows['phone']:'N/A';
            $time=date('d-m-Y H:i:s', strtotime($rows['cdate']));
            echo "<tr name=\"trow\">";
            echo "<td width=\"30\" align=\"center\">$i</td>";
            echo "<td width=\"30\" align=\"center\"><label>";
            echo "<input type=\"checkbox\" name=\"chk\" id=\"chk\" 	 onclick=\"docheckonce('chk');\" value=\"$ids\" />";
            echo "</label></td>";
            echo "<td >$title</td>";
            echo "<td >$phone</td>";
            echo "<td>$email</td>";
            echo "<td width=\"140\">$time</td>";
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
        $sql="INSERT INTO `tbl_customer_info` (`name`, `phone`, `email`, `cdate`) VALUES ";
        $sql.="('".$this->Name."','".$this->Phone."','".$this->Email."','".$this->Cdate."')";
        return $this->objmysql->Exec($sql);
    }
    public function Update(){
        $sql="UPDATE `tbl_customer_info` SET
				`name`='".$this->Name."',
				`phone`='".$this->Phone."',
				`email`='".$this->Email."',
				`cdate`='".$this->Cdate."' WHERE `id`='".$this->ID."'";
        return $this->objmysql->Exec($sql);
    }
    public function Delete($ids){
        $sql="DELETE FROM `tbl_customer_info` WHERE `id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }
    public function setHot($ids){
        $sql="UPDATE `tbl_customer_info` SET `ishot`=if(`ishot`=1,0,1) WHERE `id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }
    public function setActive($ids,$status=''){
        $sql="UPDATE `tbl_customer_info` SET `isactive`='$status' WHERE `id` in ('$ids')";
        if($status=='')
            $sql="UPDATE `tbl_customer_info` SET `isactive`=if(`isactive`=1,0,1) WHERE `id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }
    public function Order($ids,$order){
        $sql="UPDATE tbl_customer_info SET `order`='".$order."' WHERE `id`='".$ids."'";
        return $this->objmysql->Exec($sql);
    }
    public function Orders($arids,$arods){
        for($i=0;$i<count($arids);$i++){
            $this->Order($arids[$i],$arods[$i]);
        }
    }
    /* combo box*/
    function getListCbItem($getId='', $swhere='', $arrId=''){
        $sql="SELECT id, name, code FROM tbl_customer_info ".$swhere." ORDER BY `name` ASC";
        echo $sql;
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