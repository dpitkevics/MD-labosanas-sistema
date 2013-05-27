<?php //Image generator

//Image MIME type
header('Content-type: image/gif'); //GIF is one of the advised image formats for the web

//If we have what to use from received data...

if(isset($_GET) && array_key_exists('label1',$_GET) ) 
{ 
    //Populating arrays with label & value data
    $labels = Array($_GET['label1'], $_GET['label2'], $_GET['label3'], $_GET['label4'],$_GET['label5']);
    $values = Array($_GET['value1'], $_GET['value2'], $_GET['value3'], $_GET['value4'],$_GET['value5']);

    //Making sure, values will fit in the desired drawing area
    $notzero=false; //For checking if at least 1 value is not zero
    for($i=0; $i<5; $i++) 
    {
    //Autoassigning incorrect/not present values with zero
        if(!is_numeric($values[$i]) || $values[$i]<0) $values[$i]=0; 
        else $notzero=true;
    }
    //Autolabeling when labels are not present
    for($i=0; $i<5; $i++) 
    {
        $tempx=$i+1;//For label autonumbering purpose
        if(empty($labels[$i])) $labels[$i]="label$tempx"; 
    }
	//print_r($labels);
	//print_r($values);

	//Making image here
    $image = imagecreatetruecolor(600,400);
 
    //Making needed colours here
    $background = imagecolorallocate($image, 200, 200, 200); //background
    $txt = imagecolorallocate($image, 10, 10, 10); //label colour
    $col = imagecolorallocate($image, 120, 120, 120); //column colour

    //Making sure values will fit in the desired drawing area
    if($notzero)
    {
        $maximal = max($values);
        $minimal = min($values);
        $ratio = (300 / (abs($maximal) + abs($minimal)));
    }
    
	//A place where columns will be put
    imagefilledrectangle($image, 0, 0, 600, 400, $background);

    //column drawing
    for($i=0; $i<5; $i++) 
    {
        imagefilledrectangle($image, (40+20*($i+1)+80*$i), 300, (40+100*($i+1)), 300-$values[$i]*$ratio, $col);
    }

    imageline($image, 20, 300, 580, 300, $txt);

    //For centering (as shown in one user's message at php.net web resource)
    function CenterImageString($image, $font_size, $x, $y, $image_width, $string, $color)
    {
        $text_width = imagefontwidth($font_size)*strlen($string);
        $center = ceil($x + ($image_width / 2));
        $xn = $center - (ceil($text_width / 2));
        imagestring($image, $font_size, $xn, $y, $string, $color);
    }

    //Making text labels
    for($i=0; $i<5; $i++) 
    {
        CenterImageString($image, 5, 60+100*$i, 350, 80, $labels[$i], $txt);
    }

    //Now create image!
    imagegif($image);
    imagedestroy($imamge);
    
	}
?>
