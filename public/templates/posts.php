<?php
// Get tham số post
$sp = trim(htmlspecialchars(addslashes($_GET['sp'])));
$id = trim(htmlspecialchars(addslashes($_GET['id'])));

$sql_get_data_post = "SELECT * FROM posts WHERE id_post = '$id' AND slug = '$sp'";
if ($db->num_rows($sql_get_data_post))
{
	$data_post = $db->fetch_assoc($sql_get_data_post, 1);
}else {
	require 'public/templates/404.php';
	exit;
}
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
				<div class="breadcump">
						<?php
						// In chuyên mục bài viết
						echo '
						<li itemscope>
						<a itemscope="url" href="'.$_DOMAIN.'" title="Yêu Bóng Đá"><span itemprop="title">Trang chủ</span></a>
						</li>
						';
						for ($i = 1; $i <= 3; $i++)
						{
							$id_cate = $data_post['cate_'.$i.'_id'];
							if ($id_cate)
							{

								$sql_get_data_cate = "SELECT label, url FROM categories WHERE id_cate = '$id_cate' AND type = '$i'";
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
						}
						echo '
						<li itemscope>
						<span itemprop="title">'.$data_post['title'].'</span>
						</li>
						';
						?>
				</div>
				<!-- ------ main-content ------ -->
				<div class="col630 fr">
					<h1 class="time_detail_news">
						<?php echo '
						<a href="'. $_DOMAIN . $data_post['slug'] .'-'. $data_post['id_post'] .'.html">'.$data_post['title'].'</a>
						'; ?>
					</h1>
					<div class="info_detail pkg mar_bottom10">
						<div class="author">
							<div class="time_comment">
								<span class="line_cm"></span>
								<span class="icon_share"></span>
							</div>
						</div>
					</div>
					<p class="sapo_detail fontbold"><span>YeuBongDa</span><?php echo $data_post['descr']; ?></p>
					<article id="content_detail">
						<div itemprop="articleBody" class="exp_content news_details">
							<?php echo htmlspecialchars_decode($data_post['body']); ?>
							<div class="text-right mar_top10 mar_bottom10"><?php echo 'Xuất bản ngày: '.$data_post['date_posted']?></div>
						</div>
					</article>
					<div class="tag_detail">
						<div class="pkg mar_top20">
							<div class="head_tag_detail fl">
								<span>Từ khóa</span>
							</div>
							<div class="list_tag_trend"></div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="head_detail">
						<span>Chia sẻ</span>
					</div>
					<div class="new_relation_top2 pkg mar_bottom0">
						<div class="head_new_relation_top_outer">
							<span class="head_new_relation_top">Tin mới nhất</span>
						</div>
						<ul class="list-dot">
							<?php
							$sql_get_list_hot_news = "SELECT * FROM posts WHERE status = '1' ORDER BY id_post DESC LIMIT $limit_view";
							if ($db->num_rows($sql_get_list_hot_news))
							{
								foreach ($db->fetch_assoc($sql_get_list_hot_news, 0) as $data_post)
								{
									echo 
									'
									<li>
									<h3><a href="'.$_DOMAIN . $data_post['slug'] .'-'. $data_post['id_post'] .'.html">'.$data_post['title'].'</a></h3>
									</li>
									';
								}
							}else {
								echo '<div class="alert alert-info">Chưa có bài viết nào.</div>';
							}
							?>
						</ul>
					</div>
					<div class="clearfix"></div>
					<div class="pkg mar_bottom0 mar_top15 clear text-left">
						<div class="head_new_relation_top_outer">
							<span class="head_new_relation_top">Tin nên đọc</span>
						</div>
						<ul class="list_top_news">
							<?php
							$sql_get_invole_post = "SELECT DISTINCT * FROM posts WHERE (cate_1_id = '$data_post[cate_1_id]' OR cate_2_id = '$data_post[cate_2_id]' OR cate_3_id = '$data_post[cate_3_id]') AND status = '1' AND id_post != '$id'";
							if ($db->num_rows($sql_get_invole_post))
							{
								foreach ($db->fetch_assoc($sql_get_invole_post, 0) as $data_post)
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
							}else {
								echo '<div class="alert alert-info">Không có bài viết liên quan nào.</div>';
							}
							?>
						</ul>
					</div>
				</div>
				<div></div>
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
	<div class="row">
		
		

	</div>
	<hr>
	<div class="row">
		
	</div>
</div>