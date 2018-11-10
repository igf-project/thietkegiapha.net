<?php
class CLS_VIDEO{
	private $objmysql=null;
	public function CLS_GALLERY(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function getList($where=''){
		$sql="SELECT * FROM `tbl_video` ".$where;
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
		return  $objdata->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}


    function getListVideoHot(){
        $sql="SELECT * FROM `tbl_video` WHERE `ishot`=1 ORDER BY `id` DESC LIMIT 1";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $i=0;
        while($rows=$objdata->Fetch_Assoc())
        {	$i++;
            $id=$rows['id'];
            $video_id=$rows['video_id'];
            $url=ROOTHOST."thu-vien-video/".$rows['code'].".html";
            ?>
            <div class="video-hot">
                <a class="item" href="<?php echo $url;?>" title="<?php echo $rows['name'];?>">
                    <img src="<?php echo "http://img.youtube.com/vi/".$video_id."/0.jpg";?>" class="img-video img-responsive"/>
                    <span class="ic-play"></span>
                </a>
                <h3 class="name"><?php echo $rows['name'];?></h3>
            </div>
        <?php
        }
    }
    function getListVideo($strwhere="",$limit=''){
        $sql="SELECT * FROM `tbl_video` $strwhere ORDER BY `id` DESC $limit";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        $i=0;
        while($rows=$objdata->Fetch_Assoc())
        {	$i++;
            $id=$rows['id'];
            $video_id=$rows['video_id'];
            $url=ROOTHOST."thu-vien-video/".$rows['code'].".html";
            ?>
            <div class="col-md-4 col-sm-4 col-xs-6 col-item">
                <a class="item" href="<?php echo $url;?>" title="<?php echo $rows['name'];?>">
                    <img src="<?php echo "http://img.youtube.com/vi/".$video_id."/0.jpg";?>" class="img-video img-responsive"/>
                    <span class="ic-play"></span>
                </a>
                <h3 class="name"><?php echo $rows['name'];?></h3>
            </div>
        <?php
        }
    }

    /* combo box*/
    function getName($album_id=''){
        if($album_id!='')
            $sql="SELECT name FROM tbl_album WHERE  id='$album_id'";
        else
            $sql="SELECT name FROM tbl_album ORDER BY `order` ASC LIMIT 0,1";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        if($objdata->Num_rows()<=0) return;
        $rows=$objdata->Fetch_Assoc();
        return $rows['name'];
    }
    public function countVideo($where=''){
        $objdata=new CLS_MYSQL;
        $sql="SELECT count(`tbl_video`.`id`) as count FROM `tbl_video` ".$where;
        $objdata->Query($sql);
        $row=$objdata->Fetch_Assoc();
        return $row['count'];
    }
}
?>