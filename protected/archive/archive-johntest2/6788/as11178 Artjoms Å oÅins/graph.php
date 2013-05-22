<?php
header('Content-Type: image/png');

$img = @imagecreatetruecolor(600, 400);
$fon = imagecolorallocate($img, 255, 255, 255);
imagefilledrectangle($img, 0, 0, 600, 400, $fon);


$as = array();
$sa = array();

for($i=1 ; $i<=5; $i++){
    if (empty($_GET['label'.($i)])) $as[$i] = "aLab_".($i); else $as[$i] = $_GET['label'.($i)];
    if (empty($_GET['value'.($i)])) $sa[$i] = 0; else $sa[$i] = $_GET['value'.($i)];
    if (!is_numeric($sa[$i])) $sa[$i] = 0;
}

$max_value = $sa[1];
for($i = 2; $i < 6; $i++){
if($sa[$i] > $max_value)
$max_value = $sa[$i];
}

 $shift = 60 ;
 
if ($max_value != 0)
 $ratio = 280/$max_value;
	else $ratio = 0;

 for($i = 1; $i <=5; $i++){
 $visota = $sa[$i] * $ratio;
 $black = imagecolorallocate($img, 0, 0, 0);
 imagefilledrectangle($img, $shift, 300 - $visota,  $shift + 80, 300, $black);
 imagestring($img, 5, $shift, 350, $as[$i], $black);
 $shift = $shift + 100;
}

imageline($img, 20, 300, 580, 300, $black);
imagejpeg($img);
imagedestroy($img);
