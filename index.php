<?php
$url = "http://ja.wikipedia.org/wiki/%E7%89%B9%E5%88%A5:%E3%81%8A%E3%81%BE%E3%81%8B%E3%81%9B%E8%A1%A8%E7%A4%BA";
$c = getHeaderByCurl($url);
print_r($c);
/**
 * curlを使ってURLからヘッダのみを抜いてくる
 */
function getHeaderByCurl($url, $param=array()) {
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_NOBODY, TRUE);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__)."/tmp/cook.txt");
	curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__)."/tmp/cook.txt");
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:6.0.2) Gecko/20100101 Firefox/6.0.2");
	if (sizeof($param)>0) {
		curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
	}
	$ret = curl_exec($ch);
	curl_close($ch);
	return $ret;
}
/**
 * curlを使ってURLからコンテンツを抜いてくる
 */
function getStrByCurl($url, $param=array()) {
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__)."/tmp/cook.txt");
	curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__)."/tmp/cook.txt");
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:6.0.2) Gecko/20100101 Firefox/6.0.2");
	if (sizeof($param)>0) {
		curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
	}
	$ret = curl_exec($ch);
	curl_close($ch);
	return $ret;
}

?>