<?php 
# This time you are allowed to do scripting and output 
# generation in the same file.

$data = array('label1'=> $_POST['label1'] ,
    'value1'=> $_POST['value1'] ,
    'label2'=> $_POST['label2'] ,
    'value2'=> $_POST['value2'] ,
    'label3'=> $_POST['label3'] ,
    'value3'=> $_POST['value3'] ,
    'label4'=> $_POST['label4'] ,
    'value4'=> $_POST['value4'] ,
    'label5'=> $_POST['label5'] ,
    'value5'=> $_POST['value5'] );

$parameter_string = http_build_query($data);

$graphSrc="graph.php?" . $parameter_string;
#$graphSrc should point to graph.php with additional GET parameters
#echo $param_string = $_POST['label1'] . "=". $_POST['value1'] . "&" . $_POST['label2'] . "=". $_POST['value2'] . "&" . $_POST['label3'] . "=". $_POST['value3'] . "&" . $_POST['label4'] . "=". $_POST['value4'] . "&" . $_POST['label5'] . "=". $_POST['value5'];
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
				<td><input type="text" name="label1" tabindex="1" value="<?php echo $_POST['label1'] ?>" class="<?php if (($_POST['label1']!='') AND (is_numeric($_POST['label1']))) echo "error" ?>"/></td>
				<td><input type="text" name="label2" tabindex="3" value="<?php echo $_POST['label2'] ?>" class="<?php if (($_POST['label2']!='') AND (is_numeric($_POST['label2']))) echo "error" ?>"/></td>
				<td><input type="text" name="label3" tabindex="5" value="<?php echo $_POST['label3'] ?>" class="<?php if (($_POST['label3']!='') AND (is_numeric($_POST['label3']))) echo "error" ?>"/></td>
				<td><input type="text" name="label4" tabindex="7" value="<?php echo $_POST['label4'] ?>" class="<?php if (($_POST['label4']!='') AND (is_numeric($_POST['label4']))) echo "error" ?>"/></td>
				<td><input type="text" name="label5" tabindex="9" value="<?php echo $_POST['label5'] ?>" class="<?php if (($_POST['label5']!='') AND (is_numeric($_POST['label5']))) echo "error" ?>"/></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" name="value1" tabindex="2" value="<?php echo $_POST['value1'] ?>" class="<?php if (($_POST['value1']!='') AND (!is_numeric($_POST['value1'])) OR $_POST['value1']<0) echo "error" ?>"/></td>
				<td><input type="text" name="value2" tabindex="4" value="<?php echo $_POST['value2'] ?>" class="<?php if (($_POST['value2']!='') AND (!is_numeric($_POST['value2'])) OR $_POST['value2']<0) echo "error" ?>"/></td>
				<td><input type="text" name="value3" tabindex="6" value="<?php echo $_POST['value3'] ?>" class="<?php if (($_POST['value3']!='') AND (!is_numeric($_POST['value3'])) OR $_POST['value3']<0) echo "error" ?>"/></td>
				<td><input type="text" name="value4" tabindex="7" value="<?php echo $_POST['value4'] ?>" class="<?php if (($_POST['value4']!='') AND (!is_numeric($_POST['value4'])) OR $_POST['value4']<0) echo "error" ?>"/></td>
				<td><input type="text" name="value5" tabindex="10" value="<?php echo $_POST['value5'] ?>" class="<?php if (($_POST['value5']!='') AND (!is_numeric($_POST['value5'])) OR $_POST['value5']<0) echo "error" ?>"/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>