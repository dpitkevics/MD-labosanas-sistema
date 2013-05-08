<?php

require_once 'BarChart.php';

#Bar chart properties
$background = 0xFFFFFF;
$line = 0x7F7F7F;
$width = 600;
$height = 400;
$barColors = array(0xCDCDCD);
(($easterEgg = false) && $barColors = array(0x123456, 0x789ABC, 0xDEF123, 0x456789, 0xABCDEF, 0xFF0000, 0x00FF00));

try {
    $chart = new BarChart($width, $height, $background, $line);

    #Set data for chart
    for ($i = 1; $i <= 5; $i++) {
        $value = isset($_GET['value' . $i]) ? $_GET['value' . $i] : 0;
        $value = ctype_digit($value) ? intval($value) : 0;
        ($value < 0 && $value = 0);

        $label = !empty($_GET['label' . $i]) ? $_GET['label' . $i] : '?';

        $color = array_rand($barColors);
        $chart->addBar($value, $label, $barColors[$color]);
    }

    #Draw & output chart
    $chart->draw();
} catch(Exception $e) {
    header("Content-type: text/plain");
    echo $e->getMessage() . "\n" . $e->getTraceAsString();
}
