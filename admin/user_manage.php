<?php
require_once("../inc/conf.php");
require_once(SITEROOT . "/inc/db.php");
?>
<!DOCTYPE html>
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:Web="http://schemas.live.com/Web/">
<head>
<meta content="text/html; charset=utf-8" http-equiv="content-type" />
<title>User Manage</title>
<style>
body, div, td {font-size: 14px;}
</style>
</head>
<body>
<p>用户管理</p>
<?php   
	$q = "select `id`, `username`, `fng_nick`, `email`, `mobile`, `regdate`, `user_level`, `user_quota`, `fng_recommend` from `user_info` order by `id`";
    $rs = mysql_query($q); //获取数据集
	if(!$rs){die("Valid result!");}

    echo "<table border=\"1\" cellpadding=\"3\" style=\"border-collapse:collapse\">";
    echo "
	<tr>
	  <td>用户名</td>
	  <td>用户昵称</td>
	  <td>等级</td>
	  <td>配比</td>
	  <td>推荐</td>
	  <td>&nbsp;</td>
	</tr>";
    while($row = mysql_fetch_array($rs)){
	  echo "
	<tr>
	  <td>" . $row["username"] . "</td>
	  <td>" . $row["fng_nick"] . "</td>
	  <td>" . $row["user_level"] . "</td>
	  <td>" . $row["user_quota"] . "</td>
	  <td>" . ( ( intval($row["fng_recommend"]) == 1 ) ? "是" : "" ) . "</td>
	  <td><a href=\"user_manage_modify.php?id=$row[0]&opt_type=edit\">修改</a></td>
	</tr>"; //显示数据
	}
    echo "</table>";

    mysql_free_result($rs); //关闭数据集

?>             
</body>
</html>
