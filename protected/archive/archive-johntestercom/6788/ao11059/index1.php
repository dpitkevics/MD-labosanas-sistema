<?php 
error_reporting(E_ALL ^ E_NOTICE);

$label1 = $_POST['label1'];
$label2 = $_POST['label2'];
$label3 = $_POST['label3'];
$label4 = $_POST['label4'];
$label5 = $_POST['label5'];

//$label = array('label1', 'label2', 'label3', 'label4', 'label5');

$value1 = $_POST['value1'];
$value2 = $_POST['value2'];
$value3 = $_POST['value3'];
$value4 = $_POST['value4'];
$value5 = $_POST['value5'];
   

//$graphSrc="http://localhost/TTII/graph.php";

$graphSrc="http://localhost/TTII/graph.php?label1=$label1&label2=$label2&label3=$label3&label4=$label4&label5=$label5&value1=$value1&value2=$value2&value3=$value3&value4=$value4&value5=$value5";

//$graphSrc="http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";

//#$graphSrc should point to graph.php with additional GET parameters
//http://localhost/Homeworks/MD1/graph.php?label1=$label1



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
    <form method="POST" action="index1.php">
		<table id="userdata">
			<tr id="titles">
				<th>Legend title</th>
				<td><input type="text" <?php if (isset($label1) AND $label1 == ""){echo 'class = error ';} ?> value= "<?php if(isset($label1)){echo htmlentities($label1);} ?>" name="label1" tabindex="1"/></td>
				<td><input type="text" <?php if ( isset($label2) AND $label2 == ""){echo 'class = error ';} ?> value= "<?php if(isset($label2)){echo htmlentities($label2);} ?>" name="label2" tabindex="3"/></td>
				<td><input type="text" <?php if (isset($label3) AND $label3 == ""){echo 'class = error ';} ?> value= "<?php if(isset($label3)){echo htmlentities($label3);} ?>" name="label3" tabindex="5"/></td>
				<td><input type="text" <?php if ( isset($label4) AND $label4 == ""){echo 'class = error ';} ?> value= "<?php if(isset($label4)){echo htmlentities($label4);} ?>" name="label4" tabindex="7"/></td>
				<td><input type="text" <?php if ( isset($label5) AND $label5 == ""){echo 'class = error ';} ?> value= "<?php if(isset($label5)){echo htmlentities($label5);} ?>" name="label5" tabindex="9" /></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" <?php if ( isset($value1) AND !is_numeric($value1) || $value1 < 0 ){echo 'class = error';} ?> value="<?php if(isset($value1)){echo htmlentities($value1);}?>" name="value1" tabindex="2"/></td>
				<td><input type="text" <?php if ( isset($value2) AND !is_numeric($value2) || $value2 < 0 ){echo 'class = error';} ?> value="<?php if(isset($value1)){echo htmlentities($value2);}?>" name="value2" tabindex="4"/></td>
				<td><input type="text" <?php if ( isset($value3) AND !is_numeric($value3) || $value3 < 0 ){echo 'class = error';} ?> value="<?php if(isset($value1)){echo htmlentities($value3);}?>" name="value3" tabindex="6"/></td>
				<td><input type="text" <?php if ( isset($value4) AND !is_numeric($value4) || $value4 < 0 ){echo 'class = error';} ?> value="<?php if(isset($value1)){echo htmlentities($value4);}?>" name="value4" tabindex="7"/></td>
				<td><input type="text" <?php if ( isset($value5) AND !is_numeric($value5) || $value5 < 0 ){echo 'class = error';} ?> value="<?php if(isset($value1)){echo htmlentities($value5);}?>" name="value5" tabindex="10"/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>