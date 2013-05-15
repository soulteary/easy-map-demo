<?php
/**
 * MAP DEMO
 *
 * 程序首页文件
 *
 * @version 0.0.1
 * @package soulteary
 * @email   soulteary@qq.com
 * @website http://soulteary.com
 */


/** 你可以将你的文件路径前缀随意修改，但是请将网站目录中对应的文件也进行修改。 */
define('FILE_PREFIX', 'y-');
/** 程序初始化。 */
require('./'.FILE_PREFIX.'load.php');

/** 输出网站内容 */
$album = new Album(array('THEME' => THEME, 'GZIP' => GZIP, 'DEBUG' => DEBUG));
?>