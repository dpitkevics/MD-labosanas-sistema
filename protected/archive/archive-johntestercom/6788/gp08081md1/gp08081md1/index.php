<?php
# This time you are allowed to do scripting and output
# generation in the same file.

$graphSrc="http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";

if ( isset($_POST['label1']) ) {
	$params = array('labels'=>array(),'values'=>array());
	for ( $i = 1; $i<6; $i++ ) {
		$params['labels'][] = $_POST['label'.$i];
		$params['values'][] = $_POST['value'.$i];
	}
	$url_param = urlencode(json_encode($params));
	$graphSrc = './graph.php?param='.$url_param;
}

#$graphSrc should point to graph.php with additional GET parameters

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>PHP Grapher</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript">
function validateform(form)
{
	var is_good = true;
	var input_elements = form.getElementsByTagName("input");
	for(var i = 0; i < form.length; i++) {
		if( form[i].name.indexOf("label") == 0 ) {
			if( form[i].value.length < 1 ) {
				form[i].className = "validation-error";
				is_good = false;
			} else {
				form[i].className = "";
			}
		}

		if( form[i].name.indexOf("value") == 0 ) {
			if( isNaN(form[i].value) || form[i].value < 1 || form[i].value > 240 ) {
				form[i].className = "validation-error";
				is_good = false;
			} else {
				form[i].className = "";
			}
		}
	}

	return is_good;
}
</script>
</head>
<body>
	<section>
		<img src="<?php echo $graphSrc; ?>" id="graph" alt="The graph" width="600" height="400" />
	</section>
	<aside>
	    <form method="POST" onsubmit="return validateform(this)">
		<table id="userdata">
			<tr id="titles">
				<th>Legend title</th>
				<td><input type="text" name="label1" tabindex="1"/></td>
				<td><input type="text" name="label2" tabindex="3"/></td>
				<td><input type="text" name="label3" tabindex="5"/></td>
				<td><input type="text" name="label4" tabindex="7"/></td>
				<td><input type="text" name="label5" tabindex="9" /></td>
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" name="value1" tabindex="2"/></td>
				<td><input type="text" name="value2" tabindex="4"/></td>
				<td><input type="text" name="value3" tabindex="6"/></td>
				<td><input type="text" name="value4" tabindex="7"/></td>
				<td><input type="text" name="value5" tabindex="10"/></td>
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>