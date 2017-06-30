
<?php
header('Access-Control-Allow-Origin:*');
$aid = $_REQUEST['aid'];
$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, "www.bilibili.com/blackboard/player.html?aid={$aid}&page=1");
// curl_setopt ($ch, CURLOPT_REFERER, "http://www.bilibili.com/");
$res = curl_exec ($ch);
curl_close ($ch);

