<?php

#This file should generate the response image.
$mas=[];  // veidoju savu masīvu ar QUERY vērtībām.
$sk=[]; // atsevišķs masīvs tikai ar skaitliskām vērtībām

// salieku GET elementu vērtības savā masīvā $mas, jau decodētas
// atsevišķi izveidoju ciparu masīvu, kurā ir skaitļi un tikai korektie. Nekorektie masīvā tiek saglabāti ar vērtību -1
for ($i=1; $i<6; $i++)  // salieku GET elementu vērtības savā masīvā $mas, jau decodētas
{
    $tmp_label = 'label' . $i;
    if (isset($_GET[$tmp_label]))
      $mas[$tmp_label] = urldecode ($_GET[$tmp_label]);
    $tmp_value = 'value' . $i;
    if (isset($_GET[$tmp_value]))
    {
      $mas[$tmp_value] = urldecode ($_GET[$tmp_value]);
      if (is_numeric($mas[$tmp_value]))   // tīri skaitliskajām vērtībām izveidoju vēl vienu skaitļu masīvu $sk
      {   $sk[$i]=floatval($mas[$tmp_value]);
          if ($sk[$i]<0)  // pārbaudam uz negatīvām vērtībām
              $sk[$i]=-1;
      }        
      else
          $sk[$i]=-1;   // neskaitliskus un nepareizus skaitļus masīvā marķēju ar vērtību -1
    }
}
$max = 0;
foreach ($sk as $key)  // atrodam maksimālo vērtību
    if ($key>$max)
        $max=$key;

$merogs = 0;
if ($max>0)  
    $merogs = 300 / ($max * 1.1);  // Izrēķinam mērogu, jeb vienas vienības lielumu


// izveidojam bildi un aizpildam ar baltu krāsu
$bilde = imagecreatetruecolor(600, 400);
$krasa = imagecolorallocate($bilde, 255, 255, 255);
imagefill($bilde,0,0,$krasa);
$melna = imagecolorallocate($bilde, 0, 0, 0);

$font = 'arial.ttf';

if (sizeof($sk)>0){  // Pieliekam pārbaudi, lai nenotiek zīmēšana pie neesošām vērtībām un tukša masīva
  for ($i=1; $i<6; $i++) // Tagad zīmējam stabiņus
  {
    $krasa = imagecolorallocate($bilde, rand(0,255), rand(0,255), rand(0,255));
    if ($sk[$i]>=0)  // zīmējam tos stabiņus, kur ir cipars
    {
        $h = round($sk[$i] * $merogs);  // stabiņa augstums
        $x = 60 + ($i-1) * 100; // stabiņa sākuma X koordināte
        $y = 300-$h; // stabiņa y koordināte
        $x2 = $x + 80;
        $y2 = 300;
        imagefilledrectangle($bilde, $x, $y, $x2, $y2, $krasa );
        
    }
    else 
    {
        // ko daram ar nepareizām vērtībām
        $x = 60 + ($i-1) * 100; // stabiņa sākuma X koordināte
        imagettftext($bilde, 20, 90, $x+50, 295, $melna, $font, 'Nekorekti dati');
//        imagestringup($bilde, 5, $x+30, 295, 'Nekorekti dati', $melna);   // otra teksta rakstīšanas metode, ja nedarbojas pirmā
    }
    // Tagad stabiņu leģendas...
    $x = 70 + ($i-1) * 100;
//    imagestring($bilde,5,$x, 350, $mas['label'.$i] ,$melna);  // otra teksta rakstīšanas metode, ja nedarbojas pirmā
    imagettftext($bilde, 12, 0, $x, 350, $melna, $font, $mas['label'.$i]);
  }
// uzzīmējam melnu pamata līniju zem stabiņiem
  imagefilledrectangle($bilde, 20, 300, 580, 303, $melna );
  
} // beigas if nosacījumam, kad vispār kaut kas ir jāzīmē...
unset($mas);  // atbrīvojam atmiņu, bet tas laikam ir lieki
unset($sk);


//eksportējam bildi
header ('Content-Type: image/png');
imagepng($bilde);

// iznīcinam bildes objektu
imagedestroy($bilde);

?>