<?php
class mycurl {
	public $multi_handle;
	function __construct() {
		$this->multi_handle = curl_multi_init();
	}
	
	function __destruct() {
		curl_multi_close($this->multi_handle);
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
	function setHeaderByCurl($url, $param=array()) {
		$ch = $this->init($url);
		curl_setopt($ch, CURLOPT_NOBODY, TRUE);
		if (sizeof($param)>0) {
			curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
		}
		curl_multi_add_handle($this->multi_handle, $ch);
		return true;
	}
	/**
	 * get html infomation by curl
	 */
	function setStrByCurl($url, $param=array()) {
		$ch = $this->init($url);
		if (sizeof($param)>0) {
			curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
		}
		curl_multi_add_handle($this->multi_handle, $ch);
		return true;
	}
	
	/*
	 * exec
	 */
	function exec() {
		$running = null;
		$contents = array();
		// exec handler
		do {
			curl_multi_exec($this->multi_handle, $running);
		} while($running > 0);
		
		// read data
		while ($info = curl_multi_info_read($this->multi_handle)) {
			$ch = $info['handle'];
			$contents[] = curl_multi_getcontent($ch);
			curl_multi_remove_handle($this->multi_handle, $ch);
		}
		return $contents;
	}
}
?>