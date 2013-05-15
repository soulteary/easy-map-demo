<?php
/**
 * MAP DEMO
 * 程序核心函数库。
 *
 * @version 0.0.1
 *
 * @include
 *          - @function associative_push            创建关联数组
 *          - @function init_args                   初始化传递参数
 *          - @function get_mircotime               输出毫秒时间
 *          - @function display_file_permissions    读取文件夹权限
 *          - @function gzip_accepted               判断服务器是否支持GZIP
 *          - @function message                     显示系统消息
 *          - @function stripslashes                去除请求中的多余转义字符
 *          - @function strip_slashes               [私有]递归去除转义字符
 *          - @function ajax_echo                   输出json数据
 *
 * @todo
 *      - 配置文件不存在的时候展示初始化配置文件。
 *
 * @package soulteary
 * @email   soulteary@qq.com
 * @website http://soulteary.com
 */


if(!defined('FILE_PREFIX'))die('Silence is golden.');

class Core
{
    /**
     * 创建关联数组
     *
     * @since 0.0.1
     *
     * @eg. $result = core::associative_push($target, $data);
     * @param array $arr 要被创建的关联数组。
     * @param array $tmp 要被填充为新数组内容的临时数组。
     * @return array $arr 创建好的关联数组。
     */
    public function associative_push($arr, $tmp)
    {
        if (is_array($tmp)) {
            foreach ($tmp as $key => $value) {
                $arr[$key] = $value;
            }
            return $arr;
        }
        return false;
    }

    /**
     * 初始化传递参数
     *
     * @since 0.0.1
     *
     * @use core::associative_push();
     * @eg. $this->args = core::init_args(func_get_args());
     * @param array $args 传递进来的参数。
     * @return array $result 序列化好的新数组。
     */
    public function init_args($args)
    {
        $result = array();
        for ($i = 0, $n = count($args); $i < $n; $i++) {
            $result = self::associative_push($args[$i], $result);
        }
        return $result;
    }

    /**
     * 输出毫秒时间。
     *
     * @since 0.0.1
     *
     * @eg. core::get_mircotime();
     * @return float 当前时间的毫秒时间。
     */
    public function get_mircotime(){
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }

    /**
     * 读取文件夹权限。
     *
     * @since 0.0.1
     *
     * @todo
     *       - 添加功能到安装脚本中，并测试。
     * @eg. core::display_file_permissions($filePath);
     * @params string $filePath 要读取的文件的路径。
     * @return string $result 文件的权限描述字符串。
     */
    public function display_file_permissions($filePath)
    {
        $Mode = fileperms($filePath);
        // Determine Type
        if ($Mode & 0x1000) {$Type = 'p';}// FIFO pipe
        else if ($Mode & 0x2000) {$Type = 'c';}// Character special
        else if ($Mode & 0x4000) {$Type = 'd';}// Directory
        else if ($Mode & 0x6000) {$Type = 'b';}// Block special
        else if ($Mode & 0x8000) {$Type = '-';}// Regular
        else if ($Mode & 0xA000) {$Type = 'l';}// Symbolic Link
        else if ($Mode & 0xC000) {$Type = 's';}// Socket
        else {$Type = 'u';}// UNKNOWN

        // Determine permissions
        $Owner['read']    = ($Mode & 00400) ? 'r' : '-';
        $Owner['write']   = ($Mode & 00200) ? 'w' : '-';
        $Owner['execute'] = ($Mode & 00100) ? 'x' : '-';
        $Group['read']    = ($Mode & 00040) ? 'r' : '-';
        $Group['write']   = ($Mode & 00020) ? 'w' : '-';
        $Group['execute'] = ($Mode & 00010) ? 'x' : '-';
        $World['read']    = ($Mode & 00004) ? 'r' : '-';
        $World['write']   = ($Mode & 00002) ? 'w' : '-';
        $World['execute'] = ($Mode & 00001) ? 'x' : '-';

        // Adjust for SUID, SGID and sticky bit
        if ($Mode & 0x800) $Owner['execute'] = ($Owner['execute'] == 'x') ? 's' : 'S';
        if ($Mode & 0x400) $Group['execute'] = ($Group['execute'] == 'x') ? 's' : 'S';
        if ($Mode & 0x200) $World['execute'] = ($World['execute'] == 'x') ? 't' : 'T';

        $result = $Type.$Owner['read'].$Owner['write'].$Owner['execute'];
        $result.= $Group['read'].$Group['write'].$Group['execute'];
        $result.= $World['read'].$World['write'].$World['execute'];
        return $result;
    }

