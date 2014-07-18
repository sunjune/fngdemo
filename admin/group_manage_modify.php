<?php
require_once("../inc/conf.php");
require_once(SITEROOT . "/inc/db.php");
?>
<!DOCTYPE html>
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:Web="http://schemas.live.com/Web/">
<head>
<meta content="text/html; charset=utf-8" http-equiv="content-type" />
<title>Group Manage Modify</title>
</head>
<body>
<?php
//print_r($_REQUEST);
//exit;

if( !empty($_REQUEST["opt_type"]) && !empty($_REQUEST["id"]) ) {

	$opt_type = $_REQUEST["opt_type"];
	$mysql_orderid = intval($_REQUEST["id"]);
	
	if($opt_type == "update"){
		//更新信息

		$mysql_stockid= addslashes($_REQUEST['stock_id']);
		$mysql_stockname= addslashes($_REQUEST['stock_name']);
		$mysql_buyingrate= floatval($_REQUEST['buying_rate']);
		$mysql_limitmin= intval($_REQUEST['limit_min']);
		$mysql_limitmax= intval($_REQUEST['limit_max']);
		
		$q = "update `trade_order` set 
		`stock_id`= '$mysql_stockid',
		`stock_name`= '$mysql_stockname',
		`buying_rate` = $mysql_buyingrate ,
		`limit_min` = $mysql_limitmin,
		`limit_max` = $mysql_limitmax
		where `order_id` = $mysql_orderid limit 1";
	 //var_dump($q);
	 //exit;
		$rs = mysql_query($q); //获取数据集

		echo '修改完成<br /><a href="group_manage.php">返回</a>';
		//mysql_free_result($rs); //关闭数据集
	}
	elseif($opt_type == "edit"){
		//编辑信息
		
		$q = "select `order_creator`, `order_type`, `stock_id`, `stock_name`, `buying_rate`, `limit_min`, `limit_max` from `trade_order` where `order_id` = $mysql_orderid";
		$rs = mysql_query($q); //获取数据集
		if(!$rs){die("Valid result!");}
		
		$row = mysql_fetch_array($rs);
?>
	<table border="0">
	<form name="form1" id="form1" method="post" action="group_manage_modify.php">
		<input type="hidden" name="opt_type" value="update" />
		<input type="hidden" name="id" value="<?php echo $mysql_orderid;?>" />
		<tr>
		<td>发起者</td>
		<td><?php echo $row["order_creator"];?></td>
		</tr>
		<tr>
		<td>类型</td>
		<td><?php echo $row["order_type"];?></td>
		</tr>
		<tr>
		<td>选择股票</td>
		<td>
	<script type="text/javascript">
	  function view(objsel){
		var objForm = document.getElementById('form1');
		objForm.stock_name.value = objsel.options[objsel.selectedIndex].text;
	  }
	</script>
		  <select name="stock_id" onchange="view(this);">
			<option value="0">请选择股票</option>
	<?php
		$q1 = "select `id`, `stock_code`, `stock_name` from `stock_info` order by `stock_name`";
		$rs1 = mysql_query($q1); //获取数据集
		while($row1 = mysql_fetch_array($rs1)){
			echo "<option value=\"".$row1["id"]."\"" . (($row["stock_id"] == $row1["id"]) ? " selected" : "") . ">".$row1["stock_code"]."_".$row1["stock_name"]."</option>";
		}
	?>
		  </select>
		  <input type="hidden" name="stock_name" value="<?php echo $row["stock_name"];?>" />
		</td>
		</tr>
		<tr>
		<td>买入价</td>
		<td><input type="text" name="buying_rate" value="<?php echo $row["buying_rate"];?>" /></td>
		</tr>
		<tr>
		<td>总额下限</td>
		<td><input type="text" name="limit_min" value="<?php echo $row["limit_min"];?>" /></td>
		</tr>
		<tr>
		<td>总额上限</td>
		<td><input type="text" name="limit_max" value="<?php echo $row["limit_max"];?>" /></td>
		</tr>
		<tr>
		<td><input type="submit" value=" 确 定 " /></td>
		<td>&nbsp;</td>
		</tr>
	</form>
	</table>
<?php
	}
}
else {
	echo "参数错误，请<a href=\"group_manage.php\">返回</a>";
}

?>             
</body>
</html>
