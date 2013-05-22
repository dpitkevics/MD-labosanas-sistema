<?php 
$graphSrc="http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";
$legendtitle = array();
$value = array();

for ($i=1; $i<6; $i++){
    $value[$i] = 0;
    $legendtitle[$i] = '';
}

if(!empty($_POST)){
	$error = array();
	for ($i=1; $i<6; $i++){
	
		$data = $_POST["value".$i];
		if(isset($data) && is_numeric($data)){
			$value[$i]=$data;
		} else {
			$error['value'.$i] = true;
		}
		
		$data = $_POST["label".$i];
		if(isset($data) && is_string($data)){
			$legendtitle[$i]=$data;
		} else {
			$error['label'.$i] = true;
		}
	}
}
$graphSrc = "graph.php?".http_build_query($value, 'value')."&".http_build_query($legendtitle, 'label');
  
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
				<td><input type="text" <?php if(isset($error['label1'])) echo "class=\"error\""; ?> name="label1" tabindex="1" value="<?php echo $legendtitle[1]; ?>"/></td>
				<td><input type="text" <?php if(isset($error['label2'])) echo "class=\"error\""; ?>name="label2" tabindex="3" value="<?php echo $legendtitle[2]; ?>"/></td>
				<td><input type="text" <?php if(isset($error['label3'])) echo "class=\"error\""; ?> name="label3" tabindex="5" value="<?php echo $legendtitle[3]; ?>"/></td>
				<td><input type="text" <?php if(isset($error['label4'])) echo "class=\"error\""; ?>name="label4" tabindex="7" value="<?php echo $legendtitle[4]; ?>"/></td>
				<td><input type="text" <?php if(isset($error['label5'])) echo "class=\"error\""; ?>name="label5" tabindex="9" value="<?php echo $legendtitle[5]; ?>"/></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" <?php if(isset($error['value1'])) echo "class=\"error\""; ?> name="value1" tabindex="2" value="<?php echo $value[1]; ?>"/></td>
				<td><input type="text" <?php if(isset($error['value2'])) echo "class=\"error\""; ?> name="value2" tabindex="4" value="<?php echo $value[2]; ?>"/></td>
				<td><input type="text" <?php if(isset($error['value3'])) echo "class=\"error\""; ?> name="value3" tabindex="6" value="<?php echo $value[3]; ?>"/></td>
				<td><input type="text" <?php if(isset($error['value4'])) echo "class=\"error\""; ?> name="value4" tabindex="7" value="<?php echo $value[4]; ?>"/></td>
				<td><input type="text" <?php if(isset($error['value5'])) echo "class=\"error\""; ?> name="value5" tabindex="10" value="<?php echo $value[5]; ?>"/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>