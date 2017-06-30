<?php
header('Content-Type: text/html; charset=utf-8');
error_reporting(0);
require_once('show/page.php');
require_once('show/cate.php');
if(!$con)
	$con = require_once('show/db.php');
require_once('show/sort.php');

$page = intval(isset($_REQUEST['page'])) ? intval($_REQUEST['page']) : 1;
$cate = intval(isset($_REQUEST['cate'])) ? intval($_REQUEST['cate']) : 0;
$sort = intval(isset($_REQUEST['sort'])) ? intval($_REQUEST['sort']) : 1;
$sort_info = array_key_exists($sort, $sort_arr) ? $sort_arr[$sort] : $sort_arr[1];

$size = 20;
$start = ($page-1) * $size;

$cates = $con->query("select * from bili_cate where b_cate_id is not null")->fetchAll();
// var_dump($cates);exit;
if(!$cate) $cate = $cates[0]['b_cate_id'];
$cates = array_reduce($cates, function($v,$i){$v[$i['b_cate_id']]=$i['name'];return $v;});
//array_column($cates,'name')
// $cates = array_reduce($cates, create_function('$v,$w', '$v[$w["id"]]=$w["name"];return $v;'));
$catename = $cates[$cate];
$p_catename = get_parent_cate($all_cates,$cate);
$nav_cate = get_nav_cate($g_cates,$p_catename);
// var_dump($p_catename);exit;
// var_dump($cates);
$sql = "select * from videos where b_cate_id = {$cate} order by cast({$sort_info[0]} as DECIMAL(9,2)) desc limit {$start},{$size}";

$list = $con->query($sql)->fetchAll();
foreach ($list as $key => &$value) {
	$value['aid'] = substr($value['url'],strpos($value['url'], 'video/av')+8);
}
$count = $con->query("select count(1) from videos where b_cate_id = {$cate}")->fetch();
$count = $count[0];
$page = getPage($count,$page,$size);

require_once("show/list.php");