<?php
ini_set("display_errors", 1);
require_once("class/mycurl.php");
require_once("class/simple_html_dom.php");
// wikipediaのランダム表示ページをセット
$url = "http://ja.wikipedia.org/wiki/%E7%89%B9%E5%88%A5:%E3%81%8A%E3%81%BE%E3%81%8B%E3%81%9B%E8%A1%A8%E7%A4%BA";
$curl = new mycurl($url);
$c = $curl->getStrByCurl();
$html = str_get_html($c);
echo $html->find("title",0);




?>