							  <?php
							    require_once("inc/conf.php");
							    require_once(SITEROOT . "/inc/db.php");
								if( !array_key_exists("userloginid", $_COOKIE) ){
									login_form();
							    }
								elseif( intval($_COOKIE["userloginid"]) == 0 ){
									login_form();
								}
								else{
									$q = "select `fng_nick`, `user_level` from `user_info` where `id`=" . intval($_COOKIE["userloginid"]) . " limit 1";
								 
									$rs = mysql_query($q); //获取数据集

									$row = mysql_fetch_array($rs);
									if($row){
							  ?>
									<div class="dl">
										<div class="lf">
											FNG昵称：<strong><?php echo $row["fng_nick"];?></strong><br />
											等级：<?php echo $row["user_level"];?><br />
											投资回报率：810%<br />
											关注：3<br />
											粉丝：1
											<br />
											<a href="logout.php" style="color: red;">退出登录</a>
										</div>
									</div>
							  <?php
									}
								}
								
								function login_form(){
							  ?>
									<form id="index_login" action="/login.php" method="post">
										<div class="dl">
                                      		<div class="lf">
											<input type="text" name="username" style=" margin-bottom:9px;*margin-bottom:6px;"/>
											<input type="password" name="password" />
                                            </div>
                                            <div class="lr">
                                            			<a href="" onclick="return do_form_login()">登录</a>
                                            </div>
                                            <p><a href="" class="mm">忘记密码</a><a href="">注册账户</a></p>
										</div>
                                     </form> 
							  <?php
								}
							  ?>