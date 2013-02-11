<?php
#This file should generate the response image.

 $lab_arr = array($_GET["label1"],$_GET["label2"],$_GET["label3"],$_GET["label4"],$_GET["label5"]);
 	for($i=0;$i<5;$i++){
            if ($lab_arr[$i]=='') $lab_arr[$i]='UNKNOWN';
	}
 $val_arr = array($_GET["value1"],$_GET["value2"],$_GET["value3"],$_GET["value4"],$_GET["value5"]);
        for($i=0;$i<5;$i++){
            if (!is_numeric($val_arr[$i])) $val_arr[$i]=0;
	}

 $img = imagecreatetruecolor (600, 400);           // Generates image of that parameters
 $balts  = imagecolorallocate ($img,255,255,255);  // Background color
 $tpeleks = imagecolorallocate ($img,50,50,50);   
 $peleks   = imagecolorallocate ($img,150,150,150);  
 $font = 'arial.ttf';
 
 imagefilledrectangle($img,0,0,600,400,$balts);      // Izveido diagrammas "logu"
 
 
 // Coordinates and method have been taken from JS homework

 if (abs(max($val_arr))+abs(min($val_arr))!=0){
    $ratio=(300/(abs(max($val_arr))+abs(min($val_arr))));}
    else $ratio=300;
  
 for($i=0;$i<5;$i++){
    imagefilledrectangle($img,60+$i*100,300-$ratio*$val_arr[$i],140+$i*100,300,$peleks);   
    }
    imagefilledrectangle($img,20,300,600,301,$tpeleks);
 
  for($i=0;$i<5;$i++){
        if ($val_arr[$i] < 0) imagettftext($img,12,0,70+$i*100 ,240,$peleks,$font,$lab_arr[$i]);
	else imagettftext($img,12,0,70+$i*100 ,360,$peleks,$font,$lab_arr[$i]);
    }
 header ("Content-type: image/png"); 
 imagepng($img);
 ?>