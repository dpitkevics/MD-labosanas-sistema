<?php
header('Content-type: image/png');

$img=imagecreatetruecolor(600,400);
$white = imagecolorallocate($img, 255, 255, 255);
$gray = imagecolorallocate($img, 200, 200, 200);
$black = imagecolorallocate($img, 0, 0, 0);
imagefill($img, 0, 0, $white); 

//Tukšu datu gadījumā
if(sizeof($_GET)==0){
	imagestring($img, 4, 275, 190,  'Nav datu', $black);
	imagepng($img);
	imagedestroy($img);
	die();
}

//Pārliecinās, ka _visi_ GET eksistē gadījumam, ja lietotājs GET vērtības padod manuāli
$vals=array('label1','label2','label3','label4','label5','value1','value2','value3','value4','value5');
foreach($vals as $v) if(!isset($_GET[$v])) $_GET[$v]='';

//Sapako datus atbilstošos masīvos
$labels=array($_GET['label1'],$_GET['label2'],$_GET['label3'],$_GET['label4'],$_GET['label5']);
$values=array($_GET['value1'],$_GET['value2'],$_GET['value3'],$_GET['value4'],$_GET['value5']);

imageline($img,0,300,600,300,$black);
foreach($values as &$val2) if (!is_numeric($val2)) $val2=0;

//Uzzīmē Leiblus
$o=60; $s=100; $c=1;
foreach($labels as $label){
	if($label=='') $label='Label '.$c; $c++;
	if(strlen($label)>10) $label=substr($label,0,8).'..';
	$pos = ceil((100 - (imagefontwidth(5)*strlen($label))) / 2);
	imagestring($img, 5, $o+$pos-10, 350, $label, $gray);
	$o+=$s;
}

//Uzzīmē Barus
$o=60; $s=80; $m=20; max($values)==0 ? $unit=280 : $unit=280/max($values);
foreach($values as $val){
	$offset=300-($val*$unit);
	imagefilledrectangle($img,$o,$offset, $o+$s,299, $gray);
	$o+=$s+$m;
}
imagepng($img);
imagedestroy($img);
?>