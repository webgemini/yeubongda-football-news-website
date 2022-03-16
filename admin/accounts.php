<?php
require_once 'core/init.php';

if ($user)
{
	if (isset($_POST['action']))
	{
		$action = trim(addslashes(htmlspecialchars($_POST['action'])));

		if ($action == 'add_acc')
		{
			$un_add_acc = trim(htmlspecialchars(addslashes($_POST['un_add_acc'])));
			$pw_add_acc = trim(htmlspecialchars(addslashes($_POST['pw_add_acc'])));
			$repw_add_acc = trim(htmlspecialchars(addslashes($_POST['repw_add_acc'])));
			$dpn_add_acc = trim(htmlspecialchars(addslashes($_POST['dpn_add_acc'])));

			$show_alert = '<script>$("#formAddAcc .alert").removeClass("hidden");</script>';
			$hide_alert = '<script>$("#formAddAcc .alert").addClass("hidden");</script>';
			$success = '<script>$("#formAddAcc .alert").attr("class", "alert alert-success");</script>';

			$sql_check_un_exist = "SELECT username FROM accounts WHERE username = '$un_add_acc'";

			if ($un_add_acc == '' || $pw_add_acc == '' || $repw_add_acc == '' || $dpn_add_acc == '')
			{
				echo $show_alert.'Vui lòng nhập đầy đủ thông tin.';
			}else if (strlen($un_add_acc) < 6 || strlen($un_add_acc) > 32)
			{
				echo $show_alert.'Tên đăng nhập phải từ 6-32 ký tự.';
			}else if (preg_match('/\W/', $un_add_acc))
			{
				echo $show_alert.'Tên đăng nhập không được chứa ký tự đặc biệt hoặc khoảng trắng.';
			}else if ($db->num_rows($sql_check_un_exist))
			{
				echo $show_alert.'Tên đăng nhập đã tồn tại!';
			}else if (strlen($pw_add_acc) < 6)
			{
				echo $show_alert.'Mật khẩu phải hơn 6 ký tự.';
			}else if ($pw_add_acc != $repw_add_acc)
			{
				echo $show_alert.'Mật khẩu nhập lại không đúng.';
			}else if (strlen($dpn_add_acc) < 3 || strlen($dpn_add_acc) > 50)
			{
				echo $show_alert.'Tên hiển thị phải từ 3-50 ký tự.';
			}
			else
			{
				$pw_add_acc = md5($pw_add_acc);
				$sql_add_acc = "INSERT INTO accounts VALUES ('', '$un_add_acc', '$pw_add_acc', '$dpn_add_acc', '', '0', '0', '$date_current', '', '', '', '', '', '')";
				$db->query($sql_add_acc);
				$db->close();
				echo $show_alert.$success.'Thêm tài khoản thành công.';
				new Redirect($_DOMAIN.'admin/accounts');
			}
		}
		// Mở tài khoản
		// Mở nhiều tài khoản cùng lúc
		else if ($action == 'unlock_acc_list')
		{
			foreach ($_POST['id_acc'] as $key => $id_acc) 
			{
				$sql_check_id_acc_exist = "SELECT id_acc FROM accounts WHERE id_acc = '$id_acc'";
				if ($db->num_rows($sql_check_id_acc_exist))
				{
					$sql_unlock_acc = "UPDATE accounts SET status = '0' WHERE id_acc = '$id_acc'";
					$db->query($sql_unlock_acc);
				}
			}
			$db->close();
			new Redirect($_DOMAIN.'admin/accounts');
		}
		// Mở tài khoản chỉ định
		else if ($action == 'unlock_acc')
		{
			$id_acc = trim(htmlspecialchars(addslashes($_POST['id_acc'])));
			$sql_check_id_acc_exist = "SELECT id_acc FROM accounts WHERE id_acc = '$id_acc'";
			if ($db->num_rows($sql_check_id_acc_exist))
			{
				$sql_unlock_acc = "UPDATE accounts SET status = '0' WHERE id_acc = '$id_acc'";
				$db->query($sql_unlock_acc);
				$db->close();
				new Redirect($_DOMAIN.'admin/accounts');
			}
		}
		// Khóa tài khoản
		// Khóa nhiều tài khoản cùng lúc
		else if ($action == 'lock_acc_list')
		{
			foreach ($_POST['id_acc'] as $key => $id_acc) 
			{
				$sql_check_id_acc_exist = "SELECT id_acc FROM accounts WHERE id_acc = '$id_acc'";
				if ($db->num_rows($sql_check_id_acc_exist))
				{
					$sql_lock_acc = "UPDATE accounts SET status = '1' WHERE id_acc = '$id_acc'";
					$db->query($sql_lock_acc);
				}
			}
			$db->close();
			new Redirect($_DOMAIN.'admin/accounts');
		}
		// Khóa 1 tài khoản
		else if ($action == 'lock_acc')
		{
			$id_acc = trim(htmlspecialchars(addslashes($_POST['id_acc'])));
			$sql_check_id_acc_exist = "SELECT id_acc FROM accounts WHERE id_acc = '$id_acc'";
			if ($db->num_rows($sql_check_id_acc_exist))
			{
				$sql_lock_acc = "UPDATE accounts SET status = '1' WHERE id_acc = '$id_acc'";
				$db->query($sql_lock_acc);
				$db->close();
				new Redirect($_DOMAIN.'admin/accounts');
			}
		}
		// Xóa tài khoản
		// Xóa nhiều tài khoản
		else if ($action == 'del_acc_list')
		{
			foreach ($_POST['id_acc'] as $key => $id_acc)
			{
				$sql_check_id_acc_exist = "SELECT id_acc FROM accounts WHERE id_acc = '$id_acc'";
				if ($db->num_rows($sql_check_id_acc_exist))
				{
					$sql_del_acc = "DELETE FROM accounts WHERE id_acc = '$id_acc'";
					$db->query($sql_del_acc);
				}
			}
			$db->close();
			new Redirect($_DOMAIN.'admin/accounts');
		}
		// Xóa một tài khoản chỉ định
		else if ($action == 'del_acc')
		{
			$id_acc = trim(htmlspecialchars(addslashes($_POST['id_acc'])));
			$sql_check_id_acc_exist = "SELECT id_acc FROM accounts WHERE id_acc = '$id_acc'";
			if ($db->num_rows($sql_check_id_acc_exist))
			{
				$sql_del_acc = "DELETE FROM accounts WHERE id_acc = '$id_acc'";
				$db->query($sql_del_acc);
				$db->close();
				new Redirect($_DOMAIN.'admin/accounts');
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