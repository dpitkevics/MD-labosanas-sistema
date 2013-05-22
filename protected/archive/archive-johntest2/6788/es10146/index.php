<?php 

 if (!empty($_POST))
 {
     for ($i = 1;  $i < 6; $i++)
    {
        if (!empty($_POST['label'.$i])) 
                $arr_label[$i] = $_POST['label'.$i];
        else $arr_label['empty'.$i] = true;
        if (!empty($_POST['value'.$i]) and is_numeric($_POST['value'.$i])) 
                $arr_value[$i] = intval($_POST['value'.$i]); 
        else $arr_value['empty'.$i] = true;
    }
    $graphSrc = "graph.php?".http_build_query($arr_label, 'label')."&".http_build_query($arr_value, 'value');
 }
else $graphSrc="http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";

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
                                <td><input type="text" <?php if(isset($arr_label['empty1'])) echo "class=\"error\""; ?> name="label1" tabindex="1" value="<?php if(isset($arr_label[1]))echo $arr_label[1]; ?>"/></td>
				<td><input type="text" <?php if(isset($arr_label['empty2'])) echo "class=\"error\""; ?> name="label2" tabindex="3" value="<?php if(isset($arr_label[2]))echo $arr_label[2]; ?>"/></td>
                                <td><input type="text" <?php if(isset($arr_label['empty3'])) echo "class=\"error\""; ?> name="label3" tabindex="5" value="<?php if(isset($arr_label[3]))echo $arr_label[3]; ?>"/></td>
				<td><input type="text" <?php if(isset($arr_label['empty4'])) echo "class=\"error\""; ?> name="label4" tabindex="7" value="<?php if(isset($arr_label[4]))echo $arr_label[4]; ?>"/></td>
                                <td><input type="text" <?php if(isset($arr_label['empty5'])) echo "class=\"error\""; ?> name="label5" tabindex="9" value="<?php if(isset($arr_label[5]))echo $arr_label[5]; ?>"/></td>
                                	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" <?php if(isset($arr_value['empty1'])) echo "class=\"error\""; ?> name="value1" tabindex="2" value="<?php if(isset($arr_value[1]))echo $arr_value[1]; ?>"/></td>
				<td><input type="text" <?php if(isset($arr_value['empty2'])) echo "class=\"error\""; ?> name="value2" tabindex="4" value="<?php if(isset($arr_value[2]))echo $arr_value[2]; ?>"/></td>
                                <td><input type="text" <?php if(isset($arr_value['empty3'])) echo "class=\"error\""; ?> name="value3" tabindex="6" value="<?php if(isset($arr_value[3]))echo $arr_value[3]; ?>"/></td>
				<td><input type="text" <?php if(isset($arr_value['empty4'])) echo "class=\"error\""; ?> name="value4" tabindex="8" value="<?php if(isset($arr_value[4]))echo $arr_value[4]; ?>"/></td>
                                <td><input type="text" <?php if(isset($arr_value['empty5'])) echo "class=\"error\""; ?> name="value5" tabindex="10" value="<?php if(isset($arr_value[5]))echo $arr_value[5]; ?>"/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>