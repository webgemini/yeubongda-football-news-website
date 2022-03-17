<?php
if ($user)
{
	if ($data_user['url_avatar'] == '')
	{
		$data_user['url_avatar'] = $_DOMAIN.'admin/images/profile.jpg';
	}else
	{
		$data_user['url_avatar'] = str_replace('admin/', '', $_DOMAIN . 'admin/') . $data_user['url_avatar'];
	}

	// Form upload ảnh đại diện
	echo
	'
		<h3>Hồ sơ cá nhân</h3>
		<div class="panel panel-default">
			<div class="panel-heading">Upload ảnh đại diện</div>
			<div class="panel-body">
				<form action="' . $_DOMAIN . 'admin/profile.php" method="POST" onsubmit="return false;" id="formUpAvt" enctype="multipart/form-data">
					<div class="form-group box-current-img">
						<p><strong>Ảnh đại diện</strong></p>
						<img src="' . $data_user['url_avatar'] . '" alt="Ảnh đại diện của ' . $data_user['display_name'] . '" width="80" height="80">
					</div>
					<div class="alert alert-info">Vui lòng chọn file ảnh có định dạng là .jpg, .png, .gif và có dung lượng dưới 5mb.</div>
					<div class="form-group">
						<label>Chọn hình ảnh</label>
						<input type="file" class="form-control" id="img_avt" name="img_avt" onchange="preUpAvt();">
					</div>
					<div class="form-group box-pre-img hidden">
						<p><strong>Ảnh xem trước</strong></p>
					</div>
					<div class="form-group hidden box-progress-bar">
						<div class="progress">
							<div class="progress-bar" role="progressbar"></div>
						</div>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary pull-left">Upload</button>
						<a class="btn btn-danger pull-right" id="del_avt"><span class="glyphicon glyphicon-trash"></span> Xóa</a>
					</div>
					<div class="clearfix"></div><br>
					<div class="alert alert-danger hidden"></div>
				</form>
			</div>
		</div>
	';

	// Form cập nhật các thông tin còn lại
	echo
	'
		<div class="panel panel-default">
		<div class="panel-heading">Cập nhật thông tin</div>
			<div class="panel-body">
				<form id="formUpdateInfo" method="POST" onsubmit="return false;">
					<div class="form-group">
						<label>Tên hiển thị *</label>
						<input type="text" class="form-control" id="dpn_update" value="' . $data_user['display_name'] . '">
					</div>
					<div class="form-group">
						<label>Email *</label>
						<input type="text" class="form-control" id="email_update" value="' . $data_user['email'] . '">
					</div>
					<div class="form-group">
						<label>URL Facebook</label>
						<input type="text" class="form-control" id="fb_update" value="' . $data_user['facebook'] . '">
					</div>
					<div class="form-group">
						<label>URL Google</label>
						<input type="text" class="form-control" id="gg_update" value="' . $data_user['google'] . '">
					</div>
					<div class="form-group">
						<label>URL Twitter</label>
						<input type="text" class="form-control" id="tt_update" value="' . $data_user['twitter'] . '">
					</div>
					<div class="form-group">
						<label>Số điện thoại</label>
						<input type="text" class="form-control" id="phone_update" value="' . $data_user['phone'] . '">
					</div>
					<div class="form-group">
						<label>Giới thiệu</label>
						<textarea class="form-control" id="descr_update">' . $data_user['description'] . '</textarea>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Lưu thay đổi</button>
					</div>
					<div class="alert alert-danger hidden"></div>
				</form>
			</div>
		</div>
	';

	// Form đổi mật khẩu
	echo
	'
		<div class="panel panel-default">
		<div class="panel-heading">Đổi mật khẩu</div>
			<div class="panel-body">
				<form id="formChangePass" method="POST" onsubmit="return false;">
					<div class="form-group">
						<label>Mật khẩu cũ</label>
						<input type="password" class="form-control" id="oldPwChange">
					</div>
					<div class="form-group">
						<label>Mật khẩu mới</label>
						<input type="password" class="form-control" id="newPwChange">
					</div>
					<div class="form-group">
						<label>Nhập lại mật khẩu mới</label>
						<input type="password" class="form-control" id="reNewPwChange">
					</div>
					<div class="form-group">
					<button type="submit" class="btn btn-primary">Lưu thay đổi</button>
					</div>
					<div class="alert alert-danger hidden"></div>
				</form>
			</div>
		</div>
	';
}else
{
	new Redirect($_DOMAIN.'admin/');
}
?>