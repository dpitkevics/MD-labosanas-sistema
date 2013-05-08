<?php
#This file should generate the response image. 

$width = 600;  
$height = 400;  
$image = imagecreate($width, $height);  


$data = array (
    $_GET["label1"] => intval($_GET["value1"]),
    $_GET["label2"] => intval($_GET["value2"]),
    $_GET["label3"] => intval($_GET["value3"]),
    $_GET["label4"] => intval($_GET["value4"]),
    $_GET["label5"] => intval($_GET["value5"])
);

$white = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);  
$black = imagecolorallocate($image, 0x00, 0x00, 0x00);  
$gray = imagecolorallocate($image, 0xC0, 0xC0, 0xC0);  

$bottommargin = 100;
$hmargin = 60; 

$bar_distance = 20; 
$bar_width=80;

$ysize = 300;   
$xsize = 480;  

$max_chars=0;
$max_value=0;

$data1=$data;

for (; list($label1, $value1) = each($data1);){
    if ($value1>=$max_value){
        $max_value=$value1;
    }
}

for ($i = 0; list($label, $value) = each($data); $i++) {  

    // vertical columns  
    $ymax = $ysize;  
    $ymin = (1-($value/$max_value)*0.9)*300;  
    $xmax = $hmargin + ($i+1)*$bar_width + $i*$bar_distance;  
    $xmin = $hmargin + $i*$bar_width+$i*$bar_distance;  

    imagefilledrectangle($image, $xmin, $ymin, $xmax, $ymax, $gray);  
   

    $xpos = ($xmin +40) - strlen($label)*9/2;   
    $ypos = $ymax + 40;  

    imagestring($image, 12, $xpos, $ypos, $label, $gray);     
 
}  

imageline($image, 20, 300, 580, 300, $black);

// flush image  
header("Content-type: image/gif");  
imagegif($image);  

?>