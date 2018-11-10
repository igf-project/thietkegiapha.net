<?php
class CLS_MENUITEM{
	private $objmysql=null;
	public function CLS_MENUITEM(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function getList($mnuid=0,$where=""){
		if($where!="")
			$where=" WHERE `mnu_id`='$mnuid' AND ".$where;
		$sql="SELECT * FROM `view_menuitem` ".$where;
		return $this->objmysql->Query($sql);
	}
	function Num_rows() { 
		return $this->objmysql->Num_rows();
	}
	function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function ListTopmenu($mnuid=0,$par_id=0,$level=1){
		$sql="SELECT * FROM `view_menuitem` WHERE `par_id`='$par_id' AND `mnu_id`='$mnuid' AND`isactive`='1' ORDER BY `order` ASC, mnu_id ASC";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$total = $objdata->Num_rows();
		if($total<=0)
			return;
		$style="";
		if($level==1)
			$style.='submenu';
		else if($level>1)
			$style.='submenu'.$level;
			
		$str='<ul class="list">';  	
		while($rows=$objdata->Fetch_Assoc()){
		
			$urllink="";
			if($rows['viewtype']=='link'){
				if(trim($rows['link'])!=''){
					$urllink=$rows['link'];
				}else{
					$urllink=ROOTHOST.un_unicode($rows["name"])."-mnu".$rows["mnu_id"].".html";
				}
			}
			else if($rows['viewtype']=='article'){
				$objcon=new CLS_CONTENTS;
				$objcon->getList(" AND con_id = '".$rows['con_id']."' ");
				$row_con=$objcon->Fetch_Assoc();
				$urllink=ROOTHOST.$row_con['code'].'.html';
			}
			else if($rows['viewtype']=='block' || $rows['viewtype']=='list' ){
				$objcat=new CLS_CATE;
                $objcon=new CLS_CONTENTS;
				$objcat->getList(" AND cate_id = '".$rows['cate_id']."' ");
				$objcat=$objcon->Fetch_Assoc();
				$urllink=ROOTHOST.$objcat['code'].'/';
			}
			$cls='';
			$curmenu=isset($_SESSION['CUR_MENU']) ? $_SESSION['CUR_MENU']:'';
            $cursub=isset($_SESSION['CUR_SUB_MENU']) ? $_SESSION['CUR_SUB_MENU']:'';
			if(isset($curmenu) && $curmenu!='')
				$cls='';
			if($curmenu==$rows['mnu_id'] || $cursub==$rows['mnu_id'])
				$cls=' class="active" ';
				
			$cls.='class="'.$rows['class'].'"';
			$str.="<li $cls><a href=\"$urllink\" title='".$rows['name']."'><span>".$rows["name"]."</span></a>";
			$str.=$this->ListTopmenu($mnuid,$rows["mnu_id"],$level+1);
			$str.='</li>';	
		}
		$str.='</ul>';  
		return $str;
	}
	public function ListMenuItem($mnuid=0,$par_id=0,$level=0){
		$sql="SELECT * FROM `view_menuitem` WHERE `par_id`='$par_id' AND `mnu_id`='$mnuid' AND`isactive`='1' ORDER BY `order`";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		if($objdata->Num_rows()<=0)
			return;
		$style="";$str='';
		if($level>=1) $str.="<ul class=\"dropdown-menu\">";
		else $str="
			<ul class='nav navbar-nav main-menu'>";
		$i=0;
		while($rows=$objdata->Fetch_Assoc()){
			$urllink="";
			if($rows['viewtype']=='link'){
				if(trim($rows['link'])!=''){
					$urllink=$rows['link'];
				}else{
					$urllink=ROOTHOST.un_unicode($rows["name"])."-mnu".$rows["mnu_id"].".html";
				}
			}
			else if($rows['viewtype']=='article'){
				$objcon=new CLS_CONTENTS;
				$objcon->getList(" AND id = '".$rows['con_id']."'");
				$row_con=$objcon->Fetch_Assoc();
				$urllink=ROOTHOST.$row_con['code'].'.html';
			}
			else if($rows['viewtype']=='block' || $rows['viewtype']=='list' ){
				$objcat=new CLS_CATE;
				$objcat->getList(" AND cate_id = '".$rows['cate_id']."'");
				$row_cat=$objcat->Fetch_Assoc();
				$urllink=ROOTHOST.$row_cat['code'].'/';
			}
			$cls='';
		   	$curmenu=isset($_SESSION['CUR_MENU']) ? $_SESSION['CUR_MENU']:'';
            $cursub=isset($_SESSION['CUR_SUB_MENU']) ? $_SESSION['CUR_SUB_MENU']:'';
            if(isset($curmenu) && $curmenu!='')
                $cls='';
			if($curmenu==$rows['mnu_id'] || $cursub==$rows['mnu_id']) $cls.=' active ';
			$cls.=$rows['class'];
			$child = $this->ListMenuItem($mnuid,$rows["id"],$level+1);
			if($child) $cls.="dropdown";
			$cls = $cls!=''?"class='".$cls."'":'';
			
			$str.="<li $cls>";
			if(!$child)
				$str.="<a href='".$urllink."' title='".$rows['name']."'><span>".$rows["name"]."</span></a>";
			else {
				$str.="<a class='dropdown-toggle'  role='button' aria-haspopup='true'  aria-expanded='false' href='".$urllink."' title='".$rows['name']."'>".$rows["name"]."<span class='caret'></span></a>";
                $str.="<span class='bulet-dropdown'></span>";
				$str.=$child;
			}
			$str.='</li>';			
		}
		$str.='</ul>';  
		return $str;
	}
    public function ListMenuItem1($mnuid=0,$par_id=0,$level=0){
        $sql="SELECT * FROM `view_menuitem` WHERE `par_id`='$par_id' AND `mnu_id`='$mnuid' AND`isactive`='1' ORDER BY `order`";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        if($objdata->Num_rows()<=0)
            return;
        $style="";$str='';
        if($level>=1) $str.="<ul class=\"dropdown-menu\">";
        else {
            $str="<ul class='main-menu nav navbar-nav'>";
            $str.='<li><a href="'.ROOTHOST.'" title="Trang chủ"><span class="icon_home"><i class="fa fa-home" aria-hidden="true"></i></span></a></li>';
        }
        $i=0;
        while($rows=$objdata->Fetch_Assoc()){
            //echo $rows['cate_id'];
            $urllink="";
            if($rows['viewtype']=='link'){
                if(trim($rows['link'])!=''){
                    $urllink=$rows['link'];
                }else{
                    $urllink=ROOTHOST.un_unicode($rows["name"])."-mnu".$rows["mnu_id"].".html";
                }
            }
            else if($rows['viewtype']=='article'){
                $objcon=new CLS_CONTENTS;
                $objcon->getList(" AND id = '".$rows['con_id']."'");
                $row_con=$objcon->Fetch_Assoc();
                $urllink=ROOTHOST.$row_con['code'].'.html';
            }
            else if($rows['viewtype']=='block' || $rows['viewtype']=='list' ){
                $objcat=new CLS_CATE;
                $objcat->getList(" AND cate_id = '".$rows['cate_id']."'");
                $row_cat=$objcat->Fetch_Assoc();
                $urllink=ROOTHOST.$row_cat['code'].'/';
            }
            $curmenu=isset($_SESSION['CUR_MENU']) ? $_SESSION['CUR_MENU']:'';
            $cursub=isset($_SESSION['CUR_SUB_MENU']) ? $_SESSION['CUR_SUB_MENU']:'';
            if(isset($curmenu) && $curmenu!='')
                $cls='';
            $cls='';
            if($curmenu==$rows['mnu_id'] || $cursub==$rows['mnu_id']) $cls.=' active ';
            $cls.=" ".$rows['class']." ";
            $child = $this->ListMenuItem1($mnuid,$rows["mnu_id"],$level+1);
            if($child) $cls.=" dropdown ";
            $cls = $cls!=''?"class='".$cls."'":'';


            $str.="<li $cls>";
            if(!$child)
                $str.="<a href='".$urllink."' title='".$rows['name']."'><span>".$rows["name"]."</span></a>";
            else {
                $str.="<a class='dropdown-toggle' data-toggle='dropdown'  role='button' aria-haspopup='true'  aria-expanded='false' href='".$urllink."' title='".$rows['name']."'>".$rows["name"]."<span class='caret'></span></a>";
                $str.="<span class='bulet-dropdown'></span>";
                $str.=$child;
            }
            $str.='</li>';
        }
        $str.='</ul>';
        return $str;
        // data-toggle=\"dropdown\"
    }
}
?>