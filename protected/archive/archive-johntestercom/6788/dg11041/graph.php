<?php
// Create image
$canvas = imagecreatetruecolor(600, 400);

// Create colors
$grey = imagecolorallocate($canvas, 204, 204, 204);
$lightgrey = imagecolorallocate($canvas, 206, 206, 206);
$black = imagecolorallocate($canvas, 0, 0, 0);
$white = imagecolorallocate($canvas, 255, 255, 255);
// Create font
$font = 'fonts/arialbd.ttf';

// Draw white background
imagefilledrectangle($canvas, 0, 0, 600, 400, $white);

// Draw graphic
imagefilledrectangle($canvas, 60, 300-$_GET['value1'], 140, 300, $grey);
imagefilledrectangle($canvas, 160, 300-$_GET['value2'], 240, 300, $grey);
imagefilledrectangle($canvas, 260, 300-$_GET['value3'], 340, 300, $grey);
imagefilledrectangle($canvas, 360, 300-$_GET['value4'], 440, 300, $grey);
imagefilledrectangle($canvas, 460, 300-$_GET['value5'], 540, 300, $grey);
//Draw line
imageline($canvas, 20, 300, 580, 300, $black);

//Draw labels
$right = 60;
for($i=1; $i<6; $i++)
{
	imagettftext($canvas, 12, 0, $right + 80 / (strlen($_GET['label'.$i]) > 0?strlen($_GET['label'.$i]):1), 350, $lightgrey, $font, $_GET['label'.$i]);
    $right=$right+100;
}

// Save the image
header('Content-Type: image/jpeg');

imagejpeg($canvas);

imagedestroy($canvas);

?>
