<?php 
# This time you are allowed to do scripting and output 
# generation in the same file.
error_reporting(E_ALL);
ini_set('display_errors', '1');

$graphSrc="http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";


if(isset($_POST['runCommand'])) {
	$data = array();
	for($i=1;$i<6;$i++){
		$l="label".$i;
		if(isset($_POST[$l]) && is_string($_POST[$l]) && !empty($_POST[$l]))
			$data[$l] = 1;
		else
			$data[$l] = 0;

		$v="value".$i;
		if(isset($_POST[$v]) && is_numeric($_POST[$v]) && !empty($_POST[$v]) && (int)$_POST[$v]>=0)
			$data[$v] = 1;
		else
			$data[$v] = 0;
	}
	$graphSrc="graph.php?label1=".urlencode($_POST['label1'])."&value1=".urlencode($_POST['value1'])."&label2=".urlencode($_POST['label2'])."&value2=".urlencode($_POST['value2'])."&label3=".urlencode($_POST['label3'])."&value3=".urlencode($_POST['value3'])."&label4=".urlencode($_POST['label4'])."&value4=".urlencode($_POST['value4'])."&label5=".urlencode($_POST['label5'])."&value5=".urlencode($_POST['value5']);
	//$graphSrc="graph.php?".urlencode($_POST['label1'])."=".urlencode($_POST['value1'])."&".urlencode($_POST['label2'])."=".urlencode($_POST['value2'])."&".urlencode($_POST['label3'])."=".urlencode($_POST['value3'])."&".urlencode($_POST['label4'])."=".urlencode($_POST['value4'])."&".urlencode($_POST['label5'])."=".urlencode($_POST['value5']);

}
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
		<img src="<?php echo $graphSrc; ?>" id="graph" alt="The graph" width="600" height="400" />
	</section>
	<aside>
	    <form method="POST">
		<table id="userdata">
			<tr id="titles">
				<?php //print_r($data); ?>
				<th>Legend title</th>
				<td><input <?php if(isset($data['label1']) && $data['label1']==0) { ?>class="error" <?php } ?>type="text" name="label1" <?php if(isset($_POST['label1'])) { ?> value="<?php echo htmlspecialchars($_POST['label1']); ?>" <?php } ?>tabindex="1"/></td>
				<td><input <?php if(isset($data['label2']) && $data['label2']==0) { ?>class="error" <?php } ?>type="text" name="label2" <?php if(isset($_POST['label2'])) { ?> value="<?php echo htmlspecialchars($_POST['label2']); ?>" <?php } ?>tabindex="3"/></td>
				<td><input <?php if(isset($data['label3']) && $data['label3']==0) { ?>class="error" <?php } ?>type="text" name="label3" <?php if(isset($_POST['label3'])) { ?> value="<?php echo htmlspecialchars($_POST['label3']); ?>" <?php } ?>tabindex="5"/></td>
				<td><input <?php if(isset($data['label4']) && $data['label4']==0) { ?>class="error" <?php } ?>type="text" name="label4" <?php if(isset($_POST['label4'])) { ?> value="<?php echo htmlspecialchars($_POST['label4']); ?>" <?php } ?>tabindex="7"/></td>
				<td><input <?php if(isset($data['label5']) && $data['label5']==0) { ?>class="error" <?php } ?>type="text" name="label5" <?php if(isset($_POST['label5'])) { ?> value="<?php echo htmlspecialchars($_POST['label5']); ?>" <?php } ?>tabindex="9" /></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input <?php if(isset($data['value1']) && $data['value1']==0) { ?>class="error" <?php } ?>type="text" name="value1" <?php if(isset($_POST['value1'])) { ?> value="<?php echo htmlspecialchars($_POST['value1']); ?>" <?php } ?>tabindex="2"/></td>
				<td><input <?php if(isset($data['value2']) && $data['value2']==0) { ?>class="error" <?php } ?>type="text" name="value2" <?php if(isset($_POST['value2'])) { ?> value="<?php echo htmlspecialchars($_POST['value2']); ?>" <?php } ?>tabindex="4"/></td>
				<td><input <?php if(isset($data['value3']) && $data['value3']==0) { ?>class="error" <?php } ?>type="text" name="value3" <?php if(isset($_POST['value3'])) { ?> value="<?php echo htmlspecialchars($_POST['value3']); ?>" <?php } ?>tabindex="6"/></td>
				<td><input <?php if(isset($data['value4']) && $data['value4']==0) { ?>class="error" <?php } ?>type="text" name="value4" <?php if(isset($_POST['value4'])) { ?> value="<?php echo htmlspecialchars($_POST['value4']); ?>" <?php } ?>tabindex="7"/></td>
				<td><input <?php if(isset($data['value5']) && $data['value5']==0) { ?>class="error" <?php } ?>type="text" name="value5" <?php if(isset($_POST['value5'])) { ?> value="<?php echo htmlspecialchars($_POST['value5']); ?>" <?php } ?>tabindex="10"/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" name="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>