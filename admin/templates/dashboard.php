<!-- Dashboard bài viết -->
<h3>Bài viết</h3>
<div class="row">
	<?php
	if ($data_user['position'] == '1')
	{
		// Lấy tổng số bài viết
		$sql_get_count_post = "SELECT id_post FROM posts";
		$count_all_post = $db->num_rows($sql_get_count_post);

		echo 
		'
			<div class="col-md-4">
				<div class="alert alert-info">
					<h1>'.$count_all_post.'</h1>
					<p>Tổng bài viết</p>
				</div>	
			</div>
		';
	}else {
		$sql_get_count_post_author = "SELECT id_post FROM posts WHERE author_id = '$data_user[id_acc]'";
		$count_post_author = $db->num_rows($sql_get_count_post_author);

		echo 
		'
			<div class="col-md-4">
				<div class="alert alert-info">
					<h1>'.$count_post_author.'</h1>
					<p>Bài viết của bạn</p>
				</div>
			</div>
		';
	}
	?>

	<?php
		if ($data_user['position'] == '1')
		{
			$sql_get_count_post_public = "SELECT id_post FROM posts WHERE status = '1'";
			$count_post_public = $db->num_rows($sql_get_count_post_public);
		}else
		{
			$sql_get_count_post_public = "SELECT id_post FROM posts WHERE status = '1' AND author_id = '$data_user[id_acc]'";
			$count_post_public = $db->num_rows($sql_get_count_post_public);
		}

		echo 
		'
			<div class="col-md-4">
				<div class="alert alert-success">
					<h1>'.$count_post_public.'</h1>
					<p>Bài viết xuất bản</p>
				</div>
			</div>
		';
	?>


	<div class="col-md-4">
		<div class="alert alert-warning">
			<h1>
				<?php
				if ($data_user['position'] == '1')
				{
					$sql_get_count_post_hide = "SELECT id_post FROM posts WHERE status = '0'";
				}else
				{
					$sql_get_count_post_hide = "SELECT id_post FROM posts WHERE status = '0' AND author_id = '$data_user[id_acc]'";
				}
				echo $db->num_rows($sql_get_count_post_hide);

				?>
			</h1>
			<p>Bài viết ẩn</p>
		</div>
	</div>
</div>

<!-- Dashboard hình ảnh -->
<h3>Hình ảnh</h3>
<div class="row">
	<?php
	if ($data_user['position'] == '1')
	{
		$sql_get_count_img = "SELECT id_img FROM images";
		$label = 'Tổng hình ảnh';
	}else{
		$sql_get_count_img = "SELECT id_img FROM images";
		$label = 'Hình ảnh';
	}
	$count_img = $db->num_rows($sql_get_count_img);
	echo 
	'
	<div class="col-md-4">
		<div class="alert alert-info">
			<h1>'.$count_img.'</h1>
			<p>'.$label.'</p>
		</div>
	</div>
	';
	?>

	<?php
	if ($data_user['position'] == '1')
	{
		$sql_get_size_img = "SELECT size FROM images";
		$label = 'Tổng dung lương ảnh';
	}else {
		$sql_get_size_img = "SELECT size FROM images";
		$label = 'Dung lượng ảnh';
	}

	// Tính dung lượng ảnh
	if ($db->num_rows($sql_get_size_img))
	{
		$count_size_img = 0;
		foreach ($db->fetch_assoc($sql_get_size_img, 0) as $data_img) 
		{
			$count_size_img = $count_size_img + $data_img['size'];
		}
	}else {
		$count_size_img = 0 .' B';
	}

	// Gán dung lượng
	if ($count_size_img < 1024)
	{
		$count_size_img = $count_size_img . ' B';
	}else if ($count_size_img < 1048576){
		$count_size_img = round($count_size_img / 1024) . ' KB';
	}else if ($count_size_img < 1073741824){
		$count_size_img = round($count_size_img / 1048576) . ' MB';
	}else if ($count_size_img < 1099511627776){
		$count_size_img = round($count_size_img / 1073741824) . ' GB';
	}

	echo 
	'
	<div class="col-md-4">
		<div class="alert alert-success">
			<h1>' .$count_size_img. '</h1>
			<p>'.$label.'</p>
		</div>
	</div>
	';
	?>

	<?php
	// Lấy tổng ảnh lỗi
	if ($data_user['position'] == '1')
	{
		$sql_get_count_img = "SELECT url FROM images";
		$label = 'Tổng hình ảnh lỗi';
	}else {
		$sql_get_count_img = "SELECT url FROM images";
		$label = 'Hình ảnh lỗi';
	}

	if ($db->num_rows($sql_get_count_img))
	{
		$count_error_img = 0;
		foreach ($db->fetch_assoc($sql_get_count_img, 0) as $data_img) 
		{
			if (!file_exists('../' . $data_img['url'])){
				$count_error_img++;
			}
		}
	}

	echo 
	'
	<div class="col-md-4">
		<div class="alert alert-danger">
			<h1>' .$count_error_img. '</h1>
			<p>'.$label.'</p>
		</div>
	</div>
	';
	?>
