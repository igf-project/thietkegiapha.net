
<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('OBJ_PAGE','GALLERY');
$keyword='';
if(isset($_POST['txtkeyword'])){
    $keyword=trim($_POST['txtkeyword']);
    $_SESSION['KEY_'.OBJ_PAGE]=$keyword;
}
$strwhere=' WHERE 1=1';
if(isset($_POST['cbo_active']))
    $_SESSION['ACT'.OBJ_PAGE]=addslashes($_POST['cbo_active']);
if(isset($_SESSION['KEY_'.OBJ_PAGE]) && $keyword!='')
    $keyword=$_SESSION['KEY_'.OBJ_PAGE];
else
    $keyword='';
$action=isset($_SESSION['ACT'.OBJ_PAGE]) ? $_SESSION['ACT'.OBJ_PAGE]:'';
if($keyword!='')
    $strwhere.=" AND(`name` like '%$keyword%')";

if($action!='' && $action!='all' ){
    $strwhere.=" AND `isactive` = '$action'";
}
$obj->getListAlbum($strwhere);
$total_rows=$obj->Num_rows();
$cur_page=isset($_POST['txtCurnpage'])? (int)$_POST['txtCurnpage']:'1';
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
                <td><strong>Tìm kiếm:</strong>
                    <input type="text" name="txtkeyword" id="txtkeyword" placeholder="Keyword" value="<?php echo $keyword;?>"/>
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
                <th align="center" width="140">Hình ảnh</th>
                <th align="center">Tên album</th>
                <th align="center">Mô tả</th>
                <td width="80" align="center">Sắp xếp
                    <a href="javascript:saveOrder()">
                        <img src="templates/default/images/save.png" border="0" width="13" alt="Save" longdesc="#" />
                    </a>
                </td>
                <th width="70" align="center">Hiển thị</th>
                <th width="30" align="center">Sửa</th>
                <th width="30" align="center">Xóa</th>
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