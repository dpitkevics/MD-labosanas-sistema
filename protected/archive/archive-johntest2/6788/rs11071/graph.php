<?php
header('Content-Type: image/png');


$attelaaugstums = 400;
$attelaplatums = 600;
$malas = 20;
$grafikaaugstums = 300;
$grafikaplatums = 560;
$stabinaplatums = 80;
$atstarpe = 20;

$vertibas = array();
for ($i = 0; $i < 5; $i++) 
	{
		$legenda = 'legenda' . $i;
		$vertiba = 'vertiba' . $i;
		if (isset($_GET[$legenda]) && isset($_GET[$vertiba])) 
			{
				$vertibas[$_GET[$legenda]] = $_GET[$vertiba];
			}
	};

$max = 'vertiba0';
$min = 'vertiba0';
for($i = 0; $i < 5; $i++)
	{
		$vertiba = "vertiba" . $i;
		if($vertiba > $max)
			$max = $vertiba;
		else
			if($vertiba < $min)
				$min = $vertiba;
	};
$ratio = 1;
$image = imagecreate($attelaplatums, $attelaaugstums);
x1 = 60;
x2 = 140;
y1 = 100;
y2 = 400;
$gray = imagecolorallocate($img, 190, 190, 190);
for($i = 0; $i < 5; $i++)
{
	$vertiba = 'vertiba' . $i;
	if($vertiba != $max)
		{
			$ratio = $max / $vertiba;
			$y2 = 400 / $ratio;
		}
	imagefilledrectangle($image, $x1, $y1, $x2, $y2, $grey);
	$x1 = $x1 + 100;
	$x2 = $x2 + 100;
};

 imagepng($image);
 imagedestroy($image);
				
	

?>