<?php
header('Content-type: image/png');
$title[0]=$_GET['label1'];
$title[1]=$_GET['label2'];
$title[2]=$_GET['label3'];
$title[3]=$_GET['label4'];
$title[4]=$_GET['label5'];
for($i=0 ; $i < 5 ; $i++)
{
    $title[$i]=  urldecode($title[$i]);
}
$value[0]=$_GET['value1'];
$value[1]=$_GET['value2'];
$value[2]=$_GET['value3'];
$value[3]=$_GET['value4'];
$value[4]=$_GET['value5'];
function getMax($array)
{
 $value=$array[0];
 for($i=1; $i<4; $i++){
  if($value<$array[$i]) {$value=$array[$i];}
 }
 return $value;
}
function getHeight($max,$current,$maxHeight)
{
 $percent=100*$current/$max;
 return $maxHeight*$percent/100;
}
for($i=0 ; $i < 5 ; $i++){
$value[$i]= floatval($value[$i]);
}
function draw($title,$value)
{
$graphImage = ImageCreate(600, 400);
$white =  ImageColorAllocate($graphImage, 255, 255, 255);
$black =  ImageColorAllocate($graphImage, 0, 0, 0);
 $marginLeft=60;
 $bulkWidth=140;;
 $maxHeight=280;
 $fontMargin=80;
 $max=getMax($value);
 $font = 'arial.ttf';
 $startX=$marginLeft;
 $currentHeight=0;
 imageline($graphImage, 20, 300, 580, 300, $black);
 for($i=0 ; $i<5; $i++)
 {
     
  if($value[$i]>0){
  $currentHeight = getHeight($max,$value[$i],$maxHeight-100);
  imagefilledrectangle($graphImage, $startX, $maxHeight-$currentHeight, $bulkWidth, 300, $black);
  }
  imagettftext($graphImage, 12, 0, $fontMargin, 350, $black, $font, $title[$i]);
  $startX+=100;
  $bulkWidth+=100;
  $fontMargin+=100;
 }
imagepng($graphImage);
imagedestroy($graphImage);
}
draw($title,$value);
?>
