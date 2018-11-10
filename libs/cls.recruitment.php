<?php
class CLS_RECRUITMENT{
	private $objmysql=null;
	public function CLS_RECRUITMENT(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function getList($where=''){
		$sql="SELECT `tbl_recruitment`.* FROM `tbl_recruitment` WHERE isactive=1 ".$where;
		return $this->objmysql->Query($sql);
	}
    public function countContent($where=''){
        $objdata=new CLS_MYSQL;
        $sql="SELECT count(`tbl_recruitment`.`id`) as count FROM `tbl_recruitment` ".$where;
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
	public function getNameById($id){
		$objdata=new CLS_MYSQL;
		$sql="SELECT `title` FROM `tbl_recruitment` WHERE isactive=1 AND `id` = '$id'";
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		return $row['title'];
	}
    public function getNameCateByCode($code){
        $objdata=new CLS_MYSQL;
        $sql="SELECT `name` FROM `tbl_category` WHERE `code` = '$code'";
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row['name'];
    }
    public function getShowroomById($id){
        $objdata=new CLS_MYSQL;
        $sql="SELECT `title` FROM `tbl_showroom` WHERE `id`='$id'";
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        $count=$objdata->Num_rows();
        if($count>=1)
             return $row['title'];
        else
            return 'Đang cập nhật';
    }
    //get list style item
    public function getListItem($strwhere="", $limit=""){
        $sql="SELECT `tbl_recruitment`.`id`, `tbl_recruitment`.`code`, `tbl_recruitment`.`ishot`, `tbl_recruitment`.`edate`, `tbl_recruitment`.`showroom_id`,
				`tbl_recruitment`.`title`, `tbl_recruitment`.`intro`, `tbl_recruitment`.`author`
			FROM `tbl_recruitment` ".$strwhere." ORDER BY `tbl_recruitment`.`id` DESC $limit";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        while($rows=$objdata->Fetch_Assoc()):
            $url=ROOTHOST."career/".$rows['code'].".html";
            $ishot=$rows['ishot'];
            $date = date("d/m/Y", strtotime($rows['edate']));
            $title=Substring($rows['title'], 0, 20);
            ?>
            <div class="col-md-6 col-sm-6 col-item">
                <div class="item">
                    <h3 class="name">
                        <a class="" href="<?php echo $url;?>" title="<?php echo $rows['title'];?>"><?php echo $title;?></a>
                        <?php if($ishot==1) {?><img src="<?php echo ROOTHOST."images/icon-hot.gif";?>" class="ic-hot"/><?php } ?>
                    </h3>
                    <span class="date"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $date;?></span>
                </div>
            </div>
        <?php endwhile;?>
    <?php }
	
}
?>