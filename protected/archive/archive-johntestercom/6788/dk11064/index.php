<?php 
$s=0;
$graphSrc="graph.php";
#$graphSrc point to graph.php with additional GET parameters
if (isset($_POST["graf"]))
{
	$in = [
		"l1" => $_POST["label1"],
		"l2" => $_POST["label2"],
		"l3" => $_POST["label3"],
		"l4" => $_POST["label4"],
		"l5" => $_POST["label5"],
		"v1" => $_POST["value1"],
		"v2" => $_POST["value2"],
		"v3" => $_POST["value3"],
		"v4" => $_POST["value4"],
		"v5" => $_POST["value5"]
		];
	$graphSrc .= "?" . http_build_query($in);
	if ($graphSrc == "graph.php?l1=&l2=&l3=&l4=&l5=&v1=&v2=&v3=&v4=&v5=") $graphSrc = "graph.php";
}
function parlab($n)
{
	return empty($n) && $n != "0";
}
function parval($n)
{
	return !is_numeric($n);
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
	<?php echo "<p> Grafika saite: " . $_SERVER['HTTP_HOST'] . str_replace("index.php","",$_SERVER['SCRIPT_NAME']) . $graphSrc . " <p>"; ?>
	</section>
	<aside>
	    <form method="POST" action="index.php">
		<table id="userdata">
			<tr id="titles">
				<th>Legend title</th>
				<td><input type="text" name="label1" tabindex="1" <?php if(isset($_POST["graf"])) {echo "value=\"" . $in["l1"] . "\"";if (parlab($in["l1"])) echo "class=\"error\"";}?> /></td>
				<td><input type="text" name="label2" tabindex="3" <?php if(isset($_POST["graf"])) {echo "value=\"" . $in["l2"] . "\"";if (parlab($in["l2"])) echo "class=\"error\"";}?> /></td>
				<td><input type="text" name="label3" tabindex="5" <?php if(isset($_POST["graf"])) {echo "value=\"" . $in["l3"] . "\"";if (parlab($in["l3"])) echo "class=\"error\"";}?> /></td>
				<td><input type="text" name="label4" tabindex="7" <?php if(isset($_POST["graf"])) {echo "value=\"" . $in["l4"] . "\"";if (parlab($in["l4"])) echo "class=\"error\"";}?> /></td>
				<td><input type="text" name="label5" tabindex="9" <?php if(isset($_POST["graf"])) {echo "value=\"" . $in["l5"] . "\"";if (parlab($in["l5"])) echo "class=\"error\"";}?>  /></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" name="value1" tabindex="2" <?php if(isset($_POST["graf"])) {echo "value=\"" . $in["v1"] . "\"";if (parval($in["v1"])) echo "class=\"error\"";}?> /></td>
				<td><input type="text" name="value2" tabindex="4" <?php if(isset($_POST["graf"])) {echo "value=\"" . $in["v2"] . "\"";if (parval($in["v2"])) echo "class=\"error\"";}?> /></td>
				<td><input type="text" name="value3" tabindex="6" <?php if(isset($_POST["graf"])) {echo "value=\"" . $in["v3"] . "\"";if (parval($in["v3"])) echo "class=\"error\"";}?> /></td>
				<td><input type="text" name="value4" tabindex="7" <?php if(isset($_POST["graf"])) {echo "value=\"" . $in["v4"] . "\"";if (parval($in["v4"])) echo "class=\"error\"";}?> /></td>
				<td><input type="text" name="value5" tabindex="10" <?php if(isset($_POST["graf"])) {echo "value=\"" . $in["v5"] . "\"";if (parval($in["v5"])) echo "class=\"error\"";}?> /></td>
			</tr>
		</table>
		<input name="graf" type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>