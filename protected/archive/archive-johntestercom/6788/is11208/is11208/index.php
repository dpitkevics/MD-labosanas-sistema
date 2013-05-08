<?php 

$graphSrc = "http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";

$data = array();
for($i = 1; $i <= 5; $i++){
	$data['value'.$i] = '';
	$data['label'.$i] = '';
}

if($_SERVER["REQUEST_METHOD"] == 'POST'){
	$errors = array();
	foreach($_POST AS $name => $value){
		if(substr($name, 0, 5) == 'label'){
			if(empty($value) || !is_string($value))
			$errors[$name] = true;
			else
			$data[$name] = $value;
		} else if(substr($name, 0, 5) == 'value'){
			if(empty($value) && $value != '0')
			$errors[$name] = true;
			else
			$data[$name] = intval($value);
		}
	}
	
	$graphSrc = "graph.php?".http_build_query($data);
	
	for($i = 1; $i <= 5; $i++)
	$data['label'.$i] = htmlspecialchars($data['label'.$i]);
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
				<td><input type="text" value="<?php echo $data['label1']?>" name="label1" tabindex="1"<?php echo (isset($errors['label1'])?" class=\"error\"":"")?>/></td>
				<td><input type="text" value="<?php echo $data['label2']?>" name="label2" tabindex="3"<?php echo (isset($errors['label2'])?" class=\"error\"":"")?>/></td>
				<td><input type="text" value="<?php echo $data['label3']?>" name="label3" tabindex="5"<?php echo (isset($errors['label3'])?" class=\"error\"":"")?>/></td>
				<td><input type="text" value="<?php echo $data['label4']?>" name="label4" tabindex="7"<?php echo (isset($errors['label4'])?" class=\"error\"":"")?>/></td>
				<td><input type="text" value="<?php echo $data['label5']?>" name="label5" tabindex="9"<?php echo (isset($errors['label5'])?" class=\"error\"":"")?>/></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" value="<?php echo $data['value1']?>" name="value1" tabindex="2"<?php echo (isset($errors['value1'])?" class=\"error\"":"")?>/></td>
				<td><input type="text" value="<?php echo $data['value2']?>" name="value2" tabindex="4"<?php echo (isset($errors['value2'])?" class=\"error\"":"")?>/></td>
				<td><input type="text" value="<?php echo $data['value3']?>" name="value3" tabindex="6"<?php echo (isset($errors['value3'])?" class=\"error\"":"")?>/></td>
				<td><input type="text" value="<?php echo $data['value4']?>" name="value4" tabindex="7"<?php echo (isset($errors['value4'])?" class=\"error\"":"")?>/></td>
				<td><input type="text" value="<?php echo $data['value5']?>" name="value5" tabindex="10"<?php echo (isset($errors['value5'])?" class=\"error\"":"")?>/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>