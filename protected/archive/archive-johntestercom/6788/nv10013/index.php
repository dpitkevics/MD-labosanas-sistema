<?php 
# This time you are allowed to do scripting and output 
# generation in the same file.

if ($_POST)
	$graphSrc="graph.php?".http_build_query($_POST);
else
	$graphSrc="http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";

#$graphSrc should point to graph.php with additional GET parameters

function fill($element) {
	if (array_key_exists($element, $_POST)) {
		if ($_POST[$element] == '' || substr($element, 0, 5) == "value" && !is_numeric($_POST[$element])) {
			echo 'class="error" ';
		}
			echo 'value="'.$_POST[$element].'"';
	}
} // This code is bad and I should feel bad, but I blame PHP

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
		<!--<a><?php echo $graphSrc; ?></a>-->
	</section>
	<aside>
	    <form method="POST">
		<table id="userdata">
			<tr id="titles">
				<th>Legend title</th>
				<td><input type="text" name="label1" tabindex="1" <?php fill("label1"); ?>/></td>
				<td><input type="text" name="label2" tabindex="3" <?php fill("label2"); ?>/></td>
				<td><input type="text" name="label3" tabindex="5" <?php fill("label3"); ?>/></td>
				<td><input type="text" name="label4" tabindex="7" <?php fill("label4"); ?>/></td>
				<td><input type="text" name="label5" tabindex="9" <?php fill("label5"); ?>/></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" name="value1" tabindex="2" <?php fill("value1"); ?>/></td>
				<td><input type="text" name="value2" tabindex="4" <?php fill("value2"); ?>/></td>
				<td><input type="text" name="value3" tabindex="6" <?php fill("value3"); ?>/></td>
				<td><input type="text" name="value4" tabindex="7" <?php fill("value4"); ?>/></td>
				<td><input type="text" name="value5" tabindex="10" <?php fill("value5"); ?>"/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>