<?php 
# This time you are allowed to do scripting and output 
# generation in the same file.
//$graphSrc="http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";

$label=array();
$value=array();
//$labelError=array();
$valueError=array();
for($i=1; $i<=5; $i++){
    $label[$i]='';
    $value[$i]=0;
   // $labelError[$i]=false;
    $valueError[$i]=false;
    
    if(!empty($_POST)){
        /*if(!empty($_POST['label'.$i]))*/
        $label[$i]=$_POST['label'.$i];
        /*else
            $labelError[$i]=true;*/
        
        if(!empty($_POST['value'.$i])&&is_numeric($_POST['value'.$i])&&($_POST['value'.$i]>0))
            $value[$i]=$_POST['value'.$i];
        else if(!empty($_POST['value'.$i]))
            $valueError[$i]=true;
    }
    
    $graphSrc="graph.php?".http_build_query($value, 'value')."&".http_build_query($label, 'label');
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
				<th>Legend title</th>
				<td><input type="text" name="label1" tabindex="1" value="<?php echo $label[1]; ?>"/></td>
				<td><input type="text" name="label2" tabindex="3" value="<?php echo $label[2]; ?>"/></td>
				<td><input type="text" name="label3" tabindex="5" value="<?php echo $label[3]; ?>"/></td>
				<td><input type="text" name="label4" tabindex="7" value="<?php echo $label[4]; ?>"/></td>
				<td><input type="text" name="label5" tabindex="9" value="<?php echo $label[5]; ?>"/></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" <?php if($valueError[1]==true) echo "class=\"error\""; ?> name="value1" tabindex="2" value="<?php echo $value[1]; ?>"/></td>
				<td><input type="text" <?php if($valueError[2]==true) echo "class=\"error\""; ?> name="value2" tabindex="4" value="<?php echo $value[2]; ?>"/></td>
				<td><input type="text" <?php if($valueError[3]==true) echo "class=\"error\""; ?> name="value3" tabindex="6" value="<?php echo $value[3]; ?>"/></td>
				<td><input type="text" <?php if($valueError[4]==true) echo "class=\"error\""; ?> name="value4" tabindex="7" value="<?php echo $value[4]; ?>"/></td>
				<td><input type="text" <?php if($valueError[5]==true) echo "class=\"error\""; ?> name="value5" tabindex="10" value="<?php echo $value[5]; ?>"/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
        <?php
            //echo $_POST['label1'];
        ?>
</body>
</html>