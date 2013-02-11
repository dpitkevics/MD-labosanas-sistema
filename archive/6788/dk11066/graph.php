<?php
$label1=$_GET['label1'];
$label2=$_GET['label2'];
$label3=$_GET['label3'];
$label4=$_GET['label4'];
$label5=$_GET['label5'];

$value[0]=$_GET['value1'];
$value[1]=$_GET['value2'];
$value[2]=$_GET['value3'];
$value[3]=$_GET['value4'];
$value[4]=$_GET['value5'];

//Zīmē grafiku
header ('Content-Type: image/png');
$im = @imagecreate(600, 400)
      or die('Cannot Initialize new GD image stream');
$background_color = imagecolorallocate($im, 255, 255, 255);
$darkgrey = imagecolorallocate($im, 127, 127, 127);   
$grey = imagecolorallocate($im, 205, 205, 205);

//Zīmē nosaukumus
imagestring($im, 3, 65,  350, $label1, $grey);
imagestring($im, 3, 165,  350, $label2, $grey);
imagestring($im, 3, 265,  350, $label3, $grey);
imagestring($im, 3, 365,  350, $label4, $grey);
imagestring($im, 3, 465,  350, $label5, $grey);

//Zīmē apakšlīniju
imagefilledrectangle ($im,   20,  301, 580, 302, $darkgrey);

//Atrod lielāko vērtību 
$maxv = $value[0];
for ($i = 1; $i < 5; $i++) {
    if ($value[$i] > $maxv) { $maxv = $value[$i]; }
}
if ($maxv==0) $maxv=1; //Ja lielākā vērtība ir 0, tad maxv mainīgajam piešķir 1, lai nebūtu jādala ar 0

//Zīmē stabiņus
$prev = 60;
$prev2 = 140;
$yhigh = 250;
$perc=($value[0] * 100) / $maxv;
$y1=50 + ($yhigh - (($perc * $yhigh) / 100));
if ($value[0]!=0){
imagefilledrectangle ($im,   $prev,  $y1, $prev2, 300, $grey);
}
for ($j = 1; $j < 5; $j++){
    $perc=$value[$j] * 100 / $maxv;
    $y1=50+ ($yhigh - (($perc * $yhigh) / 100));
    $prev+=100;
    $prev2+=100;
    if ($value[$j]!=0){
    imagefilledrectangle ($im,   $prev,  $y1, $prev2, 300, $grey);
    }
}

imagepng($im);
imagedestroy($im);

?>

