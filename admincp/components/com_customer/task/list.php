<div id="menus" class="toolbars">
    <form id="frm_menu" name="frm_menu" method="post" action="">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td><h2 style="margin:0px; padding:0px;" title="<?php echo $title_manager;?>"><?php echo $title_manager;?></h2></td>
                <td>
                    <label>
                        <input type="hidden" name="txtids" id="txtids" />
                        <input type="hidden" name="txtaction" id="txtaction" />
                    </label>
                </td>
                <td align="right">
                    <ul>

                        <li><a class="edit" href="#" onclick="dosubmitAction('frm_menu','sendmail');">Gửi mail</a></li>	
                        <li><a class="delete" href="#" onclick="javascript:if(confirm('Bạn có chắc chắn muốn xóa thông tin này không?')){dosubmitAction('frm_menu','delete'); }" title="Xóa">Xóa</a></li>     
                    </ul>
                </td>
            </tr>
        </table>
    </form>
</div>
<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('OBJ_PAGE','CUSTOMER');
$keyword='';
$txt_fromdate=isset($_POST['txt_fromdate'])? $_POST['txt_fromdate']:'';

$txt_todate=isset($_POST['txt_todate'])? $_POST['txt_todate']:'';
$keyword=isset($_POST['txtkeyword'])? trim(addslashes($_POST['txtkeyword'])):'';
$strwhere='Where 1=1';

if($keyword!='')
    $strwhere.=" AND(`name` like '%$keyword%')";
if($txt_fromdate!='')
    $strwhere.=" AND `cdate`>='$txt_fromdate'";
if($txt_todate!='')
    $strwhere.=" AND `cdate`<='$txt_todate'";

$obj->getList($strwhere);
$total_rows=$obj->Num_rows();
$cur_page=isset($_POST['txtCurnpage'])? (int)$_POST['txtCurnpage']:'1';
?>
<div id="list">
    <script language="javascript">
        function checkinput(){
            var strids=document.getElementById("txtids");
            if(strids.value=="")
            {
                alert('You are select once record to action');
                return false;
            }
            return true;
        }
    </script>
    <form id="frm_list" name="frm_list" method="post" action="">
        <div class="frm-filter form-inline">
            <div class="form-group">
                <label for="">Từ khóa</label>
                <input type="text" class="form-control" name="txtkeyword" id="txtkeyword" placeholder="Keyword" value="<?php echo $keyword;?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail2">Từ ngày</label>
                <input type="date" class="form-control" id="txt_fromdate" name="txt_fromdate" value="<?php echo $txt_fromdate;?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail2">Đến ngày</label>
                <input type="date" class="form-control" id="txt_todate" name="txt_todate" value="<?php echo $txt_todate;?>">
            </div>
            <input type="submit" name="button" id="button" value="Tìm kiếm" class="btn btn-primary"/>
        </div>
        <div style="clear:both;height:10px;"></div>
        <table class="table table-bordered">
            <tr class="header">
                <th width="30" align="center">#</th>
                <th width="30" align="center"><input type="checkbox" name="chkall" id="chkall" value="" onclick="docheckall('chk',this.checked);" /></th>
                <th align="center">Họ và tên</th>
                <th width="30" align="center">Phone</th>
                <th width="30" align="center">Email</th>
                <th width="30" align="center">Time</th>
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
