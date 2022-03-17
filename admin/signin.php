<?php
//Kết nối data và thông tin chung
require_once 'core/init.php';

//Nếu có tồn tại phương thức POST
if (isset($_POST['user_signin']) && isset($_POST['pass_signin']))
{
	//Xử lý các giá trị
	$user_signin = trim(htmlspecialchars(addslashes($_POST['user_signin'])));
	$pass_signin = trim(htmlspecialchars(addslashes($_POST['pass_signin'])));

	//Các biến xử lý thông báo
	$show_alert = '<script>$("#formSignin .alert").removeClass("hidden");</script>';
	$hide_alert = '<script>$("#formSignin .alert").addClass("hidden");</script>';
	$success = '<script>$("#formSignin .alert").attr("class", "alert alert-success");</script>';

	//Nếu giá trị rỗng
	if ($user_signin == '' || $pass_signin == ''){
		echo $show_alert.'Vui lòng điền đầy đủ thông tin!';
	}else{ //Ngược lại
		$sql_check_user_exist = "SELECT username FROM accounts WHERE username = '$user_signin'";
		//Nếu có tồn tại username
		if ($db->num_rows($sql_check_user_exist))
		{
			$pass_signin = md5($pass_signin);
			$sql_check_signin = "SELECT username, password FROM accounts WHERE username = '$user_signin' AND password = '$pass_signin'";
				if ($db->num_rows($sql_check_signin))
				{
					$sql_check_stt = "SELECT username, password FROM accounts WHERE username = '$user_signin' AND password = '$pass_signin' AND status = '0'";
					//Nếu username và password khớp và tài khoản không bị khóa (status = 0)
					if ($db->num_rows($sql_check_stt))
					{
						//Lưu session
						$session->send($user_signin);
						$db->close(); //Giải phóng

						echo $success.'Đăng nhập thành công.';
						new Redirect($_DOMAIN.'admin/'); //Trở về trang index
					}else{
						echo $show_alert.'Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên!';
					}
				}else{
					echo $show_alert.'Mật khẩu không chính xác!';
				}
		}else{ //Ngược lại tài khoản không tồn tại
			echo $show_alert.'Tài khoản không tồn tại!';
		}
	}
}else{ //Ngược lại không tồn tại phương thức post
	new Redirect($_DOMAIN.'admin/'); //Trở về index
}
?>