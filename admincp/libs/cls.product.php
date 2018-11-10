<?php
ini_set('display_errors', 1);
class CLS_PRODUCT{
    private $pro=array(
        'ID'=>'-1',
        'Pro_Code'=>'',
        'Partner_ID'=>'0',
        'Vendor_ID'=>'0',
        'Cata_ID'=>'0', 
        'Name'=>'',         
        'Code'=>'',         
        'Color'=>'',
        'Size'=>'',
        'Height'=>'',
        'Intro'=>'',
        'Fulltext'=>'',
        'Thumb'=>'',
        'Images'=>'',
        'Old_price'=>'0',
        'Cur_price'=>'0',
        'Quantity'=>'0',
        'Cdate'=>'',
        'Mdate'=>'',
        'MTitle'=>'',
        'MKey'=>'',
        'MDesc'=>'',
        'Visit'=>'',
        'Author'=>'',
        'Order'=>'',
        'isHot'=>'0',
        'isActive'=>'1');
    private $objmysql;
    public function CLS_PRODUCT(){
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
        $sql=" SELECT * FROM tbl_product $strwhere";
        return $this->objmysql->Query($sql);
    }
    public function getInfo($where=''){
        $sql="SELECT `id`,`cat_id`,`vendor_id`,`partner_id`,`name` FROM `tbl_product` WHERE isactive=1 ".$where;
        // echo $sql;
        $objdata = new CLS_MYSQL();
        $objdata->Query($sql);
        $rows = $objdata->Fetch_Assoc();
        return $rows;
    }
    public function Num_rows(){
        return $this->objmysql->Num_rows();
    }
    public function Fetch_Assoc(){
        return $this->objmysql->Fetch_Assoc();
    }
    public function getCatName($catid) {
        $sql="SELECT name FROM tbl_catalog WHERE id=$catid";
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
        $sql="SELECT tbl_product.* FROM tbl_product $strwhere ORDER BY `cdate` DESC LIMIT $star,$leng";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);  $i=0;
        while($rows=$objdata->Fetch_Assoc()){
            $i++;
            $ids=$rows['id'];
            $pro_code=$rows['pro_code'];
            $title=Substring(stripslashes($rows['name']),0,10);
            $old_price = number_format($rows['old_price']);
            $catalogs = $this->getCatName($rows['cat_id']);
            $visited=$rows['visited'];
            $order=$rows['order'];
            echo "<tr name=\"trow\">";
            echo "<td width=\"30\" align=\"center\">$i</td>";
            echo "<td width=\"30\" align=\"center\"><label>";
            echo "<input type=\"checkbox\" name=\"chk\" id=\"chk\" onclick=\"docheckonce('chk');\" value=\"$ids\" />";
            echo "</label></td>";
            echo "<td title='$title' width=\"80\" ><b>$pro_code</b></td>";
            echo "<td title='$title'>$title</td>";
            echo "<td>$catalogs</td>";
            echo "<td nowrap='nowrap' align=\"center\"><span style='color:red;'>$old_price</span><b> đ</b></td>";
            echo "<td nowrap='nowrap' align='center'>$visited</td>";
            echo "<td align=\"center\"><input type=\"text\" name=\"txt_order\" id=\"txt_order\" value=\"$order\" size=\"4\" class=\"order\"></td>";
            echo "<td align=\"center\">";

            echo "<a href=\"index.php?com=".COMS."&amp;task=hot&amp;id=$ids\">";
            showIconFun('publish',$rows['ishot']);
            echo "</a>";

            echo "</td>";
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
        $sql="INSERT INTO `tbl_product` (`pro_code`,`cat_id`,`partner_id`,`vendor_id`,`size`,`height`,`color`,`name`,`code`,`intro`,`fulltext`,`thumb`,`cur_price`,`old_price`,`quantity`,`author`,`cdate`,`mdate`,`meta_title`,`meta_key`,`meta_desc`,`ishot`,`isactive`) VALUES ";
        $sql.="('".$this->Pro_Code."','".$this->Cata_ID."','".$this->Partner_ID."','".$this->Vendor_ID."','".$this->Size."','".$this->Height."','".$this->Color."','".$this->Name."','".$this->Code."','".$this->Intro."','".$this->Fulltext."','".$this->Thumb."','";
        $sql.=$this->Cur_price."','".$this->Old_price."','".$this->Quantity."','".$this->Author."','";
        $sql.=$this->Cdate."','".$this->Mdate."','";
        $sql.=$this->MTitle."','".$this->MKey."','".$this->MDesc."','".$this->isHot."','".$this->isActive."')";
        // echo $sql;die();
        return $this->objmysql->Exec($sql);
    }
    public function Update(){
        $sql="UPDATE `tbl_product` SET  
        `pro_code`='".$this->Pro_Code."',
        `partner_id`='".$this->Partner_ID."', 
        `Vendor_id`='".$this->Vendor_ID."', 
        `cat_id`='".$this->Cata_ID."',                                  
        `color`='".$this->Color."',
        `size`='".$this->Size."',                                    
        `height`='".$this->Height."',                                    
        `name`='".$this->Name."',
        `code`='".$this->Code."',
        `intro`='".$this->Intro."',
        `fulltext`='".$this->Fulltext."',
        `thumb`='".$this->Thumb."',     
        `old_price`='".$this->Old_price."',                                 
        `cur_price`='".$this->Cur_price."',                             
        `quantity`='".$this->Quantity."',                               
        `mdate`='".$this->Mdate."',
        `author`='".$this->Author."',
        `meta_title`='".($this->MTitle)."',
        `meta_key`='".($this->MKey)."',
        `meta_desc`='".($this->MDesc)."',
        `ishot`='".$this->isHot."',
        `isactive`='".$this->isActive."' 
        WHERE `id`='".$this->ID."'";
        return $this->objmysql->Exec($sql);
    }
    public function Delete($ids){
        $sql="DELETE FROM `tbl_product` WHERE `id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }
    public function setHot($ids){
        $sql="UPDATE `tbl_product` SET `ishot`=if(`ishot`=1,0,1) WHERE `id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }
    public function setActive($ids,$status=''){
        $sql="UPDATE `tbl_product` SET `isactive`='$status' WHERE `id` in ('$ids')";
        if($status=='')
            $sql="UPDATE `tbl_product` SET `isactive`=if(`isactive`=1,0,1) WHERE `id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }
    public function Order($ids,$order){
        $sql="UPDATE tbl_product SET `order`='".$order."' WHERE `id`='".$ids."'";   
        return $this->objmysql->Exec($sql);
    }
    public function Orders($arids,$arods){
        for($i=0;$i<count($arids);$i++){
            $this->Order($arids[$i],$arods[$i]);
        }
    }
    /* combo box*/
    function getListCbItem($getId='', $swhere='', $arrId=''){
        $sql="SELECT id, name, code FROM tbl_product WHERE ".$swhere." `isactive`='1' ORDER BY `name` ASC";
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
public function countProByParID($strwhere){
    $sql="SELECT count(`id`) as count FROM `tbl_product` ".$strwhere."";
    $objmysql=new CLS_MYSQL;
    $objmysql->Query($sql);
    $row=$objmysql->Fetch_Assoc();
    return $row['count'];
}

}
?>