<?php
header('Content-Type: image/jpeg');
$image = @imagecreatetruecolor(600, 400);
$background = imagecolorallocate($image, 255, 255, 255);
imagefilledrectangle($image, 0, 0, 600, 400, $background);
$black = imagecolorallocate($image, 0, 0, 0);
imageline ($image, 20, 300, 580, 300, $black);

$arr_value['max'] = 1;
for ($i = 1;  $i < 6; $i++)
{
         if(isset($_GET['label'.$i])) $arr_label[$i] = $_GET['label'.$i];
         else $arr_label[$i] = "Label ".$i;
         if(isset($_GET['value'.$i])) $arr_value[$i] = $_GET['value'.$i];
         else $arr_value[$i] = 0;
         if ($arr_value['max'] < $arr_value[$i]) $arr_value['max'] = $arr_value[$i];
}

$ratio = 280/$arr_value['max'];
$space = 60;
for ($i = 1;  $i < 6; $i++)
{
    $height = $ratio * $arr_value[$i];
    imagefilledrectangle($image, $space, 300 - $height, $space + 80, 300, $black);
    imagestring($image, 5, $space, 350, $arr_label[$i], $black);
    $space=$space+100;
}
imagejpeg($image);
imagedestroy($image);
?>
