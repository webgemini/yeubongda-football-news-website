<?php
// Require thư viện
require_once 'classes/DB.php';
require_once 'classes/Functions.php';
require_once 'classes/Session.php';

// Kết nối database
$db = new DB();
$db->connect();
$db->set_char('utf8');

// Thông tin chung
$_DOMAIN = 'http://localhost/yeubongda/';

date_default_timezone_set('Asia/Ho_Chi_Minh');
$date_current = '';
$date_current = date('Y-m-d H:i:sa');

// Khởi tạo Session
$session = new Session();
$session->start();

// Kiểm tra Session
if ($session->get() != '')
{
	$user = $session->get();
}else {
	$user = '';
}

// Lấy dữ liệu tài khoản
if ($user)
{
	$sql_get_data_user = "SELECT * FROM accounts WHERE username = '$user'";
	if ($db->num_rows($sql_get_data_user))
	{
		$data_user = $db->fetch_assoc($sql_get_data_user, 1);
	}
}

// Lấy thông tin website
$sql_get_data_web = "SELECT * FROM website";
if ($db->num_rows($sql_get_data_web))
{
	$data_web = $db->fetch_assoc($sql_get_data_web, 1);
}
?>
