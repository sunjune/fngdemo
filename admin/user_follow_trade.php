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
<?php
if( !empty($_REQUEST["opt_type"]) && !empty($_REQUEST["order_id"]) && !empty($_REQUEST["uid"]) && !empty($_REQUEST["fid"]) ) {
	$mysql_orderuid= intval($_REQUEST['uid']);
	$mysql_tradeuid= intval($_REQUEST['fid']);

	$mysql_opttype= addslashes($_REQUEST['opt_type']);
	$mysql_orderid= intval($_REQUEST['order_id']);

	$mysql_amount= intval($_REQUEST['amount']);
	
	if($mysql_opttype == 'confirm'){
		$q = "select `order_id`, `regdate`, `fng_nick`, `order_type`, `stock_id`, `stock_code`, `stock_name`, `buying_rate` from `trade_order` where `order_id`=" . $mysql_orderid . ";";
//var_dump($q);
//exit;
		$rs = mysql_query($q); //获取数据集
		if(!$rs) {die("Valid result!");}
		$row = mysql_fetch_array($rs);
		
		$mysql_regdate = $row["regdate"];
		$mysql_ordertype = $row["order_type"];
		$mysql_stockid = $row["stock_id"];
		$mysql_stockcode = $row["stock_code"];
		$mysql_stockname = $row["stock_name"];
		$mysql_buyingrate = $row["buying_rate"];

		$q = "select `username`, `fng_nick`, `user_quota` from `user_info` where `id`=" . $mysql_tradeuid . ";";
//var_dump($q);
//exit;
		$rs = mysql_query($q); //获取数据集
		if(!$rs) {die("Valid result!");}
		$row = mysql_fetch_array($rs);
		
		$mysql_userquota= $row["user_quota"];
		$mysql_username= $row["username"];
		$mysql_fngnick= $row["fng_nick"];
		
		$q = "INSERT INTO `trade_order_log` ( `regdate`, `order_id`, `order_type`, `user_id`, `user_name`, `fng_nick`, `stock_id`, `stock_code`, `stock_name`, `buying_rate`, `amount`, `user_quota` ) values ('".$mysql_regdate."', ".$mysql_orderid.", ".$mysql_ordertype.", ".$mysql_tradeuid.", '".$mysql_username."', '".$mysql_fngnick."', ".$mysql_stockid.", '".$mysql_stockcode."', '".$mysql_stockname."', ".$mysql_buyingrate.", ".$mysql_amount.", ".$mysql_userquota.");";
//var_dump($q);
//exit;
		$rs = mysql_query($q); //获取数据集
		
		echo '跟单操作完成<br /><a href="tradelog_manage.php">查看下单记录</a>';

	}

}
elseif( !empty($_REQUEST["uid"]) && !empty($_REQUEST["fid"]) ) {
//print_r($_REQUEST);
//exit;

	$mysql_orderuid= intval($_REQUEST['uid']);
	$mysql_tradeuid= intval($_REQUEST['fid']);

?>
<p>该用户当日可用跟单</p>
<?php
	$q = 
	"select
		`order_id`,
		`regdate`,
		`fng_nick`,
		`order_type`,
		`stock_code`,
		`stock_name`,
		`buying_rate`
	from `trade_order`
	where `user_id`=".$mysql_orderuid." and `regdate`='".date('Y-m-d')."' limit 1;";
//var_dump($q);
//exit;
    $rs = mysql_query($q); //获取数据集
	if(!$rs) {die("Valid result!");}

    echo "<table border=\"1\" cellpadding=\"3\" style=\"border-collapse:collapse\">";
    echo "
	<tr>
	  <td>发起日期</td>
	  <td>单号</td>
	  <td>类型</td>
	  <td>发起者</td>
	  <td>股票代码</td>
	  <td>股票名称</td>
	  <td>买入价</td>
	</tr>";
    while($row = mysql_fetch_array($rs)) {
		$mysql_orderid = $row["order_id"];
		$mysql_orderuser_fngnick = $row["fng_nick"];
	  echo "
	<tr>
	  <td>" . $row["regdate"] . "</td>
	  <td>" . $mysql_orderid . "</td>
	  <td>" . (($row["order_type"]==1) ? "官方" : "个人") ."</td>
	  <td>" . $mysql_orderuser_fngnick . "</td>
	  <td>" . $row["stock_code"] . "</td>
	  <td>" . $row["stock_name"] . "</td>
	  <td>" . $row["buying_rate"] . "</td>
	</tr>"; //显示数据
	}
    echo "</table><br />";
	$q = "select
		`fng_nick`,
		`user_quota`
	from `user_info`
	where `id`=".$mysql_tradeuid." limit 1;";
    $rs = mysql_query($q); //获取数据集
	if(!$rs) {die("Valid result!");}
	$row = mysql_fetch_array($rs);

	$mysql_tradeuser_fngnick = $row["fng_nick"];
	$mysql_userquota = $row["user_quota"];

	echo '<p>'.$mysql_tradeuser_fngnick.' --&gt; 跟单 --&gt; '.$mysql_orderuser_fngnick.'</p>';
	echo '<form name="form1" method="post" action="user_follow_trade.php">';
	echo '<input type="hidden" name="opt_type" value="confirm" />';
	echo '<input type="hidden" name="uid" value="' . $mysql_orderuid . '" />';
	echo '<input type="hidden" name="fid" value="' . $mysql_tradeuid . '" />';
	echo '<input type="hidden" name="order_id" value="' . $mysql_orderid . '" />';
	echo '用户配比：<input type="text" name="user_quota" value="' . $mysql_userquota . '" /><br />';
	echo '买入数量：<input type="text" name="amount" value="" /><br />';
	echo '<input type="submit" value=" 确认跟单 " />';
	echo '</form>';

    mysql_free_result($rs); //关闭数据集
}
else{
	echo '参数错误，请<a href="user_followship.php">返回</a>';
}
?>
</body>
</html>
