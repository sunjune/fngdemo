<?php
require_once("inc/conf.php");
require_once(SITEROOT . "/inc/db.php");

if( !empty($_REQUEST["username"]) && !empty($_REQUEST["password"]) ) {
//print_r($_REQUEST);
//exit;

	$mysql_username = addslashes($_REQUEST['username']);
	$mysql_password = addslashes($_REQUEST['password']);

	$rtn_url = $_REQUEST['url'];
	
    $q = "select `id`, `username`, `fng_nick` from `user_info` where `username`='$mysql_username' and `password`='$mysql_password' limit 1";
 //var_dump($q);
 //exit;
 
	$rs = mysql_query($q); //获取数据集
	$row = mysql_fetch_array($rs);
	if($row){

		setcookie("userloginid", $row['id'], 0, '', '', false, true);
		setcookie("user_name", $row['username'], 0, '', '', false, true);
		setcookie("fng_nick", $row['fng_nick'], 0, '', '', false, true);
		
		header("Content-type: text/html; charset=utf-8"); 
		header("Refresh:1; URL=$rtn_url");
		echo "登录成功，正在跳转...";
		exit;
	}
	else{
		setcookie("userloginid", "");

		header("Content-type: text/html; charset=utf-8"); 
		echo "请检查登录信息<br /><a href=\"/\">返回</a>";
	}

   //mysql_free_result($rs); //关闭数据集
}
?>             
