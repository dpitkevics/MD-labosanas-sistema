<?php 
# This time you are allowed to do scripting and output 
# generation in the same file.

//$graphSrc="http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";
//autors: Sigurds Eglītis, se11006
$query=array();
for ($i=1; $i<=5; $i++)
{
    if (isset($_POST['label'.$i])) 
    $query['label'.$i]=$_POST['label'.$i];
    else
    {
        $query['label'.$i]='';
        $query['value'.$i]=0;
    }
    if (isset($_POST['value'.$i])) 
    {   
        if (is_numeric($_POST['value'.$i]))
        $query['value'.$i]=$_POST['value'.$i];
        else
        $query['value'.$i]='0';
    }
    else
    $query['value'.$i]='0';

}
$graphSrc='graph.php?'.http_build_query($query);
//echo 'isset. ?'.http_build_query($query);

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
				<td><input type="text" name="label1" tabindex="1" value="<?php echo isset($_POST['label1'])?$_POST['label1']:''; ?>"</td>
				<td><input type="text" name="label2" tabindex="3" value="<?php echo isset($_POST['label2'])?$_POST['label2']:''; ?>"/></td>
				<td><input type="text" name="label3" tabindex="5" value="<?php echo isset($_POST['label3'])?$_POST['label3']:''; ?>"/></td>
				<td><input type="text" name="label4" tabindex="7" value="<?php echo isset($_POST['label4'])?$_POST['label4']:''; ?>"/></td>
				<td><input type="text" name="label5" tabindex="9" value="<?php echo isset($_POST['label5'])?$_POST['label5']:''; ?>"/></td>	
			</tr>
			<tr id="values">
				<th >Value</th>
                                <td><input class="<?php if (isset($_POST['value1'])) echo (is_numeric($_POST['value1']))?'':'error'; ?>" type="text" name="value1" tabindex="2" value="<?php echo isset($_POST['value1'])?$_POST['value1']:''; ?>"/></td>
				<td><input class="<?php if (isset($_POST['value2'])) echo (is_numeric($_POST['value2']))?'':'error'; ?>" type="text" name="value2" tabindex="4" value="<?php echo isset($_POST['value2'])?$_POST['value2']:''; ?>"/></td>
				<td><input class="<?php if (isset($_POST['value3'])) echo (is_numeric($_POST['value3']))?'':'error'; ?>" type="text" name="value3" tabindex="6" value="<?php echo isset($_POST['value3'])?$_POST['value3']:''; ?>"/></td>
				<td><input class="<?php if (isset($_POST['value4'])) echo (is_numeric($_POST['value4']))?'':'error'; ?>" type="text" name="value4" tabindex="7" value="<?php echo isset($_POST['value4'])?$_POST['value4']:''; ?>"/></td>
				<td><input class="<?php if (isset($_POST['value5'])) echo (is_numeric($_POST['value5']))?'':'error'; ?>" type="text" name="value5" tabindex="10" value="<?php echo isset($_POST['value5'])?$_POST['value5']:''; ?>"/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>