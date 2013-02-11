<?php

$labels=array(
	$_GET["label1"],
	$_GET["label2"],
	$_GET["label3"],
	$_GET["label4"],
	$_GET["label5"]
);

$values=array(
	intval($_GET["value1"]),
	intval($_GET["value2"]),
	intval($_GET["value3"]),
	intval($_GET["value4"]),
	intval($_GET["value5"]),
);

header("Content-Type: image/png");
$img = @imagecreate(600, 400);
imagecolorallocate($img, 255, 255, 255);
$bar_color=imagecolorallocate($img, 205, 205, 205);
$line_color = imagecolorallocate($img, 127, 127, 127);
$text_color = imagecolorallocate($img, 205, 205, 205);

$bar_width=80;
$gap=20;
$max_value=max($values);
$graph_height=300;
$ratio= $graph_height/$max_value;

imageline ($img, 20, 300, 580, 300, $line_color);
imageline ($img, 20, 301, 580, 301, $line_color);

for($i=0;$i< 5; $i++){ 
	list($key,$value)=each($values); 
	$x1= 40+$gap + $i * ($gap+$bar_width) ;
	$x2= $x1 + $bar_width; 
	$y1=$graph_height - ($value * $ratio) ;
	$y2=$graph_height-1;
	if($value > 0 && is_int($value)) imagefilledrectangle($img, $x1, $y1, $x2, $y2, $bar_color);
	else continue;	
}

for($i=0, $v=1; $i< 5; $i++, $v++){
	list($key,$value)=each($labels);
	$x1= 40+$gap + $i * ($gap+$bar_width) ;
	if($value == NULL) $value = "label" . $v;
	imagestring($img, 5, $x1+15, 350, $value, $text_color);
}

imagepng($img);
imagedestroy($img);

?>