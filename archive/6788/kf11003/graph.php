<?php
for ($i=0; $i<10; $i++)
    $arr[$i] = $_GET['arr_' . $i];

    $zimejums = @imagecreate(600, 400);
    $background_color = imagecolorallocate ($zimejums, 255, 255, 255);
    $peleks = imagecolorallocate ($zimejums, 140, 140, 140);
    
    $i=0;
    
    for ($x=5; $x<10; $x++){
        if ($arr[$x]>$i) $i=$arr[$x];
    }   
    
    if($i!==0){
        $i=280/$i;   

        imagefilledrectangle ($zimejums, 60, 300-$arr[5]*$i, 140, 300, $peleks);
        imagefilledrectangle ($zimejums, 160, 300-$arr[6]*$i, 240, 300, $peleks);
        imagefilledrectangle ($zimejums, 260, 300-$arr[7]*$i, 340, 300, $peleks);
        imagefilledrectangle ($zimejums, 360, 300-$arr[8]*$i, 440, 300, $peleks);
        imagefilledrectangle ($zimejums, 460, 300-$arr[9]*$i, 540, 300, $peleks);
    
    }
    $stripa = imagecolorallocate($zimejums, 0, 0, 0);
    imageline ($zimejums, 20, 300, 580, 300, $stripa);
    imagestring ($zimejums, 15, 60, 350, $arr[0], $peleks);
    imagestring ($zimejums, 15, 160, 350, $arr[1], $peleks);
    imagestring ($zimejums, 15, 260, 350, $arr[2], $peleks);
    imagestring ($zimejums, 15, 360, 350, $arr[3], $peleks);
    imagestring ($zimejums, 15, 460, 350, $arr[4], $peleks);
    header ( 'Content-type: image/png' );
    imagepng( $zimejums);
    imagecolordeallocate ( $background_color);
    imagecolordeallocate ( $peleks);
    imagecolordeallocate ( $stripa);
    imagedestroy($zimejums);
?>