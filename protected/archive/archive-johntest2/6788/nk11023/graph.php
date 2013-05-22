<?php
$max=$_GET['value1'];
for ($i=1; $i<6; $i++) //atrod lielāko ievadīto vertibu
{
 if($_GET['value'.$i]>=$max)
   {$max=$_GET['value'.$i];};  
}
if($max==0) //koeficienta vertība ir atkarīga no maksimāla vertība, lai izvairīties no dalīšanas uz nulli
  {$height=0;}
else
  {$height=300/$max*0.99;}
$background=imagecreate(600, 400); //fons
imagecolorallocate($background, 255, 255, 250); //fona krāsa
$black=imagecolorallocate($background, 0, 0, 0); //stabiņu un teksta krāsa
$grey=imagecolorallocate($background, 133, 133, 133); //līnijas krāsa
imageline($background, 20, 300, 580, 300, $grey); //līnijas zimēšana
for ($i=1; $i<6; $i++) //stabiņu un teksta zimēšana
{
 $_GET['value'.$i];
 imagefilledrectangle($background, 60+(100*($i-1)), 300, 140+(100*($i-1)), 300-($_GET['value'.$i]*$height), $black);
 $_GET['label'.$i];
 imagestring($background, 5, 60+(100*($i-1)) , 350 , $_GET['label'.$i] , $black);
}
Header("Content-type: image/jpeg");
imageJpeg($background);
imageDestroy($background); //atbrīvo servera atmiņu
?>