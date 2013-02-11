<?php 
$graphSrc="http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>PHP Grapher</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<?php //echo  
		$errors = array();
		$inputValues = array();
		for ($i=1; $i<=5; $i++)
		{
			$errors["label" . $i]="";
			$errors["value" . $i]="";
			$inputValues["label" . $i]="";
			$inputValues["value" . $i]="";
		}
		$parameters = array();
	    if($_SERVER['REQUEST_METHOD'] == "POST") 
	    { 
	    	for ($i=1; $i<=5; $i++) 
	    	{ 
	    		$label="label" . $i;
	    		$value="value" . $i;
		    	//echo "$label = $_POST[$label]<br />";
		    	//echo "$value = $_POST[$value]<br />";
		    	//echo "<br />";
		    	/*
		    	if (isset($_POST[$label]))
		    		$parameters[$label] = $_POST[$label];
		    	if (isset($_POST[$value]))
		    		$parameters[$value] = $_POST[$value];
		    	*/
		    	
	    		$parameters[$label] = ($_POST[$label]);
	    		$inputValues[$label] = "value = \"".htmlspecialchars($_POST[$label])."\"";
		    	if ($parameters[$label]=='')
		    	{
		    		$errors[$label] = "class = \"error \" ";
		    	}
		    	
		    	$parameters[$value] = ($_POST[$value]);
		    	$inputValues[$value] = "value = \"".htmlspecialchars($_POST[$value])."\"";
		    	if ($parameters[$value]!='')
		    	{
		    		if (is_numeric($_POST[$value]))
		    		{
		    			if (is_int($_POST[$value])) echo "$i ir! <br />";
		    			if (intval($_POST[$value])>0)
		    			{ 
		    				$parameters[$value] = intval(round($_POST[$value]));
		    			}
		    			else 
		    			{
		    				$errors[$value] = "class = \"error \" ";
		    				$parameters[$value] = 0;
		    			}
		    		}
		    		else 
		    		{
		    			$errors[$value] = "class = \"error \" ";
		    			$parameters[$value] = 0;
		    		}
		    	}
		    	else 
		    	{
		    		$errors[$value] = "class = \"error \" ";
		    		$parameters[$value] = 0;
		    		
		    	}
	    	}
	    	
	    	$graphSrc="graph.php" . '?' . http_build_query($parameters);
	    	//var_dump($parameters);
	    	//var_dump($errors);
	    }    
?>
<body>
	<section>	   
		<img src="<?php echo $graphSrc; ?>" id="graph" alt="The graph" width="600" height="400" />
	</section>
	<aside>
	    <form method="POST">
		<table id="userdata">
			<tr id="titles">
				<th>Legend title</th>
				<td><input type="text" <?php echo $errors["label1"].' '.$inputValues["label1"] ?> name="label1" tabindex="1"/></td>
				<td><input type="text" <?php echo $errors["label2"].' '.$inputValues["label2"] ?> name="label2" tabindex="3"/></td>
				<td><input type="text" <?php echo $errors["label3"].' '.$inputValues["label3"] ?> name="label3" tabindex="5"/></td>
				<td><input type="text" <?php echo $errors["label4"].' '.$inputValues["label4"] ?> name="label4" tabindex="7"/></td>
				<td><input type="text" <?php echo $errors["label5"].' '.$inputValues["label5"] ?> name="label5" tabindex="9" /></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" <?php echo $errors["value1"].' '.$inputValues["value1"] ?> name="value1" tabindex="2"/></td>
				<td><input type="text" <?php echo $errors["value2"].' '.$inputValues["value2"] ?>name="value2" tabindex="4"/></td>
				<td><input type="text" <?php echo $errors["value3"].' '.$inputValues["value3"] ?>name="value3" tabindex="6"/></td>
				<td><input type="text" <?php echo $errors["value4"].' '.$inputValues["value4"] ?>name="value4" tabindex="7"/></td>
				<td><input type="text" <?php echo $errors["value5"].' '.$inputValues["value5"] ?>name="value5" tabindex="10"/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    
	    </form>
	    
	</aside>
</body>
</html>