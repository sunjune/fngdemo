<?php
require_once("../inc/conf.php");
require_once(SITEROOT . "/inc/db.php");
?>
<!DOCTYPE html>
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:Web="http://schemas.live.com/Web/">
<head>
<meta content="text/html; charset=utf-8" http-equiv="content-type" />
<title>Group Manage</title>
<style>
body, div, td {font-size: 14px;}
</style>
</head>
<body>
<p>跟单管理 &nbsp; <a href="group_manage_add.php">发起跟单</a> &nbsp; <a href="group_manage_clear.php">清空</a></p>
<?php
	$q = 
	"select
		`order_id`,
		`regdate`,
		`order_type`,
		`user_id`,
		`user_name`,
		`fng_nick`,
		`stock_code`,
		`stock_name`,
		`buying_rate`,
		`is_deal`,
		`liquidate_date`,
		`selling_rate`,
		`limit_min`,
		`limit_max`
	from `trade_order`
	order by `order_id` desc";
    $rs = mysql_query($q); //获取数据集
	if(!$rs){die("Valid result!");}

    echo "<table border=\"1\" cellpadding=\"3\" style=\"border-collapse:collapse\">";
    echo "
	<tr>
	  <td>单号</td>
	  <td>发起日期</td>
	  <td>类型</td>
	  <td>发起者</td>
	  <td>股票代码</td>
	  <td>股票名称</td>
	  <td>买入价</td>
	  <td>是否成交</td>
	  <td>平仓时间</td>
	  <td>卖出价</td>
	  <td>总额下限</td>
	  <td>总额上限</td>
	</tr>";
    while($row = mysql_fetch_array($rs)){
	  echo "<tr>
	  <td>" . $row["order_id"] . "</td>
	  <td>" . $row["regdate"] . "</td>
	  <td>" . (($row["order_type"]==1)?"官方":"个人") ."</td>
	  <td>" . $row["user_name"] ." (". $row["fng_nick"] . ")</td>
	  <td>" . $row["stock_code"] . "</td>
	  <td>" . $row["stock_name"] . "</td>
	  <td>" . $row["buying_rate"] . "</td>
	  <td>" . $row["is_deal"] . "</td>
	  <td>" . $row["liquidate_date"] . "</td>
	  <td>" . $row["selling_rate"] . "</td>
	  <td>" . $row["limit_min"] . "</td>
	  <td>" . $row["limit_max"] . "</td>
	</tr>"; //显示数据
	}
    echo "</table>";

    mysql_free_result($rs); //关闭数据集

?>             
</body>
</html>
