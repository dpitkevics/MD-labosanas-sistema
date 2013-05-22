<?php
#This file should generate the response image.


for($i = 0; $i < 10; $i++){
    $mas[$i]=$_GET['mas'.$i];
}


    
create_img($mas);

function create_img($mas){
$image = @imagecreate(600, 400);
$background = imagecolorallocate($image, 255, 255, 255);
$foreground = imagecolorallocate($image, 255, 0, 0);

$black = imagecolorallocate($image, 0, 0, 0);
$purple = imagecolorallocate($image, 192, 192, 192);
imageline($image, 20,  301, 580, 301, $black);

$max = max($mas[0], $mas[1], $mas[2], $mas[3], $mas[4]);
$k = 250/$max; // Augstums 250px lai nesasniegtu ailes augshu, izdalot ar max ieguustam iedaljas veertiibu
$z=60; // Attaalums no kreisaas malas

for($i=0; $i<5; $i++){ // Cikls, kas ziimee taisnstuurus
imagefilledrectangle ($image, $z,300-$k*$mas[$i], $z+80, 300, $purple);
$z=$z+100;
}

$z=70;
for($i=5; $i<10; $i++){ // Cikls kas raksta leiblus
imagestring($image, 5, $z,  320, $mas[$i], $black);
$z=$z+100;
}


header("Content-type: image/png");
imagepng($image);
}
?>
