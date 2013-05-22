<?php
#This file should generate the response image.
//autors: Sigurds Eglītis, se11006

header("Content-Type: image/png");
$width=600;
$height=400;
$image = imagecreatetruecolor($width, $height);
$black=imagecolorexact($image, 0, 0, 0);
$gray=imagecolorexact($image, 125, 125, 125);
$white=imagecolorexact($image, 255, 255, 255);
imagefilledrectangle($image, 0, 0, $width, $height, $white);


$margin=20;
$firstbarmargin=60;
$barwidth=80;
$lineheight=300;
$barmaxheight=250;
$barspacing=20;
$labelspacing=30;

$maxvalue=0;

for ($i=1;$i<=5;$i++)
{
    if (!isset($_GET['value'.$i]))
    $_GET['value'.$i]=0;
    else 
    {
        if (!is_numeric($_GET['value'.$i]))
        $_GET['value'.$i]=intval($_GET['value'.$i]);
    }
    if (!isset($_GET['label'.$i]))
    $_GET['label'.$i]='';
    
    if ($_GET['label'.$i]=='')
    $_GET['label'.$i]='no label';
    
    if ($_GET['value'.$i]>$maxvalue)
    $maxvalue=$_GET['value'.$i];
    
}
for ($i=1;$i<=5;$i++)
{
    imagettftext($image, 12, 0, $firstbarmargin+($i-1)*($barwidth+$barspacing)+$barwidth/2-strlen($_GET['label'.$i])*3, $lineheight+$labelspacing, $gray, 'arial.ttf', $_GET['label'.$i]);
    imagefilledrectangle($image, $firstbarmargin+($i-1)*($barwidth+$barspacing), $lineheight, $firstbarmargin+($i-1)*($barwidth+$barspacing)+$barwidth, $lineheight-$barmaxheight*$_GET['value'.$i]/(($maxvalue!=0)?$maxvalue:1), $gray);
}

imageline($image, $margin, $lineheight, $width-$margin, $lineheight, $black);

imagepng($image)
?>