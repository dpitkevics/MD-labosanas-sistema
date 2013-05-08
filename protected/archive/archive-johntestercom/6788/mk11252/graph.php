<?php
$graph_height = 400;
$graph_width = 600;
$img = @imagecreatetruecolor($graph_width, $graph_height) or die('Cannot Initialize new GD image stream');

$color = imagecolorallocate($img, 255, 120, 100);

imageline($img, 5, 300, 580, 300, $color);

for ($i=1; $i <= 5; $i++) 
{
	imagestring($img, 14, 70+(($i-1)*100), 350,  $_GET["label".$i], $color);
}

for ($i=1; $i <= 5; $i++)
{
	imagefilledrectangle($img, 60+(($i-1)*100), 300, 140+(($i-1)*100), 300-$_GET["value".$i]*$_GET["scaler"], $color);
}

header ('Content-Type: image/png');
imagepng($img);
imagedestroy($img);
?>