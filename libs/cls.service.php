<?php
class CLS_SERVICE{
	private $objmysql=null;
	public function CLS_SERVICE(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function getList($where=''){
		$sql="SELECT `tbl_service`.* FROM `tbl_service` WHERE isactive=1 ".$where;
		return $this->objmysql->Query($sql);
	}
    public function countContent($where=''){
        $objdata=new CLS_MYSQL;
        $sql="SELECT count(`tbl_service`.`id`) as count FROM `tbl_service` ".$where;
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
		$sql="SELECT `title` FROM `tbl_service` WHERE isactive=1 AND `id` = '$id'";
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		return $row['title'];
	}
    //get list style item
    public function getListItem($strwhere="", $limit=""){
        $sql="SELECT `tbl_service`.`id`, `tbl_service`.`code`, `tbl_service`.`thumb`, `tbl_service`.`cdate`,
				`tbl_service`.`title`, `tbl_service`.`intro`, `tbl_service`.`author`
			FROM `tbl_service` ".$strwhere." ORDER BY `tbl_service`.`id` DESC $limit";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()):
            $intro=strip_tags(Substring($rows['intro'], 0, 20));
            $url=ROOTHOST."tin-tuc/".$rows['code'].".html";
            $date = date("d-m-Y", strtotime($rows['cdate']));
            $title=Substring($rows['title'], 0, 20);
            $img= getThumbNews($rows['thumb'], 'img-responsive thumb-news1', $rows['title']);
            ?>
            <div class="col-md-3 col-sm-4 col-item">
                <div class="item">
                    <a class="" href="<?php echo $url;?>" title="<?php echo $rows['title'];?>"> <?php echo $img;?></a>
                    <h3 class="name"><a class="" href="<?php echo $url;?>" title="<?php echo $rows['title'];?>"><?php echo $title;?></a> </h3>
                    <span class="date"><?php //echo $date;?></span>
                    <p><?php echo $intro;?></p>
                    <a class="btn btn-readmore" href="<?php echo $url;?>">Chi tiết</a>
                </div>
            </div>
        <?php endwhile;?>
    <?php }
    //get list style item
    public function getListItemHome($strwhere="", $limit=""){
        $sql="SELECT `tbl_service`.`id`, `tbl_service`.`code`, `tbl_service`.`thumb`, `tbl_service`.`cdate`,
				`tbl_service`.`title`, `tbl_service`.`intro`, `tbl_service`.`author`
			FROM `tbl_service` ".$strwhere." ORDER BY `tbl_service`.`id` DESC $limit";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $index=0;
        while($rows=$objdata->Fetch_Assoc()):
            $index++;
            $intro=strip_tags(Substring($rows['intro'], 0, 20));
            $url=ROOTHOST."service/".$rows['code'].".html";
            $date = date("d-m-Y", strtotime($rows['cdate']));
            $title=Substring($rows['title'], 0, 20);
            $img= getThumbNews($rows['thumb'], 'img-responsive thumb-news', $rows['title']);
            if($index==1) echo '<div class="col-sm-12 col-item item-1">';
            else echo '<div class="col-sm-6 col-item">';
            ?>
                <div class="item">
                    <a class="" href="<?php echo $url;?>" title="<?php echo $rows['title'];?>"> <?php echo $img;?></a>
                    <h3 class="name"><a class="" href="<?php echo $url;?>" title="<?php echo $rows['title'];?>"><?php echo $title;?></a> </h3>
                </div>
            </div>
        <?php endwhile;?>
    <?php }
	 public function updateView($code){
       // if(!isset($_SESSION['count_view'])){
            $sql="UPDATE `tbl_food` SET `view`=`view`+1 WHERE code='$code'";
            $_SESSION['count_view']=1;
            return $this->objmysql->Exec($sql);
        //}
    }
}
?>