<?php
class CLS_CONTENTS{
	private $objmysql=null;
	public function CLS_CONTENTS(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function getList($where=''){
		$sql="SELECT * FROM `view_content` WHERE isactive=1 ".$where;
		return $this->objmysql->Query($sql);
	}
    public function countContent($where=''){
        $objdata=new CLS_MYSQL;
        $sql="SELECT count(`view_content`.`id`) as count FROM `view_content` ".$where;
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row['count'];
    }
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
    public function getNameCateByCode($code){
        $objdata=new CLS_MYSQL;
        $sql="SELECT `name` FROM `tbl_category` WHERE `code` = '$code'";
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row['name'];
    }
	public function getNameById($id){
		$objdata=new CLS_MYSQL;
		$sql="SELECT `title` FROM `view_content` WHERE isactive=1 AND `id` = '$id'";
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		return $row['title'];
	}
    public function getAuthorById($id){
        $objdata=new CLS_MYSQL;
        $sql="SELECT `lastname`,`firstname` FROM `tbl_user`  WHERE isactive=1 AND `user_id` = '$id'"; 
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row['lastname'].' '.$row['firstname'];
    }
    //get list style item
    public function getListItem($strwhere="", $limit=""){
        $sql="SELECT * FROM `view_content` ".$strwhere." ORDER BY cdate DESC $limit";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()):
            $intro=strip_tags(Substring($rows['intro'], 0, 20));
            $url=ROOTHOST.$rows['code'].".html";
            $date = date("d-m-Y", strtotime($rows['cdate']));
            $title=Substring($rows['title'], 0, 20);
            $img= getThumbNews($rows['thumb'], 'img-responsive thumb-news1', $rows['title']);
            ?>
            <div class="col-md-4 col-sm-4 col-item">
                <div class="item">
                    <a class="" href="<?php echo $url;?>" title="<?php echo $rows['title'];?>"> <?php echo $img;?></a>
                    <h3 class="name"><a class="" href="<?php echo $url;?>" title="<?php echo $rows['title'];?>"><?php echo $title;?></a> </h3>
                </div>
            </div>
        <?php endwhile;?>
    <?php }
    //get list style item
	 public function updateView($code){
       // if(!isset($_SESSION['count_view'])){
            $sql="UPDATE `tbl_food` SET `view`=`view`+1 WHERE code='$code'";
            $_SESSION['count_view']=1;
            return $this->objmysql->Exec($sql);
        //}
    }
}
?>