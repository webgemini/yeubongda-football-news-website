<?php
if ($user)
{
	if ($data_user['position'] == '0')
	{
		echo '<div class="alert alert-danger">Bạn không đủ quyền để vào trang này.</div>';
	}else if ($data_user['position'] == '1')
	{
		echo '<h3>Tài khoản</h3>';

		if (isset($_GET['ac']))
		{
			$ac = trim(addslashes(htmlspecialchars($_GET['ac'])));
		}else
		{
			$ac = '';
		}

		if (isset($_GET['id']))
		{
			$id = trim(addslashes(htmlspecialchars($_GET['id'])));
		}else
		{
			$id = '';
		}

		if ($ac != '')
		{
			if ($ac == 'add')
			{
				echo 
				'
					<a href="'.$_DOMAIN.'admin/accounts" class="btn btn-default">
						<span class="glyphicon glyphicon-arrow-left"></span> Trở về
					</a>
				';

				// Content thêm tài khoản
				echo 
				'
					<p class="form-add-acc">
						<form method="POST" id="formAddAcc" onsubmit="return false;">
							<div class="form-group">
								<label>Tên đăng nhập</label>
								<input type="text" class="form-control title" id="un_add_acc">
							</div>
							<div class="form-group">
								<label>Mật khẩu</label>
								<input type="password" class="form-control" id="pw_add_acc">
							</div>
							<div class="form-group">
								<label>Nhập lại mật khẩu</label>
								<input type="password" class="form-control" id="repw_add_acc">
							</div>
							<div class="form-group">
								<label>Tên hiển thị</label>
								<input type="text" class="form-control" id="dpn_add_acc">
							</div>
							<div class="form-group">
								<button type="sumit" class="btn btn-primary">Thêm</button>
							</div>
							<div class="alert alert-danger hidden"></div>
						</form>
					</p>
				';
			}
		}else
		{
			echo 
			'
				<a href="'.$_DOMAIN.'admin/accounts/add" class="btn btn-default">
					<span class="glyphicon glyphicon-plus"></span> Thêm
				</a>
				<a href="'.$_DOMAIN.'admin/accounts" class="btn btn-default">
					<span class="glyphicon glyphicon-repeat"></span> Reload
				</a>
				<a class="btn btn-warning" id="lock_acc_list">
					<span class="glyphicon glyphicon-lock"></span> Khóa
				</a>
				<a class="btn btn-success" id="unlock_acc_list">
					<span class="glyphicon glyphicon-lock"></span> Mở khóa
				</a>
				<a class="btn btn-danger" id="del_acc_list">
					<span class="glyphicon glyphicon-trash"></span> Xóa
				</a>
			';

			// Content danh sách tài khoản
			$sql_get_list_acc = "SELECT * FROM accounts WHERE position = '1' OR position = '0' ORDER BY id_acc DESC";
			if ($db->num_rows($sql_get_list_acc))
			{
				echo 
				'
					<br><br>
					<div class="table-responsive">
						<table class="table table-striped list" id="list_acc">
							<tr>
								<td><input type="checkbox"></td>
								<td><strong>ID</strong></td>
								<td><strong>Tên đăng nhập</strong></td>
								<td><strong>Tên hiển thị</strong></td>
								<td><strong>Trạng thái</strong></td>
								<td><strong>Tools</strong></td>
							</tr>
				';

				foreach ($db->fetch_assoc($sql_get_list_acc, 0) as $key => $data_acc) 
				{
					if ($data_acc['status'] == 0)
					{
						$stt_acc = '<label class="label label-success">Hoạt động</label>';
					}else if ($data_acc['status'] == 1)
					{
						$stt_acc = '<label class="label label-warning">Khóa</label>';
					}

					echo 
					'
						<tr>
							<td><input type="checkbox" name="id_acc[]" value="'.$data_acc['id_acc'].'"></td>
							<td>'.$data_acc['id_acc'].'</td>
							<td>'.$data_acc['username'].'</td>
							<td>'.$data_acc['display_name'].'</td>
							<td>'.$stt_acc.'</td>
							<td>
								<a data-id="'.$data_acc['id_acc'].'" class="btn btn-sm btn-warning lock-acc-list">
									<span class="glyphicon glyphicon-lock"></span>
								</a>
								<a data-id="'.$data_acc['id_acc'].'" class="btn btn-sm btn-success unlock-acc-list">
									<span class="glyphicon glyphicon-lock"></span>
								</a>
								<a data-id="'.$data_acc['id_acc'].'" class="btn btn-sm btn-danger del-acc-list">
									<span class="glyphicon glyphicon-trash"></span>
								</a>
							</td>
						</tr>
					';
				}
				echo 
				'
						</table>
					</div>
				';
			}else
			{
				echo '<br><br><div class="alert alert-info">Chưa có tài khoản nào.</div>';
			}
		}
	}
}else
 {
 	new Redirect($_DOMAIN.'admin/');
 }
?>