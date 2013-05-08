<?php
#This file should generate the response graph_img.
															
	header ('Content-Type: graph_img/png');
	$graph_img = @imagecreatetruecolor(600, 400)
		or die('Ќевозможно инициализировать GD поток');
	$white = imagecolorallocate($graph_img, 240, 240, 240);
	imagefilledrectangle($graph_img, 0, 0, 600, 600, $white);
	if(!(empty($_GET) ) ) {
		for($i=1; $i<=5; $i++) {
			$corrected_label[$i] = $_GET['corrected_label'.$i];
			$corrected_value[$i] = $_GET['corrected_value'.$i];
		}
		$black = imagecolorallocate($graph_img, 0, 0, 0);
		$light_gray = imagecolorallocate($graph_img, 150, 150, 150);
		$light_gray_2 = imagecolorallocate($graph_img, 200, 200, 200);
		imageline($graph_img, 21, 301, 580, 301, $black);
		for($i=1; $i<=5; $i++)
			imagestring($graph_img, 11, 76+($i-1)*100, 351, $corrected_label[$i], $light_gray);
		$max = $corrected_value[1];
		for($i=2; $i<=5; $i++)
			if($corrected_value[$i] > $max)
				$max = $corrected_value[$i];
		if($max != 0)
			for($i=1; $i<=5; $i++) {
				if($corrected_value[$i] > 0)
					imagefilledrectangle($graph_img, 60+($i-1)*100, 300-($corrected_value[$i]/$max)*250, 140+($i-1)*100, 300, $light_gray_2);
			}
	}
	imagepng($graph_img);
	imagedestroy($graph_img);
?>