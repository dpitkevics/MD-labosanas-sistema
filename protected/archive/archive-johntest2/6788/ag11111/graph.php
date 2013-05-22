<?php
$value1= $_GET['value1'];
    if (is_numeric($value1) and $value1>0) {
        $value1=intval($value1);
    } else {
        $value1=0;
    }
    
$value2= $_GET['value2'];
    if (is_numeric($value2) and $value2>0) {
        $value2=intval($value2);
    } else {
        $value2=0;
    }
    
$value3= $_GET['value3'];
    if (is_numeric($value3) and $value3>0) {
        $value3=intval($value3);
    } else {
        $value3=0;
    }
    
$value4= $_GET['value4'];
    if (is_numeric($value4) and $value4>0) {
        $value4=intval($value4);
    } else {
        $value4=0;
    }
    
$value5= $_GET['value5'];
    if (is_numeric($value5) and $value5>0) {
        $value5=intval($value5);
    } else {
        $value5=0;
    }
    
$label1= $_GET['label1'];
    if ($label1 !== '') {
        $label1=strval($label1);
    } else {
        $label1 = 'etikete 1';
    }
    
$label2= $_GET['label2'];
    if ($label2 !== '') {
        $label2=strval($label2);
    } else {
        $label2 = 'etikete 2';
    }
    
    
$label3= $_GET['label3'];
    if ($label3 !== '') {
        $label3=strval($label3);
    } else {
        $label3 = 'etikete 3';
    }
    
$label4= $_GET['label4'];
    if ($label4 !== '') {
        $label4=strval($label4);
    } else {
        $label4 = 'etikete 4';
    }
    
$label5= $_GET['label5'];
    if ($label5 !== '') {
        $label5=strval($label5);
    } else {
        $label5 = 'etikete 5';
    }
    
header('content-type: image/jpeg');

$maksimala_vertiba = max($value1, $value2, $value3, $value4, $value5);
if ($maksimala_vertiba === 0) {
    $maksimala_vertiba = 1;
} else {
    $maksimala_vertiba = 250/$maksimala_vertiba;
    }

$image= imagecreate(600, 400);
$fons= imagecolorallocate($image, 235, 0 , 121);
$teksta_krasa= imagecolorallocate($image, 0, 0, 0);
$stabina_krasa= imagecolorallocate($image, 4, 235, 0);

imageline($image, 20, 300, 580, 300, $stabina_krasa);

imagestring($image, 3, 60, 350, $label1, $teksta_krasa);
imagestring($image, 3, 160, 350, $label2, $teksta_krasa);
imagestring($image, 3, 260, 350, $label3, $teksta_krasa);
imagestring($image, 3, 360, 350, $label4, $teksta_krasa);
imagestring($image, 3, 460, 350, $label5, $teksta_krasa);

imagefilledrectangle($image, 60, 300, 140, 300 - ($value1 * $maksimala_vertiba), $stabina_krasa);
imagefilledrectangle($image, 160, 300, 240, 300 - ($value2 * $maksimala_vertiba), $stabina_krasa);
imagefilledrectangle($image, 260, 300, 340, 300 - ($value3 * $maksimala_vertiba), $stabina_krasa);
imagefilledrectangle($image, 360, 300, 440, 300 - ($value4 * $maksimala_vertiba), $stabina_krasa);
imagefilledrectangle($image, 460, 300, 540, 300 - ($value5 * $maksimala_vertiba), $stabina_krasa);



imagejpeg($image);
imagedestroy($image);

?>