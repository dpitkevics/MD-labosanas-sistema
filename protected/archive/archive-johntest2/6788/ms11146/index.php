<?php 
# This time you are allowed to do scripting and output 
# generation in the same file.
#$graphSrc should point to graph.php with additional GET parameters
									//Notice that in my programm "incorrect" values are concidered only incorrect numbers ('-5' or 'dd2')
									//only those are matched with class "error"
	for($i=1; $i<=5; $i++)
		$value_class[$i] = '';
	if(empty($_POST) ) {
		for($i=1; $i<=5; $i++) {
			$label[$i] = '';
			$value[$i] = '';
		}
		$graphSrc = 'graph.php?';
	}
	else
	{
		for($i=1; $i<=5; $i++) {
			$label[$i] = $_POST['label'.$i];
			$value[$i] = $_POST['value'.$i];
			if($label[$i] == '')									//to not to check input values 2 times(in index.php and graph.php) for correctness,
				$corrected_label[$i] = 'auto_'.$i;					//I decided to handle them once here and give data to graph.php already handled
			else
				$corrected_label[$i] = $label[$i];
			if($value[$i] == '')
				$corrected_value[$i] = 0; 
			else
				if(is_numeric($value[$i]) ) {
					if($value[$i] < 0) {
						$corrected_value[$i] = 0;
						$value_class[$i] = 'error';
					}
					else
						$corrected_value[$i] = $value[$i];
				}
				else {
					$corrected_value[$i] = 0;
					$value_class[$i] = 'error';
				}
		}
		$label_url = http_build_query($corrected_label,'corrected_label');
		$value_url = http_build_query($corrected_value,'corrected_value');
		$graphSrc = 'graph.php?'.$label_url.'&'.$value_url;
	}
	for($i=1; $i<=5; $i++) {
		$label_html[$i] = htmlspecialchars($label[$i]);
		$value_html[$i] = htmlspecialchars($value[$i]);
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
				<td><input type="text" name="label1" tabindex="1" value="<?php echo $label_html[1]; ?>"/></td>
				<td><input type="text" name="label2" tabindex="3" value="<?php echo $label_html[2]; ?>"/></td>
				<td><input type="text" name="label3" tabindex="5" value="<?php echo $label_html[3]; ?>"/></td>
				<td><input type="text" name="label4" tabindex="7" value="<?php echo $label_html[4]; ?>"/></td>
				<td><input type="text" name="label5" tabindex="9" value="<?php echo $label_html[5]; ?>" /></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input class="<?php echo $value_class[1]; ?>" type="text" name="value1" tabindex="2" value="<?php echo $value_html[1]; ?>"/></td>
				<td><input class="<?php echo $value_class[2]; ?>" type="text" name="value2" tabindex="4" value="<?php echo $value_html[2]; ?>"/></td>
				<td><input class="<?php echo $value_class[3]; ?>" type="text" name="value3" tabindex="6" value="<?php echo $value_html[3]; ?>"/></td>
				<td><input class="<?php echo $value_class[4]; ?>" type="text" name="value4" tabindex="7" value="<?php echo $value_html[4]; ?>"/></td>
				<td><input class="<?php echo $value_class[5]; ?>" type="text" name="value5" tabindex="10" value="<?php echo $value_html[5]; ?>"/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>