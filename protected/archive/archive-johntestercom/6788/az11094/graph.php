<?php


// Parbauda vai ir ierakstita vertiba LABEL lucinja un ja nav, paradas nosaukums Tuksh
 $label1 = $_GET["label1"];

 if ($label1 !== '')
 {
     $label1 = strval($label1);
 }
 else 
 {
     $label1 = 'TUKSH';
 }
 
 $label2 = $_GET["label2"];
 
 if ($label2 !== '')
 {
     $label2 = strval($label2);
 }
 else 
 {
     $label2 = 'TUKSH';
 }

 $label3 = $_GET["label3"];
 
 if ($label3 !== '')
 {
     $label3 = strval($label3);
 }
 else 
 {
     $label3 = 'TUKSH';
 }
 
 $label4 = $_GET["label4"];
 
 if ($label4 !== '')
 {
     $label4 = strval($label4);
 }
 else 
 {
     $label4 = 'TUKSH';
 }
 
 $label5 = $_GET["label5"];

 if ($label5 !== '')
 {
     $label5 = strval($label5);
 }
 else 
 {
     $label5 = 'TUKSH';
 }





// parbauda vertibas vai ir cipars un >0 un ja nav tad pieskirs nulles veribu.

$value1 = $_GET["value1"];
if (is_numeric($value1) and $value1>0)
{
    $value1 = intval($value1);
}
else 
{
    $value1=0;
}


$value2 = $_GET["value2"];
if (is_numeric($value2) and $value2>0)
{
    $value2 = intval($value2);
}
else 
{
    $value2=0;
}

$value3 = $_GET["value3"];
if (is_numeric($value3) and $value3>0)
{
    $value3 = intval($value3);
}
else 
{
    $value3=0;
}

$value4 = $_GET["value4"];
if (is_numeric($value4) and $value4>0)
{
    $value4 = intval($value4);
}
else 
{
    $value4=0;
}

$value5 = $_GET["value5"];
if (is_numeric($value5) and $value5>0)
{
    $value5 = intval($value5);
}
else 
{
    $value5=0;
   
}


header('content-type: image/jpeg');






$bildite = imagecreate(600, 400);
$fons = imagecolorallocate($bildite,0,0,0);
$stabinja_krasa = imagecolorallocate($bildite,255,0,102);
$teksts = imagecolorallocate($bildite,255,255,255);

imagestring($bildite, 3,60,350,$label1, $teksts);
imagestring($bildite, 3,160,350,$label2, $teksts);
imagestring($bildite, 3,260,350,$label3, $teksts);
imagestring($bildite, 3,360,350,$label4, $teksts);
imagestring($bildite, 3,460,350,$label5, $teksts);


//Stabinji neies arpus zimejuma pateicoties koeficentam
$maximums = max($value1, $value2, $value3, $value4, $value5);
if ($maximums===0)  //bez juggling
{
    $maximums = 1;
}
else
{
$maximums = 290/$maximums;
}



imagefilledrectangle($bildite, 60,300,140, 300-($value1*$maximums),$stabinja_krasa);
imagefilledrectangle($bildite, 160,300,240, 300-($value2*$maximums),$stabinja_krasa);
imagefilledrectangle($bildite, 260,300,340, 300-($value3*$maximums),$stabinja_krasa);
imagefilledrectangle($bildite, 360,300,440, 300-($value4*$maximums),$stabinja_krasa);
imagefilledrectangle($bildite, 460,300,540, 300-($value5*$maximums),$stabinja_krasa);
//Es vnk gribeju, lai ir biezaka linija
imageline($bildite,20,300,580,300,$teksts);
imageline($bildite,20,301,580,301,$teksts);
imageline($bildite,20,302,580,302,$teksts);


imagejpeg($bildite);
imagedestroy($bildite);
?>

