<?php
// Kết nối database và thông tin chung
require_once 'core/init.php';

if ($user)
{
	if (isset($_POST['action']))
	{
		$action = trim(addslashes(htmlspecialchars($_POST['action'])));

		if ($action == 'stt_web')
		{
			$stt_web = trim(htmlspecialchars(addslashes($_POST['stt_web'])));
			$sql_stt_web = "UPDATE website SET status = '$stt_web'";
			$db->query($sql_stt_web);
			//echo 'Thay đổi thành công.';
			$db->close();
		}
		
		// Chỉnh sửa thông tin website
		else if ($action == 'infor_web')
		{
			$title_web = trim(htmlspecialchars(addslashes($_POST['title_web'])));
			$descr_web = trim(htmlspecialchars(addslashes($_POST['descr_web'])));
			$keywords_web = trim(htmlspecialchars(addslashes($_POST['keywords_web'])));

			$sql_infor_web = "UPDATE website SET title = '$title_web', descr = '$descr_web', keywords = '$keywords_web'";
			$db->query($sql_infor_web);
			//echo 'Cập nhật thành công.';
			$db->close();
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