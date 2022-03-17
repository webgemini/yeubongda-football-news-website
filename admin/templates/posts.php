<?php

//Nếu đăng nhập
if ($user)
{
	echo '<h3>Bài viết</h3>';
	// Lấy tham số ac
	if (isset($_GET['ac']))
	{
		$ac = trim(addslashes(htmlspecialchars($_GET['ac'])));
	}else
	{
		$ac = '';
	}

	// Lấy tham số id
	if (isset($_GET['id']))
	{
		$id = trim(addslashes(htmlspecialchars($_GET['id'])));
	}else
	{
		$id = '';
	}

	// Nếu có tham số ac
	if ($ac != '')
	{
		//-- Trang thêm bài viết --
		if ($ac == 'add')
		{
			echo
			'
				<a href="'.$_DOMAIN.'admin/posts" class="btn btn-default">
					<span class="glyphicon glyphicon-arrow-left"></span> Trở về
				</a>
			';

			//-- Content thêm bài viết --
			echo
			'
				<p class="form-add-post">
					<form method="POST" id="formAddPost" onsubmit="return false;">
						<div class="alert alert-danger hidden"></div>
						<div class="form-group">
							<label>Tiêu đề bài viết</label>
							<input type="text" class="form-control title" id="title_add_post">
						</div>
						<div class="form-group">
							<label>URL chuyên mục</label>
							<input type="text" class="form-control slug" placeholder="Nhấp vào để tự tạo" id="slug_add_post">
						</div>
						<div class="form-group">
							<label>Mô tả bài viết</label>
							<textarea id="descr_add_post" class="form-control"></textarea>
						</div>

						<div class="form-group">
							<label>Nội dung bài viết</label>
							<textarea id="body_add_post" class="form-control"></textarea>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Tạo</button>
						</div>
					</form>
				</p>
			';
		}
		//-- Trang chỉnh sửa bài viết --
		else if ($ac == 'edit')
		{
			$sql_check_id_cate = "SELECT id_post, author_id FROM posts WHERE id_post = '$id'";
			//Nếu tồn tại id trong table
			if ($db->num_rows($sql_check_id_cate))
			{
				$data_post = $db->fetch_assoc($sql_check_id_cate, 1);
				if ($data_post['author_id'] == $data_user['id_acc'] || $data_user['position'] == '1')
				{
					echo
					'
						<a href="'.$_DOMAIN.'admin/posts" class="btn btn-default">
							<span class="glyphicon glyphicon-arrow-left"></span> Trở về
						</a>
						<a class="btn btn-danger" id="del_post" data-id="'.$id.'">
							<span class="glyphicon glyphicon-trash"></span> Xóa
						</a>
					';

					//-- Content chỉnh sửa bài viết --
					$sql_get_data_post = "SELECT * FROM posts WHERE id_post = '$id'";
					$data_post = $db->fetch_assoc($sql_get_data_post, 1);

					echo
					'
						<p class="form-edit-post">
							<form method="POST" id="formEditPost" data-id="' . $id . '" onsubmit="return false;">
								<div class="form-group">
									<label class="alert-info">Lưu ý: Chuyển nội dung bài viết sang định dạng "Mã HTML" sau đó mới lưu bài viết, để tránh bị lỗi!</label>
								</div>
								<div class="alert alert-danger hidden"></div>
								<div class="form-group">
									<label>Trạng thái bài viết</label>
					';

					// Trạng thái bài viết
					// Nếu đã xuất bản
					if ($data_post['status'] == '1')
					{
						echo
						'
								<div class="radio">
									<label>
										<input type="radio" name="stt_edit_post" value="1" checked> Xuất bản
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="stt_edit_post" value="0"> Ẩn
									</label>
								</div>
						';
					} //Nếu đang ẩn
					else if ($data_post['status'] == '0')
					{
						echo
						'
								<div class="radio">
									<label>
										<input type="radio" name="stt_edit_post" value="1"> Xuất bản
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="stt_edit_post" value="0" checked> Ẩn
									</label>
								</div>
						';
					}
					echo
					'
								</div>
								<div class="form-group">
									<label>Tiêu đề bài viết</label>
									<input type="text" class="form-control title" value="' . $data_post['title'] . '" id="title_edit_post">
								</div>
								<div class="form-group">
									<label>Slug bài viết</label>
									<input type="text" class="form-control slug" value="' . $data_post['slug'] . '" id="slug_edit_post">
								</div>
								<div class="form-group">
									<label>Url thumbnail</label>
									<input type="text" class="form-control" value="' . $data_post['url_thumb'] . '" id="url_thumb_edit_post">
								</div>
								<div class="form-group">
									<label>Mô tả bài viết</label>
									<textarea id="descr_edit_post" class="form-control">' . $data_post['descr'] . '</textarea>
								</div>
								<div class="form-group">
									<label>Từ khóa bài viết</label>
									<input type="text" class="form-control" value="' . $data_post['keywords'] . '" id="keywords_edit_post">
								</div>
								<div class="form-group cate_post_1">
									<label>Chuyên mục lớn</label>
									<select class="form-control" id="cate_post_1">

					';
					//Tải chuyên mục lớn bài viết
					$sql_get_cate_post_1 = "SELECT label, id_cate FROM categories WHERE type = '1'";
					if ($db->num_rows($sql_get_cate_post_1))
					{
						if ($data_post['cate_1_id'] == '0')
						{
							echo '<option value="">Vui lòng chọn chuyên mục</option>';
						}
						foreach ($db->fetch_assoc($sql_get_cate_post_1, 0) as $key => $data_cate_1)
						{
							if ($data_cate_1['id_cate'] == $data_post['cate_1_id'])
							{
								echo '<option value="' . $data_cate_1['id_cate'] . '" selected>' . $data_cate_1['label'] . '</option>';
							}else
							{
								echo '<option value="' . $data_cate_1['id_cate'] . '">' . $data_cate_1['label'] . '</option>';
							}
						}
					}else
					{
						echo '<option value="0">Chưa có chuyên mục lớn nào</option>';
					}
					echo
					'
									</select>
								</div>

								<div class="form-group cate_post_2">
									<label>Chuyên mục vừa</label>
									<select class="form-control" id="cate_post_2">
					';
					//Tải chuyên mục vừa
					$sql_get_cate_post_2 = "SELECT label, id_cate FROM categories WHERE type = '2' AND parent_id = '$data_post[cate_1_id]'";
					if ($db->num_rows($sql_get_cate_post_2))
					{
						if ($data_post['cate_2_id'] == '0')
						{
							echo '<option value="">Vui lòng chọn chuyên mục</option>';
						}
						foreach ($db->fetch_assoc($sql_get_cate_post_2, 0) as $key => $data_cate_2) {
							if ($data_cate_2['id_cate'] == $data_post['cate_2_id'])
							{
								echo '<option value="' . $data_cate_2['id_cate'] . '" selected>' . $data_cate_2['label'] . '</option>';
							}else
							{
								echo '<option value="' . $data_cate_2['id_cate'] . '">' . $data_cate_2['label'] . '</option>';
							}
						}
					}else
					{
						echo '<option value="0">Chưa có chuyên mục vừa nào</option>';
					}
					echo
					'
										</select>
									</div>

									<div class="form-group cate_post_3">
										<label>Chuyên mục nhỏ</label>
										<select class="form-control" id="cate_post_3">
					';
					//Tải chuyên mục nhỏ
					$sql_get_cate_post_3 = "SELECT label, id_cate FROM categories WHERE type = '3' AND parent_id = '$data_post[cate_2_id]'";
					if ($db->num_rows($sql_get_cate_post_3))
					{
						if ($data_post['cate_3_id'] == '0')
						{
							echo '<option value="">Vui lòng chọn chuyên mục</option>';
						}
						foreach ($db->fetch_assoc($sql_get_cate_post_3, 0) as $key => $data_cate_3)
						{
							if ($data_cate_3['id_cate'] == $data_post['cate_3_id'])
							{
								echo '<option value="' . $data_cate_3['id_cate'] . '" selected>' . $data_cate_3['label'] . '</option>';
							}else
							{
								echo '<option value="' . $data_cate_3['id_cate'] . '">' . $data_cate_3['label'] . '</option>';
							}
						}
					}else
					{
						echo '<option value="0">Chưa có chuyên mục nhỏ nào</option>';
					}

					echo
					'
										</select>
									</div>

									<div class="form-group">
										<label>Nội dung bài viết</label>
										<textarea id="body_edit_post" class="form-control">' . $data_post['body'] . '</textarea>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary">Lưu thay đổi</button>
									</div>

							</form>
						</p>
					';

				}else
				{
					echo '<div class="alert alert-danger">ID của bài viết không thuộc quyền sở hữu của bạn.</div>';
				}
			}else
			{
				// Hiển thị thông báo lỗi
				echo '<div class="alert alert-danger">ID bài viết đã bị xóa hoặc không tồn tại.</div>';
			}
		}
	}
	//-- Trang danh sách bài viết --
	else
	{
		echo
		'
			<a href="'.$_DOMAIN.'admin/posts/add" class="btn btn-default">
				<span class="glyphicon glyphicon-plus"></span> Thêm
			</a>
			<a href="'.$_DOMAIN.'admin/posts" class="btn btn-default">
				<span class="glyphicon glyphicon-repeat"></span> Reload
			</a>
			<a class="btn btn-danger" id="del_post_list">
				<span class="glyphicon glyphicon-trash"></span> Xóa
			</a>
		';

		//-- Content danh sách bài viết --
		//Nếu là admin thì lấy toàn bộ bài viết
		if ($data_user['position'] == '1')
		{
			$sql_get_list_post = "SELECT * FROM posts ORDER BY id_post DESC";
			$list_post = $db->num_rows($sql_get_list_post);
		}else
		{
			$sql_get_list_post = "SELECT * FROM posts WHERE author_id = '$data_user[id_acc]' ORDER BY id_post DESC";
			$list_post = $db->num_rows($sql_get_list_post);
		}

		// Nếu có bài viết
		if ($list_post)
		{
			//Lấy số trang
			if (isset($_GET['page']))
			{
				$current_page = trim(htmlspecialchars(addslashes($_GET['page'])));

				if (preg_match('/\d/', $current_page))
				{
					$current_page = $current_page;
				}else {
					$current_page = 1;
				}
			}else
			{
				$current_page = 1;
			}

			//Giới hạn bài viết của 1 trang
			$limit = 10;
			$total_page = ceil($list_post / $limit);

			// Validate
			if ($current_page > $total_page)
			{
				$current_page = $total_page;
			}else if ($current_page < 1) {
				$current_page = 1;
			}

			$start = ($current_page - 1) * $limit;

			//Nếu trang hiện tại lớn hơn tổng trang
			if ($current_page > $total_page)
			{
				new Redirect($_DOMAIN.'admin/posts&page='.$total_page);
			}else if ($current_page < 1)
			{
				new Redirect($_DOMAIN.'admin/posts&page=1');
			}

			//Form tìm kiếm
			echo
			'
				<p>
					<form method="POST" id="formSearchPost" onsubmit="return false;">
						<div class="input-group">
							<input type="text" class="form-control" id="kw_search_post" placeholder="Nhập ID, tiều đề, slug...">
							<span class="input-group-btn">
								<button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
							</span>
						</div>
					</form>
				</p>
			';

			echo
			'
				<div class="table-responsive" id="list_post">
					<table class="table table-striped list">
						<tr>
							<td><input type="checkbox"></td>
							<td><strong>ID</strong></td>
							<td><strong>Tiêu đề</strong></td>
							<td><strong>Trạng thái</strong></td>
							<td><strong>Chuyên mục</strong></td>
							<td><strong>Lượt xem</strong></td>
			';
			//Nếu là admin
			if ($data_user['position'] == '1')
			{
				echo '<td><strong>Tác giả</strong></td>';
			}

			echo
			'
							<td><strong>Tools</strong></td>
						</tr>
			';

			// Nếu là admin thì lấy toàn bộ bài viết
			if ($data_user['position'] == '1')
			{
				$sql_get_list_post_limit = "SELECT * FROM posts ORDER BY id_post DESC LIMIT $start, $limit";
			}else
			{
				$sql_get_list_post_limit = "SELECT * FROM posts WHERE author_id = '$data_user[id_acc]' ORDER BY id_post DESC LIMIT $start, $limit";
			}
			//In danh sách bài viết
			foreach ($db->fetch_assoc($sql_get_list_post_limit, 0) as $key => $data_post)
			{
				//Trạng thái bài viết
				if ($data_post['status'] == 0)
				{
					$stt_post = '<label class="label label-warning">Ẩn</label>';
				}else if ($data_post['status'] == 1)
				{
					$stt_post = '<label class="label label-success">Xuất bản</label>';
				}

				//Chuyên mục bài viết
				$cate_post = '';
				$sql_check_id_cate_1 = "SELECT label, id_cate FROM categories WHERE id_cate = '$data_post[cate_1_id]' AND type = '1'";
				if ($db->num_rows($sql_check_id_cate_1))
				{
					$data_cate_1 = $db->fetch_assoc($sql_check_id_cate_1, 1);
					$cate_post .= $data_cate_1['label'];
				}else
				{
					$cate_post .= '<span class="text-danger">Lỗi</span>';
				}

				$sql_check_id_cate_2 = "SELECT label, id_cate FROM categories WHERE id_cate = '$data_post[cate_2_id]' AND type = '2'";
				if ($db->num_rows($sql_check_id_cate_2))
				{
					$data_cate_2 = $db->fetch_assoc($sql_check_id_cate_2, 1);
					$cate_post .= ' > '.$data_cate_2['label'];
				}else
				{
					$cate_post .= ' > <span class="text-danger">Lỗi</span>';
				}

				$sql_check_id_cate_3 = "SELECT label, id_cate FROM categories WHERE id_cate = '$data_post[cate_3_id]' AND type = '3'";
				if ($db->num_rows($sql_check_id_cate_3))
				{
					$data_cate_3 = $db->fetch_assoc($sql_check_id_cate_3, 1);
					$cate_post .= ' > '.$data_cate_3['label'];
				}else
				{
					$cate_post .= ' > <span class="text-danger">Lỗi</span>';
				}

				// Tác giả bài viết
				$sql_get_author = "SELECT display_name FROM accounts WHERE id_acc = '$data_post[author_id]'";
				if ($db->num_rows($sql_get_author))
				{
					$data_author = $db->fetch_assoc($sql_get_author, 1);
					$author_post = $data_author['display_name'];
				}else
				{
					$author_post = '<span class="text-danger">Lỗi</span>';
				}

				echo
				'
					<tr>
						<td><input type="checkbox" name="id_post[]" value="' . $data_post['id_post'] . '"></td>
						<td>' . $data_post['id_post'] . '</td>
						<td style="width: 30%;"><a href="' . $_DOMAIN . 'admin/posts/edit/' . $data_post['id_post'] . '">' . $data_post['title'] . '</a></td>
						<td>' .$stt_post . '</td>
						<td>' . $cate_post . '</td>
						<td>' . $data_post['view'] . '</td>
				';

				// Tác giả bài viết
				if ($data_user['position'] == '1')
				{
					echo '<td>'.$author_post.'</td>';
				}

				echo
				'
						<td>
							<a href="' . $_DOMAIN . 'admin/posts/edit/' . $data_post['id_post'] . '" class="btn btn-primary">
								<span class="glyphicon glyphicon-edit"></span>
							</a>
							<a class="btn btn-danger btn-sm del-post-list" data-id="' . $data_post['id_post'] . '">
								<span class="glyphicon glyphicon-trash"></span>
							</a>
						</td>
					</tr>
				';
			}
			echo
			'
					</table>
			';

			// Nút phân trang
			echo '<div class="btn-group" id="paging_post">';
			if ($current_page > 1 && $total_page > 1)
			{
				echo '<a class="btn btn-default" href="' . $_DOMAIN . 'admin/posts&page=' . ($current_page - 1) . '">
					<span class="glyphicon glyphicon-chevron-left"></span> Prev
				</a>';
			}
			//In nút trang
			for ($i = 1; $i <= $current_page; $i++)
			{
				if ($i == $current_page)
				{
					echo '<a class="btn btn-default active">' . $i . '</a>';
				}else
				{
					echo '<a class="btn btn-default" href="' . $_DOMAIN . 'admin/posts&page=' . $i . '">' . $i . '</a>';
				}
			}
			if ($current_page < $total_page && $total_page > 1)
			{
				echo '<a class="btn btn-default" href="' . $_DOMAIN . 'admin/posts&page=' . ($current_page + 1) . '">Next <span class="glyphicon glyphicon-chevron-right"></span></a>';
			}
			echo '<br><br><br></div>';
			echo
			'
				</div>
			';
		}else
		{
			echo '<br><br><div class="alert alert-info">Chưa có bài viết nào.</div>';
		}
	}

}else // Chưa đăng nhập
{
	new Redirect($_DOMAIN.'admin/');
}

?>