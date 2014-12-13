<?php
require_once("../inc/conf.php");
require_once(SITEROOT . "/inc/db.php");
?>
<!DOCTYPE html>
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:Web="http://schemas.live.com/Web/">
<head>
<meta content="text/html; charset=utf-8" http-equiv="content-type" />
<title>FNG Manage</title>
</head>
<frameset rows="60,*">
  <frame name="frame_top" src="frame_top.php">
  <frameset cols="150, *">
    <frame name="frame_nav" src="frame_nav.php">
    <frame name="frame_content" src="frame_content.php">
  </frameset>
</frameset>
</html>
