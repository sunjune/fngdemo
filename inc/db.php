<?php
	$link=mysql_connect("127.0.0.1","root","111111");
    if(!$link) die("DB can not be accessed...");
    
	mysql_select_db("sq_demo", $link); //ѡ�����ݿ�
	mysql_query("SET NAMES UTF8");
?>