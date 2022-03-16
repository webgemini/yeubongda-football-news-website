<?php
// Bài viết
if (isset($_GET['sp']) && isset($_GET['id']))
{
	require 'public/templates/posts.php';
}
// Chuyên mục
else if (isset($_GET['sc']))
{
	require 'public/templates/categories.php';
}
// Tìm kiếm
else if (isset($_GET['s']))
{
	require 'public/templates/search.php';
}
// Trang chủ
else{
	require 'public/templates/latest-news.php';
}
?>