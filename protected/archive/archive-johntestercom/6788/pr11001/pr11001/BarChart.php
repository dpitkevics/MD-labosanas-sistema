<?php

/**
 * Draw a horizontal bar chart with unlimited number of bars.
 * Images can be output to stdout (or saved to files) as PNGs.
 * 
 * @author pr11001
 */
class BarChart 
{
    /**
     * Width of chart image in pixels.
     *
     * @type int
     */
    private $_width;

    /**
     * Height of chart image in pixels.
     *
     * @type int
     */
    private $_height;

    /**
     * Background color of chart.
     * Stored as an int, but can be set as a hex value 
     * using PHP's 0x... hex value defining method.
     *
     * @type int
     */
    private $_background;

    /**
     * Color of the line between bars and labels.
     * 
     * @type int
     */
    private $_lineColor;

    /**
     * Array of arrays that represent chart bars.
     * Each bar is defined as follows:
     * array(
     *     value: (int), //value of the bar [0..+inf]
     *     label: (string), //label of bar
     *     color: (int) //set in the same way as background
     * )
     *
     * @type array
     */
    private $_bars = array();

    /**
     * @param int $width width of chart
     * @param int $height height of chart
     * @param int $background background color of chart
     * @param int $lineColor color of line that seperates bars from labels
     */
    public function __construct(
        $width, 
        $height,
        $background = 0xFFFFFF,
        $lineColor = 0xCACACA
    ) {
        //TODO: add validation for params
        $this->_width = $width;
        $this->_height = $height;
        $this->_background = $background;
        $this->_lineColor = $lineColor;
    }
    
    /**
     * Add a bar to chart. 
     *
     * @param int $value bar value (0..+inf)
     * @param string $label label of bar
     * @param int $color color of bar
     */
    public function addBar($value, $label, $color = 0x000000)
    {
        //TODO: validate the values
        $this->_bars[] = array(
            'value' => $value,
            'label' => $label,
            'color' => $color,
        );
    }

    /**
     * Make an empty image (canvas) in the given size & bg color.
     *
     * @return resource $image
     */
    private function getCanvas() 
    {
        if (!function_exists('imagecreatetruecolor')) {
            throw new Exception("BarChart error: imagecreatetruecolor() does not exist. (GD library not loaded?)");
        }

        $image = imagecreatetruecolor($this->_width, $this->_height);
        if (!$image) {
            throw new Exception("BarChart error: can't create image.");
        }

        //Background
        imagefilledrectangle($image, 0, 0, $this->_width, $this->_height, $this->_background);

        //Draw the bar line.
        $line1Y = (int)(3 / 4 * $this->_height);
        $line2Y = $line1Y + 1;
        $line1X = (int)(1 / 30 * $this->_width);
        $line2X = $this->_width - $line1X;
        imagefilledrectangle($image, $line1X, $line1Y, $line2X, $line2Y, $this->_lineColor);

        return $image;
    }

    /**
     * Save image resource or output it to stdout. 
     *
     * @param resource $image
     * @param string $filename or null for stdout
     */
    private function handleImageOutput($image, $output = null) 
    {
        if ($output === null) {
            header('Content-type: image/png');
            $result = imagepng($image);
        } else if (is_string($output)) {
            //Append .png to filename
            if (strtolower(end(explode('.', $output))) != 'png') {
                $output .= '.png';
            }

            $result = imagepng($image, $output);
        } else {
            throw new Exception("BarChart error: unknown output.");
        }

        if (!$result) {
            throw new Exception("BarChart error: can't output image.");
        }
    }

    /**
     * Destroy image resource. 
     *
     * @param resource $image
     */
    private function destroyCanvas(&$image) 
    {
        imagedestroy($image);
    }

    /**
     * Maximum value of bars.
     * 
     * @return int
     */
    private function getMax() 
    {
        $bars = count($this->_bars);
        $max = $this->_bars[0]['value'];
        for ($i = 0; $i < $bars; $i++) {
            $max = max($max, $this->_bars[$i]['value']);
        }

        return $max;
    }

    /**
     * Draw one bar to the chart.
     *
     * @param resource $image
     * @param int $index index of the bar to draw
     * @param int $max maximum value of all bars
     */
    private function drawBar($image, $index, $max)
    {
        $value = $this->_bars[$index]['value'];
        $label = $this->_bars[$index]['label'];
        $color = $this->_bars[$index]['color'];
        $bars = count($this->_bars);
        $max = max(1, $max);

        //Area where we draw bars
        $barAreaWidth = (int)((5 / 6) * $this->_width);
        $barAreaHeight = (int)((13 / 20) * $this->_height) - 1;
        $barAreaX = (int)(((1 / 6) * $this->_width) / 2);
        $barAreaY = (int)((1 / 10) * $this->_height);

        //Parameters of the bars
        $barWidth = (int)((4 / 5) * $barAreaWidth / $bars);
        $barMargin = (int)((1 / 5) * $barAreaWidth / $bars);

        //Current bar
        $bar1X = (int)($barAreaX + ($barWidth + $barMargin) * $index + 0.5 * $barMargin);
        $barHeight = (int)(($value * $barAreaHeight) / $max);
        $bar1Y = (int)($barAreaY + $barAreaHeight - $barHeight);
        $bar2X = $bar1X + $barWidth;
        $bar2Y = $bar1Y + $barHeight;

        //Current bar label
        $labelLen = mb_strlen($label);
        $label1X = (int)(($bar2X + $bar1X) / 2 - (($labelLen + 1) / 2) * imagefontwidth(3));
        $label1X = max($label1X, $bar1X);
        $label1Y = (int)((5 / 6) * $this->_height);

        //Current bar value
        $valueStr = (string)$value;
        $valueLen = strlen($valueStr);
        $value1X = (int)(($bar2X + $bar1X) / 2 - (($valueLen + 1) / 2) * imagefontwidth(3));
        $value1X = max($value1X, $bar1X);
        $value1Y = $bar1Y - 15;

        //Background
        if ($value > 0) {
            imagefilledrectangle($image, $bar1X, $bar1Y, $bar2X, $bar2Y, $color);
        }

        //Label
        imagestring($image, 3, $label1X, $label1Y, $label, $color);

        //Value on top of bar
        if ($value > 0) {
            imagestring($image, 3, $value1X, $value1Y, $valueStr, $color);
        }
    }

    /**
     * Draw the chart & output it to a file or stdout.
     *
     * @param string $output filename or null for stdout.
     */
    public function draw($output = null) 
    {
        $bars = count($this->_bars);
        if ($bars < 1) {
            throw new Exception("BarChart error: no bars were set.");
        }

        $image = $this->getCanvas();
        $max = $this->getMax();
        for ($i = 0; $i < $bars; $i++) {
            $this->drawBar($image, $i, $max);
        }

        $this->handleImageOutput($image);
        $this->destroyCanvas($image);
    }
}
