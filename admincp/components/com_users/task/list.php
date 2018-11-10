<?php
ini_set('display_errors', 1);
defined('ISHOME') or die("Can't acess this page, please come back!");
define('OBJ_PAGE','USER');
$keyword='';$strwhere='';$action='';
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
		<?php if($obj->isAdmin()==true) { ?>
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
		<?php } ?>
		<div style="clear: both;height: 10px;"></div>
		<table class="table table-bordered">
			<tr class="header">
				<th width="30" align="center"><input type="checkbox" name="chkall" id="chkall" value="" onclick="docheckall('chk',this.checked);" /></th>
				<th align="center">Tên đăng nhập</th>
				<th align="center">Tên</th>
				<th align="center">Email</th>
				<?php if($obj->isAdmin()==true) { ?>
				<th align="center">Đổi mật khẩu</th>
				<th align="center">Nhóm quyền</th>
				<th width="50" align="center">Hiển thị</th>
				<th width="50" align="center">Sửa</th>
				<th width="50" align="center">Xóa</th>
				<?php } ?>
			</tr>
			<?php 
			if(!isset($UserLogin)) $UserLogin=new CLS_USERS();
			$start=($cur_page-1)*MAX_ROWS;
			$obj->getList($strwhere,' LIMIT $start,'.MAX_ROWS);
			while($rows=$obj->Fetch_Assoc()){
				$id=$rows["user_id"];
				$username=$rows["username"];
				$name=$rows["firstname"]." ".$rows["lastname"];
				$gender=($rows["gender"]==0)?'Nam':'Nữ';
				$obj_guser->getList(" WHERE guser_id='".$rows["guser_id"]."' ",''); 
				$grow=$obj_guser->Fetch_Assoc();
				$guser=$grow['name'];
				$email=$rows["email"];
				echo "<tr name='trow'>";
				echo "<td width='30' align='center'><label>";
				echo "<input type='checkbox' name='chk' id='chk' onclick='docheckonce(\"chk\");' value='$id' />";
				echo "</label></td>";
				echo "<td width='100'>$username</td>";
				echo "<td nowrap='nowrap'><a href='index.php?com=".COMS."&amp;task=edit&amp;id=$id'>$name</a></td>";
				echo "<td nowrap='nowrap'>$email</td>";
				if($UserLogin->isAdmin()==true) {
					echo "<td align='center'><a href='index.php?com=".COMS."&amp;task=changepass&amp;id=$id'>Đổi</a></td>";
					echo "<td nowrap='nowrap'>$guser</td>";
					echo "<td width='50' align='center'>";
					echo "<a href='index.php?com=".COMS."&amp;task=active&amp;id=$id'>";
					showIconFun('publish',$rows["isactive"]);
					echo "</a>";			
					echo "</td>";
					echo "<td width='50' align='center'>";
					echo "<a href='index.php?com=".COMS."&amp;task=edit&amp;id=$id'>";
					showIconFun('edit','');
					echo "</a>";			
					echo "</td>";
					echo "<td width='50' align='center'>";
					echo "<a href='javascript:detele_field(\"index.php?com=".COMS."&amp;task=delete&amp;id=$id\")'>";
					showIconFun('delete','');
					echo "</a>";
					echo "</td>";
				}
				echo "</tr>";
			}
			?>
		</table>
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