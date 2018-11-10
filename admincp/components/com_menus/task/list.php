<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('OBJ_PAGE','MENUS');
$flag=false;
if(!isset($UserLogin)) $UserLogin=new CLS_USERS;
if($UserLogin->isAdmin()==true)
	$flag=true;
if($flag==false){
	echo ('<div id="action" style="background-color:#fff"><h4>Bạn không có quyền truy cập. <a href="index.php">Vui lòng quay lại trang chính</a></h4></div>');
	return false;
}
$keyword='';$strwhere='WHERE 1=1 ';$action='';
// Khai báo SESSION
if(isset($_POST['txtkeyword'])){
  $keyword=trim($_POST['txtkeyword']);
  $_SESSION['KEY_'.OBJ_PAGE]=$keyword;
}
if(isset($_POST['cbo_active']))
    $_SESSION['ACT'.OBJ_PAGE]=addslashes($_POST['cbo_active']);
if(isset($_SESSION['KEY_'.OBJ_PAGE]))
    $keyword=$_SESSION['KEY_'.OBJ_PAGE];
else
    $keyword='';
$action=isset($_SESSION['ACT'.OBJ_PAGE]) ? $_SESSION['ACT'.OBJ_PAGE]:'';

// Gán strwhere
if($keyword!='')
    $strwhere.=" AND ( `name` like '%$keyword%' )";
if($action!='' && $action!='all' ){
    $strwhere.=" AND `isactive` = '$action'";
}

// Pagging
if(!isset($_SESSION['CUR_PAGE_'.OBJ_PAGE]))
    $_SESSION['CUR_PAGE_'.OBJ_PAGE]=1;
if(isset($_POST['txtCurnpage'])){
    $_SESSION['CUR_PAGE_'.OBJ_PAGE]=(int)$_POST['txtCurnpage'];
}
$obj->getList($strwhere,'');
$total_rows=$obj->Num_rows();
if($_SESSION['CUR_PAGE_'.OBJ_PAGE]>ceil($total_rows/MAX_ROWS))
    $_SESSION['CUR_PAGE_'.OBJ_PAGE]=ceil($total_rows/MAX_ROWS);
$cur_page=$_SESSION['CUR_PAGE_'.OBJ_PAGE] ? $_SESSION['CUR_PAGE_'.OBJ_PAGE]>0:1;
// End pagging
?>
<div id="list">
	<script language="javascript">
		function checkinput(){
			var strids=document.getElementById("txtids");
			if(strids.value==""){
				alert('You are select once record to action');
				return false;
			}
			return true;
		}
	</script>
	<form id="frm_list" name="frm_list" method="post" action="">
		<div class="table-responsive">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Header_list">
				<tr>
					<td>Tìm kiếm:
						<input type="text" name="txtkeyword" id="txtkeyword" placeholder="Keyword" value="<?php echo $keyword;?>"/>
						<input type="submit" name="button" id="button" value="Tìm kiếm" class="button" />
					</td>
					<td align="right">
						<select name="cbo_active" id="cbo_active" onchange="document.frm_list.submit();">
							<option value="all">Tất cả</option>
							<option value="1">Hiển thị</option>
							<option value="0">Ẩn</option>
							<script language="javascript">
								cbo_Selected('cbo_active','<?php echo $action;?>');
							</script>
						</select>
					</td>
				</tr>
			</table>
		</div>
		<div style="height:10px;"></div>
		<div class="table-responsive">
			<table class="table table-bordered">
				<tr class="header">
					<th width="30" align="center">#</th>
					<th width="30" align="center"><input type="checkbox" name="chkall" id="chkall" value="" onclick="docheckall('chk',this.checked);" /></th>
					<th width="150" align="center">Mã</th>
					<th align="center">Tên</th>
					<th align="center">Mô tả</th>
					<th width="100" align="center">Menu chi tiết</th>
					<td width="50" align="center">Hiển thị</td>
					<td width="50" align="center">Sửa</td>
					<td width="50" align="center">Xóa</td>
				</tr>
				<?php
				$start=($cur_page-1)*MAX_ROWS;
				$obj->getList($strwhere," LIMIT $start,".MAX_ROWS);
				$i=0;
				while($rows= $obj->Fetch_Assoc()){ $i++;
					$id=$rows['id'];$code=$rows['code'];$name=Substring($rows['name'],0,10);$desc=$rows['desc'];
					echo "<tr name=\"trow\">";
					echo "<td width=\"30\" align=\"center\">$i</td>";
					echo "<td width=\"30\" align=\"center\"><label>";
					echo "<input type=\"checkbox\" name=\"chk\" id=\"chk\" onclick=\"docheckonce('chk');\" value=\"$id\" />";
					echo "</label></td>";
					echo "<td width=\"75\">$code</td>";
					echo "<td>$name</td>";
					echo "<td>$desc &nbsp;</td>";

					echo "<td align=\"center\">";
					echo "<a href=\"index.php?com=mnuitem&mnuid=$id\">";
					showIconFun('menuitem',0);
					echo "</a>";
					echo "</td>";

					echo "<td width=\"50\" align=\"center\">";
					echo "<a href=\"index.php?com=".COMS."&task=active&id=$id\">";
					showIconFun('publish',$rows["isactive"]);
					echo "</a>";
					echo "</td>";

					echo "<td width=\"50\" align=\"center\">";

					echo "<a href=\"index.php?com=".COMS."&task=edit&id=$id\">";
					showIconFun('edit','');
					echo "</a>";

					echo "</td>";
					echo "<td width=\"50\" align=\"center\">";

					echo "<a href=\"javascript:detele_field('index.php?com=".COMS."&task=delete&id=$id')\">";
					showIconFun('delete','');
					echo "</a>";

					echo "</td>";
					echo "</tr>";
				}
				?>
			</table>
		</div>
	</form>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
		<tr>
			<td align="center">	  
				<?php 
				paging($total_rows,MAX_ROWS,$cur_page);
				?>
			</td>
		</tr>
	</table>
</div>
<?php //----------------------------------------------?>