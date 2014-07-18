<?php
		setcookie("userloginid", '');
		
		header("Content-type: text/html; charset=utf-8"); 
		header("Refresh:1; URL=/");
		echo "退出登录，正在转向首页...";
		exit;
?>             
