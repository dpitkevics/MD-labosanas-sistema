<?php

header ('Content-Type: image/jpeg');
$img = imagecreate ( 600 , 400 );
$white = imagecolorallocate($img, 255, 255, 255);
$black = imagecolorallocate($img, 0, 0, 0);
$blue = imagecolorallocate($img, 0, 0, 100);



imageline($img, 20, 300, 580, 300, $black);

for ($i=1; $i<=5; $i++)
{
    imagestring($img, 12, 60+(($i-1)*100), 350,  $_GET["label$i"], $black);
}

$temp=1;
for ($i=1; $i<=5; $i++)
{
    $temp=$temp+$_GET["value$i"];
}
$x=300/$temp;

for ($i=1; $i<=5; $i++)
{
imagefilledrectangle($img, 60+(($i-1)*100), 300, 140+(($i-1)*100), 300-$x*$_GET["value$i"], $blue);
}

imagejpeg($img);
imagedestroy($img);

?>