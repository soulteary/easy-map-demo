<?php
/**
 * MAP DEMO
 *
 * 程序基础设置文件
 *
 * @version 0.0.1
 *
 * @package soulteary
 * @email   soulteary@qq.com
 * @website http://soulteary.com
 */

if(!defined('FILE_PREFIX'))die('Silence is golden.');

/** 程序版本 */
define("VERSION", "0.0.1");
/** 调试模式开关 */
define('DEBUG', false);
/** 主题选择 */
define('THEME', 'default');
/** 开启GZIP压缩(如果调试模式被激活，那么忽略此设置。) */
define('GZIP', true);
/** 语言设置 */
define('Y_LANG', 'zh-CN');
/** 字符集设置 */
define('Y_CHARSET', 'UTF-8');

include(FILE_PREFIX.'dbconfig.php');

/** 设置默认时区。 */
date_default_timezone_set('PRC');

/** 载入程序模块 */
function __autoload($classname)
{
    $fileName = ABSPATH . FILE_PREFIX . "includes/" . strtolower($classname);
    $classFile = $fileName . ".class.php";
    $libFile = $fileName . ".lib.php";

    if (file_exists($libFile)) {
        include($libFile);
    }
    if (file_exists($classFile)) {
        include($classFile);
    }

}


?>