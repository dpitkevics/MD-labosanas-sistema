<?php
header ('Content-Type: image/png');

$values = array(0=>$_GET['val1'], 1=>$_GET['val2'], 2=>$_GET['val3'], 3=>$_GET['val4'], 4=>$_GET['val5']);
$labels = array(0=>$_GET['lab1'], 1=>$_GET['lab2'], 2=>$_GET['lab3'], 3=>$_GET['lab4'], 4=>$_GET['lab5']);

$maxVal = 300;
for($i=1;$i<5;$i++)
{
	if($maxVal < $values[$i]) $maxVal = $values[$i];
}

$k=0;
while($maxVal > 300)
{
	$maxVal--;
	$k++;
}

if($k!=0) 
{
	$ratio = 300/$k*0.1;
	for($i=0;$i<5;$i++) $values[$i] = $values[$i]*$ratio;
}

$image = ImageCreate(600, 400);

$White = ImageColorAllocate($image, 255, 255, 255);
$Grey =  ImageColorAllocate($image, 205, 205, 205);
$DarkGrey = ImageColorAllocate($image, 127, 127, 127);

if($values[0] == 0 && $values[1] == 0 && $values[2] == 0 && $values[3] == 0 && $values[4] == 0)
{
	ImageFilledRectangle($image, 60, 300, 140, 300, $Grey);
	ImageFilledRectangle($image, 160, 300, 240, 300, $Grey); 
	ImageFilledRectangle($image, 260, 300, 340, 300, $Grey);
	ImageFilledRectangle($image, 360, 300, 440, 300, $Grey);
	ImageFilledRectangle($image, 460, 300, 540, 300, $Grey);
}
else {
	ImageFilledRectangle($image, 60, 300, 140, 300-$values[0], $Grey);
	ImageFilledRectangle($image, 160, 300, 240, 300-$values[1], $Grey); 
	ImageFilledRectangle($image, 260, 300, 340, 300-$values[2], $Grey);
	ImageFilledRectangle($image, 360, 300, 440, 300-$values[3], $Grey);
	ImageFilledRectangle($image, 460, 300, 540, 300-$values[4], $Grey);
}

ImageString($image, 5, 60, 350, $labels[0], $Grey);
ImageString($image, 5, 160, 350, $labels[1], $Grey);
ImageString($image, 5, 260, 350, $labels[2], $Grey);
ImageString($image, 5, 360, 350, $labels[3], $Grey);
ImageString($image, 5, 460, 350, $labels[4], $Grey);

ImageLine($image, 20, 300, 580, 300, $DarkGrey);

imagepng($image);
imagedestroy($image);

?>