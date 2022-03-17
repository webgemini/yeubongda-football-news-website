<?php
$title_error_404 = 'Không tìm thấy trang!';

// Url bài viết
if (isset($_GET['sp']) && isset($_GET['id']))
{
	$slug_post = trim(htmlspecialchars($_GET['sp']));
	$id_post = trim(htmlspecialchars($_GET['id']));

	$sql_check_post = "SELECT id_post, slug, title FROM posts WHERE slug = '$slug_post' AND id_post = '$id_post'";
	if ($db->num_rows($sql_check_post))
	{
		$data_post = $db->fetch_assoc($sql_check_post, 1);
		$title = $data_post['title'];
		//..
	}else{
		$title = $title_error_404;
	}
}else if (isset($_GET['sc'])) // Url chuyên mục
{
	$slug_cate = trim(htmlspecialchars($_GET['sc']));

	$sql_check_cate = "SELECT url, label FROM categories WHERE url = '$slug_cate'";
	if ($db->num_rows($sql_check_cate))
	{
		$data_cate = $db->fetch_assoc($sql_check_cate, 1);
		$title = $data_cate['label'];
		//..
	}else{
		$title = $title_error_404;
	}
}else{
	$title = $data_web['title'];
	//..
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
	<title><?php echo $title; ?></title>
	<!-- ... -->
	<link rel="stylesheet" href="<?php echo $_DOMAIN; ?>public/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $_DOMAIN; ?>public/css/extended-v1.0.css">
</head>
<body>
	<!-- Header -->
<div class="head" id="header">
	<nav class="navbar-default" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<div class="navbar-brand">
					<a href="<?php echo $_DOMAIN; ?>" title="Yêu Bóng Đá"><img src="<?php echo $_DOMAIN; ?>upload/2022/02/12/logo_home.png" alt="logo-home"></a>
				</div>
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation mobile-only</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="menu-home"><a href="<?php echo $_DOMAIN; ?>"><span class="glyphicon glyphicon-home"></span> Home</a></li>
					<?php
					// Lấy danh sách chuyên mục cấp 1
					$sql_get_list_menu_1 = "SELECT * FROM categories WHERE type = '1' ORDER BY sort ASC";
					if ($db->num_rows($sql_get_list_menu_1))
					{
						foreach ($db->fetch_assoc($sql_get_list_menu_1, 0) as $data_menu_1)
						{
							$sql_get_list_menu_2 = "SELECT * FROM categories WHERE type = '2' AND parent_id = '$data_menu_1[id_cate]' ORDER BY sort ASC";
							if ($db->num_rows($sql_get_list_menu_2))
							{
								$sub_menu = '<ul class="dropdown-menu">';
								foreach ($db->fetch_assoc($sql_get_list_menu_2, 0) as $data_menu_2)
								{
									$sub_menu .= '<li><a href="'.$_DOMAIN . $data_menu_2['url'] . '">' . $data_menu_2['label'] . '</a></li>';
								}
								$sub_menu .= '</ul>';
								echo
								'
									<li class="dropdown">
										<a href="' . $_DOMAIN . $data_menu_1['url'] . '" class="dropdown-toggle" data-toggle="dropdown">' . $data_menu_1['label'] . '
										<span class="caret"></span>
										</a>
										'.$sub_menu.'
									</li>
								';
							}else
							{
								$sub_menu = '';
								echo '<li><a href="' . $_DOMAIN . $data_menu_1['url'] . '">' . $data_menu_1['label'] . '</a>' . $sub_menu . '</li>';
							}
						}
					}
					?>
				</ul>
				<ul class="nav navbar-nav navbar-right">
	                <li data-toggle="modal" data-target="#boxSearch"><a><span class="glyphicon glyphicon-search"></span> Tìm kiếm</a></li>
	            </ul>
			</div>
			<div class="clearfix"></div>
</div>
	</nav>
</div>