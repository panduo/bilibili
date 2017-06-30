<?php


function get_sort($sort_arr){
	$html = '<ul class="dropdown-menu" style="filter:alpha(Opacity=80);-moz-opacity:0.7;opacity: 0.7;">';
	foreach ($sort_arr as $key => $value) {
		$html .= "<li><a href='javascript:;' v='{$key}'>{$value[1]}&emsp;⬇️ </a></li><li role='separator' class='divider'></li>";
	}
	$html .= '</ul>';
	return $html;
}



$sort_arr = [
	1=>['play','播放'],
	2=>['favorites','收藏'],
	3=>['review','评论']
];

$sort_html = get_sort($sort_arr);
