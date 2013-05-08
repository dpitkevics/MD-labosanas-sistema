<?php
#This file should generate the response image.
header('Content-Type: image/jpeg');

$image = ImageCreate (600,400);
$background_color = ImageColorAllocate ($image, 255, 255, 255);
$line_color = ImageColorAllocate ($image, 0, 0, 0);
$text_color = ImageColorAllocate ($image, 180, 180, 180);

$label1=$_GET["label1"];
$label2=$_GET["label2"];
$label3=$_GET["label3"];
$label4=$_GET["label4"];
$label5=$_GET["label5"];
$value1=intval($_GET["value1"]);
$value2=intval($_GET["value2"]);
$value3=intval($_GET["value3"]);
$value4=intval($_GET["value4"]);
$value5=intval($_GET["value5"]);

$values=array($value1,$value2,$value3,$value4,$value5);
$absvalues=array(abs($value1),abs($value2),abs($value3),abs($value4),abs($value5));
$max=max($absvalues);

for($i=0;$i<5;$i++) {
    if (is_numeric($values[$i])){
            if($values[$i]>=0){
                imagefilledrectangle($image, 60+($i)*100, 150-($values[$i]/$max*140), 60+($i)*100+80, 150, $text_color);
            }
            else{           
                imagefilledrectangle($image, 60+($i)*100, 150, 60+($i)*100+80, 150-$values[$i]/$max*140, $text_color);
            }
    }
    else{
       imagefilledrectangle($image, 60+($i)*100, 150, 60+($i)*100+80, 150, $text_color); 
    }
};

$labels=array($label1,$label2,$label3,$label4,$label5);

imageline ($image,20,150,580,150,$line_color);

$font = imageloadfont('arial.gdf');
$default='default';
for ($i=0;$i<5;$i++){
    if(is_string($labels[$i])){
        imagestring($image, $font, 60+$i*100+40-strlen($labels[$i])/2*7, 350, $labels[$i], $text_color);
    }
    else{
        imagestring($image, $font, 60+$i*100+40-strlen($default)/2*7, 350, $default, $text_color);
    }
}


ImageJpeg ($image);
?>

