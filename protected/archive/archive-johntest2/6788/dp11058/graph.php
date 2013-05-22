<?php
header ('Content-Type: image/png');

class Graph
{
	private $_width;
	private $_height;
	private $_data;
	private $_colors;
	private $_barMax;
	private $_etc;
	private $_img;

	// saliekam visas defaultās vērtības privātajos mainīgajos
	public function __construct()
	{
		$g = $_GET;
		foreach ($g as $key => $val)
		{
			$this->_data[$key] = $val;
		}
		$this->_width = 600;
		$this->_height = 400;
		$this->_colors = array (
				'bg'	=>	array (255, 255, 255),
				'text'	=>	array (0, 0, 0),
				'bar0'	=>	array (255, 0, 0),
				'bar1'	=>	array (125, 125, 0),
				'bar2'	=>  array (0, 125, 125),
				'bar3'	=>	array (0, 255, 0),
				'bar4'	=>	array (0, 0, 255)
			);
		$this->_barMax = array ('width' => 100, 'height' => 250);
	}

	// izveidojam pašu bildi
	private function CreateImage()
	{
		$this->_img = imagecreatetruecolor($this->_width, $this->_height);
		$bg = imagecolorallocate($this->_img, $this->_colors['bg'][0], $this->_colors['bg'][1], $this->_colors['bg'][2]);
		imagefill($this->_img, 0, 0, $bg);
	}

	// zīmējam kolonnas un tekstu ar datiem
	private function DrawBars()
	{
		$c = 0;
		$space = 10;
		$max = max($this->_data);
		foreach ($this->_data as $key => $val)
		{
			// iegūstam krāsu, no krāsu masīva un saglabājam
			$color = imagecolorallocate($this->_img, $this->_colors['bar'.$c][0], $this->_colors['bar'.$c][1], $this->_colors['bar'.$c][2]);
			$text_color = imagecolorallocate($this->_img, $this->_colors['text'][0], $this->_colors['text'][1], $this->_colors['text'][2]);

			// izveidojam un aizpildam četrstūri pareizajās koordinātēs
			imagefilledrectangle($this->_img, $c*$this->_barMax['width']+$space, 300, $c*$this->_barMax['width']+$this->_barMax['width'], 300-($this->_barMax['height'] / $max) * $val, $color);
			// tā pat arī uzzīmējam tekstu pareizajās koordinātēs
			imagestring($this->_img, 2, $c*$this->_barMax['width']+$space, 320, $key .' ('. $val .')', $text_color);
			$c++;
		}
	}

	// izveidojam png bildi un iztīram atmiņu
	private function FinalizeImage()
	{
		imagepng($this->_img);
		imagedestroy($this->_img);
	}

	// publiskā funkcija, kas palaiž nepieciešamās metodes
	public function GenerateImage()
	{
		$this->CreateImage();
		$this->DrawBars();
		$this->FinalizeImage();
	}


}

// izveidojam objektu un uzzīmējam bildi
$graph = new Graph();
$graph->GenerateImage();

?>