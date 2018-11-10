<?php
?>
<div class="box-breadcrumb">
    <ul class="breadcrumb">
        <li><a href="<?php echo ROOTHOST;?>" title="Trang chủ">Trang chủ</a></li>
        <li class="active">Đặt câu hỏi</li>
    </ul>
</div>
<form class="col-md-8 col-md-offset-2" name="frm-answer" method="post" action="" role="form">
    <h1>Đặt câu hỏi</h1>
    <div class="form-group">
        <label>Điện thoại</label>
        <input type="phone" class="form-control" name="txt-phone" required>
    </div>
    <div class="form-group">
        <label>Email (nếu có)</label>
        <input type="email" class="form-control" name="txt-email">
    </div>
    <div class="form-group">
        <textarea class="form-control" name="content-answer" rows="5" required></textarea>
    </div>
    <div class="text-center"><button type="submit" name="button-submit" class="btn btn-success">Gửi yêu cầu</button> </div>
</form>
