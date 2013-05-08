<?php 
error_reporting(E_ALL);

$graphSrc="http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";

#$graphSrc should point to graph.php with additional GET parameters

function userinput($name) {
/** Build string for HTML <input> elem. arguments (value, class) **/
	$result = '';
	if (isset($_POST[$name])) {
		$result = $_POST[$name];
		if (substr($name, 0, 5) == 'value') {
			if (!(is_numeric($_POST[$name]) and intval($_POST[$name]) != 0)) {
				$result = $result . '" class="error';
			};
		} elseif (substr($name, 0, 5) == 'label') {
			if (!(is_string($_POST[$name]) && ($_POST[$name] != ''))) {
				$result = $result . '" class="error';
			};
		};
	};
	return $result; 
};

function process_label($label) {
/** Check if POST param. is set or return default value **/
	if (isset($_POST[$label])) {
		$data = $_POST[$label];
	} else {
		$data = '';
	};
	return ($data != '' ? urlencode($data) : $label);
};

function process_value($value) {
/** Check if POST param. is set or return default value **/
	if (isset($_POST[$value]) && is_numeric($_POST[$value])) {
		$data = intval($_POST[$value]);
	} else {
		$data = '';
	};
	return ($data != '' ? urlencode($data) : 0);
};

$data = array();
for($ii = 1; $ii <= 5; $ii += 1) {
	$label = 'label' . strval($ii);
	$value = 'value' . strval($ii);
	$data[$label] = process_label($label);
	$data[$value] = process_value($value);
}

// Redefine image url using POST parameters
$graphSrc = 'graph.php?' . http_build_query($data);

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
				<?php for ($ii = 1; $ii <= 5; $ii += 1) {
					$name = 'label' . $ii;
					echo '<td><input type="text" name="' . $name . '" value="' . userinput($name) . '" tabindex="1"/></td>';
					echo "\t\t\t\t\n";
				} ?>
			</tr>
			<tr id="values">
				<th>Value</th>
				<?php for ($ii = 1; $ii <= 5; $ii += 1) {
					$name = 'value' . $ii;
					echo '<td><input type="text" name="' . $name . '" value="' . userinput($name) . '" tabindex="2"/></td>';
					echo "\t\t\t\t\n";
				} ?>
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>
