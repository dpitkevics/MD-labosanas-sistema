<?php
#This file should generate the response image.

$labels[]= ($_GET["label1"] ? $_GET["label1"] : "label1");
$labels[]= ($_GET["label2"] ? $_GET["label2"] : "label2");
$labels[]= ($_GET["label3"] ? $_GET["label3"] : "label3");
$labels[]= ($_GET["label4"] ? $_GET["label4"] : "label4");
$labels[]= ($_GET["label5"] ? $_GET["label5"] : "label5");


$values[]= is_numeric($_GET["value1"]) ? $_GET["value1"] : 0;
$values[]= is_numeric($_GET["value2"]) ? $_GET["value2"] : 0;
$values[]= is_numeric($_GET["value3"]) ? $_GET["value3"] : 0;
$values[]= is_numeric($_GET["value4"]) ? $_GET["value4"] : 0;
$values[]= is_numeric($_GET["value5"]) ? $_GET["value5"] : 0;
$max_value=max($values);

header ('Content-Type: image/png');
$im = @imagecreatetruecolor(600, 400)
      or die('Cannot Initialize new GD image stream');
$background_color = imagecolorallocate($im, 128, 181, 173);
$text_color = imagecolorallocate($im, 233, 14, 91);
$line_color = imagecolorallocate($im, 0, 0, 255);  // blue
$bar_color = imagecolorallocate($im, 100, 100, 100);
imagefilledrectangle ($im,   0,  0, 599, 399, $background_color);
imageline ($im,   20,  300, 559, 300, $line_color);
$x1=60; $bar_width=80; $bar_interval=100;
$max_height=250; $y2=299;
for ($i=0; $i<5; $i++) {
    $y1=$y2-intval($values[$i]/$max_value*$max_height);
    $x2=$x1+$bar_width;
    imagefilledrectangle($im, $x1, $y1, $x2, $y2, $bar_color);
    imagestring($im, 3, $x1, 310, $labels[$i], $text_color);
    $x1+=$bar_interval;
} 

imagepng($im);
imagedestroy($im);


?>
