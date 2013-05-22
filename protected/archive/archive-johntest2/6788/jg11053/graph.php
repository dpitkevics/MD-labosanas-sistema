<?php
#This file should generate the response image.
header ('Content-Type: image/jpeg');
$canvas=imagecreatetruecolor(600, 400);
$label=array();
$value=array();
    
for($i=1 ; $i<=5; $i++){
    if(isset($_GET['label'.$i])&&!empty($_GET['label'.$i]))
        $label[$i]=$_GET['label'.$i];
     else
        $label[$i]="Default".$i;
    
    if(isset($_GET['value'.$i])&&(is_numeric($_GET['value'.$i]))&&($_GET['value'.$i]>0))
        $value[$i]=intval($_GET['value'.$i]);
    else 
        $value[$i]=0;
}

$white=imagecolorallocate($canvas, 255, 255, 255);
$grey=imagecolorallocate($canvas, 128, 128, 128);
$lightgrey=imagecolorallocate($canvas, 211, 211, 211);

imagefilledrectangle($canvas, 0 , 0 , 600 , 400 , $white ); //backscreen
imagefilledrectangle($canvas, 20 , 300 , 580 , 301 , $grey ); //line in the bottom


//normilizing values:
$max=$value[1];
for($i=2;$i<=5;$i++){
    if($value[$i]>$max)
        $max=$value[$i];
}
$highest=280;
$nv=array();
for($i=1;$i<6;$i++){
    if($max>0)
        $nv[$i]=($highest/$max)*$value[$i];
    else
        $nv[$i]=0;
}
//now values are normilized


for($i=1;$i<6;$i++){   //Drawing columns and labels
        imagefilledrectangle($canvas,60+100*($i-1), 300-$nv[$i], 140+100*($i-1), 299, $lightgrey);
        imagestring($canvas, 5, 70+100*($i-1), 350, $label[$i], $grey);
}


imagejpeg($canvas);
imagedestroy($canvas);
?>