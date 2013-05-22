<?php 

$label = array();
$value = array();

if (!empty($_POST))
for ($i=0; $i<5; $i++)
{
	$label[$i] = $_POST['label'.($i+1)];
	$value[$i] = $_POST['value'.($i+1)];
}
else 
for ($i=0; $i<5; $i++)
{
	$label[$i] = "";
	$value[$i] = "";
}

$val_q = http_build_query($value, 'val');
$lab_q = http_build_query($label, 'lab');

$class = array();
$class_v = array();
if (!empty($_POST)) {
	for ($i=0; $i<5; $i++) {
		if ($label[$i] == "") $class[$i] = "error"; else $class[$i] = "";
		if (!is_numeric($value[$i])) $class_v[$i] = "error"; else $class_v[$i] = "";
	}
		$graphSrc = "graph.php?$val_q&$lab_q";
} else 
{		
		for ($i=0; $i<5; $i++)
		{
			$class[$i] = "";
			$class_v[$i] = "";
		}
		$graphSrc = "http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";
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
				<td><input <?php echo "class =\" ".$class[0]."\" "; ?> value="<?php echo $label[0]; ?>" type="text" name="label1" tabindex="1"/></td>
				<td><input <?php echo "class =\" ".$class[1]."\" "; ?> value="<?php echo $label[1]; ?>" type="text" name="label2" tabindex="3"/></td>
				<td><input <?php echo "class =\" ".$class[2]."\" "; ?> value="<?php echo $label[2]; ?>" type="text" name="label3" tabindex="5"/></td>
				<td><input <?php echo "class =\" ".$class[3]."\" "; ?> value="<?php echo $label[3]; ?>" type="text" name="label4" tabindex="7"/></td>
				<td><input <?php echo "class =\" ".$class[4]."\" "; ?> value="<?php echo $label[4]; ?>" type="text" name="label5" tabindex="9"/></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input <?php echo "class =\" ".$class_v[0]."\" "; ?> value="<?php echo $value[0]; ?>" type="text" name="value1" tabindex="2"/></td>
				<td><input <?php echo "class =\" ".$class_v[1]."\" "; ?> value="<?php echo $value[1]; ?>" type="text" name="value2" tabindex="4"/></td>
				<td><input <?php echo "class =\" ".$class_v[2]."\" "; ?> value="<?php echo $value[2]; ?>" type="text" name="value3" tabindex="6"/></td>
				<td><input <?php echo "class =\" ".$class_v[3]."\" "; ?> value="<?php echo $value[3]; ?>" type="text" name="value4" tabindex="7"/></td>
				<td><input <?php echo "class =\" ".$class_v[4]."\" "; ?> value="<?php echo $value[4]; ?>" type="text" name="value5" tabindex="10"/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>