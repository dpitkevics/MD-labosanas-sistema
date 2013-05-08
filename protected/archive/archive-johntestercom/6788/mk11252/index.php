<?php 

function collectData()
{
	// Collects label and value field values
	for ($i=1; $i <= 5; $i++)
	{
		if (isset($_POST["label$i"]) && $_POST["label".$i] != "") 
		{
			$values["label".$i] = $_POST["label".$i];
		}
		else 
		{
			$values["label".$i]="label".$i; 
		}
		if (isset($_POST["label".$i]) && is_numeric($_POST["value".$i])) 
		{
			$values["value".$i] = intval($_POST["value".$i]);
		}
		else 
		{
			$values["value".$i]=0;
		}
	}
	
	// Get scaler
	$scaler = 1;
	
	for($i = 1; $i <= 5; $i++)
	{
		if($values["value".$i] > $scaler)
		{
			$scaler = $values["value".$i];
		}
	}
	
	$values["scaler"] = 280/$scaler;
	return $values;
}
	

function labelCheck($label)
{
	if (isset($label))
	{
		echo "value=\"" . $label . "\"";
	}
	if ($label === "") 
	{
		echo "class=\"error\"";
	}

}

function valueCheck($value)
{
	echo "value=\"" . $value . "\"";
	if ($value === "" || !(is_numeric($value)))
	{
		echo "class=\"error\"";
	}
}

$url = http_build_query(collectData());
$graphSrc="graph.php?$url";

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
				<td><input type="text" name="label1" tabindex="1" <?php if (isset($_POST["label1"])) labelCheck($_POST["label1"]); ?>/></td>
				<td><input type="text" name="label2" tabindex="3" <?php if (isset($_POST["label2"])) labelCheck($_POST["label2"]); ?>/></td>
				<td><input type="text" name="label3" tabindex="5" <?php if (isset($_POST["label3"])) labelCheck($_POST["label3"]); ?>/></td>
				<td><input type="text" name="label4" tabindex="7" <?php if (isset($_POST["label4"])) labelCheck($_POST["label4"]); ?>/></td>
				<td><input type="text" name="label5" tabindex="9" <?php if (isset($_POST["label5"])) labelCheck($_POST["label5"]); ?>/></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" name="value1" tabindex="2" <?php if (isset($_POST["value1"])) valueCheck($_POST["value1"]); ?>/></td>
				<td><input type="text" name="value2" tabindex="4" <?php if (isset($_POST["value2"])) valueCheck($_POST["value2"]); ?>/></td>
				<td><input type="text" name="value3" tabindex="6" <?php if (isset($_POST["value3"])) valueCheck($_POST["value3"]); ?>/></td>
				<td><input type="text" name="value4" tabindex="7" <?php if (isset($_POST["value4"])) valueCheck($_POST["value4"]); ?>/></td>
				<td><input type="text" name="value5" tabindex="10" <?php if (isset($_POST["value5"])) valueCheck($_POST["value5"]); ?>/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>