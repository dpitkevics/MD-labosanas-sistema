<?php
/*
 * #This file will generate the response image.
 * Author: Vladislavs Sokurenko ID:vs10037
 * date: 2012.10.07
 * company: Latvijas Universitate
 * mail: vladislavs.sokurenko@gmail.com
 */

//error_reporting(E_ALL);
$piLabels = array();
$piValues = array();
$piCollumns = array();
$piLabels = piIinitLabelsArray($piLabels);
$piValues = piIinitValuesArray($piValues);

$iMax = iGetMax($piValues);
$piCollumns = vGetPixelsForColumns($iMax, $piValues);
//echo "max ==".$iMax."!!!!";
//echo '<br />';
//echo $iMax."###########";
//print_r($piCollumns);
//exit();

header ('Content-Type: image/png; charset=utf-8');
$im = @imagecreatetruecolor(600, 400)
      or die('Cannot Initialize new GD image stream');
$text_color = imagecolorallocate($im, 0, 0, 0);
$background_color = imagecolorallocate($im, 255, 255, 255);
imagefilledrectangle ($im, 0,
        0, 600, 400, $background_color);
//imagefill ($im, 600, 400, $text_color);
//Labels 
//imagestring($im, 1, 5, 5,  'A Simple Text String', $text_color);
//imagestring($im, 1, 1, 382,  $_GET["label1"] , $text_color);
iDrawLabels($im, $text_color,$piLabels);
imageline ($im, 20, 301, 580, 301, $text_color);
vDrawColumns($im, $piCollumns);
imagepng($im);
imagedestroy($im);


/*
 * Thus is to initialise array of labels and check them for spec chars 
 * input:
 * piLabels - array to initialise with labels from get
 * return piLabels - initialised piLabels
 */
function piIinitLabelsArray($piLabels)
{
   $i = 0;
   $j = 1;
   $piLabels = array();
   
   while($i < 5)
   {
      $piLabels[$i] = htmlspecialchars($_GET["label".$j]);//Do we need to check string to be string ?
      //echo $piLabels[$i];
      $i++;
      $j++;
   }
   
   return $piLabels;
}
/*
 * This is to initialise array of values and check for numeric or spec char
 * will also put 0 if value is not numeric
 * input:
 * piValues - array to initialise with vales from get
 * return piValues - initialised values
 */
function piIinitValuesArray($piValues)
{
   $i = 0;
   $j = 1;
   $piValues= array();
   
   while($i < 5)
   {
      $piValues[$i] = is_numeric(htmlspecialchars($_GET["value".$j])) &&
               $_GET["value".$j] > 0?
              htmlspecialchars($_GET["value".$j]) : 0;
      //echo $piLabels[$i];
      $i++;
      $j++;
   }
   
   return $piValues;
}
/*
 * This is to calculate pixels for columns
 * input values:
 * iMax - max value of values from get
 * piValues - array of all values
 * 
 * returns:
 * piCollums - array of pixels for every column
 * 
 */
function vGetPixelsForColumns($iMax, $piValues)
{
   $piCollumns = array();
   $i = 0;
   while( $i < 5)
   {
      
      //printf("iMax %d Value %d IsSet %d isInt %d\n",$iMax, $_GET["value".$j],
      //       isset($_GET["value".$j]),
      //        is_int($_GET["value".$j])); 
      //echo '<br />';
      
      if($piValues[$i])
      { 
         $piCollumns[$i] = 300 * $piValues[$i] / $iMax;
      }
      else
      {
         $piCollumns[$i] = 0;
      }
      //echo "pixels [".$piCollumns[$i]."]";
      //echo '<br />';
      $i++;
   }   
   return $piCollumns;
}
/*
 * will determine max and return it
 * input: all values array
 */
function iGetMax($piValues)
{
   $i = 0;
   $iMax = $piValues[$i];
   $i++;
   
   while($i < 5)
   {
      if($iMax < $piValues[$i])
      {
         $iMax = $piValues[$i];
      }   
      $i++;
   }
   return $iMax;
}
/*
 * will draw labels
 * input:
 * im - handler for console
 * text_color - color for text
 * piLabels - array of labels
 */
function iDrawLabels($im, $text_color, $piLabels)
{
   $x = 60;
   $i = 0;
   while($i < 5)
   {
      
      imagestring($im, 1, $x + 20, 350,
              strlen($piLabels[$i]) ? $piLabels[$i] : "No Label",
              $text_color);
      //imagettftext ($im, 12, 0, $x + 10, 350, $text_color,
      //        "arial.ttf", $_GET["label".$i] );
      $x += 100;
      $i++;
 //array imagettftext 
//(resource image, int size, int angle, int x, int y, int col, string fontfile, string text)     
   }
}

/*
 * will draw columns
 * input: 
 * im - handler for console
 * piCollumns - array of pixels count for columns
 */

function vDrawColumns($im, $piCollumns)
{
   $x = 60;
   $i = 0;
   
   $text_color = imagecolorallocate($im, 203, 203, 203);
   
   while($i < 5)
   {
      $i++;
      imagefilledrectangle ($im, $x,
        300, $x + 80,  300 - $piCollumns[$i -1], $text_color);
      $x += 100;
      
   }
}
?>