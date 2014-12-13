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

#income_divide {width: 240px; height: 20px; background-color: #F7CB1F;}
#income_divide div {float: left; height: 20px;}
#income_divide .stampduty {background-color: #2bc91a;}
#income_divide .occupancycost {background-color: #f218bb;}
#income_divide .benefitsharing {background-color: #335af4;}
#income_divide .initiatorsharing {background-color: #f4a80e;}

.amount_cost { color: #EC4C4C; }
.amount_income { color: #3AAB40; }
.amount_income_total { color: #1F9905; }
</style>
</head>
<body>
<p>查看下单记录 &nbsp; <a href="tradelog_manage_clear.php">清空</a></p>
<ol>
	<li class="stampduty">交易税 ＝ 19.9</li>
	<li class="occupancycost">平台资金占用费 ＝ (买入价 × 买入量 × 平台配比) × 4‰</li>
	<li class="benefitsharing">平台收益分成 ＝ (交易收入 - 交易税 - 平台资金占用费) × 20%</li>
	<!-- li class="initiatorsharing">发起人收益分成 ＝ (交易收入 - 交易税 - 平台资金占用费 - 平台收益分成 ) × 10%</li -->
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
		`benefitsharing`
	from `trade_order_log`
	order by `order_id` desc";
    $rs = mysql_query($q); //获取数据集
	if(!$rs){die("Valid result!");}

	//统计相关金额
	$stampduty_total = 0;
	$occupancycost_total = 0;
	$benefitsharing_total = 0;
	//$initiatorsharing_total = 0;

	$buy_amount_pt = 0;
	$occupancycost_pt = 0;

	//暂存table内容
	$table1 = '';
	$table2 = '';

    echo '<p>个人收益</p>';
    echo "<table border=\"1\" cellpadding=\"3\" style=\"border-collapse:collapse\">";
    echo "<tr>
	  <th>股票<br >代码</th>
	  <th>股票<br >名称</th>
	  <th>日期</th>
	  <th>类型</th>
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
	  <th>&nbsp;</th>
	</tr>";
    while($row = mysql_fetch_array($rs)){
      //用户下单数据
	  $table1 .= "<tr>
	  <td>" . $row["stock_code"] . "</td>
	  <td>" . $row["stock_name"] . "</td>
	  <td>" . $row["regdate"] . "</td>
	  <td>" . (($row["order_type"]==1)?"官方":"个人") ."</td>
	  <td>" . $row["fng_nick"] . "</td>
	  <td>" . $row["user_quota"] . "</td>
	  <td class='numvalue'>" . $row["buying_rate"] . "</td>
	  <td class='numvalue'>" . $row["amount"] . "</td>
	  <th>" . (($row["is_deal"]==1) ? '√' : '') . "</th>
	  <td class='numvalue'>" . $row["selling_rate"] . "</td>
	  <td class='numvalue'>" . number_format($row["income"],2) . "</td>
	  <td class='numvalue'>-" . $row["stampduty"] . "</td>
	  <td class='numvalue'>-" . number_format($row["occupancycost"],2) . "</td>
	  <td class='numvalue'>-" . number_format($row["benefitsharing"],2) . "</td>
	  <td>";
	  $stampduty_total += $row["stampduty"];
	  $occupancycost_total += $row["occupancycost"];
	  $benefitsharing_total += $row["benefitsharing"];
	  //$initiatorsharing_total += $row["initiatorsharing"];
	  
	  if($row["income"]>0){
	  	$table1 .= "<div class=\"income\" id=\"income_divide\">
	    <div class=\"stampduty\" style=\"width:";
	    if(floor($row["stampduty"]/$row["income"]*100) > 1){
	    	$table1 .=  floor($row["stampduty"]/$row["income"]*100);
	    }
	    else{
	    	$table1 .=  "1";
		}
	    $table1 .=  "px;\"></div>
	    <div class=\"occupancycost\" style=\"width:" . floor($row["occupancycost"]/$row["income"]*240) . "px;\"></div>
	    <div class=\"benefitsharing\" style=\"width:" . floor($row["benefitsharing"]/$row["income"]*240) . "px;\"></div>
	  </div>";
		}
	  $table1 .=  "</td>
	  </tr>";

	  //平台资金占用及收益数据
	  if($row["stampduty"] > 0){
	  	$table2 .= "<tr>
		  <td>" . $row["stock_code"] . "</td>
		  <td>" . $row["stock_name"] . "</td>
		  <td>" . $row["regdate"] . "</td>
		  <td>" . $row["user_quota"] . "</td>
		  <td class='numvalue'>" . $row["buying_rate"] . "</td>
		  <td class='numvalue'>" . $row["amount"] . "</td>";
		$buy_amount_pt += $row["amount"];
		$occupancycost_pt += $row["buying_rate"] * $row["amount"] * $row["user_quota"];
		$table2 .= "
		  <td class='numvalue'>" . number_format($row["buying_rate"] * $row["amount"] * $row["user_quota"],2) . "</td>
		  <th>" . (($row["is_deal"]==1) ? '√' : '') . "</th>
		  <td class='numvalue'>" . $row["stampduty"] . "</td>
		  <td class='numvalue'>" . number_format($row["occupancycost"],2) . "</td>
		  <td class='numvalue'>" . number_format($row["benefitsharing"],2) . "</td>
		  <td></td>
		  </tr>";
	  }
	}
	echo $table1;
    echo "</table>";

    mysql_free_result($rs); //关闭数据集

    echo '<br /><p>平台收益</p>';
    echo "<table border=\"1\" cellpadding=\"3\" style=\"border-collapse:collapse\">";
    echo "<tr>
	  <th>股票<br >代码</th>
	  <th>股票<br >名称</th>
	  <th>日期</th>
	  <th>配比</th>
	  <th>买入价</th>
	  <th>买入量</th>
	  <th>平台资金占用</th>
	  <th>是否<br />成交</th>
	  <th>交易税</th>
	  <th>平台资金<br >占用费</th>
	  <th>平台<br >收益分成</th>
	  <th></th>
	</tr>";
	echo $table2;
	echo "<tr>
	  <th>合计</th>
	  <th> </th>
	  <th> </th>
	  <th> </th>
	  <th> </th>
	  <th class='numvalue amount_cost'>".number_format($buy_amount_pt)."</th>
	  <th class='numvalue amount_cost'>".number_format($occupancycost_pt,2)."</th>
	  <th> </th>
	  <td class='numvalue amount_income'>".number_format($stampduty_total,2)."</th>
	  <td class='numvalue amount_income'>".number_format($occupancycost_total,2)."</th>
	  <td class='numvalue amount_income'>".number_format($benefitsharing_total,2)."</th>
	  <th class='numvalue amount_income_total'>". number_format($stampduty_total + $occupancycost_total + $benefitsharing_total,2) ."</th>
	</tr>";
    echo "</table>";

?>             
</body>
</html>
