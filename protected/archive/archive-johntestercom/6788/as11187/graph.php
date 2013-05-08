<?php
// Declare MIME type
header('Content-Type: image/png');

function draw_rectangle($img, $x1, $y1, $width, $height) {
/** Draw light-gray rectangle using top-left coordinate and dimensions **/
	$gray = imagecolorallocate($img, 200, 200, 200);
	$height += $y1;
	$width += $x1;
	if ($height < $y1) {
		$tmp = $y1;
		$y1 = $height;
		$height = $tmp;
	};
	
	imagefilledrectangle($img, $x1, $y1, $width, $height, $gray);
};

function draw_label($img, $label, $width) {
/** Draw black bar label text at given X position **/
	$width = $width + (100 - imagefontwidth(3) * (strlen($label) + 1)) / 2.0;
	$black = imagecolorallocate($img, 60, 60, 60);
	imagestring($img, 3, $width, 330, $label, $black);
};

function draw($img, $data, $ratio) {
/** Draw bars and print labels on image **/
	// Apply ratio
	foreach ($data as $label => $value) { 
		$data[$label] *= $ratio;
	};
	$x = 60;
	$y = 300 - max(-min($data), 0);

	foreach ($data as $label => $value) {
		draw_rectangle($img, $x, $y, 80, -$value);
		draw_label($img, $label, $x);
        	$x += 100; // move label position to the right
	};
	// Zero-level line
	draw_rectangle($img, 20, $y, 560, 1);
};

// Create image canvas
$image = imagecreatetruecolor(600, 400);

// Fill background with white color
$white = imagecolorallocate($image, 255, 255, 255);
imagefill($image, 0, 0, $white);

// Collect label names and values from GET parameters into associative array
$inputs = array();
for ($ii = 1; $ii <= 5; $ii += 1) {
	$label = 'label' . $ii;
	$value = 'value' . $ii;
	if (isset($_GET[$label]) && isset($_GET[$value])) {
		$inputs[$_GET[$label]] = $_GET[$value];
	};
};

// Calculate amplitude between highest positive and lowest negative values
$amplitude = max($inputs) - min(min($inputs), 0);

if ($amplitude != 0) {
	// Calculate ratio (resize bars to fit canvas)
	$ratio = 270 / $amplitude;

	// Call drawing function
	draw($image, $inputs, $ratio);
};
// Create image
imagepng($image);
imagedestroy($image);

?>
