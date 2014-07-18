<?php
require_once("../inc/conf.php");
require_once(SITEROOT . "/inc/db.php");
?>
<!DOCTYPE html>
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:Web="http://schemas.live.com/Web/">
<head>
<meta content="text/html; charset=utf-8" http-equiv="content-type" />
<title>FNG Manage</title>
<style>
li {line-height: 2em; }
</style>
</head>
<body>
<ul>
  <li><a href="user_manage.php" target="frame_content">用户管理</a></li>
  <li><a href="group_manage.php" target="frame_content">跟单管理</a></li>
  <li><a href="tradelog_manage.php" target="frame_content">下单记录</a></li>
  <li><a href="stock_manage.php" target="frame_content">股票管理</a></li>
  <li><a href="user_followship.php" target="frame_content">用户关注</a></li>
</ul>
</body>
</html>
