<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>FNG</title>
        <link href="style/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>
    </head>
    <body id="bid">
        <!--登录条-->
<?php
    if( array_key_exists("userloginid", $_COOKIE) ){
        $user_id = $_COOKIE["userloginid"];
        $fng_nick = $_COOKIE["fng_nick"];
        $user_name = $_COOKIE["user_name"];
    }
    else{
        $user_id = 0;
        $fng_nick = '';
        $user_name = '';
    }

    require_once("inc/conf.php");
    require_once(SITEROOT . "/inc/db.php");
?>
        <div class="bg_top_h_tile">
            <div class="bg_top_owner">
                <div id="page_body">
                    <div class="column_wrapper">
                        <div class="col_w1000">
                            <div class="top">
                                <div class="col_200"><a href="/"><img src="image/logo.png" width="166" height="24" /></a></div>
                                <div class="col_800"><span>北京<a href=""><?php echo date("Y.m.d H:i"); ?></a></span></div>
                            </div>
                            <div class="left">
                                <ul>
                                    <li class="nav1"><a href="/">今日关注</a></li>
                                    <li class="nav2"><a href="/sub01.php">我的FNG</a></li>
                                    <li class="nav3"><a href="/sub02.php">账户明细</a></li>
                                    <li class="cur nav4"><a href="/sub03.php">股票操盘</a></li>
                                    <li class="nav5"><a href="/sub04.php">股票查询</a></li>
                                    <li class="nav8"><a href="/sub05.php">FNG商城</a></li>
                                    <li class="nav6"><a href="/sub06.php">游戏规则</a></li>
                                    <li class="nav7"><a href="/sub07.php">在线帮助</a></li>
                                </ul>
                            </div>
                            <div class="middle">
                                <div class="page_zj_center2">
                                    <div class="zj_nr_top">
                                        <a href="" class="er"></a>
                                        <div class="t1"><span>规则说明</span>　股市有风险，入市需谨慎。</div>
                                        <p>学习现货黄金知识。投入一个新领域一定要获得足够的知识，在获得知识上花费的时间越
                                            多转变交易思维模式。从单向交易模式向双向交易模式转变，学会两头思考... <a href="">查看全部</a></p>
                                    </div>
                                    <div class="zj_nr_top2">
                                        <h3>账户认证</h3>
                                        <div style="float:left;">
                                            <div class="nr_left">
                                                <input name="" type="text" class="inp_1" value="输入手机号码" />
                                                <input name="" type="text" class="inp_2" value="输入操盘密码" />
                                            </div>
                                            <div class="nr_right">
                                                <a href=""><img src="image/rz_but_03.jpg" width="52" height="60" title=""/></a>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="ck"><input name="" type="checkbox" value="" checked="checked" class="ckb" /><span class="sp_1">我已阅读并同意《FNG操盘规则》</span></div>
                                        </div>
                                        <div class="zj_nr_top2_right">
                                            <ul>
                                                <li><a href="">如何绑定手机 >></a></li>
                                                <li><a href="">为何认证失败 >></a></li>
                                                <li><a href="">我要找回密码 >></a></li>
                                                <li><a href="">更多常见问题 >></a></li>
                                                <li><a href="">绑定手机不成功 >></a></li>
                                                <li><a href="">更多常见问题 >></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="vspace" style="height:10px;"></div>
                                    <div class="zj_nr_top3">
                                        <ul>
                                            <li class="cur"><a href="">沪深A股</a></li>
                                            <li><a href="">香港H股</a></li>
                                            <li class="li_last"><a href="">美股</a></li>
                                        </ul>
                                        <div class="clear"></div>
                                        <div class="vspace"></div>
                                        <div class="zj_nr_top3_left">
                                            <div class="d_1">自选　　　<a href="">规则说明 >></a></div>
                                            <div class="vspace"></div>
<script type="text/javascript">
  function viewStock(objsel){
    var objForm = document.getElementById('form1');

    var objOption = objsel.options[objsel.selectedIndex];

    if(objsel.selectedIndex > 0){
        objForm.stock_name.value = objOption.attributes['stock_code'].value + '_' + objOption.text;

        document.querySelector('#buying_rate').value = objOption.attributes['cur_price'].value;
    }
    else{
        objForm.stock_name.value = '';

        objForm.buying_rate.value = '';
    }
  }

