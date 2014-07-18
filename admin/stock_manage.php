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
body, div, td {font-size: 12px;}
</style>
</head>
<body>
<p>股票管理 &nbsp; &nbsp; <a href="stock_manage_add.php">添加股票</a></p>
<?php   
	$q = "select `id`, `stock_code`, `stock_name`, `stock_price` from `stock_info` order by `id` desc";
    $rs = mysql_query($q); //获取数据集
	if(!$rs){die("Valid result!");}

    echo "<table border=\"1\" cellpadding=\"3\" style=\"border-collapse:collapse\">";
    echo "
	<tr>
	  <td>id</td>
	  <td>股票代码</td>
	  <td>股票名称</td>
	  <td>当前价格</td>
	  <td>&nbsp;</td>
	</tr>";
    while($row = mysql_fetch_array($rs)){
	  echo "
	<tr>
	  <td>" . $row["id"] . "</td>
	  <td>" . $row["stock_code"] . "</td>
	  <td>" . $row["stock_name"] . "</td>
	  <td>" . $row["stock_price"] . "</td>
	  <td><a href=\"stock_manage_modify.php?id=" . $row["id"] . "&opt_type=edit\">修改</a> &nbsp; <a href=\"stock_simulation.php?id=" . $row["id"] . "\">模拟平仓</a></td>
	</tr>"; //显示数据
	}
    echo "</table>";

    mysql_free_result($rs); //关闭数据集

?>             
</body>
</html>
