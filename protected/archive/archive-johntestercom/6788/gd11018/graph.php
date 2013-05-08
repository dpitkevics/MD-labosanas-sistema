<?php
header ('Content-Type: image/png');
$im = @imagecreate(600, 400) or die("Cannot Initialize new GD image stream");
$background_color = imagecolorallocate($im, 255, 255, 255);
$stabi_color = imagecolorallocate($im, 192, 192, 192);

//linijas zimesana
imageline($im, 20, 300, 580, 300, $stabi_color);

//stabu zimesana
for ($i=1; $i<6; $i++) 
	{
		imagefilledrectangle($im, 60+(($i-1)*100), 300, 140+(($i-1)*100), 300-$_GET["value$i"]*(300/$_GET["max"]), $stabi_color);
	}

//vardu rakstisana
for ($i=1; $i<6; $i++) 
	{
		imagestring($im, 12, 60+(($i-1)*100), 350,  $_GET["label$i"], $stabi_color);
	}

	
imagepng($im);
imagedestroy($im);

?>


