<?php
#This file generate the response image.
header ('Content-Type: image/png');
$im = @imagecreatetruecolor(600, 400);
$color = imagecolorallocate($im, 0, 255, 0);
$max=0;
$min=0;
$k=1;

if (empty($_GET))
{
	imagestring($im, 6, 260, 200,  'Grafiks', $color);
}
else
{
	$val = [
		"v1" => $_GET["v1"],
		"v2" => $_GET["v2"],
		"v3" => $_GET["v3"],
		"v4" => $_GET["v4"],
		"v5" => $_GET["v5"]
	];
	foreach ($val as &$n) {
		if(!is_numeric($n)) $n=0;
		if($n > $max)$max=$n;
		else if($n < $min) $min=$n;
	};
	unset($n);
	$lab = [
		"l1" => $_GET["l1"],
		"l2" => $_GET["l2"],
		"l3" => $_GET["l3"],
		"l4" => $_GET["l4"],
		"l5" => $_GET["l5"]
	];
	foreach  ($lab as &$n) {
		if (empty($n) && $n != "0") $n = "Bez varda";
	};
	unset($n);
	if($min < 0 && $max == 0)
	{
		imageline($im, 20, 100, 580, 100, $color);
		$max=$min;
		imagefilledrectangle($im, 60, 100, 140, 100+$val["v1"]*(250/$max), $color);
		imagefilledrectangle($im, 160, 100, 240, 100+$val["v2"]*(250/$max), $color);
		imagefilledrectangle($im, 260, 100, 340, 100+$val["v3"]*(250/$max), $color);
		imagefilledrectangle($im, 360, 100, 440, 100+$val["v4"]*(250/$max), $color);
		imagefilledrectangle($im, 460, 100, 540, 100+$val["v5"]*(250/$max), $color);
		imagestring($im, 6, 60, 80,  $lab["l1"], $color);
		imagestring($im, 6, 160, 80,  $lab["l2"], $color);
		imagestring($im, 6, 260, 80,  $lab["l3"], $color);
		imagestring($im, 6, 360, 80,  $lab["l4"], $color);
		imagestring($im, 6, 460, 80,  $lab["l5"], $color);
	}
	else if($min < 0)
	{
		if($min*-1>$max) $max=-1*$min;
		imageline($im, 20, 200, 580, 200, $color);
		imagefilledrectangle($im, 60, 200, 140, 200-$val["v1"]*(150/$max), $color);
		imagefilledrectangle($im, 160, 200, 240, 200-$val["v2"]*(150/$max), $color);
		imagefilledrectangle($im, 260, 200, 340, 200-$val["v3"]*(150/$max), $color);
		imagefilledrectangle($im, 360, 200, 440, 200-$val["v4"]*(150/$max), $color);
		imagefilledrectangle($im, 460, 200, 540, 200-$val["v5"]*(150/$max), $color);
		if($val["v1"] < 0) $k=-1;
		else $k=1;
		imagestring($im, 6, 60, 192+20*$k, $lab["l1"], $color);
		if($val["v2"] < 0) $k=-1;
		else $k=1;
		imagestring($im, 6, 160, 192+20*$k, $lab["l2"], $color);
		if($val["v3"] < 0) $k=-1;
		else $k=1;
		imagestring($im, 6, 260, 192+20*$k, $lab["l3"], $color);
		if($val["v4"] < 0) $k=-1;
		else $k=1;
		imagestring($im, 6, 360, 192+20*$k, $lab["l4"], $color);
		if($val["v5"] < 0) $k=-1;
		else $k=1;
		imagestring($im, 6, 460, 192+20*$k, $lab["l5"], $color);
	}
	else
	{	
		imageline($im, 20, 300, 580, 300, $color);
		if($max != 0)
		{
			imagefilledrectangle($im, 60, 300, 140, 300-$val["v1"]*(250/$max), $color);
			imagefilledrectangle($im, 160, 300, 240, 300-$val["v2"]*(250/$max), $color);
			imagefilledrectangle($im, 260, 300, 340, 300-$val["v3"]*(250/$max), $color);
			imagefilledrectangle($im, 360, 300, 440, 300-$val["v4"]*(250/$max), $color);
			imagefilledrectangle($im, 460, 300, 540, 300-$val["v5"]*(250/$max), $color);
		}
		imagestring($im, 6, 60, 320,  $lab["l1"], $color);
		imagestring($im, 6, 160, 320,  $lab["l2"], $color);
		imagestring($im, 6, 260, 320,  $lab["l3"], $color);
		imagestring($im, 6, 360, 320,  $lab["l4"], $color);
		imagestring($im, 6, 460, 320,  $lab["l5"], $color);
	}
}

imagepng($im);
imagedestroy($im)
?>