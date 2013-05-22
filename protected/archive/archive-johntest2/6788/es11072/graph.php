<?php
header('Content-type: image/png');
$picture = @imagecreatetruecolor(600, 400);
$legend_title = array();
$value_check = false;
$background = imagecolorallocate($picture, 255, 255, 255); 
$columns = imagecolorallocate($picture, 198, 198, 198); 
$textcolor = imagecolorallocate($picture, 0, 0, 255);

if (isset($_GET) && array_key_exists('label1', $_GET)) {
	$legend_title = Array($_GET['label1'], $_GET['label2'], $_GET['label3'], $_GET['label4'],$_GET['label5']);
	$value = Array($_GET['value1'], $_GET['value2'], $_GET['value3'], $_GET['value4'],$_GET['value5']);
	imagefilledrectangle($picture, 0, 0, 600, 400, $background);
	$maksimum =  max($value);
	$ratio = 300 / $maksimum;
	for ($i = 0; $i < 5; $i++){
		imagefilledrectangle($picture, (40+20*($i+1)+80*$i), 300, (40+100*($i+1)), 300-$value[$i]*$ratio, $columns);
		imagestring($picture, 4, 67+100*$i, 350, $legend_title[$i], $textcolor);
	}
}
else $blankSrc="http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";
/*
if (isset($_GET) && array_key_exists('label1', $_GET)) {
	$legend_title = Array($_GET['label1'], $_GET['label2'], $_GET['label3'], $_GET['label4'],$_GET['label5']);
	$value = Array($_GET['value1'], $_GET['value2'], $_GET['value3'], $_GET['value4'],$_GET['value5']);

	$maksimum =  max($value);
	$ratio = 300 / $maksimum;
	imagefilledrectangle($picture, 0, 0, 600, 400, $background);
	for ($i = 0; i < 5; i++){
		imagefilledrectangle($picture, (40+20*($i+1)+80*$i), 300, (40+100*($i+1)), 300-$value[$i]*$ratio, $columns);
	}
} */
imagepng($picture);
imagedestroy($picture);
/*
} else {
	$blankSrc="http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";
}*/
