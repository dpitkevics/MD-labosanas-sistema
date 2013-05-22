<?php 
//print_r($_POST);
$total_bars = 5;
$label = array();
$value = array();
$error = array();
for ($i=1; $i<=$total_bars; $i++){
    $label[$i] = '';
    $value[$i] = 0;
}
if(!empty($_POST)){
    for ($i=1; $i<=$total_bars; $i++){
	$value_information = $_POST['value' . $i];
	if(isset($value_information) && is_numeric($value_information)){
	$value[$i] = $value_information;
	} else $error['value' . $i] = true;	
	$label_information = $_POST['label' . $i];
	if(isset($label_information) && is_string($label_information)){
		$label[$i] = $label_information;
	} else $error['label' . $i] = true;
	}
}
$graphSrc = "graph.php?".http_build_query($value, 'value')."&".http_build_query($label, 'label');  
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
	    <form method="POST" action="index.php">
		<table id="userdata">
			<tr id="titles">
				<th>Legend title</th>
				<td><input type="text" <?php if(isset($error['label1'])) echo "class=\"error\""; ?> name="label1" tabindex="1" value="<?php echo $label[1]; ?>"/></td>
				<td><input type="text" <?php if(isset($error['label2'])) echo "class=\"error\""; ?> name="label2" tabindex="3" value="<?php echo $label[2]; ?>"/></td>
				<td><input type="text" <?php if(isset($error['label3'])) echo "class=\"error\""; ?> name="label3" tabindex="5" value="<?php echo $label[3]; ?>"/></td>
				<td><input type="text" <?php if(isset($error['label4'])) echo "class=\"error\""; ?> name="label4" tabindex="7" value="<?php echo $label[4]; ?>"/></td>
				<td><input type="text" <?php if(isset($error['label5'])) echo "class=\"error\""; ?> name="label5" tabindex="9" value="<?php echo $label  [5]; ?>"/></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" <?php if(isset($error['value1'])) echo "class=\"error\""; ?> name="value1" tabindex="2" value="<?php echo $value[1]; ?>"/></td>
				<td><input type="text" <?php if(isset($error['value2'])) echo "class=\"error\""; ?> name="value2" tabindex="4" value="<?php echo $value[2]; ?>"/></td>
				<td><input type="text" <?php if(isset($error['value3'])) echo "class=\"error\""; ?> name="value3" tabindex="6" value="<?php echo $value[3]; ?>"/></td>
				<td><input type="text" <?php if(isset($error['value4'])) echo "class=\"error\""; ?> name="value4" tabindex="7" value="<?php echo $value[4]; ?>"/></td>
				<td><input type="text" <?php if(isset($error['value5'])) echo "class=\"error\""; ?> name="value5" tabindex="10" value="<?php echo $value[5]; ?>"/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>