<?php
require_once("../inc/conf.php");
require_once(SITEROOT . "/inc/db.php");
?>
<!DOCTYPE html>
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:Web="http://schemas.live.com/Web/">
<head>
<meta content="text/html; charset=utf-8" http-equiv="content-type" />
<title>Stock Manage Add</title>
</head>
<body>
<?php
if( !empty($_REQUEST["stock_code"]) && !empty($_REQUEST["stock_name"]) && !empty($_REQUEST["stock_price"]) ) {
//print_r($_REQUEST);
//exit;

	$mysql_userid = 0;
	$mysql_stockcode = addslashes($_REQUEST['stock_code']);
	$mysql_stockname = addslashes($_REQUEST['stock_name']);
	$mysql_stockprice = floatval($_REQUEST['stock_price']);
	
    $q = "INSERT INTO `stock_info` (`stock_code`, `stock_name`, `stock_price`) VALUES ('". $mysql_stockcode . "', '" . $mysql_stockname ."', " . $mysql_stockprice .")";
 //var_dump($q);
 //exit;
 
	$rs = mysql_query($q); //获取数据集
/*
	$mysql_userid = mysql_insert_id();	//得到注册用户的id
	
	$q = "INSERT INTO `user_account` (`user_id`, `user_name`, `user_balance`, `user_quota`) VALUES (" . $mysql_userid . ", '" . $mysql_username. "', 0, 0 )";
    $rs = mysql_query($q); //获取数据集
*/
	echo '<a href="stock_manage_add.php">继续添加</a>';
    //mysql_free_result($rs); //关闭数据集
}
else{
?>
<p>添加股票</p>
<table border="0">
<form name="form1" method="post" action="stock_manage_add.php">
	<tr>
	<td>股票代码</td>
	<td><input type="text" name="stock_code" /></td>
	</tr>
	<tr>
	<td>股票名称</td>
	<td><input type="text" name="stock_name" /></td>
	</tr>
	<tr>
	<td>当前价格</td>
	<td><input type="text" name="stock_price" /></td>
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
