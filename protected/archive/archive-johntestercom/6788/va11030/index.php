<?php 
# This time you are allowed to do scripting and output
# generation in the same file.

$blank = true;

function startsWith($string1,$string2){
	return strncmp($string1,$string2,strlen($string2)) == 0;
}

function isValidValue($value){
	global $blank;
	return strlen($value)>0 && is_numeric($value) || $blank;
}

function isValidText($text){
	global $blank;
	return strlen($text)>0  || $blank;
}

//notice safe
function post($name){
	if(isset( $_POST[$name])){
		return $_POST[$name];
	}
	return NULL;
}

foreach($_POST as $arg => $val){
	if (startsWith($arg,"label") || startsWith($arg,"value") || $arg=="mode"){
		$args[$arg]=urlencode($val);
	}
}


$graphSrc="graph.php";
if (isset($args)){
	$blank = false;
	$graphSrc.="?".http_build_query($args);
}
$num_bars=5;
#$graphSrc should point to graph.php with additional GET parameters

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
		<img src="<?php echo $graphSrc; ?>" id="graph" alt="The graph"
			width="600" height="400" />
	</section>
	<aside>
		<form method="POST">
			<table id="userdata">
				<tr id="titles">
					<th>Legend title</th>
					<?php for ($i=1;$i<=$num_bars;$i++){ ?>
					<td><input
					<?= (!isValidText(post("label".$i)))?'class="error"':"";?>
						type="text" name="<?= "label".$i;?>" tabindex="<?= $i*2-1;?>"
						value="<?= post("label".$i);?>" /></td>
					<?php } ?>
				</tr>
				<tr id="values">
					<th>Value</th>
					<?php for ($i=1;$i<=$num_bars;$i++){ ?>
					<td><input
					<?= (!isValidValue(post("value".$i)))?'class="error"':"";?>
						type="text" name="<?= "value".$i;?>" tabindex="<?= $i*2;?>"
						value="<?= post("value".$i);?>" /></td>
					<?php } ?>
				</tr>
			</table>
			Render mode: <select name="mode">
				<option value="png"
				<?= (post('mode')!="svg")?'selected="selected"':"";?>>PNG (default)</option>
				<option value="svg"
				<?= (post('mode')=="svg")?'selected="selected"':"";?>>SVG</option>
			</select> <input type="submit" id="runCommand" tabindex="11"
				value="Draw it!" />
		</form>
	</aside>
</body>
</html>
