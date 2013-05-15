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
        $data = array();

        if ($this->args['mode'] == "main") {

            @$page = $_REQUEST['p'];

            if (($page == 0) || ($page == '')) {
                $page = 1;
            }
            $pagelistnum = 7;
            $pagelist = ($page - 1) * $pagelistnum;

            $sql = "SELECT title FROM {$this->prefix}album";
            $total = $this->DB->query($sql);
            $total = $this->DB->num_rows($total);

            ($total % $pagelistnum == 0) ? ($totalpage = $total / $pagelistnum) : ($totalpage = floor($total / $pagelistnum) + 1);
            if ($totalpage <= 1) {
                $totalpage = 1;
            }
            $page > 1 ? $uppage = $page - 1 : $uppage = 1;
            $page >= $totalpage ? $nextpage = $totalpage : $nextpage = $page + 1;

            $sql = "SELECT pid,title,date,des,tags,url FROM {$this->prefix}album ORDER BY pid DESC LIMIT $pagelist,$pagelistnum";
            $query = $this->DB->query($sql);

            $user = User::userstate();

            $data['user'] = array('user' => $user);
            $data['page'] = array('cur' => $page, 'prev' => $uppage, 'next' => $nextpage, 'total' => $totalpage);
            $post = array();
            while ($arr = $this->DB->fetch_array($query)) {
                array_push($post, array('id' => $arr['pid'], 'title' => $arr['title'], 'url' => $arr['url'], 'desc' => $arr['des'], 'date' => strftime("%Y-%m-%d", $arr['date']), 'tags' => $arr['tags']));
            }
            $data['post'] = $post;
        } elseif ($this->args['mode'] == "tag") {
            $tags = $_REQUEST['tags'];
            if (!$tags) {
                $sql = "SELECT tags FROM {$this->prefix}album WHERE tags <>''";
            } else {
                $sql = "SELECT tags FROM {$this->prefix}album WHERE tags LIKE '%{$tags}%'";
            }
            $exec = $this->DB->query($sql);
            while ($arr = $this->DB->fetch_array($exec)) {
                if ((!empty($arr['tags'])) && ($arr['tags'] != '')) {
                    $arr_tags[] = $arr['tags'];
                }
            }

            $arr_tags_times = array_count_values($arr_tags);
            $arr_tags = array_unique($arr_tags);

            while ($arr_tags_item = each($arr_tags)) {
                array_push($data, array('name' => $arr_tags_item['value'],
                    'times' => $arr_tags_times[$arr_tags_item['value']]
                ));
            }
        } elseif ($this->args['mode'] == "archive") {

            $action = $_REQUEST['archive'];
            if ($action == 'all') {
                $sql = "SELECT date,title,pid FROM {$this->prefix}album";

            } else {
                //TODO:这里语句有问题，数据库格式也有问题
                if (in_array($action, array(2011, 2012, 2013))) {
                    $sql = "SELECT date,title,pid FROM {$this->prefix}album WHERE date LIKE '%{$action}%'";
                } else {
                    $sql = "SELECT date,title,pid FROM {$this->prefix}album";
                }
            }

            $exec = $this->DB->query($sql);
            while ($arr = $this->DB->fetch_array($exec)) {
                if ((!empty($arr['date'])) && ($arr['date'] != '')) {
                    $arr_arch[] = $arr;
                }
            }

            $data = array();
            while ($arr_arch_item = each($arr_arch)) {
                array_push($data, array('name' => $arr_arch_item['value']['title'],
                    'date' => strftime("%Y-%m-%d", $arr_arch_item['value']['date']),
                    'id' => $arr_arch_item['value']['pid']
                ));
            }
        } elseif ($this->args['mode'] == "single") {

            $pid = $_REQUEST['id'];
            if (($pid == 0) || ($pid == '')) {
                $pid = 1;
            }
            $sql = "SELECT title,date,des,tags,url FROM {$this->prefix}album WHERE pid={$pid} ORDER BY pid DESC";
            $query = $this->DB->query($sql);

            while ($arr = $this->DB->fetch_array($query)) {
                array_push($data, array('title' => $arr['title'],
                    'date' => strftime("%Y-%m-%d", $arr['date']),
                    'url' => $arr['url'],
                    'desc' => $arr['des'],
                    'tags' => $arr['tags']
                ));
            }
        }

        $data['created'] = strftime("%Y-%m-%d %H:%M:%S", time());
        Core::ajax_echo($data);
    }

}