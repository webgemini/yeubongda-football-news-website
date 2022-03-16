<?php

// Kết nối database
require 'system/core/init.php';

if ($data_web['status'] == 0)
{
	require 'public/templates/shutdown.php';
	exit;
}

// Header
require 'includes/header.php';

// Content
require 'public/templates/content.php';

// Footer
require 'includes/footer.php';
?>