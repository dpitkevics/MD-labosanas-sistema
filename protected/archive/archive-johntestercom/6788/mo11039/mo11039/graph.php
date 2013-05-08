<?php
#This file should generate the response image.
header("Content-Type: image/png");

// Variable setup
$labels = array( null, null, null, null, null );
$values = array( null, null, null, null, null );

// Allow only existing numbers, that are above 0
if ( $_GET['value1'] && is_numeric($_GET['value1']) && $_GET['value1'] > 0 ) { $values[0] = floatval($_GET['value1']); }
if ( $_GET['value2'] && is_numeric($_GET['value2']) && $_GET['value2'] > 0 ) { $values[1] = floatval($_GET['value2']); }
if ( $_GET['value3'] && is_numeric($_GET['value3']) && $_GET['value3'] > 0 ) { $values[2] = floatval($_GET['value3']); }
if ( $_GET['value4'] && is_numeric($_GET['value4']) && $_GET['value4'] > 0 ) { $values[3] = floatval($_GET['value4']); }
if ( $_GET['value5'] && is_numeric($_GET['value5']) && $_GET['value5'] > 0 ) { $values[4] = floatval($_GET['value5']); }

if ($_GET['label1']) { $labels[0] = $_GET['label1']; }
if ($_GET['label2']) { $labels[1] = $_GET['label2']; }
if ($_GET['label3']) { $labels[2] = $_GET['label3']; }
if ($_GET['label4']) { $labels[3] = $_GET['label4']; }
if ($_GET['label5']) { $labels[4] = $_GET['label5']; }

// Image setup
$img = imagecreatetruecolor(600, 400);

$white		= imagecolorallocate($img, 255, 255, 255);
$black		= imagecolorallocate($img, 0, 0, 0);
$grey		= imagecolorallocate($img, 200, 200, 200);

imagefilledrectangle($img, 0, 0, 600, 400, $white); // Draws a white background
imageline($img , 20 , 300 , 580, 300, $black); // Draws the black line

// Function for creating centered text field
function imagettftextcentred($img, $size, $angle, $x, $y, $color, $font, $text)  { 
   $bbox = imagettfbbox ($size, $angle, $font, $text); 
   $text_width = $bbox[2] - $bbox[0];
   $x -= $text_width / 2; 
   imagettftext ($img, $size, $angle, $x, $y, $color, $font, $text); 
} 
// Draw text
for ($i=0; $i<5; $i++) { imagettftextcentred($img, 12, 0, 100+($i*100), 350, $grey, 'arial.ttf', $labels[$i]); }

// Draw bars
$max = 0;
for ($i = 0; $i<5; $i++){ if ($values[$i]>$max) $max = $values[$i]; }
if ($max==0) $max=1;
$section = 250/$max;
for ($i=0; $i<5; $i++) { imagefilledrectangle($img, 60+($i*100), 300, 140+($i*100), 300-$section*$values[$i], $grey); }

imagepng($img);
imagedestroy($img);
?>