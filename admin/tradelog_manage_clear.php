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
	
    $q = "delete from `trade_order_log`";
 //var_dump($q);
 //exit;
 
	$rs = mysql_query($q); //获取数据集


	echo '清空完成<br /><a href="tradelog_manage.php">返回</a>';
    //mysql_free_result($rs); //关闭数据集

?>             
</body>
</html>
