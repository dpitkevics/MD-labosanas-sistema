<?php 
# This time you are allowed to do scripting and output 
# generation in the same file.

$graphSrc="http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";

#$graphSrc should point to graph.php with additional GET parameters
if($_SERVER['REQUEST_METHOD'] == "POST")
{
      
      $graphSrc="graph.php";
      $graphSrc=$graphSrc
      .'?label1='.urlencode($_POST["label1"]) 
      .'&label2='.urlencode($_POST["label2"]) 
      .'&label3='.urlencode($_POST["label3"])
      .'&label4='.urlencode($_POST["label4"])
      .'&label5='.urlencode($_POST["label5"])
              
      .'&value1='.urlencode($_POST["value1"])
      .'&value2='.urlencode($_POST["value2"])
      .'&value3='.urlencode($_POST["value3"])
      .'&value4='.urlencode($_POST["value4"])
      .'&value5='.urlencode($_POST["value5"]);
      //$graphSrc = urlencode($graphSrc);
       //echo $graphSrc;
      //print_r($_POST);
      //header( 'Location:'.$graphSrc);//ok
}//
function vPostOrError($pcVariable, $bIsString)
{
   if($bIsString)
   {
      $pcTxt = strlen($_POST[$pcVariable]) ? $_POST[$pcVariable] : "";
   }
   else
   {
      $pcTxt = is_numeric($_POST[$pcVariable]) ? $_POST[$pcVariable] : "";
   }   
   return $pcTxt;
}
function pcCheckForError($pcVariable, $bIsString)
{
   if($bIsString)
   {
      $pcTxt = strlen($_POST[$pcVariable]) ? $_POST[$pcVariable] : "error";
   }
   else
   {
      $pcTxt = is_numeric($_POST[$pcVariable]) && $_POST[$pcVariable] >= 0 ? $_POST[$pcVariable] : "error";
   }   
   return $pcTxt;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>PHP Grapher</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<section>
		<img src="<?php echo $graphSrc; ?>" id="graph" alt="The graph" width="600" height="400" />
	</section>
        
	<aside>
	    <form action="index.php" method="POST">
		<table id="userdata">
			<tr id="titles">
				<th>Legend title</th>
				<td><input class ="<?php echo pcCheckForError("label1", 1) ?>" type="text" name="label1" tabindex="1"
                                           value ="<?php echo vPostOrError("label1", 1) ?>"
                                           /></td>
				<td><input class ="<?php echo pcCheckForError("label2", 1) ?>" type="text" name="label2" tabindex="3"
                                           value ="<?php echo vPostOrError("label2", 1) ?>"
                                           /></td>
				<td><input class ="<?php echo pcCheckForError("label3", 1) ?>" type="text" name="label3" tabindex="5"
                                           value ="<?php echo vPostOrError("label3", 1) ?>"
                                           /></td>
				<td><input class ="<?php echo pcCheckForError("label4", 1) ?>" type="text" name="label4" tabindex="7"
                                           value ="<?php echo vPostOrError("label4", 1) ?>"
                                           /></td>
				<td><input class ="<?php echo pcCheckForError("label5", 1) ?>" type="text" name="label5" tabindex="9"
                                           value ="<?php echo vPostOrError("label5", 1) ?>"
                                           /></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input class ="<?php echo pcCheckForError("value1", 0) ?>"  type="text" name="value1" tabindex="2"
                                           value="<?php echo vPostOrError("value1", 0) ?>"
                                           /></td>
				<td><input class ="<?php echo pcCheckForError("value2", 0) ?>" type="text" name="value2" tabindex="4"
                                           value="<?php echo vPostOrError("value2", 0)?>"
                                           /></td>
				<td><input class ="<?php echo pcCheckForError("value3", 0) ?>" type="text" name="value3" tabindex="6"
                                           value="<?php echo vPostOrError("value3", 0)?>"
                                           /></td>
				<td><input class ="<?php echo pcCheckForError("value4", 0) ?>" type="text" name="value4" tabindex="7"
                                           value="<?php echo vPostOrError("value4", 0)?>"
                                           /></td>
				<td><input class ="<?php echo pcCheckForError("value5", 0) ?>" type="text" name="value5" tabindex="10"
                                           value="<?php echo vPostOrError("value5", 0)?>"
                                           /></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>