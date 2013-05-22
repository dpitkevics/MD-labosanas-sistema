<?php
header ('Content-Type: image/jpeg');
$picture = @imagecreatetruecolor(600, 400);
$legendtitle = array();
$value = array();

for($i=1 ; $i<6; $i++){
    if(isset($_GET['label'.$i]))
    $legendtitle[$i] = $_GET['label'.$i];
 else
 $legendtitle[$i] = 'label'.$i;
    if(isset($_GET['value'.$i]))
            $value[$i]=intval($_GET['value'.$i]);
            else $value[$i]=0;
}

$white = imagecolorallocate($picture, 255, 255, 255);
imagefilledrectangle ($picture, 600, 400, 0,0 ,$white);
$black = imagecolorallocate ($picture, 0, 0, 0);
imageline ($picture, 20, 300, 580, 300, $black);
imageline ($picture, 20, 301, 580, 301, $black);
imagefilledrectangle ($picture, 60, 300, 140,0 ,$white);

$max = 1;
for($i = 1; $i < 6; $i++){
if($value[$i] > $max)
$max = $value[$i];
}
$dal = 280 / $max;
$right=60;
for($i=1; $i<6; $i++)
{
	$height = $value[$i] * $dal;
	imagefilledrectangle($picture, $right, 300 - $height, $right + 80, 300, $black);
	 imagestring($picture, 5, $right + 80 / (strlen($legendtitle[$i]) > 0?strlen($legendtitle[$i]):1), 350, $legendtitle[$i], $black);
    $right=$right+100;
}
imagejpeg($picture);
imagedestroy($picture);
?>




