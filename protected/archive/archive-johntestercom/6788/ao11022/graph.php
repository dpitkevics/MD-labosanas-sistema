<?php

function urldecode_to_array ($url) {
  $ret_ar = array();
  
  if (($pos = strpos($url, '?')) !== false) $url = substr($url, $pos + 1);
  if (substr($url, 0, 1) == '%26') $url = substr($url, 1);

  $elems_ar = explode('%26', $url);                  
  for ($i = 0; $i < count($elems_ar); $i++) {
    list($key, $val) = explode('%3D', $elems_ar[$i]);
    $ret_ar[urldecode($key)] = urldecode($val);    
  }

  return $ret_ar;
}

function get_values_array($get_arr) {
    $output_array = array();
    
    for($i = 1; $i <= 5; $i++) {
        $key = 'value'.$i;
        if(!is_numeric($get_arr[$key]) or ($get_arr[$key] < 0)) $get_arr[$key] = 0;
        $output_array[$i] = $get_arr[$key];
    }
    return $output_array;
}

function get_labels_array($get_arr) {
    $output_array = array();
    
    for($i = 1; $i <= 5; $i++) {
        $key = 'label'.$i;
        if($get_arr[$key] == "") $get_arr[$key] = $key;
        $output_array[$i] = $get_arr[$key];
    }
    return $output_array;
}

function add_centered_text($image, $font, $text, $x1, $y1, $font_size, $color)
{
    $bbox = imagettfbbox($font_size, 0, $font, $text);
    $width = $bbox[2] - $bbox[0];
    imagettftext($image, $font_size, 0, ($x1 + (80 - $width) / 2), $y1, $color, $font, $text);
}


header("Content-type: image/jpeg");

$get_array = urldecode_to_array($_SERVER['REQUEST_URI']);
//print_r($get_array);
$values_array = get_values_array($get_array);
//print_r($values_array);
$labels_array = get_labels_array($get_array);
//print_r($labels_array);


$graph_image = imagecreatetruecolor (600, 400);
$white = imagecolorallocate($graph_image, 255, 255, 255);
$black = imagecolorallocate($graph_image, 0, 0, 0);
$dark_grey = imagecolorallocate($graph_image, 84, 84, 84);
$light_grey = imagecolorallocate($graph_image, 184, 184, 184);
$font_file = './arialbd.ttf';
$font_size = 12;

imagefill($graph_image, 0, 0, $white);

if(max($values_array) == 0) $const_for_size = 0;
else $const_for_size = (260 / max($values_array));

for($i = 1; $i <= 5; $i++) {
    imagefilledrectangle($graph_image, (60 + ($i-1)*100), (300 - ($const_for_size * $values_array[$i])),
            (60 + $i*80 + ($i-1)*20), 300, $light_grey);
    add_centered_text($graph_image, $font_file, $labels_array[$i], (60 + ($i-1)*100), 350,
            $font_size, $light_grey);
}

imageline($graph_image, 20, 300, 580, 300, $dark_grey);

$img_data = imagejpeg($graph_image); 
echo $img_data;

?>