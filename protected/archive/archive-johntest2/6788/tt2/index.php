<?php
//Renārs Vilnis RV11036 
ini_set('display_errors', 'Off');
$title=array();
$data=array();
$graphSrc="http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif"; //default value for image;
$title['label0']= $_POST['label1']; 
$title['label1']= $_POST['label2']; 
$title['label2']= $_POST['label3']; 
$title['label3']= $_POST['label4']; 
$title['label4']= $_POST['label5']; 
$data['value0']= $_POST['value1']; 
$data['value1']= $_POST['value2']; 
$data['value2']= $_POST['value3']; 
$data['value3']= $_POST['value4']; 
$data['value4']= $_POST['value5'];
$allvar=array_merge ($data , $title);
$link=http_build_query($allvar);
urlencode($link);
$graphSrc="./graph.php?$link";
function check_if_number($name){ //funkcija,kas parbauda vai ievaditais ir skaitlis
	if( is_numeric($_POST[$name])===false)
	echo "error";
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
				<td><input type="text" name="label1" tabindex="1" value="<?php echo $_POST['label1'];?>"/></td>
				<td><input type="text" name="label2" tabindex="3" value="<?php echo $_POST['label2'];?>"/></td>
				<td><input type="text" name="label3" tabindex="5" value="<?php echo $_POST['label3'];?>"/></td>
				<td><input type="text" name="label4" tabindex="7" value="<?php echo $_POST['label4'];?>"/></td>
				<td><input type="text" name="label5" tabindex="9" value="<?php echo $_POST['label5'];?>"/></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" name="value1" tabindex="2" value="<?php echo $_POST['value1'];?>" class="<?php check_if_number(value1); ?>"/></td>
				<td><input type="text" name="value2" tabindex="4" value="<?php echo $_POST['value2'];?>" class="<?php check_if_number(value2); ?>"/></td>
				<td><input type="text" name="value3" tabindex="6" value="<?php echo $_POST['value3'];?>" class="<?php check_if_number(value3); ?>"/></td>
				<td><input type="text" name="value4" tabindex="7" value="<?php echo $_POST['value4'];?>" class="<?php check_if_number(value4); ?>"/></td>
				<td><input type="text" name="value5" tabindex="10" value="<?php echo $_POST['value5'];?>" class="<?php check_if_number(value5); ?>"/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>