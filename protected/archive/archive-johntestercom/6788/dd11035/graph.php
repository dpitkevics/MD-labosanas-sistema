<?php
// --- common section ---
$FIELDS = 5;

function is_valid_value($val){
    $val = trim($val);
    if (is_numeric($val) and intval($val)>=0)
        return true;
    return false;
}

function is_valid_label($lab){
    if (trim($lab)!=='')
        return true;
    return false;
}
// --- end of common section ---


$clean_labels = array_fill(1, $FIELDS, 'label');
$clean_values = array_fill(1, $FIELDS, 0);

// check values there too - trust no one, spies are everywhere.
for ($i=1; $i <= $FIELDS; $i++) {
    $label_str = 'label'.$i;
    if (isset($_GET[$label_str]) and is_valid_label($_GET[$label_str])) {
        $clean_labels[$i] = trim($_GET[$label_str]);
    }

    $value_str = 'value'.$i;
    if (isset($_GET[$value_str]) and is_valid_value($_GET[$value_str])) {
        $clean_values[$i] = intval($_GET[$value_str]);
    }
}

$max = max($clean_values);
if ($max){
    $ratio = 290.0/$max;
}
else{
    $ratio = 0;
}

// lot of magic numbers below...
$im = imagecreatetruecolor(600, 400);
$bg = imagecolorallocate($im, 240, 240, 240);
imagefill($im, 0, 0, $bg);
$black=imagecolorallocate($im, 10, 10, 10);
$grey=imagecolorallocate($im, 140, 140, 140);

$offset = 60;
for ($i=1; $i <= $FIELDS; $i++, $offset+=100) {
    imagefilledrectangle($im, $offset, 310, $offset+80, 310-$clean_values[$i]*$ratio, $grey);
    imagestring($im, 5, $offset+20, 350, $clean_labels[$i], $grey);
}
imageline($im, 20, 310, 580, 310, $black);

header ('Content-Type: image/png');
imagepng($im);
imagedestroy($im);
?>