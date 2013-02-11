<?php 
$graphSrc="http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";
$value = array();
$title = array();
$error = array();

if(!empty($_POST)){  
    
for($i = 1; $i <= 5; $i++){   
$value[$i]=$_POST['value'.$i];
$title[$i]=$_POST['title'.$i];

if(!is_numeric($value[$i])){
$error['value'.$i]=true;
}

if(empty($title[$i])){
$error['title'.$i]=true;
}

}
$graphSrc = "graph.php?".http_build_query($title, 'title')."&".http_build_query($value, 'value');		
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>rh10008_PHP_Grapher</title>
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
				<th>Title</th>
				<td><input type="text" <?php echo (isset($error['title1'])?"class=\"error\"":"") ?> value="<?php echo (isset($title[1])?$title[1]:"") ?>" name="title1" tabindex="1" /></td>
				<td><input type="text" <?php echo (isset($error['title2'])?"class=\"error\"":"") ?> value="<?php echo (isset($title[1])?$title[2]:"") ?>" name="title2" tabindex="3" /></td>
				<td><input type="text" <?php echo (isset($error['title3'])?"class=\"error\"":"") ?> value="<?php echo (isset($title[1])?$title[3]:"") ?>" name="title3" tabindex="5" /></td>
				<td><input type="text" <?php echo (isset($error['title4'])?"class=\"error\"":"") ?> value="<?php echo (isset($title[1])?$title[4]:"") ?>" name="title4" tabindex="7" /></td>
				<td><input type="text" <?php echo (isset($error['title5'])?"class=\"error\"":"") ?> value="<?php echo (isset($title[1])?$title[5]:"") ?>" name="title5" tabindex="9" /></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" <?php echo (isset($error['value1'])?"class=\"error\"":"") ?> value="<?php echo (isset($value[1])?$value[1]:"") ?>" name="value1" tabindex="2" /></td>
				<td><input type="text" <?php echo (isset($error['value2'])?"class=\"error\"":"") ?> value="<?php echo (isset($value[2])?$value[2]:"") ?>" name="value2" tabindex="4" /></td>
				<td><input type="text" <?php echo (isset($error['value3'])?"class=\"error\"":"") ?> value="<?php echo (isset($value[3])?$value[3]:"") ?>" name="value3" tabindex="6" /></td>
				<td><input type="text" <?php echo (isset($error['value4'])?"class=\"error\"":"") ?> value="<?php echo (isset($value[4])?$value[4]:"") ?>" name="value4" tabindex="7" /></td>
				<td><input type="text" <?php echo (isset($error['value5'])?"class=\"error\"":"") ?> value="<?php echo (isset($value[5])?$value[5]:"") ?>" name="value5" tabindex="10" /></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="15" value="Create!" />
	    </form>
	</aside>
</body>
</html>