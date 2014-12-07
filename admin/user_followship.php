<?php
require_once("../inc/conf.php");
require_once(SITEROOT . "/inc/db.php");
?>
<!DOCTYPE html>
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:Web="http://schemas.live.com/Web/">
<head>
<meta content="text/html; charset=utf-8" http-equiv="content-type" />
<title>User Followship</title>
<style>
body, div, td {font-size: 14px;}
</style>
</head>
<body>
<p>用户关注关系</p>
<?php   
	$q = "select `user_be_followed`, `user_be_followed_name`, `user_id`, `user_name` from `user_followship` order by `user_be_followed`, `regdate` desc";
    $rs = mysql_query($q); //获取数据集
	if(!$rs){die("Valid result!");}

    echo "<table border=\"1\" cellpadding=\"3\" style=\"border-collapse:collapse\">";
    echo "
	<tr>
	  <td>被关注者</td>
	  <td>粉丝名称</td>
	  <td>操作</td>
	</tr>";
    while($row = mysql_fetch_array($rs)){
	  echo "
	<tr>
	  <td>" . $row["user_be_followed_name"] . "</td>
	  <td>" . $row["user_name"] . "</td>
	  <td><a href=\"user_follow_trade.php?uid=" . $row["user_be_followed"] . "&fid=" . $row["user_id"] . "\">跟单</a></td>
	</tr>"; //显示数据
	}
    echo "</table>";

    mysql_free_result($rs); //关闭数据集

?>
</body>
</html>
