<?php
/**
 * MAP DEMO
 *
 * 程序加载器。
 *
 * @version 0.0.1
 *
 * @todo
 *      - 配置文件不存在的时候展示初始化配置文件。
 *
 * @package soulteary
 * @email   soulteary@qq.com
 * @website http://soulteary.com
 */


if(!defined('FILE_PREFIX'))die('Silence is golden.');

if (file_exists('./install.php')) {
    header("Location: ./install.php");
    die();
}


define( 'ABSPATH', dirname(__FILE__) . '/' );

error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR );

if ( file_exists( ABSPATH . FILE_PREFIX .'config.php') ) {

    require_once( ABSPATH . FILE_PREFIX . 'config.php' );
    require_once( ABSPATH . FILE_PREFIX . 'load.php' );

} else {
    //todo:html
    die('none config.');
}
?>