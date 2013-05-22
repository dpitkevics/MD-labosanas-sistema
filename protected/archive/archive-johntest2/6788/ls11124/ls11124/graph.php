<?php
#This file should generate the response image.
header ('Content-Type: image/png');
$im = imagecreate(600, 400);
$bg = imagecolorallocate($im, 255, 255, 255);
$textcolor = imagecolorallocate($im, 0, 0, 255);
$value=array ();
$max = '';
for ($a=1; $a<=5; $a++)
{
	if (isset ($_GET["label".$a]) && $_GET["label".$a]!="" && is_string($_GET["label".$a]))
	{
		$label=$_GET["label".$a];
		imagestring($im, 5, $a*100-40, 350, $label, $textcolor);
	}
	if (isset ( $_GET["value".$a]) && $_GET["value".$a]!="" && is_numeric ($_GET["value".$a]))
	{
		if($max == "")
			$max= $_GET ["value".$a];
		$value[$a]=$_GET["value".$a];
		if ($max< $value[$a])
			$max=$value[$a];
	}
}
if($max != "")
{
	if ($max==0)
	{
		$max=1;
	}
	for($a=1; $a<=5; $a++)
	{
		if (isset ($value[$a]) && $value[$a]!="")
		{	
		$y= 300-((285* intval($value[$a]))/$max);
		imagefilledrectangle($im, $a*100-40, $y, $a*100+40, 300, imagecolorallocate ($im, rand(0,255), rand(0,255), rand(0,255)));
		//x1, y1, x2, y2
		}
	}
}
imagepng($im);
imagedestroy($im);
