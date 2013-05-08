<?php
/*
 * Gustavs Venters, gv11017, 3.10.2012
 */
header ("Content-Type: image/png");

//Creates image
$im = imagecreatetruecolor(600, 400);
$white = imagecolorallocate($im, 255, 255, 255);
imagefill($im, 0, 0, $white);

$dark_grey = imagecolorallocate($im, 140, 140, 140);

if (!empty($_GET))
{
	$labels = [
		"label1" => $_GET["label1"],
		"label2" => $_GET["label2"],
		"label3" => $_GET["label3"],
		"label4" => $_GET["label4"],
		"label5" => $_GET["label5"]
	];
	$count = 1;
	foreach  ($labels as &$x) {
		if (empty($x) && $x != "0") $x = "[Bar " . (string)$count . "]";
		$count++;
	};
	unset($x);
	
	$values = [
		"value1" => $_GET["value1"],
		"value2" => $_GET["value2"],
		"value3" => $_GET["value3"],
		"value4" => $_GET["value4"],
		"value5" => $_GET["value5"]
	];
	foreach ($values as &$x) {
		if (!(preg_match("/^\d+$/", $x))) $x = 0; // works more precisely than is_numeric & is_int, checks if string is integer >= 0
		$x = ltrim($x, "0");
		if (strlen($x) > 9) $x = substr($x, 0, 9);
		// I'm using only the first 9 significant digits of input, to not exceed int limits.
		// Graph will can be drawn with very large integers.

	};
	unset($x);
	// Creates labels
	imagestring($im, 5, 65, 340,  $labels["label1"], $dark_grey);
	imagestring($im, 5, 165, 340,  $labels["label2"], $dark_grey);
	imagestring($im, 5, 265, 340,  $labels["label3"], $dark_grey);
	imagestring($im, 5, 365, 340,  $labels["label4"], $dark_grey);
	imagestring($im, 5, 465, 340,  $labels["label5"], $dark_grey);
	
	// Draws columns
	$biggest = 1;
	foreach ($values as $x) {
		if ($x > $biggest) $biggest = $x;
	};
	$k = 250/$biggest; // 250 = biggest column size
	$light_grey = imagecolorallocate($im, 220, 220, 220);
	imagefilledrectangle($im, 60, 300, 140, 300-$values["value1"]*$k, $light_grey);
	imagefilledrectangle($im, 160, 300, 240, 300-$values["value2"]*$k, $light_grey);
	imagefilledrectangle($im, 260, 300, 340, 300-$values["value3"]*$k, $light_grey);
	imagefilledrectangle($im, 360, 300, 440, 300-$values["value4"]*$k, $light_grey);
	imagefilledrectangle($im, 460, 300, 540, 300-$values["value5"]*$k, $light_grey);
	
	// Draws line
	$black = imagecolorallocate($im, 0, 0, 0);
	imagesetthickness($im, 2);
	imageline($im, 20, 300, 580, 300, $black);
}
else { // If no input
	imagestring($im, 5, 260, 200,  "Your graph", $dark_grey);
}

imagepng($im);
imagedestroy($im);
?>