<?php
ini_set('display_errors', 1);
class CLS_CONTENTS{
    private $pro=array(
        'ID'=>'-1',
        'Title'=>'',
        'Code'=>'0',
        'Cate_ID'=>'0',
        'Intro'=>'',
        'Fulltext'=>'',
        'Thumb'=>'',
        'Cdate'=>'',
        'Mdate'=>'',
        'Author'=>'',
        'Meta_title'=>'',
        'Meta_key'=>'',
        'Meta_desc'=>'',
        'Visited'=>'',
        'isHot'=>'',
        'Order'=>'',
        'Tags'=>'0',
        'LangID'=>'0',
        'isActive'=>'1');
    private $objmysql;
    public function CLS_CONTENTS(){
        $this->objmysql=new CLS_MYSQL;
    }
    // property set value
    public function __set($proname,$value){
        if(!isset($this->pro[$proname])){
            echo ($proname.' is not member of CLS_CONTENTS Class' );
            return;
        }
        $this->pro[$proname]=$value;
    }
    public function __get($proname){
        if(!isset($this->pro[$proname])){
            echo ($proname.' is not member of CLS_CONTENTS Class' );
            return '';
        }
        return $this->pro[$proname];
    }
    public function getList($strwhere="",$lagid=0){
        $sql=" SELECT * FROM view_content WHERE lag_id='$lagid' $strwhere";
        return $this->objmysql->Query($sql);
    }
    public function Num_rows(){
        return $this->objmysql->Num_rows();
    }
    public function Fetch_Assoc(){
        return $this->objmysql->Fetch_Assoc();
    }
    public function getCatName($catid) {
        $sql="SELECT name from tbl_category where cate_id='$catid'";
        $objdata=new CLS_MYSQL;
        $objdata->Query($sql);
        if($objdata->Num_rows()>0) {
            $r=$objdata->Fetch_Assoc();
            return $r['name'];
        }
    }
    public function LoadConten($lagid=0){
        $sql="SELECT * FROM `view_content` WHERE lag_id='$lagid' AND isactive='1'";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()){
            $ids=$rows['id'];
            $title=$rows['title'];
            echo "<option value=\"$ids\">$title</option>";
        }
    }
    public function listTable($strwhere="",$page,$lagid=0){
        $star=($page-1)*MAX_ROWS;
        $leng=MAX_ROWS;
        $sql="SELECT * FROM view_content WHERE lag_id='$lagid' $strwhere ORDER BY `order` ASC, id DESC LIMIT $star,$leng";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $i=0;
        include_once(libs_path.'cls.users.php');
        $obj_user = new CLS_USERS();
        while($rows=$objdata->Fetch_Assoc()){
            $i++;
            $ids=$rows['id'];
            $title=Substring(stripslashes($rows['title']),0,10);
            $intro = Substring(stripslashes($rows['intro']),0,10);
            $author= $obj_user->getNameById($rows['author']);
            $category = $this->getCatName($rows['cate_id']);
            $visited = $rows['visited'];
            $order = $rows['order'];
            echo "<tr name=\"trow\">";
            echo "<td width=\"30\" align=\"center\">$i</td>";
            echo "<td width=\"30\" align=\"center\"><label>";
            echo "<input type=\"checkbox\" name=\"chk\" id=\"chk\"   onclick=\"docheckonce('chk');\" value=\"$ids\" />";
            echo "</label></td>";
            echo "<td title='$intro'>$title</td>";
            echo "<td>$category</td>";
            echo "<td width=\"75\">$author &nbsp;</td>";

            echo "<td width=\"50\" align=\"center\">$visited</td>";

            echo "<td align=\"center\">";
            echo "<a href=\"index.php?com=".COMS."&amp;task=ishot&amp;id=$ids\">";
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
        $objdata=new CLS_MYSQL;
        $objdata->Query("BEGIN");
        $sql="INSERT INTO tbl_content (`cate_id`,`code`,`thumb`,`cdate`,`mdate`,`author`,`ishot`,`isactive`) VALUES ";
        $sql.="('".$this->Cate_ID."','".$this->Code."','".$this->Thumb."','";
        $sql.=$this->Cdate."','".$this->Mdate."','".$this->Author."','".$this->isHot."','".$this->isActive."')";

        $result=$objdata->Query($sql);

        $ids=$objdata->LastInsertID();
        $sql="INSERT INTO tbl_content_text (`con_id`,`title`,`intro`,`fulltext`,`meta_title`,`meta_key`,`meta_desc`,`tags`,`lag_id`) VALUES";
        $sql.="('$ids','".$this->Title."','".$this->Intro."','";
        $sql.=$this->Fulltext."','".$this->Meta_title."','".$this->Meta_key."','".$this->Meta_desc."','".$this->Tags."','0')";

        $result1=$objdata->Query($sql);

        if($result && $result1 ){
            $objdata->Query('COMMIT');
            return $result;
        }
        else
            $objdata->Query('ROLLBACK');
    }
    function Update(){
        $objdata=new CLS_MYSQL;
        $objdata->Query("BEGIN");
        $sql="UPDATE tbl_content SET 
        `cate_id`='".$this->Cate_ID."', 
        `code`='".$this->Code."',
        `thumb`='".$this->Thumb."',
        `mdate`='".$this->Mdate."',
        `author`='".$this->Author."',
        `ishot`='".$this->isHot."',
        `isactive`='".$this->isActive."' 
        WHERE `id`='".$this->ID."'";
        $result = $objdata->Query($sql);

        $sql="UPDATE tbl_content_text SET 
        `title`='".$this->Title."',
        `intro`='".$this->Intro."',
        `fulltext`='".$this->Fulltext."',
        `meta_title`='".$this->Meta_title."',
        `meta_key`='".$this->Meta_key."',
        `meta_desc`='".$this->Meta_desc."',
        `tags`='".$this->Tags."'
        WHERE `con_id`='".$this->ID."'";
        $result1 = $objdata->Query($sql);

        if($result && $result1 ){
            $objdata->Query('COMMIT');
            return $result;
        }
        else
            $objdata->Query('ROLLBACK');
    }
    function Delete($ids){
        $objdata=new CLS_MYSQL;
        $objdata->Query("BEGIN");
        $sql="DELETE FROM `tbl_content` WHERE `id` in ('$ids')";
        $result=$objdata->Query($sql);
        $sql="DELETE FROM `tbl_content_text` WHERE `con_id` in ('$ids')";
        $result1=$objdata->Query($sql);
        if($result && $result1 ){
            $objdata->Query('COMMIT');
            return $result;
        }else
        $objdata->Query('ROLLBACK');
    }
    function setActive($ids,$status=''){
        $sql="UPDATE `tbl_content` SET `isactive`='$status' WHERE `id` in ('$ids')";
        if($status=='')
            $sql="UPDATE `tbl_content` SET `isactive`=if(`isactive`=1,0,1) WHERE `id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }
    function setHot($ids,$status=''){
        $sql="UPDATE `tbl_content` SET `ishot`='$status' WHERE `id` in ('$ids')";
        if($status=='')
            $sql="UPDATE `tbl_content` SET `ishot`=if(`ishot`=1,0,1) WHERE `id` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }
    function Order($ids,$order){
        $objdata=new CLS_MYSQL;
        $sql="UPDATE tbl_content SET `order`='".$order."' WHERE `id`='".$ids."'";   
        $objdata->Query($sql);  
    }
    function Orders($arids,$arods){
        for($i=0;$i<count($arids);$i++){
            $this->Order($arids[$i],$arods[$i]);
        }
    }
}
?>