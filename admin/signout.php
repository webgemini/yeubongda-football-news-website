<?php
require_once 'core/init.php';

$session->destroy();
new Redirect($_DOMAIN.'admin/');
?>