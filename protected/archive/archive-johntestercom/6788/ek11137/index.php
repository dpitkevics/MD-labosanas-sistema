<?php 
function PostData()
{
	$LargestValue=0.0001;									
	for ($i=1; $i<6; $i++)
	{					
		if (($_POST["label$i"])!='') 
		{		
			$Inputs["label$i"]=$_POST["label$i"];
		}
		else 
		{
		$Inputs["label$i"]="label$i"; 
		}
		if (is_numeric($_POST["value$i"]) && ($_POST["value$i"])>0) 
		{
			$Inputs["value$i"]=($_POST["value$i"]);
			if ($Inputs["value$i"]>$LargestValue) 
			{
				$LargestValue=$Inputs["value$i"];
			}
		}
		else 
		{
			$Inputs["value$i"]=0;
		}
	}
	$Inputs["LargestValue"]=$LargestValue;
	return $Inputs;
}

$url=http_build_query(PostData());
$graphSrc="graph.php?$url";

function LabelTest($label)
{
	echo "value='" . $label . "'";
	if ($label == '') 
	{
		echo 'class="error"'; 
		return;
	}
}

function ValueTest($value)
{
	echo "value='" . $value . "'";
	if ($value == '' || ($value)<0 || !(is_numeric($value))) 
	{
		echo 'class="error"'; 
		return;
	}
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
				<td><input type="text" name="label1" tabindex="1" <?php if (isset($_POST["label1"])) LabelTest($_POST["label1"]); ?>/></td>
				<td><input type="text" name="label2" tabindex="3" <?php if (isset($_POST["label2"])) LabelTest($_POST["label2"]); ?>/></td>
				<td><input type="text" name="label3" tabindex="5" <?php if (isset($_POST["label3"])) LabelTest($_POST["label3"]); ?>/></td>
				<td><input type="text" name="label4" tabindex="7" <?php if (isset($_POST["label4"])) LabelTest($_POST["label4"]); ?>/></td>
				<td><input type="text" name="label5" tabindex="9" <?php if (isset($_POST["label5"])) LabelTest($_POST["label5"]); ?>/></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" name="value1" tabindex="2" <?php if (isset($_POST["value1"])) ValueTest($_POST["value1"]); ?>/></td>
				<td><input type="text" name="value2" tabindex="4" <?php if (isset($_POST["value2"])) ValueTest($_POST["value2"]); ?>/></td>
				<td><input type="text" name="value3" tabindex="6" <?php if (isset($_POST["value3"])) ValueTest($_POST["value3"]); ?>/></td>
				<td><input type="text" name="value4" tabindex="7" <?php if (isset($_POST["value4"])) ValueTest($_POST["value4"]); ?>/></td>
				<td><input type="text" name="value5" tabindex="10" <?php if (isset($_POST["value5"])) ValueTest($_POST["value5"]); ?>/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>