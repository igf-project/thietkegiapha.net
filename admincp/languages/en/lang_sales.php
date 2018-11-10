<?php
class LANG_SALES{
	var $pro=array(
				   "CATE_MANAGER"=>"QUẢN LÝ ÐẠI LÝ",
				   "CATE_MANAGER_EDIT"=>"SỬA TÊN ĐAI LÝ",
				   "CATE_MANAGER_ADD"=>"THÊM MỚI ĐẠI LÝ",	
				   
				   "CATE_A01"=>"Thêm mới đại lí",
				   "CATE_A02"=>"Lỗi. Thêm mới đại lí",
				   "CATE_U01"=>"Cập nhật đại lí",
				   "CATE_U02"=>"Lỗi. Thông tin đại lí chưa được cập nhật",
				   "CATE_U03"=>"Lỗi. Không tìm thấy thông đại lí cần lưu trữ trong CSDL.",		
				   "CATE_D01"=>"Xóa đại lí thành công",
				   "CATE_D02"=>"Lỗi. Xóa đại lí không thành công",
				   "CATE_D03"=>"Lỗi. Không tìm thấy đại lí cần xóa.",	
				   "CATE_D04"=>"Lỗi. Đại lí này đang có bài viết, nên bạn không thể xóa. Vui lòng xóa bài viết trước khi xóa nhóm sản phẩm",	
				   "CATE_D05"=>"Lỗi. Đại lí con của nhóm sản phẩm này đang có bài viết, nên bạn không thể xóa. Vui lòng xóa bài viết trước khi xóa nhóm sản phẩm",	
				   "LANG_CODE"=>"Code",
				   "LANG_NAME"=>"Name",
				   "LANG_SITE"=>"Site",
				   "LANG_FLAG"=>"Flag"
				   );
	function __get($proname){
		if(isset($this->pro[$proname]))
			return $this->pro[$proname];
		else
			return "";
	}
}
?>