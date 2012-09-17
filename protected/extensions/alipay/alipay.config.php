<?php
$aliapy_config['partner']      = '2088701853514903';
$aliapy_config['key']          = '1tg64bn6nl2iev24x2lmlqeyznd4zrr9';
$aliapy_config['seller_email'] = 'muyunfanyi@163.com';

//页面跳转同步通知页面路径，要用 http://格式的完整路径，不允许加?id=123这类自定义参数
//return_url的域名不能写成http://localhost/create_direct_pay_by_user_php_utf8/return_url.php ，否则会导致return_url执行无效
//$aliapy_config['return_url']   = 'http://127.0.0.1/imuyun/index.php/consume/return';
$aliapy_config['return_url']   = 'http://imuyun.com/index.php/consume/return';
//服务器异步通知页面路径，要用 http://格式的完整路径，不允许加?id=123这类自定义参数
//$aliapy_config['notify_url']   = 'http://127.0.0.1/imuyun/index.php/consume/notify';
$aliapy_config['notify_url']   = 'http://imuyun.com/index.php/consume/notify';


//签名方式 不需修改
$aliapy_config['sign_type']    = 'MD5';

//字符编码格式 目前支持 gbk 或 utf-8
$aliapy_config['input_charset']= 'utf-8';

//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
$aliapy_config['transport']    = 'http';
?>