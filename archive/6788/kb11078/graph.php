<?php
#This file should generate the response image.

#Script created under Linux Ubuntu

class HomeWorkCreateImg {
	public static $inst;
	public static $column_width = 117;
	public static $img_height = 350;
	public static $default_text = 'unknown';
	private $url = array();

	/**
	 * Prepare all data
	 */
	public function __construct() {
		// gets all values and labels
		if (isset($_GET)) {
			for ($i=1; $i<=5; $i++) {
				$this->url['label'.$i] = urldecode($_GET['label'.$i]);
				if ($this->isEmptyStr($this->url['label'.$i])) $this->url['label'.$i] = self::$default_text;

				if (!is_numeric($_GET['value'.$i]) || $_GET['value'.$i] < 0) $this->url['value'.$i] = 0;
				else $this->url['value'.$i] = urldecode(intval($_GET['value'.$i]));
			}
		}
		// find biggest value
		$big = 0;
		for ($i=1; $i<=5; $i++) {
			if ($this->url['value'.$i] > $big) $big = $this->url['value'.$i];
		}
		// sets values to proper number 0->400
		if ($big != 0) {
			for ($i=1; $i<=5; $i++) {
				$this->url['value'.$i] = (self::$img_height / $big) * $this->url['value'.$i];
			}
		}
	}

	/**
	 * Creats and output image
	 */
	public function printImg() {
		header ('Content-Type: image/png; charset=utf-8');

		$img = @imagecreatetruecolor(600, 400) or die('Nevar izveidot bildi');
		$bar_color = imagecolorallocate($img, 0, 105, 255);
		$color = imagecolorallocate($img, 255, 255, 255);

		for ($i=1; $i<=5; $i++) {
			$y = ($i-1)*self::$column_width;
			// draw column
			imagefilledrectangle(
				$img, 
				15+$y, 
				self::$img_height, 
				self::$column_width+$y, 
				self::$img_height-$this->url['value'.$i], 
				$bar_color
			);
			// draw text
			imagestring($img, 2, 15+$y, self::$img_height+10, $this->url['label'.$i], $color);
		}

		imagefilledrectangle($img, 0, self::$img_height+3, 600, self::$img_height+3, $color);

		imagepng($img);
		imagedestroy($img);
	}

	private function isEmptyStr($str) {
		return !str_replace(" ", "", $str);
	}

	public static function instance() {
        if (!self::$inst) self::$inst = new self;
        return self::$inst;
    }
}

HomeWorkCreateImg::instance()->printImg();