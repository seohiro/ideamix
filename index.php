<?php
require_once("class/mycurl.php");
require_once("class/simple_html_dom.php");
// wikipedia's randomize page
$url = "http://ja.wikipedia.org/wiki/%E7%89%B9%E5%88%A5:%E3%81%8A%E3%81%BE%E3%81%8B%E3%81%9B%E8%A1%A8%E7%A4%BA";
$curl = new mycurl();
$c = $curl->getStrByCurl($url);
$html = str_get_html($c);
$word1 = $html->find("h1#firstHeading", 0)->innertext;
$desc1 = $html->find("#bodyContent p", 0);
$image1 = $html->find("div.mw-content-ltr", 0);
if ($image1!="") $image1 = $image1->find("a.image", 0);
$word1url = "http://ja.wikipedia.org/wiki/".$word1;

$c2 = $curl->getStrByCurl($url);
$html2 = str_get_html($c2);
$word2 = $html2->find("h1#firstHeading",0)->innertext;
$desc2 = $html2->find("#bodyContent p", 0);
$image2 = $html2->find("div.mw-content-ltr", 0);
if ($image2!="") $image2 = $image2->find("a.image", 0);
$word2url = "http://ja.wikipedia.org/wiki/".$word2;
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>idea mix</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
</head>
<body>
	<div id="main">
		<div class="btns row">
			<button class="btn" onclick="location.reload();">Reload</button>
		</div>
		
		
		<div id="wordsbox" class="row">
			<div class="wordbox span8">
				<span class="title">
					<a href="<?php echo $word1url;?>"><?php echo $word1;?></a>
					<?php echo $desc1;?>
					<?php echo $image1;?>
				</span>
			</div>
			
			<div class="wordbox span8">
				<span class="title">
					<a href="<?php echo $word2url;?>"><?php echo $word2;?></a>
					<?php echo $desc2;?>
					<?php echo $image2;?>
				</span>
			</div>
		</div>
	</div>
</body>
</html>