<?php

$valu1 = $_GET["valu1"];
$valu2 = $_GET["valu2"];
$valu3 = $_GET["valu3"];
$valu4 = $_GET["valu4"];
$valu5 = $_GET["valu5"];

$labe1 = $_GET["labe1"];
$labe2 = $_GET["labe2"];
$labe3 = $_GET["labe3"];
$labe4 = $_GET["labe4"];
$labe5 = $_GET["labe5"];

$mas = array($valu1, $valu2, $valu3, $valu4, $valu5, $labe1, $labe2, $labe3, $labe4, $labe5);

for ($int=0; $int<10; $int++)
{
    if($int <= 4)
        {
            if ($mas[$int]<0 or !is_numeric($mas[$int]))
            {
                $mas[$int] = 0;
            }
        }
        
    if($int >= 5)
        {
            if ($mas[$int]=="")
            {
                $mas[$int] = "Kol. nr. " . ($int-4);
            }
        }
}

$max = 0;
$min = $mas[0];

    for ($int=0; $int<=4; $int++)
    {
        if ($max < $mas[$int])
        {
            $max = $mas[$int];
        }
    }

    for ($int=0; $int<=4; $int++)
    {
        if ($min > $mas[$int])
        {
            $min = $mas[$int];
        }
    }

    if ($max==0)
    {
        $normalization = 1;
    }
    else 
    {
        $normalization = 300/($max-$min);
    }
    
header ('Content-Type: image/png');
$im = imagecreatetruecolor(600, 400)
      or die('Kaut kas nav kartiba.');

$white = imagecolorallocate($im, 255, 255, 255);
$black = imagecolorallocate($im, 0, 0, 0);
$grey = imagecolorallocate($im, 204, 204, 204);
$text_color = imagecolorallocate($im, 204, 204, 204);

imagefill($im, 0, 0, $white);

 $_x = array(1, 0, 1, 0, -1, -1, 1, 0);
        $_y = array(0, -1, -1, 0, 0, -1, 1, 1);
        for($n=0;$n<=7;$n++){
                imagestring ($im, 4, 65+$_x[$n], 335+$_y[$n], $mas[5], $text_color);
                imagestring ($im, 4, 165+$_x[$n], 335+$_y[$n], $mas[6], $text_color);
                imagestring ($im, 4, 265+$_x[$n], 335+$_y[$n], $mas[7], $text_color);
                imagestring ($im, 4, 365+$_x[$n], 335+$_y[$n], $mas[8], $text_color);
                imagestring ($im, 4, 465+$_x[$n], 335+$_y[$n], $mas[9], $text_color);
        }

imagefilledrectangle($im, 60, 300, 140, 300-($mas[0]*$normalization)*0.75, $grey);
imagefilledrectangle($im, 160, 300, 240, 300-($mas[1]*$normalization)*0.75, $grey);
imagefilledrectangle($im, 260, 300, 340, 300-($mas[2]*$normalization)*0.75, $grey);
imagefilledrectangle($im, 360, 300, 440, 300-($mas[3]*$normalization)*0.75, $grey);
imagefilledrectangle($im, 460, 300, 540, 300-($mas[4]*$normalization)*0.75, $grey);

imageline($im, 20, 300, 580, 300, $black);

imagepng($im);

imagedestroy($im);
   
?>