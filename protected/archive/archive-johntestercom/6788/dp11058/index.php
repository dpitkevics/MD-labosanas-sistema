<?php 
# This time you are allowed to do scripting and output 
# generation in the same file.

$graphSrc="http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";

// pārveido stringu par int, ja tas ir cipars 
function isInt($x)
{
	return (is_numeric($x) ? intval($x) == $x : false);
}

// defaultās vērtības, lai pievienojot input klasi un default vērtības nerādītu kļūdas
$p = null;
$error = array();

// pārbaudam vai forma ir submitota
if ($_SERVER['REQUEST_METHOD'] === "POST")
{
	$p = $_POST;
	$data = array();

	for ($i = 1; $i <= 5; $i++)
	{
		// ja labels ir tukšs, tad kļūda ir gan label, gan value
		if (!empty($p['label'.$i]))
		{
			// ja value ir tukšs vai nav int, tad kļūda pie value, bet label saglabājam
			if (isInt($p['value'.$i]))
			{
				$data[htmlspecialchars($p['label'.$i])] = htmlspecialchars(intval($p['value'.$i]));
			}
			else
			{
				$data[htmlspecialchars($p['label'.$i])] = 0;
				$error[] = 'value'.$i;
			}
		}
		else
		{
			$error[] = 'label'.$i;
			$error[] = 'value'.$i;
		}

	}

	// izveidojam gatavu, pilnu URL
	$graphSrc = 'http://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] .'graph.php?'. http_build_query($data, '', '&amp;');
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
				<td><input type="text" name="label1" id="f" tabindex="1" <?=($p!=null)?'value="'.htmlspecialchars($p['label1']).'"':''?> <?=(in_array('label1', $error))?'class="error"':''?> /></td>
				<td><input type="text" name="label2" tabindex="3" <?=($p!=null)?'value="'.htmlspecialchars($p['label2']).'"':''?> <?=(in_array('label2', $error))?'class="error"':''?> /></td>
				<td><input type="text" name="label3" tabindex="5" <?=($p!=null)?'value="'.htmlspecialchars($p['label3']).'"':''?> <?=(in_array('label3', $error))?'class="error"':''?> /></td>
				<td><input type="text" name="label4" tabindex="7" <?=($p!=null)?'value="'.htmlspecialchars($p['label4']).'"':''?> <?=(in_array('label4', $error))?'class="error"':''?> /></td>
				<td><input type="text" name="label5" tabindex="9" <?=($p!=null)?'value="'.htmlspecialchars($p['label5']).'"':''?> <?=(in_array('label5', $error))?'class="error"':''?> /></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" name="value1" tabindex="2" <?=($p!=null)?'value="'.htmlspecialchars($p['value1']).'"':''?> <?=(in_array('value1', $error))?'class="error"':''?> /></td>
				<td><input type="text" name="value2" tabindex="4" <?=($p!=null)?'value="'.htmlspecialchars($p['value2']).'"':''?> <?=(in_array('value2', $error))?'class="error"':''?> /></td>
				<td><input type="text" name="value3" tabindex="6" <?=($p!=null)?'value="'.htmlspecialchars($p['value3']).'"':''?> <?=(in_array('value3', $error))?'class="error"':''?> /></td>
				<td><input type="text" name="value4" tabindex="7" <?=($p!=null)?'value="'.htmlspecialchars($p['value4']).'"':''?> <?=(in_array('value4', $error))?'class="error"':''?> /></td>
				<td><input type="text" name="value5" tabindex="10"<?=($p!=null)?'value="'.htmlspecialchars($p['value5']).'"':''?> <?=(in_array('value5', $error))?'class="error"':''?> /></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>