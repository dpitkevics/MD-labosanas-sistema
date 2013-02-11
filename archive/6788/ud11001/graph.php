<?php
#This file should generate the response image.
	$labels=array();
	$values=array();
	
	for ($i=1; $i<=5; $i++) { 
    	
		$label="label" . $i;
    	$value="value" . $i;
    	
    	$labels[intval($i-1)] = $_GET[$label];
    // ja nav ievad�ta v�rt�ba, uzst�d�m noklus�to "uzraksts_i", kur i - skaitlis 1-5
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
// horizont�l�s l�nijas z�m��ana
    	imageline ($image,   20,  301, 580, 301, $lineGrey);
    	

// liel�k�s un maz�k�s v�rt�bas atra�ana	
    $min = $values[0];
    $max = $values[0];
    foreach ($values as $value)
    {
    		
    	if ($value > $max) $max = $value;
    	else if ($value < $min ) $min=$value;
    }
    if ($min===0) $min=1;
    	
// apr��ins un stabi�u z�m��ana
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

// teksta (le�endas) z�m��ana 	
    $center = 100;
    foreach ($labels as $label)
    {
    // izr��in�m teksta s�kuma x koordin�tas (lai teksts b�tu k� centr�ts attiec�b� pret stabi�iem, jo k� parametrs j�padod kreis� apak��j� st�ra x koordin�tas)
    	$text_width = imagefontwidth(4)*strlen($label);
    	$x = $center - (intval(round($text_width/2)));
    	imagettftext($image, 12, 0, $x, 340, $textGrey, './arialbd.ttf', $label);
    	$center += 100;
    }
    	header('Content-Type: image/jpeg');
    	imagejpeg($image);
?>

