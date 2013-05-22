<?php

header ('Content-Type: image/png');

function stripslashes_array($array) 
{
   return is_array($array) ?
     array_map('stripslashes_array', $array) : stripslashes($array);
}
if (get_magic_quotes_gpc()) 
   $_GET = stripslashes_array($_GET);

if (!empty($_GET['blank'])) 
{
	$im = @imagecreatetruecolor(600, 400)
		or die('Cannot Initialize new GD image stream');
	$white = imagecolorallocate($im, 255, 255, 255);
	imagefilledrectangle($im, 0, 0, 600, 400, $white);
	imagepng($im);
	imagedestroy($im);
} 
else 
{
	$value = array();
	$label = array();
	for ($i=0; $i<5; $i++)
	{
		if (empty($_GET['val'.$i])) $value[$i] = 0; else $value[$i] = $_GET['val'.$i];
		if (empty($_GET['lab'.$i])) $label[$i] = "auto_".($i+1); else $label[$i] = $_GET['lab'.$i];
		if(!is_numeric($value[$i])) $value[$i] = 0;
	}
	
	$im = @imagecreatetruecolor(600, 400)
		or die('Cannot Initialize new GD image stream');
	$white = imagecolorallocate($im, 255, 255, 255);
	$black = imagecolorallocate($im, 0, 0, 0);
	$LightSlateGray = imagecolorallocate($im, 119, 136, 153);
	$SlateGrey = imagecolorallocate($im, 112, 128, 144);
	imagefilledrectangle($im, 0, 0, 600, 400, $white);
	imageline($im, 21, 301, 580, 301, $black);
	
	for($i=0; $i<5; $i++)
	{
		$a=70+100*$i;
		imagestring($im, 12, $a, 350, $label[$i], $LightSlateGray);
	};
	
	$max = 0;
	for($i=0; $i<5; $i++)
	{	
		if ($max<$value[$i]) $max=$value[$i];
	};
	
	if ($max != 0)
		$unit = 290/$max;
	
	for($i=0; $i<5; $i++)
	{
		if ($value[$i]>0)
		{
			$left_x = 60+100*$i;
			$left_y = 300-$unit*$value[$i];
			$right_x = $left_x+80;
			$right_y = 300;
			imagefilledrectangle($im, $left_x, $left_y, $right_x, $right_y, $SlateGrey);
		}
	};

	imagepng($im);
	imagedestroy($im);
}
?>