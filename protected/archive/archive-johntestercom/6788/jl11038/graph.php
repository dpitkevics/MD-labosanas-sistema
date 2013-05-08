<?php
//izveidojam masivu
$data = Array();
for($i = 1; $i < 6; $i++)
{
	// tiek pieskirta DEFAULT skaitla vertiba - 0, ja netiek ievadits nekads skaitlis
	if (empty($_GET["value".$i])) $data["value".$i] = 0;
	// tiek pieskirta DEFAULT skaitla vertiba - 0, ja netiek ievadits cipars
	else if (isset($_GET["value".$i]) && !is_numeric($_GET["value".$i])) $data["value".$i] = 0;
	// nodrosinam to, ka nevares ievadit negativu skaitli
	else if ($_GET["value".$i] < 0) $data["value".$i] = 0;		
	else $data["value".$i] = $_GET["value".$i];
	
	// tiek pieskirta DEFAULT teksta vertiba - "label" + nr., kurð label tas ir(piemeram, label4), ja netiek ievadits nekads teksts
	if (empty($_GET["label".$i])) $data["label".$i] = "label".$i;	
	// tiek parbaudits, vai label ir string veida, ja nav, tad tiek pieskrita defaulta vertiba - "label" + nr.
	else if (isset($_GET["label".$i]) && !is_string($_GET["label".$i])) $data["label".$i] = "label".$i;
	else $data["label".$i] = $_GET["label".$i];	
}

// izveido laukumu, un noklaj to ar baltu krasu, lai nav default melns, ko rada funkcija imagecreatetruecolor
$canvas = imagecreatetruecolor(600, 400);
$white = imagecolorallocate($canvas, 255, 255, 255);
imagefilledrectangle($canvas, 0, 0, 600, 400, $white);

// uzzime liniju
imagesetthickness($canvas, 2);
$gray = imagecolorallocate($canvas, 191, 191, 191);
imageline($canvas, 20, 301, 580, 301, $gray);

// aprekina vajadzigo mainigo, lai varetu velak zimet grafiku
$max = $data["value1"];
for($i = 2; $i < 6; $i++)
{
	if($data["value".$i]>$max) $max = $data["value".$i];
}

$min = $data["value1"];
for($i = 2; $i < 6; $i++)
{
	if($data["value".$i]<$min) $min = $data["value".$i];
}

if ($max==0 || $min==0)
{
	if ($min==0 && $max!=0) $tmp = 300/$max;
	if ($max==0) $tmp = 300;
}
else $tmp = 300/($max+$min);


// izveido vajadzigo krasu, un uzzime vajadzigos grafikus
$whitegray = imagecolorallocate($canvas, 205, 205, 205);
for($i = 1; $i < 6; $i++)
{
	imagefilledrectangle($canvas, 60+(($i-1)*100), 300-($data["value".$i])*$tmp, 60+(($i-1)*100)+80, 300, $whitegray);
}

// panem no faila vajadzigo fontu un pievieno zimejuma klat vajadzigos grafika virsrakstus
$font = 'arial.ttf';
for($i = 1; $i < 6; $i++)
{
	imagettftext($canvas, 12, 0, 79+(($i-1)*100), 350, $whitegray, $font, $data["label".$i]);
} 

// sagatavosanas darbi, darba beigsanai
header('Content-Type: image/jpeg');
imagejpeg($canvas);
imagedestroy($canvas);

?>