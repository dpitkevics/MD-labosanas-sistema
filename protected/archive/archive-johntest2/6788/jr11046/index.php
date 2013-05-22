 <?php 
$graphSrc="http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";
$label=array();
$value=array();
$mistake=array();

for($i=1 ; $i<6; $i++){
    $label[$i] = isset($_POST['label'.$i])?$_POST['label'.$i]:"";
        if(!is_string($label[$i]) || empty($label[$i]))
           $mistake["label".$i]=true; 
        else $mistake["label".$i]=false;
        
    $value[$i] = isset($_POST['value'.$i])?$_POST['value'.$i]:"";
        if(!is_numeric($value[$i]))
           $mistake['value'.$i]=true; 
        else $mistake['value'.$i]=false;
 }
 
 if(empty($_POST)){
	for($i = 1; $i <6; $i++){
	 $mistake['value'.$i]=false;
	$mistake["label".$i]=false;
	}
 }

$graphSrc = "graph.php?".http_build_query($value, 'value')."&".http_build_query($label, 'label');

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
				<td><input type="text" <?php if($mistake['label1']) echo "class=\"error\""; ?> name="label1" tabindex="1" value="<?php echo $label[1]; ?>" /></td>
				<td><input type="text" <?php if($mistake['label2']) echo "class=\"error\""; ?> name="label2" tabindex="3" value="<?php echo $label[2]; ?>"/></td>
				<td><input type="text" <?php if($mistake['label3']) echo "class=\"error\""; ?> name="label3" tabindex="5" value="<?php echo $label[3]; ?>"/></td>
				<td><input type="text" <?php if($mistake['label4']) echo "class=\"error\""; ?> name="label4" tabindex="7" value="<?php echo $label[4]; ?>"/></td>
				<td><input type="text" <?php if($mistake['label5']) echo "class=\"error\""; ?> name="label5" tabindex="9" value="<?php echo $label[5]; ?>"/></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" <?php if($mistake['value1']) echo "class=\"error\""; ?> name="value1" tabindex="2" value="<?php echo $value[1]; ?>"/></td>
				<td><input type="text" <?php if($mistake['value2']) echo "class=\"error\""; ?> name="value2" tabindex="4" value="<?php echo $value[2]; ?>"/></td>
				<td><input type="text" <?php if($mistake['value3']) echo "class=\"error\""; ?> name="value3" tabindex="6" value="<?php echo $value[3]; ?>"/></td>
				<td><input type="text" <?php if($mistake['value4']) echo "class=\"error\""; ?> name="value4" tabindex="7" value="<?php echo $value[4]; ?>"/></td>
				<td><input type="text" <?php if($mistake['value5']) echo "class=\"error\""; ?> name="value5" tabindex="10" value="<?php echo $value[5]; ?>"/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>