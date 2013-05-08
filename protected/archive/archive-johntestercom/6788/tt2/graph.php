<?php
//Renārs Vilnis RV11036 
$title2=array();
$data2=array();
$title2['label0']= $_GET['label0']; 
$title2['label1']= $_GET['label1']; 
$title2['label2']= $_GET['label2']; 
$title2['label3']= $_GET['label3']; 
$title2['label4']= $_GET['label4']; 
$data2['value0']= $_GET['value0']; 
$data2['value1']= $_GET['value1']; 
$data2['value2']= $_GET['value2']; 
$data2['value3']= $_GET['value3']; 
$data2['value4']= $_GET['value4'];  
$im = imagecreatetruecolor(600, 400);
$background_color=imagecolorallocate($im, 255, 255, 255);
imagefill($im, 0, 0, $background_color);
$black = imagecolorallocate($im, 0, 0, 0);
$grey = imagecolorallocate($im, 205, 205, 205);
$big_value=20;
{
	$c=0;
	do{
		if($big_value==0){
			if(is_numeric($data2["value$c"]))$big_value=$data2["value$c"];
		}
		else if(is_numeric($data2["value$c"])) {
			if($data2["value$c"]>$big_value) $big_value=$data2["value$c"];
		}
		
	$c++;
	} while ($c<5);
}
$ratio=280/$big_value;
$rect_x=60;
$rect_y=140;
for($s=0;$s<5;$s++){ //cikls ,kurš katru grafiku uzzīmēs
	if(is_numeric($data2["value$s"]) && $data2["value$s"]>=0){
		$rect_height=300-$ratio*$data2["value$s"];

		imagefilledrectangle($im, $rect_x, 300, $rect_y, $rect_height, $grey);
	}

	$rect_x=$rect_x+100;
	$rect_y=$rect_y+100;
}

$def_text = 'no name';
$font = './Helvetica.ttf'; //helvetica skaistāka :D
$text_pos=100;
for($s=0;$s<5;$s++){ //cikls ,title izdrukāšanai
	if($title2["label$s"]!=NULL){
		$title_lenght=imagettfbbox(12, 0, $font, $title2["label$s"]);
		$text_start=($title_lenght[2]-$title_lenght[0])/2;
		imagettftext($im, 12, 0, $text_pos-$text_start, 350, $black, $font, $title2["label$s"]);
	}
	else{
		$title_lenght=imagettfbbox(12, 0, $font, $def_text);
		$text_start=($title_lenght[2]-$title_lenght[0])/2;
		imagettftext($im, 12, 0, $text_pos-$text_start, 350, $black, $font,$def_text);
	}
	$text_pos=$text_pos+100;
}
$colorforline = imagecolorallocate($im, 127, 127, 127); //apakšējā līnija 2px plata(takā nebija ļiels platums tad funkciju nevēlējos rakstīt)
imageline($im,20,300,580,300,$colorforline);
imageline($im,20,301,580,301,$colorforline);
header ('Content-Type: image/jpeg');
imagejpeg($im);
imagedestroy($im); 
?>