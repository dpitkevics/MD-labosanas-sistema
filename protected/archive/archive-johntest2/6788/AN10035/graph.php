<?php
header ("Content-Type: image/png");
$im = @imagecreatetruecolor(600, 400)
      or die('Cannot Initialize new GD image stream');
$background = imagecolorallocate($im, 255, 255, 255);
$color = imagecolorallocate($im, 150, 150, 150);
$line_color = imagecolorallocate($im, 0, 0, 0);
imagefilledrectangle($im, 0, 0, 600, 400, $background);

foreach($_GET as $key=>$val)
{
    if ($val != "")
    {
        $i = intval(substr($key, -1));
        if ("label" == substr_replace($key ,"",-1))
            imagestring($im, 3, (100 * $i) - 40, 350, $val, $color);
        if ("value" == substr_replace($key ,"",-1))
        {
            $val = intval ($val);
            imagefilledrectangle($im, ((100 * $i) - 40), 300, ((100 * $i) + 40), (300 - $val), $color);
        }
    }
}

imageline($im, 20, 300, 580, 300, $line_color);

imagepng($im);
imagecolordeallocate($im, $color);
imagecolordeallocate($im, $line_color);
imagedestroy($im);
?>