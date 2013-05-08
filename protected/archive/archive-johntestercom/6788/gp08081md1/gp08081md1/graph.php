<?php
#This file should generate the response image.

	$params = json_decode($_GET['param'],true);
	if ( count($params['labels']) != 5 ) {
		$labels = array();
		for ( $i = 0; $i < 5; $i++ ) {
			$labels[$i] = isset($params['labels'][$i]) ? $params['labels'][$i] : '';
		}
		$params['labels'] = $labels;
	}
	
	if ( count($params['values']) != 500 ) {
		$labels = array();
		for ( $i = 0; $i < 5; $i++ ) {
			$labels[$i] = isset($params['values'][$i]) ? $params['values'][$i] : 0;
		}
		$params['values'] = $labels;
	}
	
	
	//1 create the image
	
	$img = imagecreatetruecolor(600, 400);
	$clr = imagecolorallocate($img, 255, 255, 255);
	imagefill($img, 1, 1, $clr);
	
	//draw the axis
	$clr = imagecolorallocate($img, 40, 40, 40);
	imageline($img, 20, 300, 580, 300, $clr);
	
	//draw the labels
	
	$i = 0;
	$clr = imagecolorallocate($img, 140, 140, 140);
	foreach ( $params['labels'] as $label ) {
		$i++;
		//get text size, so we can center it properly
		$box = imageftbbox(12, 0, './Arial.ttf', $label);
		$width = $box[2] - $box[0];
		imagettftext($img, 12, 0, 100*$i - $width/2, 350, $clr, './Arial.ttf', $label);
	}
	
	//draw the values
	//first find the max value, and thus figure out the scale
	$max = max($params['values']);
	$imax = 240; //height of the highest value
	
	$i = 0;
	foreach ( $params['values'] as $value ) {
		if ( $value && $value > 0 ) {
			$h = $value / $max * $imax;

			imagefilledrectangle($img, 60 + $i*100, 299-$h, 60 + 80 + $i*100, 299, $clr);
		}
		$i++;
	}	
	
	//send image to client
	header("content-type:image/png");
	imagepng($img);