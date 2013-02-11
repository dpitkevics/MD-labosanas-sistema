<?php 
// izveido vajadzigo datu masivu un nodrosina balta attela paradisanos
$graphSrc="http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";
$data = Array();

// ievieto datu masiva vajadzigos mainigos, protams, ja tadi ir uzstaditi
for($i = 1; $i<6; $i++)
{
	if (isset($_POST["label".$i])) $data["label".$i] = $_POST["label".$i];
	if (isset($_POST["value".$i])) 
	{
		if ( is_numeric($_POST["value".$i])) 
		{
			$data["value".$i] = intval($_POST["value".$i]);
		}
		else
		{
			$data["value".$i] = $_POST["value".$i];
		}
	}
}

$set = false;
// nododam datus url veida failam 'graph.php'
if (isset($_POST["poga"]))
{
    $set = true;
	$graphSrc="graph.php" . '?'. htmlspecialchars(http_build_query($data));
}

function error_class_label($i,$set)
{	
	// checks whether the label is inputed
	if (empty($_POST["label".$i]) && $set) echo "error";
}

function error_class_input($i,$set)
{	
	// checks whether the value is negative
	if (!empty($_POST["value".$i])&& ($_POST["value".$i]<0)) echo "error";
	// checks whether the value is not numeric
	if (!empty($_POST["value".$i])&& !is_numeric($_POST["value".$i])) echo "error";
	// checks wheter the value is inputed 
	if (empty($_POST["value".$i]) && $set && $_POST["value".$i] != '0') echo "error"; 
}

// makes sure that labels are seen even after input
function value_label($i,$data)
{	
	if (isset($_POST["label".$i])) echo htmlspecialchars($data["label".$i]);
}

// makes sure that values ar seen even after input
function value_input($i,$data)
{	
	if (isset($_POST["value".$i])) echo htmlspecialchars($data["value".$i]);
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
				<td><input class="<?php error_class_label(1,$set); ?>" value="<?php value_label(1,$data); ?>" type="text" name="label1" tabindex="1"/></td>
				<td><input class="<?php error_class_label(2,$set); ?>" value="<?php value_label(2,$data); ?>" type="text" name="label2" tabindex="3"/></td>
				<td><input class="<?php error_class_label(3,$set); ?>" value="<?php value_label(3,$data); ?>" type="text" name="label3" tabindex="5"/></td>
				<td><input class="<?php error_class_label(4,$set); ?>" value="<?php value_label(4,$data); ?>" type="text" name="label4" tabindex="7"/></td>
				<td><input class="<?php error_class_label(5,$set); ?>" value="<?php value_label(5,$data); ?>" type="text" name="label5" tabindex="9" /></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input class="<?php error_class_input(1,$set) ?>" value="<?php value_input(1,$data); ?>" type="text" name="value1" tabindex="2"/></td>
				<td><input class="<?php error_class_input(2,$set) ?>" value="<?php value_input(2,$data); ?>" type="text" name="value2" tabindex="4"/></td>
				<td><input class="<?php error_class_input(3,$set) ?>" value="<?php value_input(3,$data); ?>" type="text" name="value3" tabindex="6"/></td>
				<td><input class="<?php error_class_input(4,$set) ?>" value="<?php value_input(4,$data); ?>" type="text" name="value4" tabindex="7"/></td>
				<td><input class="<?php error_class_input(5,$set) ?>" value="<?php value_input(5,$data); ?>" type="text" name="value5" tabindex="10"/></td>	
			</tr>
		</table>
		
		<input type="submit" name="poga" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>