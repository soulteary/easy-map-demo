<?php
/**
 * MAP DEMO
 * 用户操作。
 *
 * @version 0.0.1
 *
 * @package soulteary
 * @email   soulteary@qq.com
 * @website http://soulteary.com
 */

if(!defined('FILE_PREFIX'))die('Silence is golden.');

class User extends Core
{
    private $DB;
    private $prefix;
    function __construct(){
        $this->prefix = DB_PREFIX;
        $this->DB = MySql::getInstance();
    }

    /**
     * 用户登录
     */
    public function login(){
        if (@$_REQUEST['action'] == 'login') {
            @$_REQUEST['username'] != '' ? $username = @$_REQUEST['username'] : $username = '';
            @$_REQUEST['password'] != '' ? $password = @$_REQUEST['password'] : $password = '';
            if (('' != $username) && ('' != $password)) {
                $result = $this->DB->query('SELECT * FROM {$prefix}user');
                $userinfo = $this->DB->fetch_array($result);

                if (($username == $userinfo['username']) && ($password == $userinfo['password'])) {
                    @$_SESSION['role'] = 'admin';
                } else {
                    @$_SESSION['role'] = 'guest';
                }
                $data = array('code'=>200,'message'=>'登录成功。');
            }else{
                $data = array('code'=>400,'message'=>'登录失败。');
            }
            Core::ajax_echo($data);
        }else{
            Core::message('请求参数错误。');
        }
    }



    /**
     * 状态
     */
    static function userstate()
    {
        $ret = '';
        if ((isset($_SESSION['role'])) && (!empty($_SESSION['role']))) {
            $ret = @$_SESSION['role'];
        } else {
            $ret = 'guest';
            @$_SESSION['role'] = $ret;
        }

        return $ret;
    }


    /**
     * 登出
     */
    static function userloginout()
    {
        @$_SESSION['role'] = 'guest';
        return @$_SESSION['role'];
    }


    /**
     * 更新配置选项
     * @param $name
     * @param $value
     * @param $isSyntax 更新值是否为一个表达式
     */
    static function updateOption($name, $value, $isSyntax = false)
    {
        $value = $isSyntax ? $value : "'$value'";
        $this->DB->query("UPDATE {$prefix}options SET option_value=$value where option_name='$name'");
    }






}