<?php
class CLS_PRODUCT{
	private $objmysql=null;
	public function CLS_PRODUCT(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function getList($where=''){
		$sql="SELECT * FROM `tbl_product` WHERE isactive=1 ".$where;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
    public function getNameById($id){
        $sql="SELECT `name` FROM `tbl_product` WHERE `isactive`=1 AND `id`=$id";       
        $objmysql=new CLS_MYSQL;
        $objmysql->Query($sql);
        $row=$objmysql->Fetch_Assoc();
        return $row['name'];
    }
    public function getNameGroupByCode($code){
        $objdata=new CLS_MYSQL;
        $sql="SELECT `name` FROM `tbl_group` WHERE `code` = '$code'";
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row['name'];
    }
    public function getNameCateGroupByCode($code){
        $objdata=new CLS_MYSQL;
        $sql="SELECT `name` FROM `tbl_cataloggroup` WHERE `code` = '$code'";
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row['name'];
    }
    public function getNameCateByCode($code){
        $objdata=new CLS_MYSQL;
        $sql="SELECT `name` FROM `tbl_service` WHERE `code` = '$code'";
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row['name'];
    }
    public function getListItem($strwhere="", $limit=""){
        $sql="SELECT tbl_product.* FROM tbl_product WHERE 1=1 $strwhere ORDER BY `tbl_product`.`order`,`tbl_product`.`cdate` DESC $limit";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);	$i=0;
        if($objdata->Num_rows()<1){
            echo  'Dữ liệu đang được cập nhật';
            return false;
        }
        while($rows=$objdata->Fetch_Assoc())
        {	$i++;
            $ids=$rows['id'];
            $code=$rows['code'];
            $title = Substring(stripslashes($rows['name']),0,10);
            $intro =$rows['intro']!==''? Substring(stripslashes($rows['intro']),0,16):'Đang cập nhật';
            $img= getThumb($rows['thumb'], 'img-responsive img-product',$rows['name']);
            $url=ROOTHOST.'project/'.$code.'.html';
            ?>
            <div class="col-md-4 col-sm-4 col-xs-6 col-custom">
                <a class="item" href="<?php echo $url;?>" title="<?php echo $rows['name'];?>">
                    <?php echo $img;?>
                    <h3 class="name-pro"><?php echo $title;?></h3>
                </a>
            </div>
        <?php
        }
    }

    public function getListItem2($strwhere="", $limit=""){
        $sql="SELECT tbl_product.* FROM tbl_product $strwhere ORDER BY `tbl_product`.`order`,`tbl_product`.`cdate` DESC $limit";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);	$i=0;
        if($objdata->Num_rows()<1){
            echo  NO_UPDATED_DATA;
            return false;
        }
        while($rows=$objdata->Fetch_Assoc())
        {	$i++;
            $ids=$rows['id'];
            $code=$rows['code'];
            $title = Substring(stripslashes($rows['name']),0,10);
            $intro =Substring(stripslashes($rows['intro']),0,10);
            $img= getThumb($rows['thumb'], 'img-responsive img-product',$rows['name']);
            $url=ROOTHOST.$code.'.html';
            ?>
            <div class="item">
                <div class="row row row-fullheight">
                    <div class="col-md-7 left-side">
                        <a href="<?php echo $url;?>" title="<?php echo $rows['name'];?>"><?php echo $img;?></a>
                    </div>
                    <div class="col-md-5 right-side">
                        <h3 class="name-pro"><a href="<?php echo $url;?>" class="name txt-ellipsis" title="<?php echo $rows['name'];?>"><?php echo $title;?></a></h3>
                        <div class="txt-intro"><?php echo $intro;?></div>
                        <ul class="list-act">
                            <li>
                                <a href="#">See related blogs...</a>
                            </li>
                            <li>
                                <a href="#">See related service...</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php
        }
    }

}
?>