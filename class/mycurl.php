<?php
class mycurl {
	function __construct() {
	}
	
	function __destruct() {
	}
	
	function init($url) {
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__)."/tmp/cook.txt");
		curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__)."/tmp/cook.txt");
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:6.0.2) Gecko/20100101 Firefox/6.0.2");
		return $ch;
	}
	/**
	 * get only header infomation by curl
	 */
	function getHeaderByCurl($url, $param=array()) {
		$ch = $this->init($url);
		curl_setopt($ch, CURLOPT_NOBODY, TRUE);
		if (sizeof($param)>0) {
			curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
		}
		$ret = curl_exec($ch);
		curl_close($ch);
		return $ret;
	}
	/**
	 * get html infomation by curl
	 */
	function getStrByCurl($url, $param=array()) {
		$ch = $this->init($url);
		if (sizeof($param)>0) {
			curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
		}
		$ret = curl_exec($ch);
		curl_close($ch);
		return $ret;
	}
	
}
?>