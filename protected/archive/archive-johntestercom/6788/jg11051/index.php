<?php 
# This time you are allowed to do scripting and output 
# generation in the same file.

$values = array(0 => '', 1 => '', 2 => '', 3 => '', 4 => '');
$labels = array(0 => '', 1 => '', 2 => '', 3 => '', 4 => '');

#ja tiek padoti parametri
if (isset($_POST['value1']))
{
	
	if (!is_string($_POST['label1'])) $error6 = 'class="error"';
	if (!is_string($_POST['label2'])) $error7 = 'class="error"';
	if (!is_string($_POST['label3'])) $error8 = 'class="error"';
	if (!is_string($_POST['label4'])) $error9 = 'class="error"';
	if (!is_string($_POST['label5'])) $error10 = 'class="error"';
	
	if (empty($_POST['value1'])) $values[0] = 0; else $values[0] = $_POST['value1'];
	if (empty($_POST['value2'])) $values[1] = 0; else $values[1] = $_POST['value2'];
	if (empty($_POST['value3'])) $values[2] = 0; else $values[2] = $_POST['value3'];
	if (empty($_POST['value4'])) $values[3] = 0; else $values[3] = $_POST['value4'];
	if (empty($_POST['value5'])) $values[4] = 0; else $values[4] = $_POST['value5'];
	
	if (!is_numeric($_POST['value1'])) {$error1 = 'class="error"'; $values[0] = 0;}
	if (!is_numeric($_POST['value2'])) {$error2 = 'class="error"'; $values[1] = 0;}
	if (!is_numeric($_POST['value3'])) {$error3 = 'class="error"'; $values[2] = 0;}
	if (!is_numeric($_POST['value4'])) {$error4 = 'class="error"'; $values[3] = 0;}
	if (!is_numeric($_POST['value5'])) {$error5 = 'class="error"'; $values[4] = 0;}
	
	if (empty($_POST['label1'])) $labels[0] = 'Label 1'; else $labels[0] = $_POST['label1'];
	if (empty($_POST['label2'])) $labels[1] = 'Label 2'; else $labels[1] = $_POST['label2'];
	if (empty($_POST['label3'])) $labels[2] = 'Label 3'; else $labels[2] = $_POST['label3'];
	if (empty($_POST['label4'])) $labels[3] = 'Label 4'; else $labels[3] = $_POST['label4'];
	if (empty($_POST['label5'])) $labels[4] = 'Label 5'; else $labels[4] = $_POST['label5'];
}


$graphSrc="graph.php?
lab1=".urlencode($labels[0])."&val1=".urlencode($values[0])."&
lab2=".urlencode($labels[1])."&val2=".urlencode($values[1])."&
lab3=".urlencode($labels[2])."&val3=".urlencode($values[2])."&
lab4=".urlencode($labels[3])."&val4=".urlencode($values[3])."&
lab5=".urlencode($labels[4])."&val5=".urlencode($values[4])."
";

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
				<td><input <?php if(isset($error6)) echo $error6; ?> type="text" name="label1" tabindex="1" value="<?php echo $labels[0]; ?>" /></td>
				<td><input <?php if(isset($error7)) echo $error7; ?> type="text" name="label2" tabindex="3" value="<?php echo $labels[1]; ?>"/></td>
				<td><input <?php if(isset($error8)) echo $error8; ?> type="text" name="label3" tabindex="5" value="<?php echo $labels[2]; ?>" /></td>
				<td><input <?php if(isset($error9)) echo $error9; ?> type="text" name="label4" tabindex="7" value="<?php echo $labels[3]; ?>" /></td>
				<td><input <?php if(isset($error10)) echo $error10; ?> type="text" name="label5" tabindex="9" value="<?php echo $labels[4]; ?>" /></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input <?php if(isset($error1)) echo $error1; ?> type="text" name="value1" tabindex="2" value="<?php echo $values[0]; ?>" /></td>
				<td><input <?php if(isset($error2)) echo $error2; ?> type="text" name="value2" tabindex="4" value="<?php echo $values[1]; ?>" /></td>
				<td><input <?php if(isset($error3)) echo $error3; ?> type="text" name="value3" tabindex="6" value="<?php echo $values[2]; ?>" /></td>
				<td><input <?php if(isset($error4)) echo $error4; ?> type="text" name="value4" tabindex="7" value="<?php echo $values[3]; ?>" /></td>
				<td><input <?php if(isset($error5)) echo $error5; ?> type="text" name="value5" tabindex="10" value="<?php echo $values[4]; ?>" /></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>