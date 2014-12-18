<?php
require_once("../inc/conf.php");
require_once(SITEROOT . "/inc/db.php");

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
	$mysql_stockcode= addslashes($stock_info[0]);	//股票代码
	$mysql_stockname= addslashes($stock_info[1]);	//股票名称
	
	$mysql_buyingrate= floatval($_REQUEST['buying_rate']);
	
	//$mysql_limitmin= intval($_REQUEST['limit_min']);
	//$mysql_limitmax= intval($_REQUEST['limit_max']);
	
	$mysql_amount= intval($_REQUEST['amount']);
	$mysql_userquota= floatval($_REQUEST['user_quota']);

	$mysql_regdate = date('Y-m-d H:i:s');
	
    $q = "INSERT INTO `trade_order` (`regdate`, `order_type`, `user_id`, `user_name`, `fng_nick`, `stock_id`, `stock_code`, `stock_name`, `buying_rate`) VALUES ('" . $mysql_regdate . "', " . $mysql_ordertype .", ". $mysql_userid . ", '". $mysql_username . "', '". $mysql_fngnick . "', '" . $mysql_stockid ."', '" . $mysql_stockcode ."', '" . $mysql_stockname ."', " . $mysql_buyingrate .");";
 //var_dump($q);
 //exit;
 
	$rs = mysql_query($q); //获取数据集

	if($mysql_ordertype == '0'){
		$mysql_orderid = mysql_insert_id();	//得到跟单的id
		
		$q = "INSERT INTO `trade_order_log` ( `regdate`, `order_id`, `order_type`, `user_id`, `user_name`, `fng_nick`, `stock_id`, `stock_code`, `stock_name`, `buying_rate`, `amount`, `user_quota`, `is_initiator`) values ('".$mysql_regdate."', ".$mysql_orderid.", ".$mysql_ordertype.", ".$mysql_userid.", '".$mysql_username."', '".$mysql_fngnick."', ".$mysql_stockid.", '".$mysql_stockcode."', '".$mysql_stockname."', ".$mysql_buyingrate.", ".$mysql_amount.", ".$mysql_userquota.", 1);";

		$rs = mysql_query($q); //获取数据集
	}
 //var_dump($q);
 //exit;

	if(array_key_exists('post_type', $_REQUEST) && $_REQUEST['post_type'] === 'ajax'){
		echo '{"msg":"success"}';
	}
	else{
		echo '添加完成<br /><a href="group_manage.php">查看跟单列表</a>';
	}
    //mysql_free_result($rs); //关闭数据集
}
else{
?>
<!DOCTYPE html>
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:Web="http://schemas.live.com/Web/">
<head>
<meta content="text/html; charset=utf-8" http-equiv="content-type" />
<title>Group Manage Add</title>
<style>
body, div, td {font-size: 14px;}
</style>

</head>
<body>

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
	$q = "select `id`, `username`, `fng_nick` from `user_info` order by `username`";
    $rs = mysql_query($q); //获取数据集
    while($row = mysql_fetch_array($rs)){
	    echo "<option value=\"".$row["id"]."\">".$row["username"].'_'.$row["fng_nick"]."</option>";
	}
?>
	  </select>

	<input type="hidden" name="user_name" value="" />
	</td>
	</tr>
	<tr>
	<td>类型</td>
	<td><label for="order_type1"><input type="radio" name="order_type" id="order_type1" value="0" checked />个人单</label> <!-- label for="order_type2"><input type="radio" name="order_type" id="order_type2" value="1" />官方单</label --></td>
	</tr>
	<tr>
	<td>选择股票</td>
	<td>
<script type="text/javascript">
  function viewStock(objsel){
	var objForm = document.getElementById('form1');

	var objOption = objsel.options[objsel.selectedIndex];
	objForm.stock_name.value = objOption.attributes['stock_code'].value + '_' + objOption.text;

	document.querySelector('#buying_rate').value = objOption.attributes['cur_price'].value;
  }
</script>
	  <select name="stock_id" onchange="viewStock(this);">
		<option value="0">请选择股票</option>
	  </select>
	  <input type="hidden" name="stock_name" value="" />
	</td>
	</tr>
<script type="text/javascript" src="http://hq.sinajs.cn/list=sh600229,sz000920,sh600000,sz000547,sh600571,sz000987,sh601226,sh601188,sh600396,sz002735"></script>
<script type="text/javascript">
    var stock_list_text = 'sh600229,sz000920,sh600000,sz000547,sh600571,sz000987,sh601226,sh601188,sh600396,sz002735';
    var stock_list = stock_list_text.split(',');
    var objSelect = document.getElementById('form1').stock_id;
    for(var i in stock_list){
        var stock_info = eval('hq_str_' + stock_list[i] + '.split(",")');
        var option = document.createElement("option");
        option.value = parseInt(i)+1;
        option.text = stock_info[0];
        option.setAttribute('cur_price', stock_info[3]);
        option.setAttribute('stock_code', stock_list[i]);
        objSelect.add(option);
    }
</script>
	<tr>
	<td>买入价</td>
	<td><input type="text" name="buying_rate" id="buying_rate" placeholder="选择股票获得最新价" value="" /></td>
	</tr>
	<!-- tr>
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
	<tr -->
	<td>个单填写</td>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td>买入数量</td>
	<td><input type="text" name="amount" value="" /></td>
	</tr>
	<tr>
	<td>用户配比</td>
	<td><input type="text" name="user_quota" value="11.5" /></td>
	</tr>
	<tr>
	<td><input type="submit" value=" 确 定 " /></td>
	<td>&nbsp;</td>
	</tr>
</form>
</table>
</body>
</html>
<?php
}
?>