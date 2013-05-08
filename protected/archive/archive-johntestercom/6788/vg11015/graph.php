<?php
#This file should generate the response image.
//***********Collect and process data*******************
function check($one, $two){ //Find if data is Value or Label
    if (strncmp($one, $two, strlen($two)) == 0) return TRUE;
    else return FALSE;
}
function collect(){ //Collect data from GET
    $data=array();//Stores collected data
    foreach ($_GET as $dat => $val){
        $input = NULL;
        if (check($dat, "label")){//Checks if data is label
            $nr = intval(substr($dat, 5)); //Find which value
            if ($val == NULL){//No label iputed
                $input['label'] = "NO LABEL";
            }
            else{ //Label inputed
                $input['label'] = $val;
            }
            $value = $_GET["value".$nr];
            if (is_numeric($value)){ //Checks if valid number
                $input['value'] = intval($value);
            }else{
                $input['value'] = 0;
            }
            $data[$nr-1] = $input;
        }
        elseif (check($dat, "value")) { //Check the situations when theres was value but no label
            $value = $_GET[$dat];
            $nr = intval(substr($dat, 5));
            if (is_numeric($value) && is_null($data[$nr-1])){
                $input['value'] = intval($value);
                $data[$nr-1] = $input;
            }
        }
    }
    return $data;
}

function mesure($val, &$max, &$min, &$offset, &$range){
    $max = NULL;
    $min = NULL;
    foreach ($val as $va){
        if (!is_null($va['value'])){
            if (is_null($max) || $va['value'] > $max) {
                $max = $va['value'];
            }
            if (is_null($min) || $va['value'] < $min) {
                $min = $va['value'];
            }
        }
    }
    $range = ($min < 0) ? $max - $min : $max;
    if($range == 0){
        $range++;
    }
    $offset = ($min < 0) ? -$min / $range : 0;
}

$get_data = collect();
$max = $min = $offset = $range = NULL; //max - higest value, min - lowest value, offset - determines the pozition of the horizontal line
mesure($get_data, $max, $min , $offset, $range);
$width = 600;
$height = 400;
$bar_height = 300;
//*************************************
//************CREATE IMAGE**************
$img = @imagecreatetruecolor($width, $height) or die('Cannot Initialize new GD image stream');
$white = imagecolorallocate($img, 255, 255, 255);
$black = imagecolorallocate($img, 0, 0, 0);
imagefill($img, 0, 0, $white);
foreach ($get_data as $get_d => $g){
    $height = (($g['value']) / $range) * $bar_height;
    imagefilledrectangle($img, 60 + 100 * $get_d, $bar_height - $height - $offset * $bar_height, 60 + 100 * $get_d + 60, (1 - $offset) * $bar_height, $black);
    imagestring($img, 4, 60 + 100 * $get_d, $bar_height + 50, $g['label'] ,$black);
}
imagefilledrectangle($img, 20, (1 - $offset) * $bar_height-1, 580, (1 - $offset) * $bar_height+1, $black);
header ('Content-Type: image/png');
imagepng($img);
imagedestroy($img);
//*******************************************
?>