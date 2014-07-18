<?php
require_once("../inc/conf.php");
require_once(SITEROOT . "/inc/db.php");
?>
<!DOCTYPE html>
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:Web="http://schemas.live.com/Web/">
<head>
<meta content="text/html; charset=utf-8" http-equiv="content-type" />
<title>Group Manage Add</title>
</head>
<body>
<?php
/*
	`order_id` INT(11) NOT NULL AUTO_INCREMENT,
	`regdate` DATETIME NULL DEFAULT NULL COMMENT '创建日期',
	`order_creator` INT(11) NOT NULL DEFAULT '0' COMMENT '发起者',
	`order_type` INT(11) NOT NULL DEFAULT '0' COMMENT '类型 0:个人单 1:官方团单',
	`stock_id` INT(11) NOT NULL DEFAULT '0' COMMENT '股票代号',
	`stock_name` VARCHAR(50) NULL DEFAULT NULL COMMENT '股票名称',
	`buying_rate` FLOAT NOT NULL DEFAULT '0' COMMENT '买入价',
	`is_deal` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '是否成交',
	`liquidate_date` DATETIME NOT NULL COMMENT '平仓时间',
	`selling_rate` FLOAT NOT NULL DEFAULT '0' COMMENT '卖出价',
	`limit_min` FLOAT NOT NULL DEFAULT '0' COMMENT '总额下限',
	`limit_max` FLOAT NOT NULL DEFAULT '0' COMMENT '总额上限',
*/

if( !empty($_REQUEST["stock_id"]) && !empty($_REQUEST["stock_name"]) && !empty($_REQUEST["buying_rate"]) ) {
//print_r($_REQUEST);
//exit;

	$mysql_userid= intval($_REQUEST['user_id']);
	$mysql_userinfo= $_REQUEST['user_name'];
	$user_info = explode('_', $mysql_userinfo);
	$mysql_username= addslashes($user_info[0]);
	$mysql_fngnick= addslashes($user_info[1]);

	$mysql_ordertype= intval($_REQUEST['order_type']);

	$mysql_stockid= intval($_REQUEST['stock_id']);
	$mysql_stockinfo= $_REQUEST['stock_name'];
	$stock_info = explode('_', $mysql_stockinfo);
	$mysql_stockcode= addslashes($stock_info[0]);
	$mysql_stockname= addslashes($stock_info[1]);
	
	$mysql_buyingrate= floatval($_REQUEST['buying_rate']);
	
	$mysql_limitmin= intval($_REQUEST['limit_min']);
	$mysql_limitmax= intval($_REQUEST['limit_max']);
	
	$mysql_amount= intval($_REQUEST['amount']);
	$mysql_userquota= floatval($_REQUEST['user_quota']);

	$mysql_regdate = date('Y-m-d H:i:s');
	
    $q = "INSERT INTO `trade_order` (`regdate`, `order_type`, `user_id`, `user_name`, `fng_nick`, `stock_id`, `stock_code`, `stock_name`, `buying_rate`, `limit_min`, `limit_max`) VALUES ('" . $mysql_regdate . "', " . $mysql_ordertype .", ". $mysql_userid . ", '". $mysql_username . "', '". $mysql_fngnick . "', '" . $mysql_stockid ."', '" . $mysql_stockcode ."', '" . $mysql_stockname ."', " . $mysql_buyingrate .", " . $mysql_limitmin .", " . $mysql_limitmax .");";
 //var_dump($q);
 //exit;
 
	$rs = mysql_query($q); //获取数据集

	if($mysql_ordertype == '0'){
		$mysql_orderid = mysql_insert_id();	//得到跟单的id
		
		$q = "INSERT INTO `trade_order_log` ( `regdate`, `order_id`, `order_type`, `user_id`, `user_name`, `fng_nick`, `stock_id`, `stock_code`, `stock_name`, `buying_rate`, `amount`, `user_quota` ) values ('".$mysql_regdate."', ".$mysql_orderid.", ".$mysql_ordertype.", ".$mysql_userid.", '".$mysql_username."', '".$mysql_fngnick."', ".$mysql_stockid.", '".$mysql_stockcode."', '".$mysql_stockname."', ".$mysql_buyingrate.", ".$mysql_amount.", ".$mysql_userquota.");";

		$rs = mysql_query($q); //获取数据集
	}
 //var_dump($q);
 //exit;

	echo '添加完成<br /><a href="group_manage_add.php">继续添加</a>';
    //mysql_free_result($rs); //关闭数据集
}
else{
?>
<p>发起跟单</p>
<table border="0">
<form name="form1" id="form1" method="post" action="group_manage_add.php">
	
	<tr>
	<td>发起者</td>
	<td>
<script type="text/javascript">
  function viewUser(objsel){
	var objForm = document.getElementById('form1');
	objForm.user_name.value = objsel.options[objsel.selectedIndex].text;
  }
</script>

	  <select name="user_id" onchange="viewUser(this);">
		<option value="0">请选择用户</option>
<?php
	$q = "select `id`, `username`, `fng_nick` from `user_info` where `user_level`>0 order by `username`";
    $rs = mysql_query($q); //获取数据集
    while($row = mysql_fetch_array($rs)){
	    echo "<option value=\"".$row["id"]."\">".$row["username"]."_".$row["fng_nick"]."</option>";
	}
?>
	  </select>

	<input type="hidden" name="user_name" value="" />
	</td>
	</tr>
	<tr>
	<td>类型</td>
	<td><label for="order_type1"><input type="radio" name="order_type" id="order_type1" value="0" />个人单</label> <label for="order_type2"><input type="radio" name="order_type" id="order_type2" value="1" />官方单</label></td>
	</tr>
	<tr>
	<td>选择股票</td>
	<td>
<script type="text/javascript">
  function viewStock(objsel){
	var objForm = document.getElementById('form1');
	objForm.stock_name.value = objsel.options[objsel.selectedIndex].text;
  }
</script>
	  <select name="stock_id" onchange="viewStock(this);">
		<option value="0">请选择股票</option>
<?php
	$q = "select `id`, `stock_code`, `stock_name` from `stock_info` order by `stock_name`";
    $rs = mysql_query($q); //获取数据集
    while($row = mysql_fetch_array($rs)){
	    echo "<option value=\"".$row["id"]."\">".$row["stock_code"]."_".$row["stock_name"]."</option>";
	}
?>
	  </select>
	  <input type="hidden" name="stock_name" value="" />
	</td>
	</tr>
	<tr>
	<td>买入价</td>
	<td><input type="text" name="buying_rate" value="" /></td>
	</tr>
	<tr>
	<td>团单填写</td>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<tr>
	<td>总额下限</td>
	<td><input type="text" name="limit_min" value="" /></td>
	</tr>
	<tr>
	<td>总额上限</td>
	<td><input type="text" name="limit_max" value="" /></td>
	</tr>
	<tr>
	<td>个单填写</td>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td>买入数量</td>
	<td><input type="text" name="amount" value="" /></td>
	</tr>
	<tr>
	<td>用户配比</td>
	<td><input type="text" name="user_quota" value="" /></td>
	</tr>
	<tr>
	<td><input type="submit" value=" 确 定 " /></td>
	<td>&nbsp;</td>
	</tr>
</form>
</table>
<?php
}

?>             
</body>
</html>
