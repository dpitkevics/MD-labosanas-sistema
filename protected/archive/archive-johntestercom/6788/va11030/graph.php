<?php

//notice safe
function get($name) {
    if (isset($_GET[$name])) {
        return $_GET[$name];
    }
    return NULL;
}

function startsWith($string1, $string2) {
    return strncmp($string1, $string2, strlen($string2)) == 0;
}

function parseValues() {
    $res = array();
    foreach ($_GET as $arg => $val) {
        //parses labels
        $pair = NULL;
        if (startsWith($arg, 'label')) {
            $id = intval(substr($arg, 5));
            $pair['label'] = $_GET[$arg];
            $value = $_GET['value' . $id];
            //tries to match values
            if (is_numeric($value)) {
                $pair['value'] = intval($value);
            }
            $res[$id - 1] = $pair;
            //adds unmatched values
        } elseif (startsWith($arg, 'value')) {
            $value = $_GET[$arg];
            $id = intval(substr($arg, 5));
            if (is_numeric($value) && is_null($res[$id - 1])) {
                $pair['value'] = intval($value);
                $res[$id - 1] = $pair;
            }
        }
    }
    return $res;
}

function scale($inputs, &$min, &$max, &$offset, &$range) {
	$min = NULL; $max = NULL;
    foreach ($inputs as $i) {
        if (!isset($i['value']) || is_null($i['value'])) {
            continue;
        }
        if (is_null($max) || $i['value'] > $max) {
            $max = $i['value'];
        }
        if (is_null($min) || $i['value'] < $min) {
            $min = $i['value'];
        }
    }
    $range = ($min < 0) ? $max - $min : $max;
    if ($range == 0) {
        $range = 1;
    }
    $offset = ($min < 0) ? -$min / $range : 0;
}

$mode = get('mode');

$values = parseValues();
$width = 600;
$height = 400;
$barHeight = 300;
scale($values, $min, $max, $offset, $range);

if ($mode == 'svg') {

    header('Content-Type: image/svg+xml');
    echo '<?xml version="1.0" standalone="no"?>
	<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
	<svg width="' . $width . '" height="' . $height . '" version="1.1" xmlns="http://www.w3.org/2000/svg">';
    $colors = array("#FF0000", "#00FF00", "#0000FF", "#FF00FF", "#FFFF00");
    foreach ($values as $i => $val) {
        $barColor = $colors[$i];
        if (isset($val['value'])) {
            $height = (($val['value']) / $range) * $barHeight;
            if ($height >= 0) {
                echo '<rect width="60" height="' . $height . '" x="' . (60 + 100 * $i) . '" y="' . ($barHeight - $height - $offset * $barHeight) . '" fill="' . $barColor . '"/>';
            } else {
                //silly SVG can't handle negative height
                echo '<rect width="60" height="' . (-$height) . '" x="' . (60 + 100 * $i) . '" y="' . ((1 - $offset) * $barHeight) . '" fill="' . $barColor . '"/>';
            }
        }
        if (isset($val['label'])) {
            echo '<text font-size = "12" x="' . (60 + 100 * $i) . '" y="' . ($barHeight + 50) . "\" fill=\"$barColor\">$val[label]</text>\n";
        }
    }
    echo '<rect width="560" height="2" x="20" y="' . ((1 - $offset) * $barHeight - 1) . "\"/>\n";
    echo '<text fill="red" x="0" y="12" font-size = "12">SVG</text>';
    echo '</svg>';
} else {
//default graphics mode png
    $im = @imagecreatetruecolor($width, $height)
            or die('Cannot Initialize new GD image stream');
    $white = imagecolorallocate($im, 255, 255, 255);
    $black = imagecolorallocate($im, 0, 0, 0);
    imagefill($im, 0, 0, $white);
    $colors = array(array(255, 0, 0), array(0, 255, 0), array(0, 0, 255), array(255, 0, 255), array(255, 255, 0));
    foreach ($values as $i => $val) {
        $barColorArr = $colors[$i];
        $barColor = imagecolorallocate($im, $barColorArr[0], $barColorArr[1], $barColorArr[2]);
        if (isset($val['value'])) {
            $height = (($val['value']) / $range) * $barHeight;
            imagefilledrectangle($im, 60 + 100 * $i, $barHeight - $height - $offset * $barHeight, 60 + 100 * $i + 60, (1 - $offset) * $barHeight, $barColor);
        }
        if (isset($val['label'])) {
            imagestring($im, 5, 60 + 100 * $i, $barHeight + 50, $val['label'], $barColor);
        }
    }
    imagefilledrectangle($im, 20, (1 - $offset) * $barHeight - 1, 580, (1 - $offset) * $barHeight + 1, $black);
    header('Content-Type: image/png');
    imagepng($im);
    imagedestroy($im);
}
?>
