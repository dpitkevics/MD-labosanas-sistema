<?php
/*$my_img = imagecreate( 600, 400 );
$background = imagecolorallocate( $my_img, 0, 0, 255 );
$text_colour = imagecolorallocate( $my_img, 255, 255, 0 );
$line_colour = imagecolorallocate( $my_img, 128, 255, 0 );
if(!empty($_GET))
imagestring( $my_img, 4, 30, 25, $_GET["label1"],
  $text_colour );
imagesetthickness ( $my_img, 5 );
imageline( $my_img, 30, 45, 165, 45, $line_colour );

header( "Content-type: image/png" );
imagepng( $my_img );
imagecolordeallocate( $line_colour );
imagecolordeallocate( $text_colour );
imagecolordeallocate( $background );
imagedestroy( $my_img );*/

//Image inicialization;
$image =  imagecreate(600, 400);
$background = imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);
$object_color = imagecolorallocate($image, 150, 150, 150);
//Drawing
$labels = array(
    1 => $_GET["label1"],
    2 => $_GET["label2"],
    3 => $_GET["label3"],
    4 => $_GET["label4"],
    5 => $_GET["label5"]
);
imageline($image, 20, 300, 580, 300, $text_color);
imagestring($image, 5, 60, 350, $labels[1], $text_color);
imagestring($image, 5, 160, 350, $labels[2], $text_color);
imagestring($image, 5, 260, 350, $labels[3], $text_color);
imagestring($image, 5, 360, 350, $labels[4], $text_color);
imagestring($image, 5, 460, 350, $labels[5], $text_color);

$values = array(
    1 => $_GET["value1"],
    2 => $_GET["value2"],
    3 => $_GET["value3"],
    4 => $_GET["value4"],
    5 => $_GET["value5"]   
);

$biggest=1;

for($i = 1; $i <= 5; $i++)
{
    if($values[$i] >= $biggest) $biggest=$values[$i];
}

for($i=1; $i<6; $i++)
{

    $values[$i]= (100 * $values[$i])/$biggest;
}

for ($i=1; $i<6; $i++)
{
    $values[$i] = (250 * $values[$i]) / 100;
}



$y=300-intval($values[1]);
imagefilledrectangle($image, 60, $y, 120, 300, $object_color);
$y=300-intval($values[2]);
imagefilledrectangle($image, 160, $y, 220, 300, $object_color);
$y=300-intval($values[3]);
imagefilledrectangle($image, 260, $y, 320, 300, $object_color);
$y=300-intval($values[4]);
imagefilledrectangle($image, 360, $y, 420, 300, $object_color);
$y=300-intval($values[5]);
imagefilledrectangle($image, 460, $y, 520, 300, $object_color);



//End
header("Content-type: image/png");
imagepng($image);
imagecolordeallocate($background);
imagecolordeallocate($text_color);
imagecolordeallocate($object_color);
imagedestroy($image);

?>