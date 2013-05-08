<?php
header ('Content-Type: image/jpeg');
$image = @imagecreatetruecolor(600, 400);
$label=array();
$value=array();

for($i=1 ; $i<=5; $i++){
    if(isset($_GET['label'.$i])|| is_string($_GET['label'.$i]))
    $label[$i] = $_GET['label'.$i];
    else $label[$i]='';
    if(isset($_GET['value'.$i]) || is_numeric($_GET['value'.$i]))
    $value[$i]= intval($_GET['value'.$i]);
    else $value[$i]='0';
}

$maximal = 1;
for($i = 1; $i <=5; $i++){
if($value[$i] > $maximal)
$maximal = $value[$i];
}

if ($maximal != 0)
$parts=290/$maximal;

$rborder=60;

$white = imagecolorallocate($image, 255, 255, 255);
$grey = imagecolorallocate ($image, 84, 84, 84);
$black = imagecolorallocate ($image, 0, 0, 0);
imagefilledrectangle ($image, 600, 400, 0,0 ,$white);
imagefilledrectangle ($image, 60, 300, 140,0 ,$white);
imageline ($image, 20, 300, 580, 300, $black);

for($i=1; $i<=5; $i++)
{
    $graf=$value[$i] * $parts;
    imagefilledrectangle($image, $rborder, 300 - $graf, $rborder + 80, 300, $grey);
    imagestring($image, 5, $rborder, 350, $label[$i], $black);
    $rborder=$rborder+100;
}
imagejpeg($image);
imagedestroy($image);
?>

