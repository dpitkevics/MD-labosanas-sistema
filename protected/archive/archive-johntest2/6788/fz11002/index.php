<?php 

if(!(isset($_POST["run"]))) { 
  $graphSrc = "http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";
}

else {
$lab1 = $_POST["label1"];
$lab2 = $_POST["label2"];
$lab3 = $_POST["label3"];
$lab4 = $_POST["label4"];
$lab5 = $_POST["label5"];

$val1 = $_POST["value1"];
$val2 = $_POST["value2"];
$val3 = $_POST["value3"];
$val4 = $_POST["value4"];
$val5 = $_POST["value5"];

$graphSrc = "graph.php?valu1=$val1&valu2=$val2&valu3=$val3&valu4=$val4&valu5=$val5&labe1=$lab1&labe2=$lab2&labe3=$lab3&labe4=$lab4&labe5=$lab5";
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
		<img src="<?php echo $graphSrc ?>" id="graph" alt="The graph" width="600" height="400" />
        </section>
	<aside>
	    <form method="POST" action="index.php">
		<table id="userdata">
			<tr id="titles">
				<th>Legend title</th>
				<td><input type="text" value="<?php if(!(isset($_POST["run"]))) {echo "";} else {echo $lab1;} ?>" name="label1" tabindex="1"/></td>
				<td><input type="text" value="<?php if(!(isset($_POST["run"]))) {echo "";} else {echo $lab2;} ?>" name="label2" tabindex="3"/></td>
				<td><input type="text" value="<?php if(!(isset($_POST["run"]))) {echo "";} else {echo $lab3;} ?>" name="label3" tabindex="5"/></td>
				<td><input type="text" value="<?php if(!(isset($_POST["run"]))) {echo "";} else {echo $lab4;} ?>" name="label4" tabindex="7"/></td>
				<td><input type="text" value="<?php if(!(isset($_POST["run"]))) {echo "";} else {echo $lab5;} ?>" name="label5" tabindex="9" /></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" style="<?php if(!(isset($_POST["run"]))){} else if ($val1<0 or !is_numeric($val1)) {echo 'background-color:#F00;';} ?>" value="<?php if(!(isset($_POST["run"]))) {echo "";} else {echo $val1;} ?>" name="value1" tabindex="2"/></td>
				<td><input type="text" style="<?php if(!(isset($_POST["run"]))){} else if ($val2<0 or !is_numeric($val2)) {echo 'background-color:#F00;';} ?>" value="<?php if(!(isset($_POST["run"]))) {echo "";} else {echo $val2;} ?>" name="value2" tabindex="4"/></td>
				<td><input type="text" style="<?php if(!(isset($_POST["run"]))){} else if ($val3<0 or !is_numeric($val3)) {echo 'background-color:#F00;';} ?>" value="<?php if(!(isset($_POST["run"]))) {echo "";} else {echo $val3;} ?>" name="value3" tabindex="6"/></td>
				<td><input type="text" style="<?php if(!(isset($_POST["run"]))){} else if ($val4<0 or !is_numeric($val4)) {echo 'background-color:#F00;';} ?>" value="<?php if(!(isset($_POST["run"]))) {echo "";} else {echo $val4;} ?>" name="value4" tabindex="7"/></td>
				<td><input type="text" style="<?php if(!(isset($_POST["run"]))){} else if ($val5<0 or !is_numeric($val5)) {echo 'background-color:#F00;';} ?>" value="<?php if(!(isset($_POST["run"]))) {echo "";} else {echo $val5;} ?>" name="value5" tabindex="10"/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" name="run" tabindex="11" value="Draw it!"/>
	    </form>
	</aside>
</body>
</html>