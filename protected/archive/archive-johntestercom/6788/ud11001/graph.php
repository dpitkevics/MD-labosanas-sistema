<?php
#This file should generate the response image.
	$labels=array();
	$values=array();
	
	for ($i=1; $i<=5; $i++) { 
    	
		$label="label" . $i;
    	$value="value" . $i;
    	
    	$labels[intval($i-1)] = $_GET[$label];
    // ja nav ievadîta vçrtîba, uzstâdâm noklusçto "uzraksts_i", kur i - skaitlis 1-5
    	if ($labels[intval($i-1)]=='')
    		$labels[intval($i-1)]="uzraksts_".$i;
    	
    	$values[intval($i-1)] = intval($_GET[$value]);		
    }
    	
    $image = @imagecreatetruecolor(600, 400);
    	
    $white = imagecolorallocate($image, 255, 255, 255);
    $lineGrey = imagecolorallocate($image, 112, 112, 112);
    $grey = imagecolorallocate($image, 181, 181, 181);
    $textGrey = imagecolorallocate($image, 100, 100, 100);
    	
    imagefilledrectangle ($image,   0,  400, 600, 0,  $white);
// horizontâlâs lînijas zîmçðana
    	imageline ($image,   20,  301, 580, 301, $lineGrey);
    	

// lielâkâs un mazâkâs vçrtîbas atraðana	
    $min = $values[0];
    $max = $values[0];
    foreach ($values as $value)
    {
    		
    	if ($value > $max) $max = $value;
    	else if ($value < $min ) $min=$value;
    }
    if ($min===0) $min=1;
    	
// aprçíins un stabiòu zîmçðana
    $ratio=300/(intval($max+$min));
    $x=60;

   	foreach ($values as $value)
   	{
   		if ($value!==0)
    	{
	   		$val=intval($value*$ratio);
	   		imagefilledrectangle ($image,   $x,  300, $x+80, 300-$val,  $grey);
    	}	
    	$x += 100;
    }
    	//var_dump($values);

// teksta (leìendas) zîmçðana 	
    $center = 100;
    foreach ($labels as $label)
    {
    // izrçíinâm teksta sâkuma x koordinâtas (lai teksts bûtu kâ centrçts attiecîbâ pret stabiòiem, jo kâ parametrs jâpadod kreisâ apakðçjâ stûra x koordinâtas)
    	$text_width = imagefontwidth(4)*strlen($label);
    	$x = $center - (intval(round($text_width/2)));
    	imagettftext($image, 12, 0, $x, 340, $textGrey, './arialbd.ttf', $label);
    	$center += 100;
    }
    	header('Content-Type: image/jpeg');
    	imagejpeg($image);
?>

