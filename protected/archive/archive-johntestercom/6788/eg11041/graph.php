<?php // Header
/*
Author: Çriks Gopaks, LU DF 2.kurss
ID: eg11041

Developed this work using Notepad++ (in my opinion, the best for learning programming languages).
Tested on Apache 2.2 web server.
*/
?>
<?php // Validation functions (same as in 'index.php')
function validLabel($label)
{
    // Disallowing a bunch of spaces/tabs, so that $label = '   ' is considered invalid.
    return trim($label) != false;
}

function validValue($value)
{
    // Expecting $value to be castable to double
    if (is_numeric($value))
    {
        // Disallowing hexadecimal values
        if (intval($value) === 0 && intval($value, 16) !== 0)
        {
            return false;
        }
        
        if (doubleval($value) >= 0) // Disallowing negative values
        {
            return true;
        }
        return false;
    }
    return false;
}
?>
<?php // Main
    $labels = array();
    $values = array();
    for ($i = 1; $i <= 5; $i++)
    {
        $labels[] = trim($_GET["label$i"]);
        if (validLabel($labels[$i - 1]) !== true)
        {
            // Automatic label
            $labels[$i - 1] = "Bar $i";
        }
        $values[] = trim($_GET["value$i"]);
        if (validValue($values[$i - 1]) !== true)
        {
            $values[$i - 1] = "0";
        }
        $values[$i - 1] = doubleval($values[$i - 1]);
    }
    
    // Image dimensions
    $W = 600;
    $H = 400;
    
    // Creating image
    header ('Content-Type: image/png');
    $im = @imagecreatetruecolor($W, $H) or die('Cannot Initialize new GD image stream');
    
    // Defining sizes
    $font_size = 3;
    
    $bar_height = 300;
    $bar_width = 90;
    $pad_width = 20;
    
    $base_height = 80;
    $base_width = 5 * $bar_width + 6 * $pad_width;
    
    # Leftmost bar's x1-coordinate
    $X = $W / 2 - 5 * $bar_width / 2 - 2 * $pad_width;
    
    // Defining colors
    $background_color = imagecolorallocate($im, 255, 255, 255); # White
    $base_color = imagecolorallocate($im, 0, 0, 255); # Black
    $bar_color = imagecolorallocate($im, 0, 85, 255); # 'Soft' blue
    $label_color = imagecolorallocate($im, 17, 85, 255); # Another blue
    
    // Filling background (which is black by default for true color images)
    imagefill($im, 0, 0, $background_color);
    
    // Drawing baseline
    $start_x = $W / 2 - $base_width / 2;
    $start_y = $H - $base_height;
    $end_x = $W / 2 + $base_width / 2;
    $end_y = $start_y;
    imageline($im, $start_x, $start_y, $end_x, $end_y, $base_color);
    
    // Drawing bars with labels
    $Max = doubleval(0);
    for ($i = 0; $i < 5; $i++)
    {
        if ($values[$i] > $Max) $Max = $values[$i];
    }
    if ($Max == 0)
    {
        // Simple workaround for a case where all values are equal to zero.
        $Max = 1;
    }
    
    for ($i = 0; $i < 5; $i++)
    {
        // Bar
        $x1 = $X + $i * ($bar_width + $pad_width);
        $y1 = $start_y;
        $x2 = $x1 + $bar_width;
        $y2 = $y1 - $bar_height * $values[$i] / $Max;
        imagefilledrectangle($im, $x1, $y1, $x2, $y2, $bar_color);
        
        // Label, aligned to the center of the bar
        $text_width = imagefontwidth($font_size) * strlen($labels[$i]);
        $x = $x1 + $bar_width / 2 - $text_width / 2;
        $y = $start_y + $font_size;
        imagestring($im, $font_size, $x, $y, $labels[$i], $label_color);
    }
    
    imagestring($im, $font_size, 5, 5,  $string, $bar_color);
    imagepng($im);
    imagedestroy($im);
?>