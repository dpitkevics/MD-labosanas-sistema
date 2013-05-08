<?php

    $value = $_GET;
	$values[0]=$value["value1"];
	$values[1]=$value["value2"];
	$values[2]=$value["value3"];
	$values[3]=$value["value4"];
	$values[4]=$value["value5"];
	for($i=0;$i<5;$i++){
		if (false==is_numeric($values[$i])) $values[$i]=0;
	}
	$valued[0]=$value["label1"];
	$valued[1]=$value["label2"];
	$valued[2]=$value["label3"];
	$valued[3]=$value["label4"];
	$valued[4]=$value["label5"];
	for($i=0;$i<5;$i++){
		if ($valued[$i]=='') $valued[$i]='No Name';
	}
	$im        = imagecreate(600,400);
	$grey      = imagecolorallocate ($im,150,150,150);
    $grey_dark = imagecolorallocate ($im,50,50,50);
    $white     = imagecolorallocate ($im,255,255,255);
	imagefilledrectangle($im,0,0,600,400,$white);
	if (abs(max($values))+abs(min($values))!=0){
    $ratio=(280/(abs(max($values))+abs(min($values))));}
	else $ratio=280;
	for($i=0;$i<5;$i++){
		imagefilledrectangle($im,60+$i*100,300-$ratio*$values[$i],140+$i*100,300,$grey);
	}
	imagefilledrectangle($im,20,300,580,301,$grey_dark);
	for($i=0;$i<5;$i++){
		imagettftext($im,12,0,75+$i*100 ,360,$grey,'arial.ttf',$valued[$i]);
	}
	header ("Content-type: image/png"); 
	imagepng($im);
    
#This file should generate the response image.

?>