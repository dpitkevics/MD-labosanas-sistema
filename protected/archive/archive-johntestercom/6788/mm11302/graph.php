<?php

function normalizeValues($values, $maxValueAllowed) {
    $min = 0;
    $max = 0;

	for ($i = 0; $i < count($values); $i++) {
		if ($values[$i] > $max) {
			$max = $values[$i];
        }
		elseif ($values[$i] < $min) {
			$min = $values[$i];
        }
    }

	$normalized = array();
	for ($i = 0; $i < count($values); $i++) {
        if ($max-$min != 0) {
		    array_push($normalized, ($values[$i] * ($maxValueAllowed / ($max-$min))));
        }
        else {
            array_push($normalized, 0);
        }
    }

	return $normalized;
}

function drawGraph($img, $values, $labels) {
    $horizMargin = 20;
    $vertMargin = 20;

    $horizBarMargin = 60;
    $maxBarHeight = 300;
    $spacingBetweenBars = 20;

    $lineMargin = 20;
    $lineHeight = 2;

    $imgWidth = 600;
    $imgHeight = 400;

    $white = imagecolorallocate($img, 255, 255, 255);
    $black = imagecolorallocate($img, 0, 0, 0);
    imagefilledrectangle($img, 0, 0, $imgWidth, $imgHeight, $white);

    // zīmē līniju
    $x1 = $lineMargin;
    $y1 = $imgHeight - ($imgHeight - $maxBarHeight);
    $x2 = $x1 + $imgWidth - (2 * $lineMargin);
    $y2 = $y1;
    imagesetthickness($img, 2);
    imageline($img, $x1, $y1, $x2, $y2, $black);
    imagesetthickness($img, 1);

    // zīmē stabiņus un to nosaukumus
    $spaceLeft = (2 * $horizBarMargin) + ((count($values)-1) * $spacingBetweenBars);
    $barWidth = (count($values) > 0) ? ($imgWidth - $spaceLeft) / count($values) : ($imgWidth - $spaceLeft);
    $curLeft = $horizBarMargin;
    $normalized = normalizeValues($values, $maxBarHeight - $vertMargin);
    for ($i = 0; $i < count($normalized); $i++) {
        $curTop = $maxBarHeight - $normalized[$i];
        $randomColor = imagecolorallocate($img, rand(0,255), rand(0,255), rand(0,255));
        if ($normalized[$i] != 0) {
            imagefilledrectangle($img, $curLeft, $curTop, $curLeft+$barWidth, $curTop+$normalized[$i], $randomColor);
        }
        $fontSize = 4;
        $length = imagefontwidth($fontSize) * strlen($labels[$i]);
        imagestring($img,
                    $fontSize,
                    $curLeft + ($barWidth / 2) - ($length / 2),
                    $imgHeight - ($imgHeight - $maxBarHeight) / 2,
                    $labels[$i],
                    $black);
        $curLeft += $spacingBetweenBars + $barWidth;
    }
}

header('Content-Type: image/png');
$img = imagecreatetruecolor(600, 400);

$values = array();
$labels = array();
for ($i = 1; $i <= 5; $i++) {
    $curLabel = (isset($_GET["label$i"]) && $_GET["label$i"] != '') ? $_GET["label$i"] : "quantity$i";
    $curValue = (isset($_GET["value$i"])) ? $_GET["value$i"] : 0;
    if (!is_numeric($curValue)) { $curValue = 0; };
    if (!is_int($curValue)) { $curValue = intval($curValue); }
    if ($curValue < 0) { $curValue = 0; }
    array_push($labels, $curLabel);
    array_push($values, $curValue);
}

drawGraph($img, $values, $labels);

imagepng($img);
imagedestroy($img);
