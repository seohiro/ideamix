<?php
class mycurl {
	private $curl_ch;
	
	function mycurl($url) {
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__)."/tmp/cook.txt");
		curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__)."/tmp/cook.txt");
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:6.0.2) Gecko/20100101 Firefox/6.0.2");
		$this->curl_ch = $ch;
	}
	/**
	 * curlを使ってURLからヘッダのみを抜いてくる
	 */
	function getHeaderByCurl($param=array()) {
		curl_setopt($this->curl_ch, CURLOPT_NOBODY, TRUE);
		if (sizeof($param)>0) {
			curl_setopt($this->curl_ch, CURLOPT_POSTFIELDS, $param);
		}
		$ret = curl_exec($this->curl_ch);
		curl_close($this->curl_ch);
		return $ret;
	}
	/**
	 * curlを使ってURLからコンテンツを抜いてくる
	 */
	function getStrByCurl($param=array()) {
		if (sizeof($param)>0) {
			curl_setopt($this->curl_ch, CURLOPT_POSTFIELDS, $param);
		}
		$ret = curl_exec($this->curl_ch);
		curl_close($this->curl_ch);
		return $ret;
	}
	
}
?>