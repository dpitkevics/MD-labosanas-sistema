<?php
$im = imagecreate(600, 400);

$bg = imagecolorallocate($im, 255, 255, 255);
for ($i=1; $i<=5; $i++)
{
    if (isset($_GET['label'.$i]))
    {
        imagestring($im, 2, $i * 100 - 40, 350, $_GET['label'.$i], imagecolorallocate($im, 0, 0, 173));
    }    
};
$max = "";
for ($i=1; $i<=5; $i++)
{
    if (isset($_GET['value'.$i]))
    {
        if ($max == "") $max = intval($_GET['value'.$i]);
        if ($max < intval($_GET['value'.$i])) $max = intval(($_GET['value'.$i]));
    }
}
if ($max!="")
{
   for ($i=1; $i<=5; $i++)
   {
       if (isset($_GET['value'.$i]))
       {
           $sab = (intval($_GET['value'.$i]))/$max;             //Sablona vertiba
           imagefilledrectangle($im, $i * 100 - 40, 300 - 290 * $sab, 40 + $i * 100, 300, imagecolorallocate($im, 40 + 40 * $i, 250 - 40 * $i, 255));}
       }
}




header('Content-type: image/png');

imagepng($im);
imagedestroy($im);

?>