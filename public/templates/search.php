<?php
$limit_view = 12;
?>
<div class="container">
	<div id="aheader" style="margin-top: 20px">
	<!------ ADS ------>
	</div>
	<div class="content_main pkg">
		<div class="pkg">
			<!-- ------ left-sidebar ------ -->
			<div class="col830 fl">
				<!-- ------ main-content ------ -->
				<div class="col630 fr">
					<ul class="list_top_news list_news_cate">
						<div class="clearfix"></div>
						<div class="head_news">
							<h3><a href="#">Tìm kiếm</a></h3>
						</div>
						<?php
						// Lấy tham số tìm kiếm
						$s = trim(htmlspecialchars(addslashes($_GET['s'])));

						if ($s)
						{
							// Lấy số hàng trong table
							$sqlGetCountPost = "SELECT id_post FROM posts WHERE status = '0' AND title LIKE '%$s%' OR keywords LIKE '%$s%' OR descr LIKE '%$s%'";
							$countPost = $db->num_rows($sqlGetCountPost);

							// Tham số trang
							if (isset($_GET['p']))
							{
								$page = trim(htmlspecialchars(addslashes($_GET['p'])));

								if (preg_match('/\d/', $page))
								{
									$page = $page;
								}else {
									$page = 1;
								}
							}else {
								$page = 1;
							}

							$limit = 20;
							$totalPage = ceil($countPost / $limit);

							// Validate
							if ($page > $totalPage)
							{
								$page = $totalPage;
							}else if ($page < 1) {
								$page = 1;
							}

							$start = ($page - 1) * $limit;

							$sql_get_news = "SELECT * FROM posts WHERE status = '0' AND title LIKE '%$s%' OR keywords LIKE '%$s%' OR descr LIKE '%$s%' ORDER BY id_post DESC LIMIT $start, $limit";
							if ($db->num_rows($sql_get_news))
							{
								foreach ($db->fetch_assoc($sql_get_news, 0) as $data_post)
								{
									echo 
									'
									<li>
									<div class="pkg">
										<a href="'.$_DOMAIN . $data_post['slug'].'-'.$data_post['id_post'].'.html" class="thumbblock thumb260x170 fl" title="'.$data_post['title'].'">
										<img src="'.$data_post['url_thumb'].'" width="240" height="145" alt="'.$data_post['title'].'">
										</a>
										<div class="info_list_top_news">
										<div class="time_comment text-left mar_bottom7">
											<h2>
											<a href="'.$_DOMAIN . $data_post['slug'].'-'.$data_post['id_post'].'.html" class="title_list_top_news" title="'.$data_post['title'].'">'.$data_post['title'].'</a>
											</h2>
										</div>
											<div class="sapo_news txt_align_just">
												<p>'.$data_post['descr'].'</p>
											</div>
										</div>
									</div>
									</li>
									';
								}
				echo '</ul>';

								echo 
								'
									<section>
										<div class="paging">
								';
								# Pagination button
								if ($page > 1 && $totalPage > 1)
								{
									echo 
									'
									<a href="'.$_DOMAIN.($page - 1).'">
										<i class="fa fa-angle-left" aria-hidden="true"></i>
									</a>
									';
								}

								for ($i = 1; $i <= $totalPage; $i++)
								{
									if ($i == $page)
									{
										echo '<a class="active">'.$i.'</a>';
									}else {
										echo 
										'
										<a href="'.$_DOMAIN.$i.'" class="btn btn-default">'.$i.'</a>
										';
									}
								}

								if ($page < $totalPage && $totalPage > 1)
								{
									echo 
									'
									<a href="'.$_DOMAIN.($page + 1).'">
										<i class="fa fa-angle-right" aria-hidden="true"></i>
									</a>
									';
								}

								echo '
										</div>
									</section>
									';
							}else {
								echo '<div class="alert alert-info">Không tìm thấy kết quả nào!</div>';
							}
						}else {
							echo '<div class="alert alert-info">Vui lòng nhập từ khóa tìm kiếm.</div>';
						}
						?>
				</div>
				<!-- ------ left-sidebar ------ -->
				<aside class="col160 fl">
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
				</aside>
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