<?php
header ('Content-Type: image/png');

$width = 600;
$heigth = 400;
$graphheigth = 350;
$img = @imagecreatetruecolor($width,$heigth)
      or die('Cannot Initialize new GD image stream');
error_reporting(E_ALL);
#This file should generate the response image.
$background = imagecolorallocate($img, 199,200,150 );
$lines = imagecolorallocate($img, 50,50,50 );
$bars = imagecolorallocate($img, 200, 100, 50);
imagefill($img, 0, 0, $background);
$text_color = imagecolorallocate($img, 233, 14, 91);
$raw_data = ($_GET);
$data='';
foreach ($raw_data as $key => $value) {
    $data[$key] = urldecode($value);
}
for ($i = 1; $i < 6; $i++) {
    if ( is_numeric($data['value'.$i])) {$a='b';}
    else $data['value'.$i]=0;
    if ($data['label'.$i]=="") $data['label'.$i]="Label ".$i;
}
$maxlen = $minlen = floatval($data['value1']);
#callculate relative data
for ($i = 1; $i < 6; $i++) {
    $tmp=$data['value'.$i];
    if (floatval($tmp) > floatval($maxlen )) $maxlen = $tmp;
    else if (floatval($tmp) < floatval($minlen)) $minlen = $tmp;
}

$relative = floatval($maxlen) / intval($graphheigth);
$graphstart = $graphheigth+25;
if ($relative == 0) $relative = 1;
if (floatval($minlen)<0) {
    $relative = floatval($maxlen - $minlen) / intval($graphheigth);
    if ($relative == 0) $relative = 1;
    $graphstart = intval($graphstart + $minlen/$relative);
}
#Draw first line
imagesetthickness ( $img, 2 );
imageline($img, 20, $graphstart+2, 560, $graphstart+2, $lines);

$currx='';
$curry='';
$currheigth='';
#Draw it all here.
for ($i = 1; $i < 6; $i++) {
     $tmp=floatval($data['value'.$i]);
     //change color here;
     $barcolor = imagecolorallocate($img, rand(0, 255), rand(0, 255), rand(0, 255));

     $currx = (60 +  intval($i-1) * 100);
     $curry  = intval($graphstart);
     $currheigth = intval($tmp) / $relative;
          //$percents = $tmp / $maxlen*100;
         
     $value = round(floatval($tmp),2);
     $label = $data['label'.$i];
     if ($tmp>0) {
         imagefilledrectangle($img, $currx,$curry , $currx+80, $curry-$currheigth, $barcolor);
         imagestring($img, 4, $currx, $graphstart+10,$label ,$text_color);
         imagestring($img, 4, $currx+5, $graphstart-$currheigth-20,$value ,$text_color);
     }
     else  {
         imagefilledrectangle($img, $currx,$curry+3 , $currx+80, $curry-$currheigth+3, $barcolor);
         imagestring($img, 4, $currx, $graphstart-20,$label ,$text_color);
         imagestring($img, 4, $currx+5, $graphstart-$currheigth+8,$value ,$text_color);
     }
     imagecolordeallocate($img, $barcolor);
}
imagestring($img, 1, 0, 0,"Andris Pakulis, ap11148.", $text_color);
imagecolordeallocate($img, $bars);
imagecolordeallocate($img, $text_color);
imagecolordeallocate($img, $lines);
imagecolordeallocate($img, $background);


imagepng($img);
imagedestroy($img);

?>
