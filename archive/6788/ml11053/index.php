<?php 
# This time you are allowed to do scripting and output 
# generation in the same file.
$my_arr = array();
$errors = array();
for ($i=1; $i<6; $i++)
	if (isset($_POST['value'.$i]))
	{
		$my_arr['value'.$i] = $_POST['value'.$i];
		if(!is_numeric($my_arr['value'.$i]))
			$errors[$i] = 1;
	}

for ($i=1; $i<6; $i++)
	if (isset($_POST['label'.$i]))
	{
		$my_arr['label'.$i] = $_POST['label'.$i];
	}

	http_build_query($my_arr);
	$graphSrc='graph.php?'.http_build_query($my_arr);
	// echo $graphSrc;

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
				<td><input type="text" name="label1" tabindex="1" value="<?php if (isset($_POST['label1'])) echo $_POST['label1']; ?>"/></td>
				<td><input type="text" name="label2" tabindex="3" value="<?php if (isset($_POST['label2'])) echo $_POST['label2']; ?>"/></td>
				<td><input type="text" name="label3" tabindex="5" value="<?php if (isset($_POST['label3'])) echo $_POST['label3']; ?>"/></td>
				<td><input type="text" name="label4" tabindex="7" value="<?php if (isset($_POST['label4'])) echo $_POST['label4']; ?>"/></td>
				<td><input type="text" name="label5" tabindex="9" value="<?php if (isset($_POST['label5'])) echo $_POST['label5']; ?>"/></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" name="value1" tabindex="2" class="<?php if (array_key_exists(1, $errors)) echo 'error';?>" value="<?php if (isset($_POST['value1'])) echo $_POST['value1']; ?>"/></td>
				<td><input type="text" name="value2" tabindex="4" class="<?php if (array_key_exists(2, $errors)) echo 'error';?>" value="<?php if (isset($_POST['value2'])) echo $_POST['value2']; ?>"/></td>
				<td><input type="text" name="value3" tabindex="6" class="<?php if (array_key_exists(3, $errors)) echo 'error';?>" value="<?php if (isset($_POST['value3'])) echo $_POST['value3']; ?>"/></td>
				<td><input type="text" name="value4" tabindex="7" class="<?php if (array_key_exists(4, $errors)) echo 'error';?>" value="<?php if (isset($_POST['value4'])) echo $_POST['value4']; ?>"/></td>
				<td><input type="text" name="value5" tabindex="10" class="<?php if (array_key_exists(5, $errors)) echo 'error';?>" value="<?php if (isset($_POST['value5'])) echo $_POST['value5']; ?>"/></td>
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
	<section>
	<div>
		<h5> Bar label 'BAD < NR >' indicates that passed value data was incorect (not numeric)</h5>
	</div>
	</section>
</body>
</html>