<?php
header ('Content-Type: image/png');
$image = imagecreate ( 600 , 400 );
$white = imagecolorallocate($image, 255, 255, 255);
$grey = imagecolorallocate($image, 192, 192, 192);
$black = imagecolorallocate($image, 0, 0, 0);

//Labels
for ($i=1; $i<6; $i++) 
{
	imagestring($image, 12, 60+(($i-1)*100), 350,  $_GET["label$i"], $black);
}

//Line
	imageline($image, 20, 300, 580, 300, $grey);

//Bars
for ($i=1; $i<6; $i++) 
{
	imagefilledrectangle($image, 60+(($i-1)*100), 300, 140+(($i-1)*100), 300-$_GET["value$i"]*(270/$_GET['LargestValue']), $grey);
}
imagepng($image);
imagedestroy($image);
?>