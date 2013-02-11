<?php 
# Dmitrijs Gallamovs, dg11041.
# This time you are allowed to do scripting and output 
# generation in the same file.
for($i = 1; $i <= 5; $i++){
    if(isset($_POST['value'.$i])){
            if($_POST['value'.$i]== NULL){
                $_POST['value'.$i] = 0;
            }
    }
}
for($i = 1; $i <= 5; $i++){
    if(isset($_POST['label'.$i])){
            if($_POST['label'.$i]== NULL){
                $_POST['label'.$i] = 'auto'.$i;
            }
    }
}

$graphSrc="graph.php?".http_build_query($_POST);

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
				<th>Legend title</th>
                <td><input class="<?php //if(!isset($_POST['label1'])) echo "error"; ?>" value="<?php if(isset($_POST['label1'])) print $_POST['label1']; ?>" type="text" name="label1" tabindex="1" /></td>
				<td><input class="<?php //if(!isset($_POST['label2'])) echo "error"; ?>" value="<?php if(isset($_POST['label2'])) print $_POST['label2']; ?>" type="text" name="label2" tabindex="3"/></td>
				<td><input class="<?php //if(!isset($_POST['label3'])) echo "error"; ?>" value="<?php if(isset($_POST['label3'])) print $_POST['label3']; ?>" type="text" name="label3" tabindex="5"/></td>
				<td><input class="<?php //if(!isset($_POST['label4'])) echo "error"; ?>" value="<?php if(isset($_POST['label4'])) print $_POST['label4']; ?>" type="text" name="label4" tabindex="7"/></td>
				<td><input class="<?php //if(!isset($_POST['label5'])) echo "error"; ?>" value="<?php if(isset($_POST['label5'])) print $_POST['label5']; ?>" type="text" name="label5" tabindex="9" /></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
                                <td><input class="<?php if(isset($_POST['value1'])) if(!is_numeric($_POST['value1'])) echo "error"; ?>" value="<?php if(isset($_POST['value1'])) print $_POST['value1']; ?>" type="text" name="value1" tabindex="2"/></td>
				<td><input class="<?php if(isset($_POST['value2'])) if(!is_numeric($_POST['value2'])) echo "error"; ?>" value="<?php if(isset($_POST['value2'])) print $_POST['value2']; ?>" type="text" name="value2" tabindex="4"/></td>
				<td><input class="<?php if(isset($_POST['value3'])) if(!is_numeric($_POST['value3'])) echo "error"; ?>" value="<?php if(isset($_POST['value3'])) print $_POST['value3']; ?>" type="text" name="value3" tabindex="6"/></td>
				<td><input class="<?php if(isset($_POST['value4'])) if(!is_numeric($_POST['value4'])) echo "error"; ?>" value="<?php if(isset($_POST['value4'])) print $_POST['value4']; ?>" type="text" name="value4" tabindex="7"/></td>
				<td><input class="<?php if(isset($_POST['value5'])) if(!is_numeric($_POST['value5'])) echo "error"; ?>" value="<?php if(isset($_POST['value5'])) print $_POST['value5']; ?>" type="text" name="value5" tabindex="10"/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>