</script>
                                            <form name="form1" id="form1">
                                                <input type="hidden" name="post_type" value="ajax" />
                                                <input type="hidden" name="user_id" value="<?php echo $user_id ;?>" >
                                                <input type="hidden" name="user_name" value="<?php echo $user_name .'_'. $fng_nick;?>">
                                                <input type="hidden" name="order_type" id="order_type1" value="0" />
                                                <input type="hidden" name="stock_name" value="" />
                                            <table width="240" border="0" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td align="center" valign="middle">选择股票</td>
                                                    <td align="center" valign="middle">
                                                      <select name="stock_id" onchange="viewStock(this);">
                                                        <option value="0">请选择股票</option>
                                                      </select>

                                                    </td>
                                                    <td valign="middle">今日禁买</td>
                                                </tr>
                                                      <script type="text/javascript" src="http://hq.sinajs.cn/list=sh600229,sz000920,sh600000,sz000547,sh600571,sz000987,sh601226,sh601188,sh600396,sz002735"></script>
                                                      <script type="text/javascript">
                                                        var stock_list_text = 'sh600229,sz000920,sh600000,sz000547,sh600571,sz000987,sh601226,sh601188,sh600396,sz002735';
                                                        var stock_list = stock_list_text.split(',');
                                                        var objSelect = document.getElementById('form1').stock_id;
                                                        for(var i in stock_list){
                                                            var stock_info = eval('hq_str_' + stock_list[i] + '.split(",")');
                                                            var option = document.createElement("option");
                                                            option.value = parseInt(i)+1;
                                                            option.text = stock_info[0];
                                                            option.setAttribute('cur_price', stock_info[3]);
                                                            option.setAttribute('stock_code', stock_list[i]);
                                                            objSelect.add(option);
                                                        }
                                                      </script>
                                                <tr>
                                                    <td align="center" valign="middle">委托价格</td>
                                                    <td align="center" valign="middle"><input type="text" class="inp_l1" name="buying_rate" id="buying_rate" value=""></td>
                                                    <td valign="middle">元RMB</td>
                                                </tr>
                                                <tr>
                                                    <td align="center" valign="middle">买入股数</td>
                                                    <td align="center" valign="middle"><input type="text" class="inp_l1" name="amount" value=""></td>
                                                    <td valign="middle">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align="center" valign="middle">配比倍数</td>
                                                    <td align="center" valign="middle"><input type="text" class="inp_l1" name="user_quota" value="11.5"></td>
                                                    <td valign="middle">配比规则</td>
                                                </tr>
                                                <?php
                                                if( $user_id != 0){
                                                ?>
                                                <tr>
                                                    <td colspan="3"><input type="image" src="image/xd_03.jpg" width="64" height="24" /></td>
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                                <tr>
                                                    <td align="center" valign="middle">结算止盈</td>
                                                    <td colspan="2" align="left" valign="middle">　+10%</td>
                                                </tr>
                                                <tr>
                                                    <td align="center" valign="middle">中止止损</td>
                                                    <td colspan="2" align="left" valign="middle">　-8%</td>
                                                </tr>
                                                <tr>
                                                    <td valign="middle">操盘周期</td>
                                                    <td colspan="2" valign="middle">　截至下交易日 14:54:59</td>
                                                </tr>
                                                <tr>
                                                    <td valign="middle">收益分配</td>
                                                    <td colspan="2" valign="middle">　显示按配比倍数与玩家分成比例</td>
                                                </tr>
                                                <tr>
                                                    <td valign="middle">积分奖励</td>
                                                    <td colspan="2" valign="middle">　显示按配比倍数与盈亏关联奖励</td>
                                                </tr>
                                            </table>
                                            </form>
<script type="text/javascript">
  $('#form1').submit(function(event){

      // Stop form from submitting normally
      event.preventDefault();

      var objForm = document.getElementById('form1');

      if(objForm.stock_id.value > 0 && objForm.amount.value != ''){

          // Get some values from elements on the page:
          url = '/admin/group_manage_add.php';
         
          // Send the data using post
          var posting = $.post( url, $( this ).serialize(), '' , "json" );
         
          // Put the results in a div
          posting.done(function( data ) {
            if(data['msg'] == 'success'){
                alert('操作已成功');
                objForm.reset();
            }
          });
      }
      else{
        alert('请选择股票，并填写买入数量。');
        return false;
      }
  });
</script>
                                            <div class="vspace"></div>
                                        </div>
                                        <div class="zj_nr_top3_right">
                                            <div style="margin-left:20px; margin-top:20px; line-height: 180%; font-size:14px;">
                                            不会炒股?直接理财吧!<br />
                                            <br />
                                            正在发售<br />
                                            年化收益18% 理财周期29天>><br />
                                            年化收益16% 理财周期10天>><br />
                                            年化收益20% 理财周期99天>><br />
                                            <br />
                                            12月25日发售<br />
                                            年化收益18% 理财周期26天>><br />
                                            </div>
                                        </div>
                                        <div class="clear"></div>
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
