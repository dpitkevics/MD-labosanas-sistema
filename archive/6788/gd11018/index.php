<?php 
# This time you are allowed to do scripting and output 
# generation in the same file.
function apstrade()
{
//nokluseta max vertiba
	$max=1;	
//savada vertibas masiva
	for ($i=1; $i<6; $i++) 
		{
//Pârbauda label vertibas
			if (isset($_POST["label$i"]) && ($_POST["label$i"])!="") 
				{
					$vert["label$i"]=$_POST["label$i"];
				}
//Ja nosaukums nav ierakstits, tad noklusejuma nosaukums bus "empty"
			else 
				{
					$vert["label$i"]="empty"; 
				}
//Pârbauda value vçrtîbas un atrod max vertibu
			if (isset($_POST["value$i"]) && is_numeric($_POST["value$i"]) && $_POST["value$i"]>0) 
				{
					$vert["value$i"]=$_POST["value$i"];
					if ($vert["value$i"]>$max) {$max=$vert["value$i"];}
				}
			else 
				{
					$vert["value$i"]=0;
				}
		}
	$vert["max"]=$max;
	return $vert;
}
$link=http_build_query(apstrade());
$graphSrc="graph.php?$link";
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
				<td><input type="text" name="label1" tabindex="1"/></td>
				<td><input type="text" name="label2" tabindex="3"/></td>
				<td><input type="text" name="label3" tabindex="5"/></td>
				<td><input type="text" name="label4" tabindex="7"/></td>
				<td><input type="text" name="label5" tabindex="9" /></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" name="value1" tabindex="2"/></td>
				<td><input type="text" name="value2" tabindex="4"/></td>
				<td><input type="text" name="value3" tabindex="6"/></td>
				<td><input type="text" name="value4" tabindex="7"/></td>
				<td><input type="text" name="value5" tabindex="10"/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>