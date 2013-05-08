<?php 

function stripslashes_array($array) 
{
   return is_array($array) ?
     array_map('stripslashes_array', $array) : stripslashes($array);
}
if (get_magic_quotes_gpc()) 
   $_POST = stripslashes_array($_POST);

$label = array();
$value = array();

if (!empty($_POST))   
for ($i=0; $i<5; $i++)
{
	$label[$i] = $_POST['label'.($i+1)];
	$value[$i] = $_POST['value'.($i+1)];
}
else 
for ($i=0; $i<10; $i++)
{
	$label[$i] = "";
	$value[$i] = "";
}

$value_q = http_build_query($value, 'val');
$label_q = http_build_query($label, 'lab');

if (!empty($_POST)) 
{
	for ($i=0; $i<5; $i++)
	{
		if ($label[$i] == "") $label[($i+5)] = "class = \"error\" "; else $label[($i+5)] = "";
		if (!is_numeric($value[$i])) $value[($i+5)] = "class = \"error\" "; else $value[($i+5)] = "";
		$label[$i] = htmlspecialchars($label[$i]);
		$value[$i] = htmlspecialchars($value[$i]);
	}
	$graphSrc = "graph.php?$value_q&$label_q";
}	else	$graphSrc = "graph.php?blank=1";


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
				<td><input <?php echo $label[5]; ?> value="<?php echo $label[0]; ?>" type="text" name="label1" tabindex="1"/></td>
				<td><input <?php echo $label[6]; ?> value="<?php echo $label[1]; ?>" type="text" name="label2" tabindex="3"/></td>
				<td><input <?php echo $label[7]; ?> value="<?php echo $label[2]; ?>" type="text" name="label3" tabindex="5"/></td>
				<td><input <?php echo $label[8]; ?> value="<?php echo $label[3]; ?>" type="text" name="label4" tabindex="7"/></td>
				<td><input <?php echo $label[9]; ?> value="<?php echo $label[4]; ?>" type="text" name="label5" tabindex="9"/></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input <?php echo $value[5]; ?> value="<?php echo $value[0]; ?>" type="text" name="value1" tabindex="2"/></td>
				<td><input <?php echo $value[6]; ?> value="<?php echo $value[1]; ?>" type="text" name="value2" tabindex="4"/></td>
				<td><input <?php echo $value[7]; ?> value="<?php echo $value[2]; ?>" type="text" name="value3" tabindex="6"/></td>
				<td><input <?php echo $value[8]; ?> value="<?php echo $value[3]; ?>" type="text" name="value4" tabindex="7"/></td>
				<td><input <?php echo $value[9]; ?> value="<?php echo $value[4]; ?>" type="text" name="value5" tabindex="10"/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>