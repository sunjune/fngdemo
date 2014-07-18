<?php
require_once("../inc/conf.php");
require_once(SITEROOT . "/inc/db.php");
?>
<!DOCTYPE html>
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:Web="http://schemas.live.com/Web/">
<head>
<meta content="text/html; charset=utf-8" http-equiv="content-type" />
<title>User Manage Modify</title>
</head>
<body>
<?php
//print_r($_REQUEST);
//exit;

if( !empty($_REQUEST["opt_type"]) && !empty($_REQUEST["id"]) ) {

	$opt_type = $_REQUEST["opt_type"];
	$mysql_userid = intval($_REQUEST['id']);
	
	if($opt_type == "update"){
		//更新用户信息
		$mysql_userlevel = intval($_REQUEST['user_level']);
		$mysql_userquota = floatval($_REQUEST['user_quota']);
		$mysql_userrecommend = array_key_exists("fng_recommend", $_REQUEST) ? intval($_REQUEST['fng_recommend']) : 0;
		
		$q = "update `user_info` set `user_level`=$mysql_userlevel, `user_quota`=$mysql_userquota, `fng_recommend`=$mysql_userrecommend where `id`=$mysql_userid";
	 //var_dump($q);
	 //exit;
		$rs = mysql_query($q); //获取数据集

		echo '修改完成<br /><a href="user_manage.php">返回</a>';
		//mysql_free_result($rs); //关闭数据集
	}
	elseif($opt_type == "edit"){
		//编辑用户信息
		
		$q = "select `id`, `username`, `email`, `mobile`, `user_level`, `user_quota`, `fng_recommend` from `user_info` where `id`=$mysql_userid";
		$rs = mysql_query($q); //获取数据集
		if(!$rs){die("Valid result!");}
		
		$row = mysql_fetch_array($rs);
?>
	<table border="0">
	<form name="user_register_pc" method="post" action="user_manage_modify.php">
		<input type="hidden" name="opt_type" value="update" />
		<input type="hidden" name="id" value="<?php echo $row[0];?>" />
		<tr>
		<td>username</td>
		<td><input type="text" name="username" value="<?php echo $row[1];?>" disabled /></td>
		</tr>
		<tr>
		<td>email</td>
		<td><input type="text" name="email" value="<?php echo $row[2];?>" disabled /></td>
		</tr>
		<tr>
		<td>mobile</td>
		<td><input type="text" name="mobile" value="<?php echo $row[3];?>" disabled /></td>
		</tr>
		<tr>
		<td>level</td>
		<td><input type="text" name="user_level" value="<?php echo $row[4];?>" /></td>
		</tr>
		<tr>
		<td>quota</td>
		<td><input type="text" name="user_quota" value="<?php echo $row[5];?>" /></td>
		</tr>
		<tr>
		<td>recommend</td>
		<td><input type="checkbox" name="fng_recommend" value="1" <?php if($row[6]==1) echo "checked";?> /></td>
		</tr>
		<tr>
		<td><input type="submit" value="submit" /></td>
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
