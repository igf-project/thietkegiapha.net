<div id="menus" class="toolbars">
    <form id="frm_menu" name="frm_menu" method="post" action="">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td><h2 style="margin:0px; padding:0px;" title="<?php echo $title_manager;?>"><?php echo $title_manager;?></h2></td>
                <td>
                    <label>
                        <input type="hidden" name="txtorders" id="txtorders" />
                        <input type="hidden" name="txtids" id="txtids" />
                        <input type="hidden" name="txtaction" id="txtaction" />
                    </label>
                </td>
                <td align="right">
                    <ul>
                        <?php 
                        $task='';
                        if(!isset($_GET["task"])){ ?>
                        <li><a class="edit" href="index.php?com=<?php echo COMS;?>" title="Danh sách">List</a></li>
                        <li><a class="publish" href="#" onclick="dosubmitAction('frm_menu','public');" title="Hiển thị">Hiển thị</a> </li>
                        <li><a class="unpublish" href="#" onclick="dosubmitAction('frm_menu','unpublic');" title="Ẩn">Ẩn</a></li>
                        <li><a class="addnew" href="index.php?com=<?php echo COMS;?>&task=add" title="Thêm mới">Thêm mới</a></li>
                        <li><a class="delete" href="#" onclick="javascript:if(confirm('Bạn có chắc chắn muốn xóa thông tin này không?')){dosubmitAction('frm_menu','delete'); }" title="Xóa">Xóa</a></li>
                        <?php }else{?>
                        <li><a class="save"  href="#" onclick="dosubmitAction('frm_action','save');" title="Lưu">Lưu</a></li>
                        <li><a class="close"  href="index.php?com=<?php echo COMS;?>" title="Đóng">Đóng</a></li>
                        <li><a class="help"  href="index.php?com=<?php echo COMS;?>&task=help" title="Trợ giúp">Trợ giúp</a></li>
                        <?php } ?>
                    </ul>
                </td>
            </tr>
        </table>
    </form>
</div>