<?php

header ('Content-Type: image/jpeg');
$bilde = imagecreate ( 600 , 400 );
$balts = imagecolorallocate($bilde, 255, 255, 255);
$melns = imagecolorallocate($bilde, 0, 0, 0);
# kolonnu nosaukumu izveide
for ($i=1; $i<6; $i++) {
imagestring($bilde, 12, 60+(($i-1)*100), 350,  $_GET["label$i"], $melns);}
# lоnija
imageline($bilde, 20, 300, 580, 300, $melns);
# kolonnu zоmзрana
for ($i=1; $i<6; $i++) {
imagefilledrectangle($bilde, 60+(($i-1)*100), 300, 140+(($i-1)*100), 300-$_GET["value$i"]*(300/$_GET["max"]), $melns);

}
imagejpeg($bilde);
imagedestroy($bilde);
?>