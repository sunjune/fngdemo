<?php
require_once("../inc/conf.php");
require_once(SITEROOT . "/inc/db.php");
?>
<!DOCTYPE html>
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:Web="http://schemas.live.com/Web/">
<head>
<meta content="text/html; charset=utf-8" http-equiv="content-type" />
<title>Stock Simulation</title>
<style>
body, div, td {font-size: 14px;}
</style>
</head>
<body>
<p>模拟平仓</p>
<?php
if( !empty($_REQUEST["opt_type"]) && !empty($_REQUEST["id"]) && !empty($_REQUEST["opening_price"]) && !empty($_REQUEST["closing_price"]) ) {
	$mysql_stockid= intval($_REQUEST['id']);
	$mysql_opttype= addslashes($_REQUEST['opt_type']);
	
	$mysql_openingprice= floatval($_REQUEST['opening_price']);
	$mysql_closingprice= floatval($_REQUEST['closing_price']);
	
	$mysql_curdate = date("Y-m-d");
	
	if($mysql_opttype == "update"){
		$q = "select `buying_rate` from `trade_order_log` where `stock_id`=".$mysql_stockid." and `regdate`='".$mysql_curdate."' and `is_deal`=0 limit 1";
		$rs = mysql_query($q); //获取数据集
		if(!$rs){die("Valid result!");}
		$row = mysql_fetch_array($rs);
		
		$mysql_buyingrate = $row['buying_rate'];
		
		//如果卖出价高于买入价
		if($mysql_closingprice > $mysql_buyingrate){
			//计算股票收入
			$q = "update `trade_order_log` set `is_deal`=1, `selling_rate`=".$mysql_closingprice.", `stampduty`=19.9, `occupancycost`=(`user_quota` * `buying_rate` * `amount` * 0.004), `liquidate_date`='".date("Y-m-d H:i:s")."', `income`=(".($mysql_closingprice-$mysql_buyingrate)." * `amount` * (1+`user_quota`)) where `stock_id`=".$mysql_stockid." and `regdate`='".$mysql_curdate."' and `is_deal`=0";

			$rs = mysql_query($q); //执行查询
			if(!$rs){die("数据库操作错误!");}
			
			//扣除交易及资金占用费和收益分成还有发起人收益分成
			//$q = "update `trade_order_log` set `benefitsharing`=( (`income` - `stampduty` - `occupancycost`) * 0.2 ), `initiatorsharing`=((`income` - `stampduty` - `occupancycost` - (`income` - `stampduty` - `occupancycost`) * 0.2 ) * 0.1 ) where `stock_id`=".$mysql_stockid." and `regdate`='".$mysql_curdate."' and `is_deal`=1";
			$q = "update `trade_order_log` set `benefitsharing`=( (`income` - `stampduty` - `occupancycost`) * 0.2 ) where `stock_id`=".$mysql_stockid." and `regdate`='".$mysql_curdate."' and `is_deal`=1";

			$rs = mysql_query($q); //执行查询
			if(!$rs){die("数据库操作错误!");}
			
			//单独为发起人抹掉 发起人收益分成
			/*
			$q = "update `trade_order_log` set `initiatorsharing`=0 where `is_initiator`=1 and `regdate`='".$mysql_curdate."' and `is_deal`=1";
			
			$rs = mysql_query($q); //执行查询
			if(!$rs){die("数据库操作错误!");}
			*/

		}
		else{
			//计算股票收入
			$q = "update `trade_order_log` set `is_deal`=1, `selling_rate`=".$mysql_closingprice.", `stampduty`=19.9, `occupancycost`=(`user_quota` * `buying_rate` * `amount` * 0.004), `liquidate_date`='".date("Y-m-d H:i:s")."', `income`=0 where `stock_id`=".$mysql_stockid." and `regdate`='".$mysql_curdate."' and `is_deal`=0";

			$rs = mysql_query($q); //执行查询
			if(!$rs){die("数据库操作错误!");}

		}

		echo "操作完成，查看<a href='tradelog_manage.php'>下单记录</a>";
	}
}
elseif( !empty($_REQUEST["id"]) ) {
	$mysql_stockid = intval($_REQUEST['id']);

	$q = "select `id`, `stock_code`, `stock_name`, `stock_price` from `stock_info` where `id`=".$mysql_stockid." limit 1";
    $rs = mysql_query($q); //获取数据集
	if(!$rs){die("Valid result!");}

    echo "<table border=\"1\" cellpadding=\"3\" style=\"border-collapse:collapse\">";
    echo "
	<tr>
	  <td>id</td>
	  <td>股票代码</td>
	  <td>股票名称</td>
	  <td>当前价格</td>
	</tr>";
    while($row = mysql_fetch_array($rs)){
	  $mysql_stockprice = $row["stock_price"];
	  echo "
	<tr>
	  <td>" . $row["id"] . "</td>
	  <td>" . $row["stock_code"] . "</td>
	  <td>" . $row["stock_name"] . "</td>
	  <td>" . $row["stock_price"] . "</td>
	</tr>"; //显示数据
	}
    echo "</table>";

    mysql_free_result($rs); //关闭数据集
?>
	<br />
	<form name="form1" method="post" action="stock_simulation.php">
	  <input type="hidden" name="opt_type" value="update" />
	  <input type="hidden" name="id" value="<?php echo $mysql_stockid;?>" />
	  <input type="button" value=" 模 拟 " onclick="simulate_price(<?php echo $mysql_stockprice;?>)" />
	  <br />
	  开盘价 <input type="text" id="opening_price" name="opening_price" value="" /><span id="start_rand"></span>
	  <br />
	  收盘价 <input type="text" id="closing_price" name="closing_price" value="" /><span id="end_rand"></span>
	  <br />
	  <input type="submit" value=" 确 定 " />
	</form>
	
	<script type="text/javascript">
		function simulate_price(sp){
			var opening_price = 0;
			var closing_price = 0;
			var flag = 0;
			
			if(Math.random() >= 0.5){
				flag = 9.9;   //涨
			}
			else{
				flag = -7.9;  //跌
			}
			
			var start_rand = Math.round((3 * Math.random()) / 100 * 100) / 100;
			var end_rand = Math.round((flag * Math.random()) / 100 * 100) / 100;
			
			opening_price = Math.round(sp * (1-start_rand) * 100) / 100;
			
			closing_price = Math.round(opening_price * (1+end_rand) * 100) / 100;
			
			document.getElementById('opening_price').value = opening_price;
			document.getElementById('closing_price').value = closing_price;
			
			document.getElementById('start_rand').innerHTML = '低于当前价' + start_rand * 100 + '%';
			document.getElementById('end_rand').innerHTML = '收盘' + ((flag > 0) ? '涨 ' : '跌 ') + end_rand * 100 + '%';
		}
	</script>
<?php
}

?>
</body>
</html>
