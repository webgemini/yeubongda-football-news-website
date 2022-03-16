<!--Liên kết thư viện JQuery Form-->
<script src="<?php echo $_DOMAIN; ?>public/js/jquery.form.min.js"></script>
<!-- Liên kết thư viện hàm xử lý Form-->
<script src="<?php echo $_DOMAIN; ?>admin/js/form.js"></script>
<!-- Liên kết thư viện CKEditor -->
<script src="<?php echo $_DOMAIN; ?>admin/ckeditor/ckeditor.js"></script>

<?php
//Active sidebar
//Lấy tham số
if (isset($_GET['tab']))
{
	$tab = trim(addslashes(htmlspecialchars($_GET['tab'])));
}else{
	$tab = '';
}
//Nếu có tham số $tab
if ($tab != '')
{
	//Tháo active của bảng điều khiển
	//echo '<script>$(".sidebar ul a:eq(1)").removeClass("active");</script>';
	//Active theo giá trị tham số
	if ($tab == 'dashboard')
	{
		echo '<script>$(".sidebar ul a:eq(1)").addClass("active");</script>';
	}
	else if ($tab == 'profile')
	{
		echo '<script>$(".sidebar ul a:eq(2)").addClass("active");</script>';
	}else if ($tab == 'posts')
	{
		echo '<script>$(".sidebar ul a:eq(3)").addClass("active");</script>';
		if ($ac == 'edit' || $ac == 'add')
		{
			if ($id)
			{
				$sql_check_id_post_exist = "SELECT id_post FROM posts WHERE id_post = '$id'";
				if ($db->num_rows($sql_check_id_post_exist))
				{
					echo 
					'
						<script>
							config = {};
							config.entities_latin = false;
							config.language = "vi";
							CKEDITOR.replace("body_edit_post", config);
						</script>
					';
				}
			} else {
				echo 
					'
						<script>
							config = {};
							config.entities_latin = false;
							config.language = "vi";
							CKEDITOR.replace("body_add_post", config);
						</script>
					';
			}
		}
	}else if ($tab == 'photos')
	{
		echo '<script>$(".sidebar ul a:eq(4)").addClass("active");</script>';
	}else if ($tab == 'accounts')
	{
		echo '<script>$(".sidebar ul a:eq(5)").addClass("active");</script>';
	}
	else if ($tab == 'categories')
	{
		echo '<script>$(".sidebar ul a:eq(6)").addClass("active");</script>';
	}else if ($tab == 'setting')
	{
		echo '<script>$(".sidebar ul a:eq(7)").addClass("active");</script>';
	}
}
?>
</body>
</html>