<?php
    $link=mysql_connect("localhost","root","之前的管理员密码");
    if(!$link) echo "没有连接成功!";
    mysql_select_db("infosystem", $link); //选择数据库
    $q = "SELECT * FROM info"; //SQL查询语句
    mysql_query("SET NAMES GB2312");
    $rs = mysql_query($q); //获取数据集
    if(!$rs){die("Valid result!");}
    echo "<table>";
    echo "<tr><td>部门名称</td><td>员工姓名</td><td>PC名称</td></tr>";
    while($row = mysql_fetch_array($rs)) echo "<tr><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td></tr>"; //显示数据
    echo "</table>";
    mysql_free_result($rs); //关闭数据集
?>             
