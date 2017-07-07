<?php

$con = require_once('./show/db.php');
error_reporting(E_ALL);
$all_cates = $con->query("select c.*,count(*) as count from bili_cate as c left join videos as v on c.b_cate_id = v.b_cate_id group by c.id")->fetchAll();

function get_parent_cate($all_cates,$cate_id){
	foreach ($all_cates as $key => $value) {
		if($value['b_cate_id'] == $cate_id){
			$pid = $value['pid'];
			break;
		}
	}

	foreach ($all_cates as $key => $value) {
		if($value['id'] == $pid){
			return $value['name'];
		}
	}
}

function get_cate_tree_generate($cates,$level=1,$pid=0){
	foreach ($cates as $key => $value) {
		$tmp = ['id'=>$value['id'],'pid'=>$value['pid'],'name'=>$value['name'],'b_cate_id'=>$value['b_cate_id']];
		if($tmp['pid'] == $pid){
			$tmp['level'] = $level;
			$tmp['_child'] = get_cate_tree_generate($cates,$level+1,$tmp['id']);
			$arr []= $tmp;
		}
	}
	
	return isset($arr) ? $arr : [];
}

function get_cate_tree_flow($cates,$level=1,$pid=0){
	$arr = [];
	$count = 0;
	foreach ($cates as $key => $value) {
		$tmp = ['id'=>$value['id'],'pid'=>$value['pid'],'name'=>$value['name'],'count'=>$value['count'],'b_cate_id'=>$value['b_cate_id']];
		if($tmp['pid'] == $pid){
			$count += $value['count'];
			$tmp['level'] = $level;
			$arr []= $tmp;
			$child = get_cate_tree_flow($cates,$level+1,$tmp['id']);
			
			if($child) $arr = array_merge($arr,$child);
		}
	}
	
	return $arr;
}

function get_select_tree($cates){
	$html = '<select>';
	foreach ($cates as $key => $value) {
		$name = str_repeat("&emsp;&emsp;",$value['level']-1).$value['name'];
		$html .= "<option value='{$value['id']}'>{$name}({$value['count']})</option>";
	}
	$html .= '</select>';
	return $html;
}

function get_nav_cate($cates,$p_catename = '',$cate_id = 0){
	$html = '<div class="btn-group" role="group" aria-label="...">';
	foreach ($cates as $key => $value) {
		if(!$value['_child']) continue;
		$class = $p_catename == $value['name'] ? 'btn-info' : 'btn-default';
		$h = '<div class="btn-group" role="group"><button type="button" class="btn '.$class.' dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$value['name'].($value['_child'] ? '<span class="caret"></span>' : '').'</button>';
		if($value['_child']){
			$h .= '<ul class="dropdown-menu">';
			foreach ($value['_child'] as $k => $v) {
				$c_class = $cate_id == $v['b_cate_id'] ? 'c_selected' : '';
				$h .= "<li><a class='{$c_class}' href='index.php?cate={$v['b_cate_id']}'>{$v['name']}</a></li>";
			}
			$h .= '</ul>';
		}
		$h.='</div>';
    	$html .= $h;
	}
	$html .= '</div>';
	return $html;
}
$g_cates = get_cate_tree_generate($all_cates);



