<?php
mb_internal_encoding('UTF-8');

header('Content-type: image/png');
$width = 600;
$height = 400;
$im = imagecreatetruecolor($width, $height);
$white = imagecolorallocate($im, 255, 255, 255);
$black = imagecolorallocate($im, 0, 0, 0);
$gray = imagecolorallocate($im, 0xB0, 0xB0, 0xB0);
imagefilledrectangle($im, 0, 0, $width, $height, $white);

if(!empty($_GET))
{
  $labels = array();
  for($i = 1; $i <= 5; $i++)
  {
    $kv = 'l'.$i;
    if(isset($_GET[$kv]) && $_GET[$kv] != '')
    {
      $labels[$i-1] = $_GET[$kv];
    }
    else
    {
      $labels[$i-1] = 'label'.$i;
    }
  }
  $values = array();
  for($i = 1; $i <= 5; $i++)
  {
    $kv = 'v'.$i;
    if(isset($_GET[$kv]) && is_numeric($_GET[$kv]) &&
       strlen($_GET[$kv]) < 30 && strpos($_GET[$kv], 'e') === false && strpos($_GET[$kv], 'E')===false)
    {
      $values[$i-1] = floatval($_GET[$kv]);
    }
    else
    {
      $values[$i-1] = 0;
    }
  }
  


  $minv = min($values);
  $maxv = max($values);


  $h0 = 7*$height/8;
  if($minv == $maxv || $minv <= 0.75*$maxv){	
	  if($maxv <= 0)$maxv = 1;
	  if($minv < 0)$h0 = 350 + (300)*$minv/($maxv-$minv);
	  $minv = 0;					
  }else{
	  $minv = $maxv - 4*($maxv-$minv);
  }

  for($i = 0; $i < 5; $i++)
  {
	  $h = ($h0-50)*($values[$i]-$minv)/($maxv-$minv);
	  imagefilledrectangle($im, 60+100*$i, $h0-$h, 60+100*$i+80, $h0-$h+$h, $gray);
  }


  for($i = 0; $i < 5; $i++)
  {
    //imagettftext($im, 12, 0,100+100*$i-(imagefontwidth(2)*mb_strlen($labels[$i]))/2, 370, $black, 'ttf-droid/DroidSans.ttf', $labels[$i]);
	  imagestring($im, 3,100+100*$i-(imagefontwidth(3)*mb_strlen($labels[$i]))/2, 370,$labels[$i], $black);
  }

  for($i = 0; $i < 5; $i++)
  {
	  $h = ($h0-50)*($values[$i]-$minv)/($maxv-$minv);
	  $x = 140+100*$i;
	  $y = $h0-$h;
	  if($values[$i] > 0)$y+=imagefontwidth(3)*mb_strlen($values[$i]);
	  //imagettftext($im, 12, -90, $x, $y, $black, 'ttf-droid/DroidSans.ttf', $values[$i]);
    imagestringup($im, 3,$x, $y, $values[$i], $black);
  }

  imagefilledrectangle($im, $width/30, $h0, $width-$width/30, $h0+2, $black);
}

imagepng($im);
imagedestroy($im);
?>
