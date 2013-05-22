<?php
//getting arrays

$lbls = array();
$vals = array();

foreach ($_GET as $k => $val)
{
	$arr = substr($k, 0, -1);
	$key = substr($k, -1);
	if ($arr == 'l')
		array_push($lbls, $val);
	else
		array_push($vals, $val);
}

//geting max value
$maxval = 0;
foreach($vals as $v)
{
	$val = intval($v);
	$val > $maxval ? $maxval = $val : $maxval = $maxval;
}

//start drawing image
header ('Content-Type: image/png');
$im = @imagecreatetruecolor(600, 400) or die('Cannot Initialize new GD image stream');

//colors
$white = imagecolorallocate($im, 255, 255, 255);
$black = imagecolorallocate($im, 0, 0, 0);
$grey = imagecolorallocate($im, 205, 205, 205);

//fillingrectangle
imagefilledrectangle($im, 0, 0, 600, 400, $white);

//drawing aditionla data
if ($maxval != 0)
{
	//drawing base line
	imageline($im, 20, 300, 580, 300, $black);
	//drawing bars
	$msize = 280;
	$k = $msize / $maxval;
	
	for($i=0; $i<5; $i++)
	{
		$val = (double)$vals[$i];
		$psize = $val * $k;
		imagefilledrectangle($im, 60+100*$i, $msize-($psize-20), 140+100*$i, 299, $grey);
	}
	
	//drawing  text
	for ($i=0; $i<5; $i++)
	{
		$twidth = imagefontwidth(5) * strlen($lbls[$i]);
		$tcenter = 100+100*$i;
		$tpos = $tcenter - (ceil($twidth/2));
		
		imagestring($im, 5, $tpos, 350, $lbls[$i], $grey);
	}
}

imagepng($im);
imagedestroy($im);
?>