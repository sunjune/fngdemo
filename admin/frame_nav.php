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
  <li><a href="user_manage.php" target="frame_content">用户列表</a></li>
  <li><a href="user_followship.php" target="frame_content">关注关系</a></li>
  <li><a href="stock_manage.php" target="frame_content">股票列表</a></li>
  <li><a href="group_manage.php" target="frame_content">跟单操作</a></li>
  <li><a href="tradelog_manage.php" target="frame_content">下单记录</a></li>

</ul>
<hr />
<style>
.textintro {font-size:12px;padding:0;margin:0;}
.textintro li {list-style-position: inside;}
</style>
<p>操作顺序：</p>
<ul class="textintro">
  <li>"跟单操作"->"发起跟单"</li>
  <li>"关注关系"->"跟单"</li>
  <li>"股票列表"->"模拟平仓"</li>
</ul>
</body>
</html>
