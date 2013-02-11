<?php

header ('Content-Type: image/png');

$value = array();
$label = array();

for ($i=0; $i<5; $i++) {
	if (empty($_GET['val'.$i])) $value[$i] = 0; else $value[$i] = $_GET['val'.$i];
	if (empty($_GET['lab'.$i])) $label[$i] = 'label_'.$i; else $label[$i] = $_GET['lab'.$i];
}
	
	for ($i=0; $i<5; $i++) {
		if (!is_numeric($value[$i]))
			$value[$i] = 0;
	};
	
	
	$image = @imagecreatetruecolor(600, 400)
		or die('ERROR');
	$white = imagecolorallocate($image, 255, 255, 255);
	$black = imagecolorallocate($image, 0, 0, 0);
	$HotPink = imagecolorallocate($image, 255, 105, 180);
	$DeepPink = imagecolorallocate($image, 255, 20, 147);
	imagefilledrectangle($image, 0, 0, 600, 400, $white);
	imageline($image, 21, 301, 580, 301, $black);
	for($i=0; $i<5; $i++) {
		imagestring($image, 12, (70+100*$i), 350, $label[$i], $HotPink);
	};
	
	$maxValue = 0;
	for($i=0; $i<5; $i++) {	
		if ($maxValue<$value[$i]) $maxValue=$value[$i];
	};
	
	if ($maxValue != 0)
		$scale = 290/$maxValue;
	
	for($i=0; $i<5; $i++) {
		if ($value[$i]>0) {
			$left_top_x = 60+100*$i;
			$left_top_y = 300-$scale*$value[$i];
			$right_bot_x = $left_top_x+80;
			$right_bot_y = 300;
			imagefilledrectangle($image, $left_top_x, $left_top_y, $right_bot_x, $right_bot_y, $DeepPink);
		}
	};

	imagepng($image);
	imagedestroy($image);
?>