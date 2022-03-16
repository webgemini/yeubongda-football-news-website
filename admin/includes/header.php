<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
	<title>Administration</title>
	<!--Liên kết Bootstrap CSS-->
	<link rel="stylesheet" href="<?php echo $_DOMAIN; ?>public/bootstrap/css/bootstrap.min.css"/>
	<!--Liên kết thư viện JQuery-->
	<script src="<?php echo $_DOMAIN; ?>public/js/jquery.min.js"></script>
</head>
<body>
	<!-- NAVBAR -->
	<?php
	//Nếu chưa đăng nhập
	if(!$user)
	{
		echo 
		'
		<div class="container">
			<div class="page-header">
				<h1><small>Administration</small></h1>
			</div>	<!-- div.page-header -->
		</div><!-- div.container -->
		';
	}else {
		echo 
		'
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" href="'.$_DOMAIN.'admin/">Administration</a>
					</div><!-- div.nav-header -->
				</div><!-- div.container-fluid -->
			</nav>
		';
	}
	?>
