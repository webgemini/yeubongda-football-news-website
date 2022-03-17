<?php
require_once 'core/init.php';
if ($user)
{
	if ($data_user['position'] == 0)
	{
		echo '<div class="alert alert-danger">Bạn không đủ quyền để vào trang này.</div>';
	}else if ($data_user['position'] == 1)
	{
		echo  '<h3>Cài đặt chung</h3>';

		// Mở/đóng hoạt động của website

		echo
		'
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Trạng thái hoạt động</h3>
			</div>
			<div class="panel-body">
				<form method="POST" id="formStatusWeb" onsupmit="return false;">
		';

		// Trạng thái website
		$sql_get_stt_web = "SELECT status FROM website";
		if ($db->num_rows($sql_get_stt_web))
		{
			$data_web = $db->fetch_assoc($sql_get_stt_web, 1);

			if ($data_web['status'] == '0')
			{
				echo
				'
					<div class="radio">
						<label><input type="radio" value="1" name="stt_web"> Mở</label>
					</div>
					<div class="radio">
						<label><input type="radio" value="0" name="stt_web" checked> Đóng</label>
					</div>
				';
			}else if ($data_web['status'] == '1')
			{
				echo
				'
					<div class="radio">
						<label><input type="radio" value="1" name="stt_web" checked> Mở</label>
					</div>
					<div class="radio">
						<label><input type="radio" value="0" name="stt_web"> Đóng</label>
					</div>
				';
			}
		}
		echo
		'
					<button type="submit" class="btn btn-primary">Lưu</button><br><br>
					<div class="alert alert-danger hidden"></div>
				</form>
			</div>
		</div>
		';

		// Chỉnh sửa thông tin website
		$sqlGetInfoWeb = "SELECT title, descr, keywords FROM website";
		if ($db->num_rows($sqlGetInfoWeb))
		{
			$data_web = $db->fetch_assoc($sqlGetInfoWeb, 1);
		}

		echo
		'
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Chỉnh sửa thông tin.</h3>
				</div>
				<div class="panel-body">
					<form method="POST" id="formInforWeb" onsubmit="return false;">
						<div class="form-group">
							<label>Tiêu đề website</label>
							<input type="text" class="form-control" value="' . $data_web['title'] . '" id="title_web">
						</div>
						<div class="form-group">
							<label>Mô tả website</label>
							<textarea class="form-control" id="descr_web">' . $data_web['descr'] . '</textarea>
						</div>
						<div class="form-group">
							<label>Từ khóa website</label>
							<input type="text" class="form-control" value="' . $data_web['keywords'] . '" id="keywords_web">
						</div>
						<button type="submit" class="btn btn-primary">Lưu</button>
						<div class="alert alert-danger hidden">Lưu</div>
					</form>
				</div>
			</div>
		';
	}
}else
{
	new Redirect($_DOMAIN.'admin/');
}

?>