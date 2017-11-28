<?php

// 检测PHP版本
version_compare( PHP_VERSION, '5.5.0', '>=' ) or die( 'PHP版本需要大于5.5.0,当前版本' . PHP_VERSION);

// 检测是否安装openssl扩展
extension_loaded('openssl') or die('openssl扩展必须安装');

// 检测runtime目录是否有读写权限
$runtime_path = ROOT_PATH . '/runtime';
if(!is_readable($runtime_path) || !is_writable($runtime_path)){
    die('runtime目录必须有可读可写权限');
}

// 引入composer自动加载文件
if(is_file($autoloadFile = ROOT_PATH . '/vendor/autoload.php')){

    require $autoloadFile;

}else{

    die('Please install composer first!');

}

// 默认关闭错误报告
ini_set("display_errors", "Off");
error_reporting(E_ALL ^ E_NOTICE);

require __DIR__ . '/bootstrap/const.php';

require __DIR__ . '/function/function.php';

require  COMMON_PATH . '/function/function.php';

// 定义调试开关
if('true' === input(DEBUG_PARAM)){

    defined('APP_DEBUG') or define('APP_DEBUG', true);

}else{

    defined('APP_DEBUG') or define('APP_DEBUG', false);

}

// 初始化核心框架
\gophp\app::run();


