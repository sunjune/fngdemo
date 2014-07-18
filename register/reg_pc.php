<?php
require_once("../inc/conf.php");
require_once(SITEROOT . "/inc/db.php");
?>
<!DOCTYPE html>
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:Web="http://schemas.live.com/Web/">
<head>
<meta content="text/html; charset=utf-8" http-equiv="content-type" />
<title>User Register PC Client</title>
</head>
<body>
<?php
if( !empty($_REQUEST["username"]) && !empty($_REQUEST["password"]) && ( !empty($_REQUEST["email"]) || !empty($_REQUEST["mobile"] ) ) ) {
//print_r($_REQUEST);
//exit;

	$mysql_userid = 0;
	$mysql_username = addslashes($_REQUEST['username']);
	$mysql_password = addslashes($_REQUEST['password']);
	$mysql_regdate = date('Y-m-d H:i:s');
	$mysql_email = addslashes($_REQUEST['email']);
	$mysql_mobile = addslashes($_REQUEST['mobile']);
	
    $q = "INSERT INTO `user_info` (`username`, `regdate`, `email`, `mobile`, `password`) VALUES ('". $mysql_username . "', '" . $mysql_regdate ."', '" . $mysql_email ."', '". $mysql_mobile ."', '". $mysql_password ."')";
 //var_dump($q);
 //exit;
 
	$rs = mysql_query($q); //获取数据集
/*
	$mysql_userid = mysql_insert_id();	//得到注册用户的id
	
	$q = "INSERT INTO `user_account` (`user_id`, `user_name`, `user_balance`, `user_quota`) VALUES (" . $mysql_userid . ", '" . $mysql_username. "', 0, 0 )";
    $rs = mysql_query($q); //获取数据集
*/
	echo '<a href="reg_pc.php">继续注册</a>';
    //mysql_free_result($rs); //关闭数据集
}
else{
?>
<table border="0">
<form name="user_register_pc" method="post" action="reg_pc.php">
	<tr>
	<td>username</td>
	<td><input type="text" name="username" /></td>
	</tr>
	<tr>
	<td>password</td>
	<td><input type="password" name="password" /></td>
	</tr>
	<tr>
	<td>email</td>
	<td><input type="text" name="email" /></td>
	</tr>
	<tr>
	<td>mobile</td>
	<td><input type="text" name="mobile" /></td>
	</tr>
	<tr>
	<td><input type="submit" value="submit" /></td>
	<td>&nbsp;</td>
	</tr>
</form>
</table>
<?php
}

?>             
</body>
</html>
