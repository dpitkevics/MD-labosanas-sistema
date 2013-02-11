<?php
# is_int() ciparu virkni, kвdu arо saтemt $_GET, uzskata par virkni, nevis par 
//integer, kв tam vajadzetu?? Tвpзc izmanto is_numeric() un >0.

$value1 = $_GET["value1"];
if (is_numeric($value1) and $value1 > 0) {
    $value1 = intval($value1);
} else {
    $value1 = 0;
}

$value2 = $_GET["value2"];
if (is_numeric($value2) and $value2 > 0) {
    $value2 = intval($value2);
} else {
    $value2 = 0;
}

$value3 = $_GET["value3"];
if (is_numeric($value3) and $value3 > 0) {
    $value3 = intval($value3);
} else {
    $value3 = 0;
}

$value4 = $_GET["value4"];
if (is_numeric($value4) and $value4 > 0) {
    $value4 = intval($value4);
} else {
    $value4 = 0;
}

$value5 = $_GET["value5"];
if (is_numeric($value5) and $value5 > 0) {
    $value5 = intval($value5);
} else {
    $value5 = 0;
}

$label1 = $_GET["label1"];
$label1 = trim($label1);
if ($label1 !== '') {
    $label1 = strval($label1);
} else {
    $label1 = '"label 1"';
}

$label2 = $_GET["label2"];
$label2 = trim($label2);
if ($label2 !== '') {
    $label2 = strval($label2);
} else {
    $label2 = '"label 2"';
}

$label3 = $_GET["label3"];
$label3 = trim($label3);
if ($label3 !== '') {
    $label3 = strval($label3);
} else {
    $label3 = '"label 3"';
}

$label4 = $_GET["label4"];
$label4 = trim($label4);
if ($label4 !== '') {
    $label4 = strval($label4);
} else {
    $label4 = '"label 4"';
}

$label5 = $_GET["label5"];
$label5 = trim($label5);
if ($label5 !== '') {
    $label5 = strval($label5);
} else {
    $label5 = '"label 5"';
}

header('content-type: image/png');

# Noskaidro maksimвlo vзrtоbu, izreiнina koeficentu ar kuru reizinвt visas 
//vзrtоbas un veic pвrbaudi, vai max_value nav nulle, jo ja ir, tad dalорana
//ar nulli izraisa kпыdu.
$max_value = max($value1, $value2, $value3, $value4, $value5);
if ($max_value === 0) { 
    $max_value = 1; 
} else {
    $max_value = 260/$max_value;
}

$image = imagecreate(600, 400); 
$background = imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);
$rectangle_color = imagecolorallocate($image, 150, 150, 150);

imageline($image, 20, 300, 580, 300, $rectangle_color);

imagestring($image, 2, 60, 350, $label1, $text_color);
imagestring($image, 2, 160, 350, $label2, $text_color);
imagestring($image, 2, 260, 350, $label3, $text_color);
imagestring($image, 2, 360, 350, $label4, $text_color);
imagestring($image, 2, 460, 350, $label5, $text_color);

# Maksimвlв iespзjamв vertоbв ko iespзjams parвdоt ir 2147483647.
imagefilledrectangle($image, 60, 300, 140, 300-($value1 * $max_value), $rectangle_color);
imagefilledrectangle($image, 160, 300, 240, 300-($value2 * $max_value), $rectangle_color);
imagefilledrectangle($image, 260, 300, 340, 300-($value3 * $max_value), $rectangle_color);
imagefilledrectangle($image, 360, 300, 440, 300-($value4 * $max_value), $rectangle_color);
imagefilledrectangle($image, 460, 300, 540, 300-($value5 * $max_value), $rectangle_color);

imagepng($image);
imagedestroy($image);
?>