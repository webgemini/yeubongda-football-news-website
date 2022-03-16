<div class="col-md-3 sidebar">
	<ul class="list-group">
		<li class="list-group-item">
			<div class="media">
				<a class="pull-left">
					<img class="media-object" src="
					<?php
						//URL ảnh đại diện tài khoản
					if($data_user['url_avatar'] == '')
					{
						echo $_DOMAIN.'admin/images/profile.jpg';
					}else{
						echo str_replace('admin/', '', $_DOMAIN).$data_user['url_avatar'];
					}
					?>
					" alt="Ảnh đại diện của <?php echo $data_user['display_name']; ?>" width="62" height="62">
				</a>
				<div class="media-body">
					<h4 class="media-heading"><?php echo $data_user['display_name']; ?></h4>
					<?php
					//Hiển thị cấp bậc tài khoản
					//Nếu là admin
					if ($data_user['position'] == '1')
					{
						echo '<span class="label label-primary">Administrators</span>';
					}else{
						echo '<span class="label label-success">Author</span>';
					}
					?>
				</div><!-- div.media_body -->
			</div><!-- div.media -->
		</li>
		<a class="list-group-item" href="<?php echo $_DOMAIN; ?>admin/dashboard">
			<span class="glyphicon glyphicon-dashboard"></span> Bảng điều khiển
		</a>
		<a class="list-group-item" href="<?php echo $_DOMAIN; ?>admin/profile">
			<span class="glyphicon glyphicon-user"></span> Hồ sơ cá nhân
		</a>
		<a class="list-group-item" href="<?php echo $_DOMAIN; ?>admin/posts">
			<span class="glyphicon glyphicon-edit"></span> Bài viết
		</a>
		<a class="list-group-item" href="<?php echo $_DOMAIN; ?>admin/photos">
			<span class="glyphicon glyphicon-picture"></span> Hình ảnh
		</a>
		<?php
		//Phân quyền sidebar
		//nếu là admin
		if ($data_user['position'] == '1')
		{
			echo
			'
			<a href="'.$_DOMAIN.'admin/accounts" class="list-group-item">
				<span class="glyphicon glyphicon-lock"></span> Tài khoản
			</a>
			<a class="list-group-item" href="'.$_DOMAIN.'admin/categories">
				<span class="glyphicon glyphicon-tag"></span> Chuyên mục
			</a>
			<a class="list-group-item" href="'.$_DOMAIN.'admin/setting">
				<span class="glyphicon glyphicon-cog"></span> Cài đặt chung
			</a>
			';
		}
		?>
		<a class="list-group-item" href="<?php echo $_DOMAIN; ?>admin/signout.php">
			<span class="glyphicon glyphicon-off"></span> Thoát
		</a>
	</ul><!-- ul.sidebar -->
</div><!-- div.sidebar -->