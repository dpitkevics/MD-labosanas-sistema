<?php
#This file should generate the response image.
header('Content-type: image/png');

$barHeight = 300;
$max=0;

$label1 = htmlspecialchars($_GET["label1"]);
$label2 = htmlspecialchars($_GET["label2"]);
$label3 = htmlspecialchars($_GET["label3"]);
$label4 = htmlspecialchars($_GET["label4"]);
$label5 = htmlspecialchars($_GET["label5"]);
$value1 = htmlspecialchars($_GET["value1"]);
$value2 = htmlspecialchars($_GET["value2"]);
$value3 = htmlspecialchars($_GET["value3"]);
$value4 = htmlspecialchars($_GET["value4"]);
$value5 = htmlspecialchars($_GET["value5"]);

if ($label1 == "") $label1 = 'Default label';
if ($label2 == "") $label2 = 'Default label';
if ($label3 == "") $label3 = 'Default label';
if ($label4 == "") $label4 = 'Default label';
if ($label5 == "") $label5 = 'Default label';
if ($value1 <0) $value1=0;
if ($value2 <0) $value2=0;
if ($value3 <0) $value3=0;
if ($value4 <0) $value4=0;
if ($value5 <0) $value5=0;


if (isset($value1))                 //search for the ratio
    {        
    $max = floatval($value1);		
        if ($value2 > $max) 
        {
            $max = floatval($value2);
        };
        if ($value3 > $max) 
        {
            $max = floatval($value3);
        };
        if ($value4 > $max) 
        {
            $max = floatval($value4);
        };
        if ($value5 > $max)
        {
            $max = floatval($value5);
        };

        if ($max!=0)
        {
            $ratio = floatval($barHeight / $max);
        } 
    };
                                       
                                    //drawing 
$x1=20; $y1=300; $x2=580; $y2=300; 
                        
$im = @imagecreatetruecolor(600, 400) or die('Cannot Initialize new GD image stream');
$bgColor = imagecolorallocate($im, 255, 255, 255);
imagefill($im, 0, 0, $bgColor);

$dark = imagecolorallocate($im, 0, 51, 51);                  
$light = imagecolorallocate($im, 183, 183, 183);                 

imagefilledrectangle ($im,   60,  300, 140, 300-$value1 * $ratio, $light);
imagestring($im, 3, 60, 350,  $label1, $light);

imagefilledrectangle ($im,   160,  300, 240, 300-$value2 * $ratio, $light);
imagestring($im, 3, 160, 350,  $label2, $light);

imagefilledrectangle ($im,   260,  300, 340, 300-$value3 * $ratio, $light);
imagestring($im, 3, 260, 350,  $label3, $light);

imagefilledrectangle ($im,   360,  300, 440, 300-$value4 * $ratio, $light);
imagestring($im, 3, 360, 350,  $label4, $light);

imagefilledrectangle ($im,   460,  300, 540, 300-$value5 * $ratio, $light);
imagestring($im, 3, 460, 350,  $label5, $light);

imageline($im, $x1, $y1, $x2, $y2, $dark);

imagepng($im);
imagedestroy($im);      

?>


