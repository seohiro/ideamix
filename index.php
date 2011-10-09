<?php
require_once("class/mycurl.php");
require_once("class/simple_html_dom.php");
// wikipedia's randomize page
$url = "http://ja.wikipedia.org/wiki/%E7%89%B9%E5%88%A5:%E3%81%8A%E3%81%BE%E3%81%8B%E3%81%9B%E8%A1%A8%E7%A4%BA";
// How many display contents?
$displays_num = 4;

$curl = new mycurl();

// set url
while ($displays_num > 0) {
	$curl->setStrByCurl($url);
	$displays_num--;
}

// exec curl & get string (async)
$returns = $curl->exec();
$list = array();
// set data here
foreach ($returns as $c) {
	$html = str_get_html($c);
	$word = $html->find("h1#firstHeading", 0)->innertext;
	$wordurl = "http://ja.wikipedia.org/wiki/".$word;
	$desc = $html->find("#bodyContent p", 0);
	$image = $html->find("div.mw-content-ltr", 0);
	if ($image!="") $image = $image->find("a.image", 0);
	$list[] = array(
		"word" => $word,
		"wordurl" => $wordurl,
		"desc" => $desc,
		"image" => $image
	);
}
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
			
			<?php foreach ($list as $content) {?>
			<div class="wordbox span8">
				<span class="title">
					<a href="<?php echo $content["wordurl"];?>"><?php echo $content["word"];?></a>
					<?php echo $content["desc"];?>
					<?php echo $content["image"];?>
				</span>
			</div>
			<?php }?>
			
		</div>
	</div>
</body>
</html>