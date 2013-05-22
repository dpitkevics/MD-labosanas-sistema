<?php
header ('Content-Type: image/png');
$im = @imagecreatetruecolor(600, 400)
      or die('Cannot Initialize new GD image stream');

$labels = array();
$values = array();
$max = 0;

for ($i = 1; $i < 6; $i++) {
	$labels[] = $_GET["label$i"] == '' ? "<label$i>" : $_GET["label$i"]; // why does PHP cast logical operations to bool? why is "0" falsy? IIAM.
	$number = floatval($_GET["value$i"]); // this will return 0 on error anyway
	if ($number > $max)
		$max = $number;
	$values[] = $number;
}

$black = imagecolorallocate($im, 0x00, 0x00, 0x00);
$white = imagecolorallocate($im, 0xFF, 0xFF, 0xFF);
imagefilledrectangle($im, 0, 0, 600, 400, $white);
imageline($im, 20, 301, 580, 301, $black);

for ($i = 0; $i < 5; $i++) {
	imagestring($im, 2, 100*($i+1), 350, $labels[$i], $black); // I'm not even going to bother aligning the text.
	$height = $values[$i] * 300 / $max;
	imagefilledrectangle($im, 60+100*$i, 300-$height, 140+100*$i, 300, $black);
}

imagepng($im);
imagedestroy($im);
?>