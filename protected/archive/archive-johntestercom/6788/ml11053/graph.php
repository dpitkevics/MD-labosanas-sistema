<?php #This file should generate the response image.
# good tutorial about drawing with php http://www.phptutorial.info/learn/create_images/

### developed by Mârtiòð Laizâns ml11053 ###
############################################

//Process input
$values = array(); //for getting , calculate values
$initial_values = array(); //for output above bars
$labels = array();

$max = (is_numeric($_GET['value1']))? $_GET['value1']:1; //set max to 1 if first value not numeric
$min = $_GET['value1'];
$level_line = $min;

for ($i=1; $i<6; $i++) //get values from GET into array
{
	$values[$i] = $_GET['value'.$i];
	$initial_values[$i] = $_GET['value'.$i];
	$labels[$i] = $_GET['label'.$i];
	if (trim($labels[$i]) == '')
		$labels[$i] = 'bar '.$i; //give bar a default name if it's not set
}

		// echo '<br>'.$max.' '.$min.'<br>';
		// for ($i=1; $i<6; $i++)
			// echo $values[$i].' ';
		// echo '<br>';

for ($i=1; $i<6; $i++) //validate values
{
if (!is_numeric($values[$i])) //set to 0 if invalid value
{
	$values[$i] = 0;
	$labels[$i] = 'BAD '.$i;
}
if($max < $values[$i]) //find max value
	$max = $values[$i]; 
if($min > $values[$i]) //find min value
	$level_line = $min = $values[$i]; 
}

		// echo '<br>'.$max.' '.$min.'<br>';
		// for ($i=1; $i<6; $i++)
			// echo $values[$i].' ';
		// echo '<br>';

$lowest_y = 340; //bottom line of bars
$highest_y =  30; //highest y point possible for bars
$left_x = 60; //left indent before first left bar
$x_interval = 20; //interval between bars
$bar_width =80;


//Calculate bar heigth
$ratio = ($lowest_y-$highest_y)/$max; //get ratio for scaling all input values to fit in height interval
		// echo 'ratio '.$ratio.'<br>';
for ( $i = 1; $i < 6; $i++) {
	$values[$i] = $lowest_y - $values[$i]*$ratio ;
	if ($values[$i] < $highest_y )
		$values[$i] = $highest_y ;
}

$level_line = ($level_line ==0)? 1: $level_line; //make sure level line is not 0, to prevent infinite loop in while loop (line 82)
$min = $level_line = $lowest_y - $level_line*$ratio;
		//testing outupt
		// for ($i=1; $i<6; $i++)
			// echo $values[$i].'<br>';
		// echo '<br>';

$width = 600;
$height = 400;

//Do the drawing
$im = @imagecreate($width, $height) or die("Cannot Initialize new GD image stream");
	// $background_color = imagecolorallocate($im, 0, 0, 0);  // black
	$background_color = imagecolorallocate($im, 255, 255, 255);  // white
	$bar_color = imagecolorallocate($im, 155, 210, 110);
	$text_color = imagecolorallocate($im, 110, 110, 110);
	$base_line_color = imagecolorallocate($im, 0, 0, 0);
	$level_line_color = imagecolorallocate($im, 200, 200, 200);
		// imagestring ($im, size, X,  Y, text, $red);
		// imagefilledrectangle ($im,  X1, Y1, X2, Y2, $color);
		// imageline ($im,  X1, Y1, X2, Y2, $color);
	while ($level_line >= $highest_y)
	{
		imageline ($im,  40, $level_line, $width-40, $level_line, $level_line_color);
		$level_line -= $lowest_y - $min ;
	}

	for ($i=0; $i<5; $i++)
	{
		imagefilledrectangle ($im, 
			$left_x+($i*($bar_width+$x_interval)), //x1
			$values[$i+1], //y1
			$left_x+$i*($bar_width+$x_interval)+$bar_width, //x2
			$lowest_y, //y2
			$bar_color);
		imagestring($im, 11, $left_x+$i*($bar_width+$x_interval)+$bar_width - 70,  $lowest_y + 15, $labels[$i+1] , $text_color);
		imagestring($im, 2, $left_x+$i*($bar_width+$x_interval)+$bar_width - 50,  $values[$i+1] - 18, $initial_values[$i+1] , $text_color);
	}
	
	imagefilledrectangle ($im, 20 , $lowest_y+1, $width-20, $lowest_y+2, $base_line_color);
	
	//for testing
	// imagepng($im,"image.png");
	// print "<img src=image.png?".date("U").">"; // avoid the browser to show an image stored in the cache
	
	//real output
	imagepng($im);
	imagedestroy($im);

?>