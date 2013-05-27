<?php 
# This time you are allowed to do scripting and output 
# generation in the same file.
if (isset($_POST) && array_key_exists("label1", $_POST)) {
	$legend_title = Array($_POST['label1'], $_POST['label2'], $_POST['label3'], $_POST['label4'],$_POST['label5']);
	$value = Array($_POST['value1'], $_POST['value2'], $_POST['value3'], $_POST['value4'],$_POST['value5']);
	$data = Array('label1'=>$legend_title[0], 'value1'=>$value[0], 'label2'=>$legend_title[1], 'value2'=>$value[1], 
			      'label3'=>$legend_title[2], 'value3'=>$value[2], 'label4'=>$legend_title[3],
				  'value4'=>$value[3], 'label5'=>$legend_title[4], 'value5'=>$value[4] );
	$graphSrc="graph.php?".http_build_query($data)."";
//	for ($i = 0; $i < 5; $i++) {
	//	if (($value[$i] < 0) || (!is_number($value[$i]))) {$value_pos[$i] = 'error';}
		//else $value_pos[$i] = ' ';
//	}
}

//$legend_pos = Array();
else
$graphSrc="http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";

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
				<td><input type="text" name="label1" tabindex="1"/></td>
				<td><input type="text" name="label2" tabindex="3"/></td>
				<td><input type="text" name="label3" tabindex="5"/></td>
				<td><input type="text" name="label4" tabindex="7"/></td>
				<td><input type="text" name="label5" tabindex="9" /></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" name="value1" tabindex="2"/></td>
				<td><input type="text" name="value2" tabindex="4"/></td>
				<td><input type="text" name="value3" tabindex="6"/></td>
				<td><input type="text" name="value4" tabindex="7"/></td>
				<td><input type="text" name="value5" tabindex="10"/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>