</div>

<?php
if ($data_user['position'] == '1')
{
?>
<!-- Dashboard chuyên mục -->
<h3>Chuyên Mục</h3>
<div class="row">
	<?php
	$sql_get_count_cate = "SELECT id_cate FROM categories";
	$count_cate = $db->num_rows($sql_get_count_cate);

	echo 
	'
	<div class="col-md-3">
		<div class="alert alert-info">
			<h1>'.$count_cate.'</h1>
			<p>Tổng chuyên mục</p>
		</div>
	</div>
	';
	?>

	<?php
	$sql_get_count_cate_1 = "SELECT id_cate FROM categories WHERE type = '1'";
	$count_cate_1 = $db->num_rows($sql_get_count_cate_1);

	echo 
	'
	<div class="col-md-3">
		<div class="alert alert-success">
			<h1>'.$count_cate_1.'</h1>
			<p>Chuyên mục lớn</p>
		</div>
	</div>
	';
	?>

	<?php
	$sql_get_count_cate_2 = "SELECT id_cate FROM categories WHERE type = '2'";
	$count_cate_2 = $db->num_rows($sql_get_count_cate_2);

	echo 
	'
	<div class="col-md-3">
		<div class="alert alert-warning">
			<h1>'.$count_cate_2.'</h1>
			<p>Chuyên mục vừa</p>
		</div>
	</div>
	';
	?>

	<?php
	$sql_get_count_cate_3 = "SELECT id_cate FROM categories WHERE type = '3'";
	$count_cate_3 = $db->num_rows($sql_get_count_cate_3);

	echo 
	'
	<div class="col-md-3">
		<div class="alert alert-danger">
			<h1>'.$count_cate_3.'</h1>
			<p>Chuyên mục nhỏ</p>
		</div>
	</div>
	';
	?>
</div>
<!-- Dashboard tài khoản -->
<h3>Tài khoản</h3>
<div class="row">
	<?php
		$sql_get_count_acc = "SELECT id_acc FROM accounts WHERE position = '0'";
		$count_acc = $db->num_rows($sql_get_count_acc);

		echo 
		'
		<div class="col-md-4">
			<div class="alert alert-info">
				<h1>'.$count_acc.'</h1>
				<p>Tổng tài khoản</p>
			</div>
		</div>
		';
	?>
	<?php
		$sql_get_count_acc = "SELECT id_acc FROM accounts WHERE position = '0' AND status = '0'";
		$count_acc_active = $db->num_rows($sql_get_count_acc);

		echo 
		'
		<div class="col-md-4">
			<div class="alert alert-success">
				<h1>'.$count_acc_active.'</h1>
				<p>Tài khoản hoạt động</p>
			</div>
		</div>
		';
	?>
	<?php
		$sql_get_count_acc = "SELECT id_acc FROM accounts WHERE position = '0' AND status = '1'";
		$count_acc_lock = $db->num_rows($sql_get_count_acc);

		echo 
		'
		<div class="col-md-4">
			<div class="alert alert-warning">
				<h1>'.$count_acc_lock.'</h1>
				<p>Tài khoản bị khóa</p>
			</div>
		</div>
		';
	?>
</div>
<?php
}
?>