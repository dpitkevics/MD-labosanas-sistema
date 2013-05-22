<?php 
# This time you are allowed to do scripting and output 
# generation in the same file.
$graphSrc="http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";
if (isset ($_POST["poga"]))
{
	$gurl=http_build_query($_POST);
	$graphSrc="graph.php";
	$graphSrc=$graphSrc."?".$gurl;
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
				<td><input type="text" name="label1" tabindex="1" <?php if (isset ($_POST["poga"])) {if (is_string($_POST["label1"])==false || $_POST["label1"]=="") echo "value='Nosaukums1'"; else echo "value='".$_POST["label1"]."'";} ?>/></td>
				<td><input type="text" name="label2" tabindex="3" <?php if (isset ($_POST["poga"])) {if (is_string($_POST["label2"])==false || $_POST["label2"]=="") echo "value='Nosaukums2'"; else echo "value='".$_POST["label2"]."'";} ?>/></td>
				<td><input type="text" name="label3" tabindex="5" <?php if (isset ($_POST["poga"])) {if (is_string($_POST["label3"])==false || $_POST["label3"]=="") echo "value='Nosaukums3'"; else echo "value='".$_POST["label3"]."'";} ?>/></td>
				<td><input type="text" name="label4" tabindex="7" <?php if (isset ($_POST["poga"])) {if (is_string($_POST["label4"])==false || $_POST["label4"]=="") echo "value='Nosaukums4'"; else echo "value='".$_POST["label4"]."'";} ?>/></td>
				<td><input type="text" name="label5" tabindex="9" <?php if (isset ($_POST["poga"])) {if (is_string($_POST["label5"])==false || $_POST["label5"]=="") echo "value='Nosaukums5'"; else echo "value='".$_POST["label5"]."'";} ?>/></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" name="value1" tabindex="2" <?php if (isset ($_POST["poga"])) {if (is_numeric ($_POST["value1"])==false) echo "class='error'"; echo "value='".$_POST["value1"]."'";} ?> /></td>
				<td><input type="text" name="value2" tabindex="4" <?php if (isset ($_POST["poga"])) {if (is_numeric ($_POST["value2"])==false) echo "class='error'"; echo "value='".$_POST["value2"]."'";} ?> /></td>
				<td><input type="text" name="value3" tabindex="6" <?php if (isset ($_POST["poga"])) {if (is_numeric ($_POST["value3"])==false) echo "class='error'"; echo "value='".$_POST["value3"]."'";} ?> /></td>
				<td><input type="text" name="value4" tabindex="7" <?php if (isset ($_POST["poga"])) {if (is_numeric ($_POST["value4"])==false) echo "class='error'"; echo "value='".$_POST["value4"]."'";} ?> /></td>
				<td><input type="text" name="value5" tabindex="10" <?php if (isset ($_POST["poga"])) {if (is_numeric ($_POST["value5"])==false) echo "class='error'"; echo "value='".$_POST["value5"]."'";} ?> /></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" name="poga" />
	    </form>
	</aside>
</body>
</html>