<?php
    header('Content-type: image/png');
    create_image();
    
    function  create_image(){
        //Reading data that is used in the graph
        $labels=array();
        $values=array();
        for($i=1;$i<6;$i++){
            $value = 'value'.$i;
            $label = 'label'.$i;
            if(isset($_GET[$value]) && !empty($_GET[$value])&& is_numeric($_GET[$value])){
                $values[$i]=  floatval($_GET[$value]);
            }else{
                $values[$i]=0;
            }
            if(isset($_GET[$label]) && !empty($_GET[$label])){
                $labels[$i]= $_GET[$label];
            }
        }
        
        $img = imagecreatetruecolor(600,400);
        imagesavealpha($img, true); 
        $background_color = imagecolorallocate($img, 255, 255, 255);  // white
        imagefill($img, 0, 0, $background_color);
        $textColor = imagecolorallocate($img, 50, 50, 50);
        
        $img_height = 400;
        $img_width = 600;
        $graph_height = 320;
        $margins = 40;
        $line_color = imagecolorallocate($img, 0, 0, 0);
        $ratio = $graph_height/max($values);
        $bar_color = imagecolorallocatealpha($img, 215, 215, 215, 30); // transparent color
        //Drawing horizontal lines
        $horizontal_lines=6;
        $horizontal_gap=$graph_height/$horizontal_lines;
        for($i=0;$i<$horizontal_lines;$i++){
               $y=$img_height - $margins - $horizontal_gap * $i;
               imageline($img,$margins,$y,$img_width-$margins,$y,$line_color);
               $v=intval($horizontal_gap * $i /$ratio);
               imagestring($img,2,20,$y-5,$v,$textColor);
        }
        imageline($img, $margins, 60, $margins, 360, $line_color);
        //Constructin rectangles
        $total_bars = 5;
        $gap = 22;
        $bar_width = 75;
        for($i=0;$i<$total_bars; $i++){
            $x1= $margins + $gap + $i * ($gap+$bar_width) ;
            $x2= $x1 + $bar_width;
            $y1=$margins +$graph_height- intval($values[$i+1] * $ratio) ;
            $y2=$img_height-$margins;
            if($values[$i+1]>0){
                imagefilledrectangle($img,$x1,$y1,$x2,$y2,$bar_color);
            }
            if(isset($values[$i+1]) && $values[$i+1]>0)imagestring($img,2,$x1+25,$y1-15,round($values[$i+1],2),$textColor);
            if(isset($labels[$i+1]))imagestring($img,2,$x1+20,$img_height-35,$labels[$i+1],$textColor);
        } 
        
        imagepng($img);
        imagedestroy($img);
    }
?>
