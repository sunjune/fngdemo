Readme
======================================================

apache/conf/http.conf
添加网站目录
<Directory "C:/web/demo_sites/sq_demo">
    Options Indexes FollowSymLinks Includes ExecCGI
    AllowOverride All
    Require all granted
</Directory>

apache/conf/extra/httpd-vhosts.conf
添加虚拟域名
<VirtualHost *:80>
    ServerAdmin test@sq-demo.com
    DocumentRoot "C:/web/demo_sites/sq_demo"
    ServerName www.sq-demo.com
    ServerAlias www.sq-demo.com
    ErrorLog "logs/sq-demo.localhost-error.log"
    CustomLog "logs/sq-demo.localhost-access.log" combined
</VirtualHost>

hosts文件添加
127.0.0.1	www.sq-demo.com

===============
下单后时扣除
19.9 股票交易税
0.004 平台资金占用费

平仓时
如果涨了 扣除
纯利润 20% 平台受益分成
       10% 发起人分成

如果跌了
完全收回配比资金

