<?php
require_once("inc/passgate_login_info.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FNG</title>
<link href="style/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
-->
</style>
<script src="js/WdatePicker.js"></script>
</head>
<body id="bid">
<!--登录条-->
<div class="bg_top_h_tile">
  <div class="bg_top_owner">
    <div id="page_body">
    				<div class="column_wrapper">
           				 <div class="col_w1000">
                   						<div class="top">
                              				<div class="col_200"><a href="/"><img src="image/logo.png" width="166" height="24" /></a></div>
                                      <div class="col_800"><span>北京<a href=""><?php echo date("Y.m.d H:i");?></a></span></div>
                              </div>
                   						<div class="left">
                              				<ul>
                                      				<li class="nav1"><a href="/">今日关注</a></li>
                                              <li class="nav2"><a href="/sub01.php">我的FNG</a></li>
                                              <li class="cur nav3"><a href="/sub02.php">账户明细</a></li>
                                              <li class="nav4"><a href="/sub03.php">股票操盘</a></li>
                                              <li class="nav5"><a href="/sub04.php">股票查询</a></li>
                                              <li class="nav8"><a href="/sub05.php">FNG商城</a></li>
                                              <li class="nav6"><a href="/sub06.php">游戏规则</a></li>
                                              <li class="nav7"><a href="/sub07.php">在线帮助</a></li>
                                      </ul>
                              </div>
                              <div class="middle">
                              			<div class="zj05">
                                          <div class="text_box">
                                                <h3><a href=""><i>尊敬的巴黎肥猫</i>，以下是您在FNG的交易记录</a></h3>
                                                <ul>
                                                      <li class="cur"><a href="">当天交易记录</a></li>
                                                      <li><a href="">一个月内交易记录</a></li>
                                                      <li><a href="">历史交易记录</a></li>
                                                </ul>
                                                <p>
                                                      <a href="">起始</a><input type="text" id="5421" onFocus="WdatePicker({onpicking:function(dp){if(!confirm('日期框原来的值为: '+dp.cal.getDateStr()+', 要用新选择的值:' + dp.cal.getNewDateStr() + '覆盖吗?')) return true;}})" class="Wdate"/>
                                                      <a href="">终止</a><input type="text" id="5421" onFocus="WdatePicker({onpicking:function(dp){if(!confirm('日期框原来的值为: '+dp.cal.getDateStr()+', 要用新选择的值:' + dp.cal.getNewDateStr() + '覆盖吗?')) return true;}})" class="Wdate"/>
                                                      <a href="" class="chaxun">查询</a>
                                                </p>
                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                			<tr>
                                                      			<td width="70"><i>日期</i></td>
                                                            <td width="64"><i>时间</i></td>
                                                            <td width="61"><i>买入</i></td>
                                                            <td width="61"><i>卖出</i></td>
                                                            <td width="42"><i>数量</i></td>
                                                            <td width="42"><i>收入</i></td>
                                                            <td width="42"><i>支出</i></td>
                                                            <td width="60"><i>类型</i></td>
                                                            <Td width="68"><i>备注</i></Td>
                                                      </tr>
                                                      <tr>
                                                      			<td>20140509</td>
                                                            <td>10:28:29</td>
                                                            <td>浙江控股</td>
                                                            <td>浙江控股</td>
                                                            <td>1000</td>
                                                            <td>1000</td>
                                                            <td>1000</td>
                                                            <td>操盘交易</td>
                                                            <td>单号GD001</td>
                                                      </tr>
                                                      <tr>
                                                      			<td>20140509</td>
                                                            <td>10:28:29</td>
                                                            <td>浙江控股</td>
                                                            <td>浙江控股</td>
                                                            <td>1000</td>
                                                            <td>1000</td>
                                                            <td>1000</td>
                                                            <td>操盘交易</td>
                                                            <td>单号GD001</td>
                                                      </tr>
                                                      <tr>
                                                      			<td>20140509</td>
                                                            <td>10:28:29</td>
                                                            <td>浙江控股</td>
                                                            <td>浙江控股</td>
                                                            <td>1000</td>
                                                            <td>1000</td>
                                                            <td>1000</td>
                                                            <td>操盘交易</td>
                                                            <td>单号GD001</td>
                                                      </tr>
                                                      <tr>
                                                      			<td>20140509</td>
                                                            <td>10:28:29</td>
                                                            <td>浙江控股</td>
                                                            <td>浙江控股</td>
                                                            <td>1000</td>
                                                            <td>1000</td>
                                                            <td>1000</td>
                                                            <td>操盘交易</td>
                                                            <td>单号GD001</td>
                                                      </tr>
                                                      <tr>
                                                      			<td colspan="2">支出交易笔数<b>2</b></td>
                                                            <Td colspan="7">收入合计<b>696.54</b></Td>
                                                      </tr>
                                                </table>
                                          </div>
                                    </div>  
                              </div>
                              <div class="right">
								<?php
								require_once("inc/login_info.php");
								?>
                                      <div class="vspace"></div>
                                      
                                      <div class="text_box">
                                      				<h3><a href="">推荐用户</a></h3>
                                              <table cellpadding="0" cellspacing="0">
                                              			<tr>
                                                    			<Td width="68">力气力气</Td>
                                                          <Td width="48">20.51</Td>
                                                          <Td width="32">买</Td>
                                                          <Td width="65">杭州发展</Td>
                                                    </tr>
                                                    <tr>
                                                    			<Td>发发发财</Td>
                                                          <Td>5.67</Td>
                                                          <Td>买</Td>
                                                          <Td>深圳企划</Td>
                                                    </tr>
                                                    <tr>
                                                    			<Td>杨思思</Td>
                                                          <Td>102.97</Td>
                                                          <Td>买</Td>
                                                          <Td>深创投行</Td>
                                                    </tr>
                                              </table>
                                      </div>
                                      <div class="text_box">
                                      				<h3><a href="">今日团单</a></h3>
                                              <table cellpadding="0" cellspacing="0">
                                              			<tr>
                                                    			<Td width="68">浙江控股</Td>
                                                          <Td width="80">002266.SZ</Td>
                                                          <Td width="65">20.51</Td>
                                                    </tr>
                                                    <tr>
                                                    			<Td>大智慧</Td>
                                                          <Td>185441.SH</Td>
                                                          <Td>5.67</Td>
                                                    </tr>
                                                    <tr>
                                                    			<Td>杨思思</Td>
                                                          <Td>123553.KS</Td>
                                                          <Td>102.97</Td>
                                                    </tr>
                                              </table>
                                      </div>
                                      <div class="text_box" style=" border:none">
                                      				<h3><a href="">今日交易排行</a></h3>
                                              <table cellpadding="0" cellspacing="0">
                                              			<tr>
                                                    			<Td width="68">浙江控股</Td>
                                                          <Td width="80">002266.SZ	</Td>
                                                          <Td width="65">关注</Td>
                                                    </tr>
                                                    <tr>
                                                    			<Td>大智慧</Td>
                                                          <Td>185441.SH</Td>
                                                          <Td>关注</Td>
                                                    </tr>
                                                    <tr>
                                                    			<Td>新锐城镇</Td>
                                                          <Td>123553.KS</Td>
                                                          <Td>关注</Td>
                                                    </tr>
                                                    
                                                    <tr>
                                                    			<Td>新锐城镇</Td>
                                                          <Td>123553.KS</Td>
                                                          <Td>关注</Td>
                                                    </tr>
                                                    <tr>
                                                    			<Td>新锐城镇</Td>
                                                          <Td>123553.KS</Td>
                                                          <Td>关注</Td>
                                                    </tr>
                                                    <tr>
                                                    			<Td>新锐城镇</Td>
                                                          <Td>123553.KS</Td>
                                                          <Td>关注</Td>
                                                    </tr>
                                                    <tr>
                                                    			<Td>新锐城镇</Td>
                                                          <Td>123553.KS</Td>
                                                          <Td>关注</Td>
                                                    </tr>
                                                    <tr>
                                                    			<Td>新锐城镇</Td>
                                                          <Td>123553.KS</Td>
                                                          <Td>关注</Td>
                                                    </tr>
                                                    <tr>
                                                    			<Td>新锐城镇</Td>
                                                          <Td>123553.KS</Td>
                                                          <Td>关注</Td>
                                                    </tr>
                                                    <tr>
                                                    			<Td>新锐城镇</Td>
                                                          <Td>123553.KS</Td>
                                                          <Td>关注</Td>
                                                    </tr>
                                              </table>
                                      </div>
                                      
                              </div>
                   </div>
            </div>
    </div>
    <!--页脚-->
    <div id="page_bottom">
    </div>
  </div>
</div>
</body>
</html>