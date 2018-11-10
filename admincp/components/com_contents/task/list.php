
<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('OBJ_PAGE','CONTENTS');
$keyword='';$strwhere='';$action='';$key_category='';
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

// Category
if(isset($_POST['key_category'])){
    $key_category=trim($_POST['key_category']);
    $_SESSION['KEY_CATEGORY']=$key_category;
}
if(isset($_SESSION['KEY_CATEGORY']))
    $key_category=$_SESSION['KEY_CATEGORY'];

// Gán strwhere
if($keyword!='')
    $strwhere.=" AND ( `title` like '%$keyword%' )";
if($action!='' && $action!='all' ){
    $strwhere.=" AND `isactive` = '$action'";
}
if($key_category!='')
    $strwhere.=" AND `tbl_contents`.`cate_id`='$key_category'";

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
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Header_list">
            <tr>
                <td>
                    <strong>Tìm kiếm:</strong>
                    <input type="text" name="txtkeyword" id="txtkeyword" placeholder="Keyword" value="<?php echo $keyword;?>"/>
                    <select name="key_category" id="key_category" onchange="document.frm_list.submit();">
                        <option value="">Tất cả</option>
                        <?php $obj_cate->getListCbItem($key_category); ?>
                    </select>
                    <input type="submit" name="button" id="button" value="Tìm kiếm" class="button" size='30'/>
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
        <div style="clear:both;height:10px;"></div>
        <table class="table table-bordered">
          <tr class="header">
            <th width="30" align="center">#</th>
            <th width="30" align="center"><input type="checkbox" name="chkall" id="chkall" value="" onclick="docheckall('chk',this.checked);" /></th>
            <th align="center">Tiêu đề</th>
            <th width="180" align="center">Nhóm tin</th>
            <th align="center" width="100">Tác giả</th>
            <th align="center">Views</th>
            <th width="30" align="center">isHot</th>
            <th width="50" align="center">Hiển thị</th>
            <th width="50" align="center">Sửa</th>
            <th width="50" align="center">Xóa</th>
        </tr>
        <?php 
        $obj->listTable($strwhere,$cur_page);
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
