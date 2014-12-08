<?php
require_once("../inc/conf.php");
require_once(SITEROOT . "/inc/db.php");
?>
<!DOCTYPE html>
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:Web="http://schemas.live.com/Web/">
<head>
<meta content="text/html; charset=utf-8" http-equiv="content-type" />
<title>Trade Log Manage</title>
<style>
body, div {font-size: 14px; font-family: Arial;}
td { font-size: 12px; font-family: Arial;}
.stampduty {color: #2bc91a;}
.occupancycost {color: #f218bb;}
.benefitsharing {color: #335af4;}
.initiatorsharing {color: #f4a80e;}

.numvalue {text-align: right;}

#income_divide {width: 100px; height: 20px; border: 1px solid #ccc;}
#income_divide div {float: left; height: 20px;}
#income_divide .stampduty {background-color: #2bc91a;}
#income_divide .occupancycost {background-color: #f218bb;}
#income_divide .benefitsharing {background-color: #335af4;}
#income_divide .initiatorsharing {background-color: #f4a80e;}

</style>
</head>
<body>
<p>查看下单记录 &nbsp; <a href="tradelog_manage_clear.php">清空</a></p>
<ol>
	<li class="stampduty">交易税 ＝ 19.9</li>
	<li class="occupancycost">平台资金占用费 ＝ (买入价 × 买入量 × 平台配比) × 4‰</li>
	<li class="benefitsharing">平台收益分成 ＝ (交易收入 - 交易税 - 平台资金占用费) × 20%</li>
	<li class="initiatorsharing">发起人收益分成 ＝ (交易收入 - 交易税 - 平台资金占用费 - 平台收益分成 ) × 10%</li>
</ol>
<?php
	$q = 
	"select
		`id`,
		`order_id`,
		`regdate`,
		`order_type`,
		`is_initiator`,
		`user_name`,
		`fng_nick`,
		`stock_code`,
		`stock_name`,
		`buying_rate`,
		`is_deal`,
		`liquidate_date`,
		`selling_rate`,
		`amount`,
		`user_quota`,
		`income`,
		`stampduty`,
		`occupancycost`,
		`benefitsharing`,
		`initiatorsharing`
	from `trade_order_log`
	order by `order_id` desc";
    $rs = mysql_query($q); //获取数据集
	if(!$rs){die("Valid result!");}

	//统计相关金额
	$stampduty_total = 0;
	$occupancycost_total = 0;
	$benefitsharing_total = 0;
	$initiatorsharing_total = 0;

    echo "<table border=\"1\" cellpadding=\"3\" style=\"border-collapse:collapse\">";
    echo "<tr>
	  <!-- th>id</th>
	  <th>单号</th -->
	  <th>股票<br >代码</th>
	  <th>股票<br >名称</th>
	  <th>日期</th>
	  <th>类型</th>
	  <th>是否<br />发起人</th>
	  <th>用户</th>
	  <th>配比</th>
	  <th>买入价</th>
	  <th>买入量</th>
	  <th>是否<br />成交</th>
	  <th>卖出价</th>
	  <th>交易<br >收入</th>
	  <!-- th>平仓时间</th -->
	  <th>交易税</th>
	  <th>平台资金<br >占用费</th>
	  <th>平台<br >收益分成</th>
	  <th>发起人<br >分成</th>
	  <th>&nbsp;</th>
	</tr>";
    while($row = mysql_fetch_array($rs)){
	  echo "<tr>
	  <!-- td>" . $row["id"] . "</td>
	  <td>" . $row["order_id"] . "</td -->
	  <td>" . $row["stock_code"] . "</td>
	  <td>" . $row["stock_name"] . "</td>
	  <td>" . $row["regdate"] . "</td>
	  <td>" . (($row["order_type"]==1)?"官方":"个人") ."</td>
	  <th>" . (($row["is_initiator"]==1) ? '√' : '') . "</th>
	  <td>" . $row["fng_nick"] . "</td>
	  <td>" . $row["user_quota"] . "</td>
	  <td>" . $row["buying_rate"] . "</td>
	  <td class='numvalue'>" . $row["amount"] . "</td>
	  <th>" . (($row["is_deal"]==1) ? '√' : '') . "</th>
	  <td>" . $row["selling_rate"] . "</td>
	  <td class='numvalue'>" . $row["income"] . "</td>
	  <!-- td>" . $row["liquidate_date"] . "</td -->
	  <td class='numvalue'>" . $row["stampduty"] . "</td>
	  <td class='numvalue'>" . $row["occupancycost"] . "</td>
	  <td class='numvalue'>" . $row["benefitsharing"] . "</td>
	  <td class='numvalue'>" . $row["initiatorsharing"] . "</td>
	  <td>";
	  $stampduty_total += $row["stampduty"];
	  $occupancycost_total += $row["occupancycost"];
	  $benefitsharing_total += $row["benefitsharing"];
	  $initiatorsharing_total += $row["initiatorsharing"];
	  
	  if($row["income"]>0){
	  	echo "<div class=\"income\" id=\"income_divide\">
	    <div class=\"stampduty\" style=\"width:";
	    if(floor($row["stampduty"]/$row["income"]*100) > 1){
	    	echo floor($row["stampduty"]/$row["income"]*100);
	    }
	    else{
	    	echo "2";
		}
	    echo "px;\"></div>
	    <div class=\"occupancycost\" style=\"width:" . floor($row["occupancycost"]/$row["income"]*100) . "px;\"></div>
	    <div class=\"benefitsharing\" style=\"width:" . floor($row["benefitsharing"]/$row["income"]*100) . "px;\"></div>
	    <div class=\"initiatorsharing\" style=\"width:" . floor($row["initiatorsharing"]/$row["income"]*100) . "px;\"></div>
	  </div>";
		}
	echo "</td>
	  </tr>"; //显示数据
	}
	echo "<tr>
	  <!-- th>id</th>
	  <th>单号</th -->
	  <th>合计</th>
	  <th> </th>
	  <th> </th>
	  <th> </th>
	  <th> </th>
	  <th> </th>
	  <th> </th>
	  <th> </th>
	  <th> </th>
	  <th> </th>
	  <th> </th>
	  <th> </th>
	  <!-- th> </th -->
	  <th class='numvalue'>".$stampduty_total."</th>
	  <th class='numvalue'>".$occupancycost_total."</th>
	  <th class='numvalue'>".$benefitsharing_total."</th>
	  <th class='numvalue'>".$initiatorsharing_total."</th>
	  <th>". ($stampduty_total + $occupancycost_total + $benefitsharing_total + $initiatorsharing_total) ."</th>
	</tr>";
    echo "</table>";

    mysql_free_result($rs); //关闭数据集

?>             
</body>
</html>
