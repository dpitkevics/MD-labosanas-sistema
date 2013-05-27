<?php

header ("content-type: image/jpeg");
$Pic = imagecreatetruecolor (600,400);
$black = imagecolorallocate ($Pic, 255, 255, 255);
imagefilledrectangle ($Pic, 0, 0, 600, 400, $black);
$black = imagecolorallocate($Pic, 0, 0, 0);
imageline($Pic, 20, 300, 580, 300, $black);
imageline($Pic, 20, 301, 580, 301, $black);

$value = array();
$title = array();
$max_v = 0;

for($i = 1; $i <= 5; $i++){
	
if(isset($_GET['value'.$i])){
$value[$i] = $_GET['value'.$i];
}
	else $value[$i] = '0';
        
if(isset($_GET['title'.$i])){
$title[$i] = $_GET['title'.$i];
}
	else $title[$i] = 'title '.$i;
	
if($max_v < $value[$i]){
$max_v = $value[$i];
}
}

$right = 60;
if($max_v > 0){
$int = 280 / $max_v;
}
else $int = 1;

for($i = 1; $i <= 5; $i++){
	
$height = $value[$i] * $int;
imagestring($Pic, 6, $right+20, 350, $title[$i], $black);
imagefilledrectangle($Pic, $right, 300, $right+80, 300-$height, $black);
$right = $right + 100;
}

imagejpeg($Pic);
imagedestroy($Pic);
?>