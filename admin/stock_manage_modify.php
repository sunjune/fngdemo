<?php
require_once("../inc/conf.php");
require_once(SITEROOT . "/inc/db.php");
?>
<!DOCTYPE html>
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:Web="http://schemas.live.com/Web/">
<head>
<meta content="text/html; charset=utf-8" http-equiv="content-type" />
<title>Stock Manage Modify</title>
</head>
<body>
<?php
//print_r($_REQUEST);
//exit;

if( !empty($_REQUEST["opt_type"]) && !empty($_REQUEST["id"]) ) {

	$opt_type = $_REQUEST["opt_type"];
	$mysql_stockid = intval($_REQUEST['id']);
	
	if($opt_type == "update"){
		//更新用户信息
		$mysql_stockcode = addslashes($_REQUEST['stock_code']);
		$mysql_stockname = addslashes($_REQUEST['stock_name']);
		$mysql_stockprice = floatval($_REQUEST['stock_price']);
		
		$q = "update `stock_info` set `stock_code`='$mysql_stockcode', `stock_name`='$mysql_stockname', `stock_price`=$mysql_stockprice where `id`=$mysql_stockid";
	 //var_dump($q);
	 //exit;
		$rs = mysql_query($q); //获取数据集

		echo '修改完成<br /><a href="stock_manage.php">返回</a>';
		//mysql_free_result($rs); //关闭数据集
	}
	elseif($opt_type == "edit"){
		//编辑用户信息
		
		$q = "select `stock_code`, `stock_name`, `stock_price` from `stock_info` where `id`=$mysql_stockid";
		$rs = mysql_query($q); //获取数据集
		if(!$rs){die("Valid result!");}
		
		$row = mysql_fetch_array($rs);
?>
	<table border="0">
	<form name="form1" method="post" action="stock_manage_modify.php">
		<input type="hidden" name="opt_type" value="update" />
		<input type="hidden" name="id" value="<?php echo $mysql_stockid;?>" />
		<tr>
		<td>股票代码</td>
		<td><input type="text" name="stock_code" value="<?php echo $row["stock_code"];?>" /></td>
		</tr>
		<tr>
		<td>股票名称</td>
		<td><input type="text" name="stock_name" value="<?php echo $row["stock_name"];?>" /></td>
		</tr>
		<tr>
		<td>当前价格</td>
		<td><input type="text" name="stock_price" value="<?php echo $row["stock_price"];?>" /></td>
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
	echo "参数错误，请<a href=\"user_manage.php\">返回</a>";
}

?>             
</body>
</html>
