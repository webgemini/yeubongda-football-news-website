<?php
require_once 'core/init.php';
if ($user)
{
	// Upload file ảnh đại diện
	if (isset($_FILES['img_avt']))
	{
		$dir = "../upload/";
		$name_img = stripslashes($_FILES['img_avt']['name']);
		$source_img = $_FILES['img_avt']['tmp_name'];

		$day_current = substr($date_current, 8, 2);
		$month_current = substr($date_current, 5, 2);
		$year_current = substr($date_current, 0, 4);

		if (!is_dir($dir.$year_current))
		{
			mkdir($dir.$year_current.'/');
		}
		if (!is_dir($dir.$year_current.'/'.$month_current))
		{
			mkdir($dir.$year_current.'/'.$month_current.'/');
		}
		if (!is_dir($dir.$year_current.'/'.$month_current.'/'.$day_current))
		{
			mkdir($dir.$year_current.'/'.$month_current.'/'.$day_current.'/');
		}

		$path_img = $dir.$year_current.'/'.$month_current.'/'.$day_current.'/'.$name_img;
		move_uploaded_file($source_img, $path_img);
		$url_img = substr($path_img, 3);

		$sql_up_avt = "UPDATE accounts SET url_avatar = '$url_img' WHERE id_acc = '$data_user[id_acc]'";
		$db->query($sql_up_avt);
		$db->close();
		new Redirect($_DOMAIN.'admin/profile');
		echo 'Upload thành công.';
	}
	else if (isset($_POST['action']))
	{
		$action = trim(addslashes(htmlspecialchars($_POST['action'])));

		// Xóa ảnh đại diện
		if ($action == 'delete_avt')
		{
			if (file_exists('../'.$data_user['url_avatar']))
			{
				unlink('../'.$data_user['url_avatar']);
			}
			$sql_delete_avt = "UPDATE accounts SET url_avatar = '' WHERE id_acc = '$data_user[id_acc]'";
			$db->query($sql_delete_avt);
			$db->close();
		}
		// Cập nhật các thông tin
		else if ($action == 'update_info')
		{
			$dpn_update = trim(htmlspecialchars(addslashes($_POST['dpn_update'])));
			$email_update = trim(htmlspecialchars(addslashes($_POST['email_update'])));
			$fb_update = trim(htmlspecialchars(addslashes($_POST['fb_update'])));
			$gg_update = trim(htmlspecialchars(addslashes($_POST['gg_update'])));
			$tt_update = trim(htmlspecialchars(addslashes($_POST['tt_update'])));
			$phone_update = trim(htmlspecialchars(addslashes($_POST['phone_update'])));
			$descr_update = trim(htmlspecialchars(addslashes($_POST['descr_update'])));

			$show_alert = '<script>$("#formUpdateInfo .alert").removeClass("hidden");</script>';
			$hide_alert = '<script>$("#formUpdateInfo .alert").addClass("hidden");</script>';
			$success = '<script>$("#formUpdateInfo .alert").attr("class", "alert alert-success");</script>';

			if ($dpn_update && $email_update)
			{
				if (strlen($dpn_update) < 3 || strlen($dpn_update) > 50)
				{
					echo $show_alert.'Tên hiển thị phải từ 3-50 ký tự.';
				}else if (filter_var($email_update, FILTER_VALIDATE_EMAIL) === FALSE)
				{
					echo $show_alert.'Email không hợp lệ.';
				}else if ($phone_update && (strlen($phone_update) < 10 || strlen($phone_update) > 11 || preg_match('/^[0-9]+$/', $phone_update) == false))
				{
					echo $show_alert.$phone_update.' Số điện thoại không hợp lệ.';
				}else
				{
					$sql_update_info = "UPDATE accounts SET display_name = '$dpn_update', email = '$email_update', facebook = '$fb_update', google = '$gg_update', twitter = '$tt_update', phone = '$phone_update', description = '$descr_update' WHERE id_acc = '$data_user[id_acc]'";
					$db->query($sql_update_info);
					new Redirect($_DOMAIN.'admin/profile');
					echo $success.'Cập nhật thông tin thành công.';
					
				}
			}else
			{
				echo $show_alert.'Vui lòng điền đầy đủ thông tin.';
			}
		} 
		// Đổi mật khẩu tài khoản
		else if ($action == 'change_pass')
		{
			$old_pw_change = md5($_POST['old_pw_change']);
			$new_pw_change = trim(htmlspecialchars(addslashes($_POST['new_pw_change'])));
			$re_new_pw_change = trim(htmlspecialchars(addslashes($_POST['re_new_pw_change'])));

			$show_alert = '<script>$("#formChangePass .alert").removeClass("hidden");</script>';
			$hide_alert = '<script>$("#formChangePass .alert").addClass("hidden");</script>';
			$success = '<script>$("#formChangePass .alert").attr("class", "alert alert-success");</script>';

			if ($old_pw_change && $new_pw_change && $re_new_pw_change)
			{
				if ($old_pw_change != $data_user['password'])
				{
					echo $show_alert.'Mật khẩu cũ không chính xác.';
				}else if (strlen($new_pw_change) < 6)
				{
					echo $show_alert.'Mật khẩu mới quá ngắn';
				}else if ($re_new_pw_change != $new_pw_change)
				{
					echo $show_alert.'Mật khẩu mới nhập lại không khớp.';
				}else
				{
					$new_pw_change = md5($new_pw_change);
					$sql_change_pw = "UPDATE accounts SET password = '$new_pw_change' WHERE id_acc = '$data_user[id_acc]'";
					$db->query($sql_change_pw);
					new Redirect($_DOMAIN.'admin/profile');
					echo $success.'Thay đổi mật khẩu thành công.';
				}
			}else
			{
				echo $show_alert.'Vui lòng điền đầy đủ thông tin.';
			}
		}
	}else
	{
		new Redirect($_DOMAIN.'admin/');
	}
}else
{
	new Redirect($_DOMAIN.'admin/');
}
?>