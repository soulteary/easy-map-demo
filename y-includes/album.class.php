<?php
/**
 * MAP DEMO
 * 程序模版函数库。
 *
 * @version 0.0.1
 *
 * @include
 *
 * @todo
 *      - 整理函数。
 *
 * @package soulteary
 * @email   soulteary@qq.com
 * @website http://soulteary.com
 */

if(!defined('FILE_PREFIX'))die('Silence is golden.');

class Album
{
    private $args = array();
    private $process_time_start;
    private $process_time_end;

    function __construct()
    {

        $this->args = core::init_args(func_get_args());

        if ($this->args['DEBUG']) {
            $this->mktimestamp();
        }

        date_default_timezone_set('PRC');

        $this->initTemplate();

        if ($this->args['GZIP'] && core::gzip_accepted()) {

            if (!ob_start(!$this->args['DEBUG'] ? 'ob_gzhandler' : null)) {
                ob_start();
            }
        }

        $this->header();
        $this->body();
        $this->footer();
    }

    /**
     * 获取当前脚本运行时间
     *
     */
    protected function mktimestamp($end = false)
    {
        if (!$end) {
            $this->process_time_start = core::get_mircotime();
        } else {
            $this->process_time_end = core::get_mircotime();
            return number_format($this->process_time_end - $this->process_time_start, 5);
        }
    }



    /**
     * THE TEMPLATE CLASS INIT
     * TODO:增加定义主题和缓存路径以及增加MEMCACHE支持
     */
    private function initTemplate()
    {
        //初始化模版
    }


    /**
     * THE TEMPLATE HEADER MODULE
     */
    private function header()
    {
        echo '<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>MAP DEMO - 记录成长故事。</title>
    <link rel="stylesheet/less" type="text/css" href="extra/main.less">
    <script type="text/javascript" src="extra/less-1.3.3.min.js"></script>
    <script type="text/javascript" src="extra/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="extra/application.js"></script>
</head>
<body data-page="main">
';

    }

    /**
     * THE TEMPLATE BODY MODULE
     */
    private function body()
    {
        echo '
<div class="container">
    <div class="row" id="header">
        <h1><a href="#CMD:HOME">Story校园相册</a></h1>
        <ul class="header-nav">
            <li><a href="#CMD:HOME">首页</a></li>
            <li><a href="#CMD:TAGS">标签</a></li>
            <li><a href="#CMD:ARCHIVE">归档</a></li>
            <li>//</li>
            <li><a href="#CMD:ABOUT">关于</a></li>
        </ul>
    </div>
    <div class="row" id="main"></div>
';
    }

    /**
     * THE TEMPLATE FOOTER MODULE
     */
    private function footer()
    {
        //调试信息输出
        if ($this->args['DEBUG']) {
            echo ($this->args);
            echo (Debug::theDebug());
            $timestamp = $this->mktimestamp(true);
            $timestamp = "\n<!--Process in $timestamp seconds.-->\n";
            echo ($timestamp);
        }
        echo '    <div class="row" id="footer">
        <span id="copyright">&copy;2011 - 2013 Soulteary. All rights reserved. <a href="http://soulteary.com">soulteary.com</a> </span>
    </div>
</div>
</body>
</html>';
    }


}

?>