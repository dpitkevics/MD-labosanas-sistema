<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
#This file should generate the response image.
//create image
$img = imagecreatetruecolor(600, 400);
//define colors
$black = imagecolorallocate($img, 0, 0, 0); 
$orange = imagecolorallocate($img, 255, 140, 0);
$white = imagecolorallocate($img, 255, 255, 255);
//set image background
imagefill($img, 0, 0, $white);
//define font
$font = './ARIAL.TTF';
//load values into array
$labels	= array();
$values = array();
$max=0;

for($i=1;$i<6;$i++){
	$l="label".$i;
	if(isset($_GET[$l]) && is_string($_GET[$l]) && !empty($_GET[$l]))
		$labels[] = $_GET[$l];
	else
		$labels[] = $l;

	$v="value".$i;
	if(isset($_GET[$v]) && is_numeric($_GET[$v]) && !empty($_GET[$v]) && (int)$_GET[$v]>=0){
		//in this case values cannot be negative
		$values[] = $_GET[$v];
		if((int)$_GET[$v]>$max) $max=(int)$_GET[$v];
	}else
		$values[] = 0;
}
if($max!=0)
	$ratio=280/$max;
else
	$ratio=0; 
for($i=0;$i<sizeof($labels);$i++){

	$bbox = imagettfbbox(12, 0, $font, $labels[$i]);
	$x = 60+40+($i*100)-($bbox[2]-$bbox[0])/2;
	$y = 350;

	imagettftext($img, 12, 0, $x, $y, $black, $font, $labels[$i]);

	imagefilledrectangle($img, 60+($i*100), 300, 60+($i*100)+80, 300-($values[$i]*$ratio), $orange);

}

//draw line between chart and labels
imageline( $img, 20, 300, 580, 300, $black );

header( 'Content-type: image/png' );
imagepng( $img );
imagecolordeallocate( $line );
imagecolordeallocate( $background );
imagedestroy( $img );

