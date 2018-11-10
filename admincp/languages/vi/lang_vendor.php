<?php
class LANG_HSX{
	var $pro=array(
				   "CATE_MANAGER"=>"QUẢN LÝ HÃNG NCC",
				   "CATE_MANAGER_EDIT"=>"SỬA TÊN HÃNG NCC",
				   "CATE_MANAGER_ADD"=>"THÊM MỚI HÃNG NCC",	
				   "CATE_A01"=>"Thêm mới nhà cung cấp",
				   "CATE_A02"=>"Lỗi. Thêm mới nhà cung cấp",
				   "CATE_U01"=>"Cập nhật nhà cung cấp",
				   "CATE_U02"=>"Lỗi. Thông tin nhà cung cấp chưa được cập nhật",
				   "CATE_U03"=>"Lỗi. Không tìm thấy thông nhà cung cấp cần lưu trữ trong CSDL.",		
				   "CATE_D01"=>"Xóa nhà cung cấp thành công",
				   "CATE_D02"=>"Lỗi. Xóa nhà cung cấp không thành công",
				   "CATE_D03"=>"Lỗi. Không tìm thấy nhà cung cấp cần xóa.",	
				   "CATE_D04"=>"Lỗi. nhà cung cấp này đang có bài viết, nên bạn không thể xóa. Vui lòng xóa bài viết trước khi xóa nhóm sản phẩm",	
				   "CATE_D05"=>"Lỗi. nhà cung cấp con của nhóm sản phẩm này đang có bài viết, nên bạn không thể xóa. Vui lòng xóa bài viết trước khi xóa nhóm sản phẩm",	
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