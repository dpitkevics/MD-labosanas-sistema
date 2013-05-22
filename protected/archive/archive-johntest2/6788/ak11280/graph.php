<?php
$total_bars = 5;
$image = @imagecreatetruecolor(600, 400);
$background_color_white = imagecolorallocate($image, 255, 255, 255);
$black_color = imagecolorallocate ($image, 0, 0, 0);
$grey_color = imagecolorallocate ($image, 191, 191, 191);
imagefilledrectangle($image, 0, 0, 600, 400, $background_color_white);
$value = array();
$label= array();
for($i=1 ; $i<=$total_bars; $i++){
    if(isset($_GET['value' . $i])){     
    $value[$i] = floatval($_GET['value' . $i]);            
    } else $value[$i] = 0;
    if(isset($_GET['label'. $i])){
    $label[$i] = $_GET['label' . $i];
    } else $label[$i] = 'label' . $i;  
}
$max_value = max($value);  
if ($max_value != 0) {
 $ratio = 260/$max_value;
} else $ratio = 0;
$margin = 60;
for($i=1; $i<=$total_bars; $i++)
{
    $height = $value[$i] * $ratio;
    imagefilledrectangle($image, $margin, 300 - $height, $margin + 80, 300, $grey_color);
    imagestring($image, 5, $margin + 12, 350, $label[$i], $grey_color);
    $margin=$margin+100;
}
imageline ($image, 20, 300, 580, 300, $black_color);
header ('Content-Type: image/png');
imagepng($image);
imagedestroy($image);
?>




