<?php
//Kết nối với database và thông tin chung
require_once 'core/init.php';

//Nếu đăng nhập
if ($user)
{
	// Nếu có file upload
	if (isset($_FILES['img_up']))
	{
		foreach($_FILES['img_up']['name'] as $name => $value)
		{
			$dir = "../upload/";
			$name_img = stripslashes($_FILES['img_up']['name'][$name]);
			$source_img = $_FILES['img_up']['tmp_name'][$name];

			//Lấy ngày , tháng, năm hiện tại
			$day_current = substr($date_current, 8, 2);
			$month_current = substr($date_current, 5, 2);
			$year_current = substr($date_current, 0, 4);

			// Tạo folder năm hiện tại
			if (!is_dir($dir.$year_current))
			{
				mkdir($dir.$year_current.'/');
			}
			// Tạo folder tháng hiệnt tại
			if (!is_dir($dir.$year_current.'/'.$month_current))
			{
				mkdir($dir.$year_current.'/'.$month_current.'/');
			}
			// Tạo folder ngày hiện tại
			if (!is_dir($dir.$year_current.'/'.$month_current.'/'.$day_current))
			{
				mkdir($dir.$year_current.'/'.$month_current.'/'.$day_current.'/');
			}

			$path_img = $dir.$year_current.'/'.$month_current.'/'.$day_current.'/'.$name_img;
			move_uploaded_file($source_img, $path_img);
			$url_img = substr($path_img, 3);
			$type_img = array_pop(explode('.', $name_img));
			$size_img = $_FILES['img_up']['size'][$name];

			// Thêm dữ liệu vào table
			$sql_up_file = "INSERT INTO images VALUES ('', '$url_img', '$type_img', '$size_img', '$date_current')";
			$db->query($sql_up_file);
		}
		$db->close();
		new Redirect($_DOMAIN.'admin/photos');
		echo 'Upload file thành công.';
	}
	// Nếu tồn tại POST action
	else if (isset($_POST['action']))
	{
		$action = trim(addslashes(htmlspecialchars($_POST['action'])));

		//Xóa nhiều ảnh cùng lúc
		if ($action == 'delete_img_list')
		{
			foreach ($_POST['id_img'] as $key => $id_img) 
			{
				$sql_check_id_img_exits = "SELECT * FROM images WHERE id_img = '$id_img'";
				if ($db->num_rows($sql_check_id_img_exits))
				{
					$data_img = $db->fetch_assoc($sql_check_id_img_exits, 1);
					if (file_exists('../'.$data_img['url']))
					{
						unlink('../'.$data_img['url']);
					}

					$sql_delete_img = "DELETE FROM images WHERE id_img='$id_img'";
					$db->query($sql_delete_img);
				}
			}
			$db->close();
		}
		// Xóa ảnh chỉ định
		else if ($action == 'delete_img')
		{
			$id_img = trim(htmlspecialchars(addslashes($_POST['id_img'])));
			$sql_check_id_img_exits = "SELECT * FROM images WHERE id_img = '$id_img'";
			if ($db->num_rows($sql_check_id_img_exits))
			{
				$data_img = $db->fetch_assoc($sql_check_id_img_exits, 1);
				if (file_exists('../'.$data_img['url']))
				{
					unlink('../'.$data_img['url']);
				}

				$sql_delete_img = "DELETE FROM images WHERE id_img = '$id_img'";
				$db->query($sql_delete_img);
				$db->close();
			}
		}
	}
}// Không đăng nhập
else
{
	new Redirect($_DOMAIN.'admin/');
}
?>