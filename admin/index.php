<?php
//Require database và thông tin chung
require_once 'core/init.php';
//Require header
require_once 'includes/header.php';
//Nếu đăng nhập
if($user)
{
	//Hiển thị Sidebar
	require_once 'templates/sidebar.php';
	//Hiển thị content
	require_once 'templates/content.php';
}else{
	//Hiển thị form đăng nhâp
	require_once 'templates/signin.php';
}
//Require footer
require_once 'includes/footer.php';
?>