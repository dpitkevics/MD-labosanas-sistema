<?php
#This file should generate the response image.
header ('Content-Type: image/jpeg');
$gpic=imagecreate (600,400);
$black=imagecolorallocate ($gpic,0,0,0);
$white=imagecolorallocate ($gpic,255,255,255);
imagefill ($gpic,0,0,$white);
imageline ($gpic,20,300,580,300,$black);
$max=0;
for ($i=1;$i<6;$i++)
{
	$v="value".$i;
	if ($_GET[$v]>$max && is_numeric($_GET[$v]))
		$max=intval($_GET[$v]);
}
if ($max==0)
	$max=1;
for ($z=1;$z<6;$z++)
{
	$v="value".$z;
	if (is_numeric($_GET[$v])==false || $_GET[$v]=="") 
	{
		$vertiba=0;
	}
	else $vertiba=$_GET[$v];
	$x=60+($z-1)*100;
	$att=($vertiba/$max);
	$y=300-($att*300);
	$xs=40+($z*100);
	imagefilledrectangle ($gpic, $x, $y, $xs, 300, $black);
	$l="label".$z;
	if (is_string($_GET[$l])==false || $_GET[$l]=="")
		$label="Nosaukums".$z;
	else 
		$label=$_GET[$l];
	imagestring ($gpic,5,$x,350,$label,$black);
}
imagejpeg($gpic);
imagedestroy($gpic);
?>