<?php
// --- common section ---
$FIELDS = 5;

function is_valid_value($val){
    $val = trim($val);
    if (is_numeric($val) and intval($val)>=0)
        return true;
    return false;
}

function is_valid_label($lab){
    if (trim($lab)!=='')
        return true;
    return false;
}
// --- end of common section ---


$input_labels = array_fill(1, $FIELDS, '');
$input_values = array_fill(1, $FIELDS, '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// all inputs are error for default
	$input_labels_error = array_fill(1, $FIELDS, 1);
	$input_values_error = array_fill(1, $FIELDS, 1);

	for ($i=1; $i <= $FIELDS; $i++) {
		$label_str = 'label'.$i;
		if (isset($_POST[$label_str])) {
			$input_labels[$i] = $_POST[$label_str];
			if (is_valid_label($input_labels[$i])) {
				$input_labels_error[$i] = 0;
			}
		}

		$value_str = 'value'.$i;
		if (isset($_POST[$value_str])) {
			$input_values[$i] = $_POST[$value_str];
			if (is_valid_value($input_values[$i])) {
				$input_values_error[$i] = 0;
			}
		}
	}
	$graphSrc = "graph.php?"
		.http_build_query($input_labels, "label")
		.'&'.http_build_query($input_values, "value");
} else {
	// if not POST, inputs are OK
	$input_labels_error = array_fill(1, $FIELDS, 0);
	$input_values_error = array_fill(1, $FIELDS, 0);

	$graphSrc='http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif';
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
				<td><input type="text" name="label1" tabindex="1" value="<?php echo $input_labels[1]?>" <?php if ($input_labels_error[1]) echo "class=error"?> /></td>
				<td><input type="text" name="label2" tabindex="3" value="<?php echo $input_labels[2]?>" <?php if ($input_labels_error[2]) echo "class=error"?> /></td>
				<td><input type="text" name="label3" tabindex="5" value="<?php echo $input_labels[3]?>" <?php if ($input_labels_error[3]) echo "class=error"?> /></td>
				<td><input type="text" name="label4" tabindex="7" value="<?php echo $input_labels[4]?>" <?php if ($input_labels_error[4]) echo "class=error"?> /></td>
				<td><input type="text" name="label5" tabindex="9" value="<?php echo $input_labels[5]?>" <?php if ($input_labels_error[5]) echo "class=error"?> /></td>
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" name="value1" tabindex="2"  value="<?php echo $input_values[1]?>" <?php if ($input_values_error[1]) echo "class=error"?> /></td>
				<td><input type="text" name="value2" tabindex="4"  value="<?php echo $input_values[2]?>" <?php if ($input_values_error[2]) echo "class=error"?> /></td>
				<td><input type="text" name="value3" tabindex="6"  value="<?php echo $input_values[3]?>" <?php if ($input_values_error[3]) echo "class=error"?> /></td>
				<td><input type="text" name="value4" tabindex="7"  value="<?php echo $input_values[4]?>" <?php if ($input_values_error[4]) echo "class=error"?> /></td>
				<td><input type="text" name="value5" tabindex="10" value="<?php echo $input_values[5]?>" <?php if ($input_values_error[5]) echo "class=error"?> /></td>
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>