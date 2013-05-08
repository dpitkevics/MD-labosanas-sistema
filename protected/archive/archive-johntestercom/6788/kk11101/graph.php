<?php
#This file should generate the response image.
class Graph {
    const BAR_COUNT             = 5;
    const CANVAS_WIDTH          = 600;
    const CANVAS_HEIGHT         = 400;
    const CANVAS_PADDING_HOR    = 20;
    const CANVAS_PADDING_VER    = 20;
    const BAR_MAX_HEIGHT        = 280;
    const BAR_WIDTH             = 80;
    const FIRST_BAR_MAGIN_LEFT  = 40;
    const BAR_MARGIN_RIGHT      = 20;
    const LABEL_MARGIN_TOP      = 50;   
    const LABEL_FONT_SIZE       = 2;

    const CANVAS_COLOR          = 0xFFFFFF;
    const BAR_COLOR             = 0xCCCCCC;
    const LINE_COLOR            = 0x000000;
    const LABEL_COLOR           = 0xCCCCCC;

    private $canvas;
    private $labels = array();
    private $values = array();
    private $barHeights = array();

    public function __construct($data) {
        // checking labels and values
        for ($i = 1; $i <= self::BAR_COUNT; $i++) {
            $label_i = "label".$i;
            $value_i = "value".$i;
            if (!isset($data[$label_i]) || strlen($data[$label_i]) == 0) {
                // if label is not set or is empty then generate label "labelN"
                $data[$label_i] = $label_i;
            }
               else {
                $data[$label_i] = urldecode($data[$label_i]);
            }
            if (!isset($data[$value_i]) || strlen($data[$value_i]) == 0 || 
                !is_numeric($data[$value_i]) || $data[$value_i] < 0) {
                $data[$value_i] = 0;
            } else {
                $data[$value_i] = intval($data[$value_i]);
            }
            $this->labels[$i-1] = $data[$label_i];
            $this->values[$i-1] = $data[$value_i];
        }

        // calculating heights
        $maxValue = $this->values[0];
        foreach($this->values as $value) {
            if ($value > $maxValue) {
                $maxValue = $value;
            }
        }
        if ($maxValue == 0) {
            // avoiding division by zero
            $maxValue = 1;
        }
        foreach($this->values as $key=>$value) {
            $this->barHeights[$key] = self::BAR_MAX_HEIGHT * $value / $maxValue;
        }

        // preparing canvas
        $this->canvas = imagecreatetruecolor(self::CANVAS_WIDTH, self::CANVAS_HEIGHT);
        $canvasBackground = $this->imageColor(self::CANVAS_COLOR);
        imagefilledrectangle($this->canvas, 0, 0, self::CANVAS_WIDTH, self::CANVAS_HEIGHT, $canvasBackground);
    }

    public function drawGraph() {
        // drawing columns and labels
        for ($i = 1; $i <= self::BAR_COUNT; $i++) {
            $this->drawColumn($i, $this->barHeights[$i-1]);
            $this->drawLabel($i, $this->labels[$i-1]);
        }
        // drawing line
        $this->drawSeparatingLine();
        // outputting an image
        header('Content-Type: image/png');
        imagepng($this->canvas);
        imagedestroy($this->canvas);
    }

    private function imageColor($color) {
        $blue = $color % 0x100;
        $green = floor($color / 0x100) % 0x100;
        $red = floor($color / 0x10000);
        return imagecolorallocate($this->canvas, $red, $green, $blue);
    }

    private function drawColumn($position, $height) {
        if ($height == 0) return;
        $x1 = self::CANVAS_PADDING_HOR + self::FIRST_BAR_MAGIN_LEFT + 
                ($position - 1) * (self::BAR_WIDTH + self::BAR_MARGIN_RIGHT);
        $x2 = $x1 + self::BAR_WIDTH;
        $y2 = self::CANVAS_PADDING_VER + self::BAR_MAX_HEIGHT;
        $y1 = $y2 - $height;
        $color = $this->imageColor(self::BAR_COLOR);
        imagefilledrectangle($this->canvas, $x1, $y1, $x2, $y2, $color);
    }

    private function drawSeparatingLine() {
        $x1 = self::CANVAS_PADDING_HOR;
        $x2 = self::CANVAS_WIDTH - self::CANVAS_PADDING_HOR;
        $y1 = self::CANVAS_PADDING_VER + self::BAR_MAX_HEIGHT;
        $y2 = $y1;
        $color = $this->imageColor(self::LINE_COLOR);
        imageline($this->canvas, $x1, $y1, $x2, $y2, $color);
    }

    private function drawLabel($position, $string) {
        $x = self::CANVAS_PADDING_HOR + self::FIRST_BAR_MAGIN_LEFT + 
                ($position - 1) * (self::BAR_WIDTH + self::BAR_MARGIN_RIGHT) +
                (self::BAR_WIDTH - imagefontwidth(self::LABEL_FONT_SIZE) * strlen($string)) / 2;
        $y = self::CANVAS_PADDING_VER + self::BAR_MAX_HEIGHT + self::LABEL_MARGIN_TOP;
        $color = $this->imageColor(self::LABEL_COLOR);
        imagestring($this->canvas, self::LABEL_FONT_SIZE, $x, $y, $string, $color);
    }
}

$chart = new Graph($_GET);
$chart->drawGraph();

//http://graph.dev/graph.php?label1=a&label2=a&label3=a&label4=a&label5=a&value1=1&value2=2&value3=3&value4=4&value5=5
?>