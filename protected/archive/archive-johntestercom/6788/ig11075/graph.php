<?php
//Iļja Gubins, ig11075
header('Content-type: image/png'); #This file should generate the response image.

if(isset($_GET) && array_key_exists('label1',$_GET) ) { //not specifically label1,
                                //could be anything from the list of what we passed
    //_GET values
    $labels = Array($_GET['label1'], $_GET['label2'], $_GET['label3'], $_GET['label4'],$_GET['label5']);
    $values = Array($_GET['value1'], $_GET['value2'], $_GET['value3'], $_GET['value4'],$_GET['value5']);

    //Moderating _GET values
    $okay=false; //bool variable to be sure at least one value is not 0 (for ratio for normalization)
    for($i=0; $i<5; $i++) {
        if(!is_numeric($values[$i]) || $values[$i]<0) $values[$i]=0; //0 height for invalid values
        else $okay=true;
    }
    for($i=0; $i<5; $i++) {
        $b=$i+1;
        if(empty($labels[$i])) $labels[$i]="label$b"; //assigning labels automatically for empty labels
    }

    //Image constructor
    $image = @imagecreatetruecolor(600,400)
             or die('GD image stream died!');

    //Colours
    $background = imagecolorallocate($image, 255, 255, 255); //white background
    $columns = imagecolorallocate($image, 198, 198, 198); //column filling colour, #C6C6C6=(198,198,198)
    $text = imagecolorallocate($image, 0, 0, 0); //colour for text and line

    //Normalization for values
    if($okay){ //if at least one value is not 0
        $largest = max($values);
        $smallest = min($values); //if smallest==0, then max column will have height of 300 (not very pretty)
        $ratio = (300 / (abs($largest) + abs($smallest)));
    }else{ //if all values are 0 we are making $ratio=1 (anyway 0*$ratio=0)
        $ratio=1;
    }

    //Filling in
    imagefilledrectangle($image, 0, 0, 600, 400, $background); //background

    for($i=0; $i<5; $i++) { //bars
        imagefilledrectangle($image, (40+20*($i+1)+80*$i), 300, (40+100*($i+1)), 300-$values[$i]*$ratio, $columns);
	}

    imageline($image, 20, 300, 580, 300, $text); //line

    function centerimagestring($image, $font_size, $x, $y, $image_width, $string, $color)
    {                                                     //Function for printing out centered text string
        $text_width = imagefontwidth($font_size)*strlen($string);
        $center = ceil($x + ($image_width / 2));
        $xn = $center - (ceil($text_width/2));
        imagestring($image, $font_size, $xn, $y, $string, $color); //imagestring() doesn't support UTF-8 by the way!
    }

    for($i=0; $i<5; $i++) { //text labels
        centerimagestring($image, 5, 60+100*$i, 325, 80, $labels[$i], $text);
        //also, changed the default layout a little bit, so the text now is on 325px, not on 350px
    }

    //Creating image
    imagepng($image);
    imagedestroy($image);

}else{

    //if no _GET variables were received (user accidently navigated to graph.php without _GET)
    $blankSrc="http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";
    $image = @imagecreatefromgif($blankSrc);
    imagegif($image);
    imagedestroy($image);
}