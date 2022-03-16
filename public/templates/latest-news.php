<?php
$limit_view = 12;
?>
<div class="container">
	<div class="aheader" id="aheader" style="margin-top: 20px">
	<!-- ------ ADS ------ -->
	</div>
	<div class="content_main pkg">
		<div class="pkg">
			<!-- ------ left-sidebar ------ -->
			<div class="col830 fl">
				<!-- ------ main-content ------ -->
				<div class="col560 fr">
					<?php
					$sql_get_once_post_news = "SELECT * FROM posts WHERE status = '1' ORDER BY id_post LIMIT 1";
					if ($db->num_rows($sql_get_once_post_news))
					{
						$data_once_post = $db->fetch_assoc($sql_get_once_post_news, 1);
						echo 
						'
						<a class="thumb560x300 thumbblock mar_bottom15" href="'.$_DOMAIN . $data_once_post['slug'] .'-'. $data_once_post['id_post'].'.html" title="'.$data_once_post['title'].'">
						<img src="'.$data_once_post['url_thumb'].'" width="100%" height="auto" alt="'.$data_once_post['title'].'">
						</a>
						<a href="'.$_DOMAIN . $data_once_post['slug'] .'-'. $data_once_post['id_post'].'.html" title="'.$data_once_post['title'].'" class="mar_bottom10">
							<h1 class="f22 fontRoboto">'.$data_once_post['title'].'</h1>
						</a>
						<div class="mar_bottom15 pad_bottom10 border-bottom-ccc">
							'.$data_once_post['descr'].'
						</div>
						';
					}else {
						echo '<div class="alert alert-info">Chưa có bài viết nào.</div>';
					}
					
					?>
					<ul class="list_top_news">
					<?php
					$sql_get_latest_news = "SELECT * FROM posts WHERE status = '1' ORDER BY id_post DESC LIMIT $limit_view";
					if ($db->num_rows($sql_get_latest_news))
					{
						foreach ($db->fetch_assoc($sql_get_latest_news, 0) as $data_post)
						{
							echo 
							'
							<li>
								<div class="pkg">
									<a href="' . $_DOMAIN . $data_post['slug'] . '-' . $data_post['id_post'] . '.html" class="thumbblock thumb110" title="'.$data_post['title'].'">
			                            <img src="' . $data_post['url_thumb'] . '" width="148" height="120" alt="'.$data_post['title'].'">
			                        </a>
			                        <h2>
			                        <a href="' . $_DOMAIN . $data_post['slug'] . '-' . $data_post['id_post'] . '.html" class="title_list_top_news" title="'.$data_post['title'].'"><span>' . $data_post['title'] . '</span></a>
			                        </h2>
								</div>
			                </li>
							';
						}
					}else{
						echo '<div class="alert alert-info">Chưa có bài viết nào.</div>';
					}
					?>
					</ul>
				</div>
				<!-- ------ left-sidebar ------ -->
				<div class="col260 fl">
					<div class="head_news">
						<a href="#">Tin nóng</a>
					</div>
					<ul class="list_news_hot">
						<div class="scroll_news_hot">
						<?php
						$sql_get_list_hot_news = "SELECT * FROM posts WHERE status = '1' ORDER BY id_post DESC LIMIT $limit_view";
						if ($db->num_rows($sql_get_list_hot_news))
						{
							foreach ($db->fetch_assoc($sql_get_list_hot_news, 0) as $data_post)
							{
								echo 
								'
								<li>
								<h2><a href="'.$_DOMAIN . $data_post['slug'] .'-'. $data_post['id_post'] .'.html" class="f14" title="'.$data_post['title'].'">'.$data_post['title'].'</a></h2>
								</li>
								';
							}
						}else {
							echo '<div class="alert alert-info">Chưa có bài viết nào.</div>';
						}
						?>
						</div>
					</ul>
				</div>
				<div class="clearfix"></div>
				<section class="box_left_home ">
					<div class="head_news">
						<a href="<?php echo $data_post['cate_1_id'] = 3; ?>">Bóng đá Việt Nam</a>
					</div>
					<div class="pkg">
						<div class="col48per fl">
							<?php
							$sql_get_once_post_news = "SELECT * FROM posts WHERE status = '1' AND cate_1_id = '3' ORDER BY id_post DESC LIMIT 1";
							if ($db->num_rows($sql_get_once_post_news))
							{
								$data_once_post = $db->fetch_assoc($sql_get_once_post_news, 1);
								echo 
								'
								<a href="'.$_DOMAIN . $data_once_post['slug'] .'-'. $data_once_post['id_post'].'.html" class="thumbblock thumb240 mar_bottom10" title="'.$data_once_post['title'].'">
									<img src="'.$data_once_post['url_thumb'].'" width="343" height="220" alt="'.$data_once_post['title'].'">
								</a>
								<h2>
									<a href="'.$_DOMAIN . $data_once_post['slug'] .'-'. $data_once_post['id_post'].'.html" class="fontRoboto f22" title="'.$data_once_post['title'].'">
										<span>'.$data_once_post['title'].'</span>
									</a>
								</h2>
								<div class="time_comment mar_top7 mar_bottom7">
									<span></span>
								</div>
								<div class="sapo_news">
									'.$data_once_post['descr'].'
								</div>
								';
							}else {
								echo '<div class="alert alert-info">Chưa có bài viết nào.</div>';
							}
							?>
						</div>
						<div class="col48per fr">
							<ul class="list_news_show_home custom_scroll">
							<?php
							$sql_get_latest_news = "SELECT * FROM posts WHERE status = '1' AND cate_1_id = '3' ORDER BY id_post DESC LIMIT $limit_view";
							if ($db->num_rows($sql_get_latest_news))
							{
								foreach ($db->fetch_assoc($sql_get_latest_news, 0) as $data_post)
								{
									echo 
									'
									<li class="first pkg">
										<a href="' . $_DOMAIN . $data_post['slug'] . '-' . $data_post['id_post'] . '.html" class="thumbblock thumb140x90 fl" title="'.$data_post['title'].'">
				                            <img src="' . $data_post['url_thumb'] . '" width="140" height="90" alt="'.$data_post['title'].'">
				                        </a>
				                        <h2>
				                        <a href="' . $_DOMAIN . $data_post['slug'] . '-' . $data_post['id_post'] . '.html" class="f18" title="'.$data_post['title'].'"><span>' . $data_post['title'] . '</span></a>
				                        </h2>
				                        <div class="time_comment mar_top7 mar_bottom7">
				                        	<span></span>
				                        </div>
					                </li>
									';
								}
							}else{
								echo '<div class="alert alert-info">Chưa có bài viết nào.</div>';
							}
							?>
							</ul>
						</div>
					</div>
				</section>
			</div>
			<!-- ------ right-sidebar ------ -->
			<div class="col300 fr">
				<aside>
					<div class="box_right_300 fl">
						<div class="head_news">
						<a href="#">Tin đọc nhiều nhất</a>
						</div>
						<ul class="list_news_300 pkg">
							<div class="scroll_hot_news">
							<?php
							$sql_get_list_hot_news = "SELECT * FROM posts WHERE status = '1' ORDER BY id_post LIMIT $limit_view";
							if ($db->num_rows($sql_get_list_hot_news))
							{
								foreach ($db->fetch_assoc($sql_get_list_hot_news, 0) as $data_post)
								{
									echo 
									'
									<li>
										<a href="' . $_DOMAIN . $data_post['slug'] . '-' . $data_post['id_post'] . '.html" class="thumb140x90 thumbblock" title="'.$data_post['title'].'">
				                            <img class="news_docnhieu playvideo" src="' . $data_post['url_thumb'] . '" width="140" height="90" alt="'.$data_post['title'].'">
				                        </a>
				                        <h3>
				                        <a href="' . $_DOMAIN . $data_post['slug'] . '-' . $data_post['id_post'] . '.html" class="f14" title="'.$data_post['title'].'"><span>' . $data_post['title'] . '</span></a>
				                        </h3>
				                        <div class="time_comment mar_top7 mar_bottom7"></div>
				                    </li>
									';
								}
							}else {
								echo '<div class="alert alert-info">Chưa có bài viết nào.</div>';
							}
							?>
							</div>
						</ul>
					</div>
					<div class="clearfix"></div>
				</aside>
			</div>
		</div>
	</div>
</div>
