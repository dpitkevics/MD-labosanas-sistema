<!-- Gustavs Venters, gv11017, 3.10.2012 -->
<?php
$graphSrc="graph.php";
$submitted = 0;
if (isset($_POST["submit"])) $submitted = 1; // Added input name="submit"

//Reads input and generates URL
if ($submitted == 1) {
$input = [
	"label1" => $_POST["label1"],
	"label2" => $_POST["label2"],
	"label3" => $_POST["label3"],
	"label4" => $_POST["label4"],
	"label5" => $_POST["label5"],
	"value1" => $_POST["value1"],
	"value2" => $_POST["value2"],
	"value3" => $_POST["value3"],
	"value4" => $_POST["value4"],
	"value5" => $_POST["value5"]
	];
	foreach ($input as &$x) {
		$x = trim($x);
	}
	unset($x);

	$graphSrc .= "?" . http_build_query($input);
	// If all boxes are left blank
	if ($graphSrc == "graph.php?label1=&label2=&label3=&label4=&label5=&value1=&value2=&value3=&value4=&value5=") $graphSrc = "graph.php";
};

function valid_label($label) {
	if (empty($label) && $label != "0") return false; // "0" is empty but valid
	if (is_string($label)) return true;
	return false;
};

function valid_value($value) {
	if (preg_match("/^\d+$/", $value)) return true; // Checks if string is integer >= 0
	return false;
};
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
	
	<!-- Displays graph url -->
	<section>
	<p><?php echo $graphSrc; ?></p>
	</section>
	
	<aside>
	    <form action="index.php" method="POST">
		<table id="userdata">
			<tr id="titles">
				<th>Legend title</th>
				<td><input type="text" name="label1" tabindex="1" 
				<?php
				if ($submitted == 1) {
					if (!valid_label($input["label1"])) echo "class=\"error\"";
					echo "value=\"" , $input["label1"] , "\"";
				}
				?>
				/></td>
				<td><input type="text" name="label2" tabindex="3" 
				<?php
				if ($submitted == 1) { 
					if (!valid_label($input["label2"])) echo "class=\"error\"";
					echo "value=\"" , $input["label2"] , "\"";
				}
				?>
				/></td>
				<td><input type="text" name="label3" tabindex="5" 
				<?php
				if ($submitted == 1) { 
					if (!valid_label($input["label3"])) echo "class=\"error\"";
					echo "value=\"" , $input["label3"] , "\"";
				}
				?>
				/></td>
				<td><input type="text" name="label4" tabindex="7" 
				<?php
				if ($submitted == 1) { 
					if (!valid_label($input["label4"])) echo "class=\"error\"";
					echo "value=\"" , $input["label4"] , "\"";
				}
				?>
				/></td>
				<td><input type="text" name="label5" tabindex="9" 
				<?php
				if ($submitted == 1) { 
					if (!valid_label($input["label5"])) echo "class=\"error\"";
					echo "value=\"" , $input["label5"] , "\"";
				}
				?>
				/></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" name="value1" tabindex="2" 
				<?php
				if ($submitted == 1) { 
					if (!valid_value($input["value1"])) echo "class=\"error\"";
					echo "value=\"" , $input["value1"] , "\"";
				}
				?>
				/></td>
				<td><input type="text" name="value2" tabindex="4" 
				<?php
				if ($submitted == 1) { 
					if (!valid_value($input["value2"])) echo "class=\"error\"";
					echo "value=\"" , $input["value2"] , "\"";
				}
				?>
				/></td>
				<td><input type="text" name="value3" tabindex="6" 
				<?php
				if ($submitted == 1) { 
					if (!valid_value($input["value3"])) echo "class=\"error\"";
					echo "value=\"" , $input["value3"] , "\"";
				}
				?>
				/></td>
				<td><input type="text" name="value4" tabindex="7" 
				<?php
				if ($submitted == 1) { 
					if (!valid_value($input["value4"])) echo "class=\"error\"";
					echo "value=\"" , $input["value4"] , "\"";
				}
				?>
				/></td>
				<td><input type="text" name="value5" tabindex="10" 
				<?php
				if ($submitted == 1) { 
					if (!valid_value($input["value5"])) echo "class=\"error\"";
					echo "value=\"" , $input["value5"] , "\"";
				}
				?>
				/></td>	
			</tr>
		</table>
		<input type="submit" name="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>