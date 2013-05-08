<?php 
# This time you are allowed to do scripting and output 
# generation in the same file.

#$graphSrc should point to graph.php with additional GET parameters

error_reporting (E_ALL ^ E_NOTICE); 

$labels = array( null, null, null, null, null );
$values = array( null, null, null, null, null );

if ($_POST['label1']) { $labels[0] = $_POST['label1']; }
if ($_POST['label2']) { $labels[1] = $_POST['label2']; }
if ($_POST['label3']) { $labels[2] = $_POST['label3']; }
if ($_POST['label4']) { $labels[3] = $_POST['label4']; }
if ($_POST['label5']) { $labels[4] = $_POST['label5']; }

if ($_POST['value1']) { $values[0] = $_POST['value1']; }
if ($_POST['value2']) { $values[1] = $_POST['value2']; }
if ($_POST['value3']) { $values[2] = $_POST['value3']; }
if ($_POST['value4']) { $values[3] = $_POST['value4']; }
if ($_POST['value5']) { $values[4] = $_POST['value5']; }

if ($_POST) {
	$graphSrc = 'graph.php?label1='.urlencode($labels[0]).'&label2='.urlencode($labels[1]).'&label3='.urlencode($labels[2]).'&label4='.urlencode($labels[3]).'&label5='.urlencode($labels[4]);
	$graphSrc .= '&value1='.urlencode($values[0]).'&value2='.urlencode($values[1]).'&value3='.urlencode($values[2]).'&value4='.urlencode($values[3]).'&value5='.urlencode($values[4]);
} else {
	$graphSrc="http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";
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
	    <form method="POST">
		<table id="userdata">
			<tr id="titles">
				<th>Legend title</th>
				<td><input type="text" name="label1" tabindex="1" value="<?php echo $labels[0]; ?>" /></td>
				<td><input type="text" name="label2" tabindex="3" value="<?php echo $labels[1]; ?>" /></td>
				<td><input type="text" name="label3" tabindex="5" value="<?php echo $labels[2]; ?>" /></td>
				<td><input type="text" name="label4" tabindex="7" value="<?php echo $labels[3]; ?>" /></td>
				<td><input type="text" name="label5" tabindex="9" value="<?php echo $labels[4]; ?>" /></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" name="value1" tabindex="2" value="<?php echo $values[0]; ?>" /></td>
				<td><input type="text" name="value2" tabindex="4" value="<?php echo $values[1]; ?>" /></td>
				<td><input type="text" name="value3" tabindex="6" value="<?php echo $values[2]; ?>" /></td>
				<td><input type="text" name="value4" tabindex="7" value="<?php echo $values[3]; ?>" /></td>
				<td><input type="text" name="value5" tabindex="10" value="<?php echo $values[4]; ?>" /></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>