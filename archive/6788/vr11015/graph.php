<?php
#This file should generate the response image.

header ('Content-Type: image/png');
$im = @imagecreatetruecolor(600, 400)
	or die('Cannot Initialize new GD image stream');
$text_color = imagecolorallocate($im, 233, 14, 91);
$max = $_GET['value1'];
for($i=1; $i<=5; $i++)
{
	$_GET['value'.$i] = intval($_GET['value'.$i]);
	if($max < $_GET['value'.$i])
		$max = $_GET['value'.$i];
}
if ($max==0)
	$max=1;
for($i=1; $i<=5; $i++)
{
	$text = $_GET['label'.$i].'('.$_GET['value'.$i].')';
	$val = 50 + (1 - $_GET['value'.$i] / $max) * 250;
	imagestring($im, 4, $i*100-40, 350,  $text, $text_color);
	imagefilledrectangle($im, $i*100-40, $val, $i*100+40, 300, imagecolorallocate($im, rand(0, 255), rand(0, 255), rand(0, 255)));
}
imagefilledrectangle($im, 20, 300, 580, 302, imagecolorallocate($im, rand(0, 255), rand(0, 255), rand(0, 255)));
imagepng($im);
imagedestroy($im);