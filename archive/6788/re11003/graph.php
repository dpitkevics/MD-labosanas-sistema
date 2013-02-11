<?php

$data= array ();
$maximum=1;

for ($a=0;$a<10;$a++)
{
    $data[$a]=$_GET[$a];
}

for ($i=5;$i<10;$i++)
{ 
    if ($data[$i]>9000||$data[$i]<0||!is_numeric($data[$i]))
        $data[$i]=0;
    if($maximum<$data[$i]) 
    $maximum=$data[$i];
}
for ($b=0;$b<5;$b++)
{
    $c=$b+1;
    if (!is_string($data[$b])||$data[$b]=="")
        $data[$b]="Label"."".$c;
}
   
header ('Content-Type: image/png');
$im = @imagecreatetruecolor(600, 400)
      or die('Cannot Initialize new GD image stream');
$trans_colour = imagecolorallocatealpha ($im, 0, 0, 0, 127);
 imagefill($im, 0, 0, $trans_colour);
 imagesavealpha($im, true);

$color = imagecolorallocate($im, 184, 184, 184);
imagefilledrectangle ($im , 60  , 300-$data[5]*275/$maximum , 140 , 300 , $color );
imagefilledrectangle ($im , 160 , 300-$data[6]*275/$maximum , 240 , 300 , $color );
imagefilledrectangle ($im , 260 , 300-$data[7]*275/$maximum , 340 , 300 , $color );
imagefilledrectangle ($im , 360 , 300-$data[8]*275/$maximum , 440 , 300 , $color );
imagefilledrectangle ($im , 460 , 300-$data[9]*275/$maximum , 540 , 300 , $color );

imagestring($im, 12,  70, 340,  $data[0], $color);
imagestring($im, 12, 170, 340,  $data[1], $color);
imagestring($im, 12, 270, 340,  $data[2], $color);
imagestring($im, 12, 370, 340,  $data[3], $color);
imagestring($im, 12, 470, 340,  $data[4], $color);
$darkcolor = imagecolorallocate($im, 122, 122, 122);
imagefilledrectangle ( $im , 20 , 300 , 580 , 301 , $darkcolor );

imagepng($im);

?>