    /**
     * 判断服务器是否支持GZIP，并防止重复压缩。
     *
     * @since 0.0.1
     *
     * @eg. core::gzip_accepted();
     * @return boolean 服务器是否支持GZIP。
     */
    public function gzip_accepted()
    {
        $enable = strtolower(ini_get('zlib.output_compression'));
        if (1 == $enable || "on" == $enable ){
            return false;
        }

        if ( !isset($_SERVER['HTTP_ACCEPT_ENCODING']) || (isset($_SERVER['HTTP_ACCEPT_ENCODING']) && strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip' ) === false ))
        {
            return false;
        }

        return true;
    }

    /**
     * 显示系统消息
     *
     * @since 0.0.1
     *
     * @param string $msg HEADER消息头部。
     * @param string $url 要转向的地址。
     * @param boolean $isAutoGo 是否自动转向。
     * @return mixed HTML消息页面。
     */
    public function message($msg, $url = 'javascript:history.back(-1);', $isAutoGo = false)
    {
        if ($msg == '404') {
            header("HTTP/1.1 404 Not Found");
            $msg = '404 请求页面不存在！';
        }
        echo <<<EOT
<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
EOT;
        if ($isAutoGo) {
            echo "<meta http-equiv=\"refresh\" content=\"2;url=$url\" />";
        }
        echo <<<EOT
    <title>系统消息</title>
    <style type="text/css">
        body {
            background-color: #F7F7F7;
            font-family: Arial;
            font-size: 12px;
            line-height: 150%;
        }
        .main {
            position: absolute;
            width: 580px;
            height: 70px;
            top: 20%;
            left: 50%;
            margin-left: -290px;
            margin-top: -35px;
            background-color: #FFF;
            border: 1px solid #DFDFDF;
            box-shadow: 1px 1px #E4E4E4;
            padding: 10px;
        }
        .main p {
            color: #666;
            line-height: 1.5;
            font-size: 12px;
            margin: 13px 20px;
        }
        .main a {
            margin: 0 5px;
            color: #11A1DA;
        }
        .main a:hover {
            color: #34B7EB;
        }
    </style>
</head>
<body>
    <div class="main">
        <p>$msg</p>
        <p><a href="$url">&laquo;点击返回</a></p>
    </div>
</body>
</html>
EOT;
        exit;
    }

    /**
     * 递归去除转义字符
     *
     * @since 0.0.1
     *
     * @param mixed $value 要去除转义内容的内容。
     * @return mixed $value 去除了转义内容的内容。
     */
    private function strip_slashes($value)
    {
        $value = is_array($value) ? array_map('stripslashesDeep', $value) : stripslashes($value);
        return $value;
    }

    /**
     * 去除多余的转义字符
     *
     * @since 0.0.1
     *
     * @return mixed 去除多余的转义字符的请求数据。
     */
    public function stripslashes()
    {
        if (get_magic_quotes_gpc()) {
            $_GET = $this->strip_slashes($_GET);
            $_POST = $this->strip_slashes($_POST);
            $_COOKIE = $this->strip_slashes($_COOKIE);
            $_REQUEST = $this->strip_slashes($_REQUEST);
        }
    }

    /**
     * 输出json数据
     *
     * @since 0.0.1
     *
     * @params mixed $data 任何变量。
     * @return json 输出json数据。
     */
    public function ajax_echo($data){
        header('Access-Control-Allow-Origin: *');
        header('Content-type:text/html; charset=UTF-8');
        header('Cache-Control: no-cache');
        header('Pragma: no-cache');
        header("Content-type:application/x-javascript");
        echo json_encode($data);
    }
}
?>