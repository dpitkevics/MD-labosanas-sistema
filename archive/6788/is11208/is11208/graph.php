<?php

$data = array();
$max_value = 1;

for($i = 1; $i <= 5; $i++){
	$title = $_GET['label'.$i];
	$value = (int) $_GET['value'.$i];
	if(empty($title))
	$title = "Label ".$i;
	$data[$i] = array("title" => $title, "value" => $value);
	if($value > $max_value)
	$max_value = $value;
}

header("Content-type: image/jpeg");

$img = imagecreatetruecolor(600, 400);
imagefill($img, 0, 0, imagecolorallocate($img, 255, 255, 255));

$text_color = imagecolorallocate($img, 0, 0, 255);
$rect_color = imagecolorallocate($img, 171, 171, 171);
$line_color = imagecolorallocate($img, 0, 0, 0);

$from_left = 60;
$scale = 280 / $max_value;
		
for($i = 1; $i <= 5; $i++){
	$height = $data[$i]['value'] * $scale;
	imagefilledrectangle($img, $from_left, 300 - $height, $from_left + 80, 300, $rect_color);
	imagestring($img, 5, $from_left + 15, 350, $data[$i]['title'], $text_color);
	$from_left += 100;
}

imageline($img, 20, 300, 580, 300, $line_color);
imageline($img, 20, 301, 580, 301, $line_color);

imagejpeg($img);
imagedestroy($img);

?>
