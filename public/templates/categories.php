<?php
// Nhận giá trị slug của chuyên mục
$sc = trim(htmlspecialchars(addslashes($_GET['sc'])));
$limit_view = 12;

$sql_get_id_cate = "SELECT id_cate, url FROM categories WHERE url = '$sc'";

// Chuyên mục tồn tại
if ($db->num_rows($sql_get_id_cate))
{
	$id_cate = $db->fetch_assoc($sql_get_id_cate, 1)['id_cate'];

?>

<div class="container">
	<div id="aheader" style="margin-top: 20px">
	<!------ ADS ------>
	</div>
	<div class="content_main pkg">
		<div class="pkg">
			<!-- ------ left-sidebar ------ -->
			<div class="col830 fl">
				<div class="breadcump">
						<?php
						// In chuyên mục bài viết
						echo '
						<li itemscope>
						<a itemscope="url" href="'.$_DOMAIN.'" title="Yêu Bóng Đá"><span itemprop="title">Trang chủ</span></a>
						</li>
						';
							if ($id_cate)
							{
								$sql_get_data_cate = "SELECT label, url FROM categories WHERE id_cate = '$id_cate'";
								if ($db->num_rows($sql_get_data_cate))
								{
									$data_cate = $db->fetch_assoc($sql_get_data_cate, 1);
									echo '
									<li itemscope>
									<a href="'.$_DOMAIN . $data_cate['url'].'" title="'.$data_cate['label'].'"><span itemprop="title">'.$data_cate['label'].'</span></a>
									</li>
									';
								}
							}
						?>
				</div>
				<div class="news-title-block">
					<h1 class="f26"><?php echo $data_cate['label']; ?></h1>
					<div class="news-short-description f14">
						<p></p>
					</div>
				</div>
				<!-- ------ main-content ------ -->
				<div class="col630 fr">
					<ul class="list_top_news list_news_cate">
						<div class="clearfix"></div>
						<?php
							$sqlGetCountPostCate = "SELECT id_post FROM posts WHERE cate_1_id = '$id_cate' OR cate_2_id = '$id_cate' OR cate_3_id = '$id_cate' AND status = '1'";
								$countPostCate = $db->num_rows($sqlGetCountPostCate);

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
								$totalPage = ceil($countPostCate / $limit);

								// Validate page
								if ($page > $totalPage)
								{
									$page = $totalPage;
								}else if ($page < 1)
								{
									$page = 1;
								}


								$start = ($page - 1) * $limit;

								$sql_get_latest_news_cate = "SELECT * FROM posts WHERE status = '1' AND cate_1_id = '$id_cate' OR cate_2_id = '$id_cate' OR cate_3_id = '$id_cate' ORDER BY id_post DESC LIMIT $start, $limit";
								if ($db->num_rows($sql_get_latest_news_cate))
								{
									foreach ($db->fetch_assoc($sql_get_latest_news_cate, 0) as $data_post)
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
											echo '<a href="'.$_DOMAIN.$i.'" class="btn btn-default">'.$i.'</a>';
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
									echo
									'
											</div>
										</section>
									';
								}else {
									echo '<div class="alert alert-info">Chưa có bài viết nào cho chuyên mục này.</div>';
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
				<div class="mar_top30"></div>
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
<?php
}else {
	require 'public/templates/404.php';
}

?>