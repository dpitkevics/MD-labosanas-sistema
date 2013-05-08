<?php 
# This time you are allowed to do scripting and output 
# generation in the same file.

$graphSrc="http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";
if (isset ($_POST["apstiprinat"]))
{
	$graphSrc="graph.php?";
	for ($i=1; $i<=5; $i++)
		{
			if (isset ($_POST ["label".$i]) && is_string($_POST["label".$i]) && $_POST ["label".$i]!="")
				$graphSrc.="label".$i."=".$_POST["label".$i]."&";
			if (isset ($_POST["value".$i]) && is_numeric ($_POST["value".$i]) && $_POST ["value".$i]!="")
				$graphSrc.="value".$i."=".$_POST["value".$i]."&";
		}
	$graphSrc= substr($graphSrc, 0, -1);
}
#$graphSrc should point to graph.php with additional GET parameters

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
	    <form method="POST">
		<table id="userdata">
			<tr id="titles">
				<th>Legend title</th>
				<td><input type="text" name="label1" tabindex="1" <?php if (isset ($_POST["label1"]) && $_POST["label1"]!="" && is_string($_POST["label1"])) echo "value='". $_POST["label1"]. "'"; else echo "class = 'error'"?>/></td>
				<td><input type="text" name="label2" tabindex="3" <?php if (isset ($_POST["label2"]) && $_POST["label2"]!="" && is_string($_POST["label2"])) echo "value='". $_POST["label2"]. "'"; else echo "class = 'error'"?>/></td>
				<td><input type="text" name="label3" tabindex="5" <?php if (isset ($_POST["label3"]) && $_POST["label3"]!="" && is_string($_POST["label3"])) echo "value='". $_POST["label3"]. "'"; else echo "class = 'error'"?>/></td>
				<td><input type="text" name="label4" tabindex="7" <?php if (isset ($_POST["label4"]) && $_POST["label4"]!="" && is_string($_POST["label4"])) echo "value='". $_POST["label4"]. "'"; else echo "class = 'error'"?>/></td>
				<td><input type="text" name="label5" tabindex="9" <?php if (isset ($_POST["label5"]) && $_POST["label5"]!="" && is_string($_POST["label5"])) echo "value='". $_POST["label5"]. "'"; else echo "class = 'error'"?>/></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" name="value1" tabindex="2" <?php if (isset ($_POST["value1"])&& $_POST["value1"]!="" && is_numeric ($_POST["value1"])) echo "value='".$_POST["value1"]."'"; else echo "class= 'error'"?>/></td>
				<td><input type="text" name="value2" tabindex="4" <?php if (isset ($_POST["value2"])&& $_POST["value2"]!="" && is_numeric ($_POST["value2"])) echo "value='".$_POST["value2"]."'"; else echo "class= 'error'"?>/></td>
				<td><input type="text" name="value3" tabindex="6" <?php if (isset ($_POST["value3"])&& $_POST["value3"]!="" && is_numeric ($_POST["value3"])) echo "value='".$_POST["value3"]."'"; else echo "class= 'error'"?>/></td>
				<td><input type="text" name="value4" tabindex="7" <?php if (isset ($_POST["value4"])&& $_POST["value4"]!="" && is_numeric ($_POST["value4"])) echo "value='".$_POST["value4"]."'"; else echo "class= 'error'"?>/></td>
				<td><input type="text" name="value5" tabindex="10" <?php if (isset ($_POST["value5"])&& $_POST["value5"]!="" && is_numeric ($_POST["value5"])) echo "value='".$_POST["value5"]."'"; else echo "class= 'error'"?>/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" name="apstiprinat" />
	    </form>
	</aside>
</body>
</html>