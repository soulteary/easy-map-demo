<?php
/**
 * MAP DEMO
 *
 * 数据输出接口。
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

Core::stripslashes();

/** 输出网站内容 */

ob_start();
session_start();


//$album = new Album(array('THEME' => THEME, 'GZIP' => GZIP, 'DEBUG' => DEBUG));

if(@$_REQUEST['q'] == 'init'){
    $show = new Data(array("mode"=>"main"));
    exit();
}







/**
 * 用户登出
 */
if (@$_REQUEST['action'] == 'loginout') {
    $the_role = User::userloginout();
}


/**
 * 上传图片
 */
if (@$_REQUEST['action'] == 'post') { //&& @$_SESSION['role']=='admin'){
    @$title = trim($_REQUEST['title']);
    @$des = trim($_REQUEST['des']);
    @$tags = trim($_REQUEST['tags']);
    @$urls = trim($_REQUEST['urls']);
    @$filename = trim($_REQUEST['filename']);
    @$date = time();

    @$title == '' ? @filename : @$title;

    $sql = "Insert Into {$db_prefix}album (`title`,`date`,`des`,`url`,`tags`) values ('$title','$date','$des','$urls','$tags')";
    $DB->query($sql);
}

/**
 * 删除图片
 */
if ((@$_REQUEST['action'] == 'del') && (User::userstate() == 'admin')) {
    @$pid = trim($_REQUEST['pid']);

    @$pid != '' ? @$pid : 0;
    if (@$pid == 0) {
        myMsg('删除失败。', './');
    }


    $sql = "DELETE FROM {$db_prefix}album WHERE pid = '$pid'";
    $DB->query($sql);
}


//回复
if (@$_REQUEST['action'] == 'rel' && (User::userstate() == 'admin')) {
    @$id = $_REQUEST['relid'];
    @$relcontent = $_REQUEST['relcontent'];
    @$reltime = time();
    $update_sql = "Update {$db_prefix}news Set relcontent = '$relcontent',reltime = '$reltime' Where id = '$id'";
    $DB->query($update_sql);
}

//$show = new Data(array("mode"=>"main"));
$show = new Data(array("mode"=>"single"));
?>