<?php
 header("Content-type: image/jpeg");
         
        // read the post data
 $label1 = $_GET['label1'];
 $label2 = $_GET['label2'];
 $label3 = $_GET['label3'];
 $label4 = $_GET['label4'];
 $label5 = $_GET['label5'];
 
 $label1 = substr($label1,0,3);
 $label2 = substr($label2,0,3);
 $label3 = substr($label3,0,3);
 $label4 = substr($label4,0,3);
 $label5 = substr($label5,0,3);
 
 $value1 = $_GET['value1'];
 $value2 = $_GET['value2'];
 $value3 = $_GET['value3'];
 $value4 = $_GET['value4'];
 $value5 = $_GET['value5'];
 
 	$label = array($label1,$label2,$label3,$label4,$label5);
        $data = array($value1,$value2,$value3,$value4,$value5);
        $sum = array_sum($data);
   
        $height = 300;
        $width = 320;
        
        $im = imagecreate($width,$height); // width , height px

        $white = imagecolorallocate($im,255,255,255); 
        $black = imagecolorallocate($im,0,0,0);   
        $red = imagecolorallocate($im,255,0,0);   
      

     
        imageline($im, 10, 230, 300, 230, $black);
    

        $x = 20;   
        $y = 230;   
        $x_width = 35;  
        $y_ht = 0; 
       
        for ($i=0;$i<=4;$i++){
        
          $y_ht = ($data[$i]/$sum)* $height;    
          
              imagerectangle($im,$x,$y,$x+$x_width,($y-$y_ht),$red);
              imagestring( $im,2,$x+8,$y+50,$label[$i],$black);
              
          $x += ($x_width+20);  
         
        }
        
        imagejpeg($im);
?>