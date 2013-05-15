<?php
/**
 * MAP DEMO
 *
 * 数据输出接口类。
 *
 * @version 0.0.1
 * @package soulteary
 * @email   soulteary@qq.com
 * @website http://soulteary.com
 */
if (!defined('FILE_PREFIX')) die('Silence is golden.');

class Data extends Mysql
{
    private $DB;
    private $prefix;

    /**
     * 输出文章数据。
     *
     * @since 0.0.1
     *
     * @return json
     */
    function __construct()
    {

        $this->prefix = DB_PREFIX;
        $this->DB = MySql::getInstance();
        $this->args = Core::init_args(func_get_args());

        //SIMPLE OVERWRITE FOR LINGXIAO.
        $data[] = array('bus'=>'532路','path'=>'1小时16分钟 / 16公里','status'=>'空闲','time'=>'4分钟');
        $data[] = array('bus'=>'590路','path'=>'1小时18分钟 / 18公里','status'=>'忙碌','time'=>'14分钟');
        $data[] = array('bus'=>'915路','path'=>'1小时16分钟 / 19.3公里','status'=>'忙碌','time'=>'24分钟');

        Core::ajax_echo($data);
    }

}