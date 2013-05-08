<?php 
$lbls = array();
$vals = array();
$validlbl = array();
$validval = array();

foreach ($_POST as $k => $val)
{
	$arr = substr($k, 0, -1);
	$key = substr($k, -1);
	if ($arr == 'label')
	{
		$lbls[$key] = $val;
		//validation
		if ($val == "")
			$validlbl[$key] = 'error';
	}
	else
	{
		$vals[$key] = $val;
		//validation
		if (!(is_int(intval($val)) && is_numeric($val)))
			$validval[$key] = 'error';
	}
}

//preparing querystring in a way that every value is valid

$params = array();

for($i = 1; $i<=5; $i++)
{
	$val = isset($lbls[$i]) && !isset($validlbl[$i]) ? $lbls[$i] : "label".$i;
	$params["l".strval($i)] = $val;
}



for($i = 1; $i<=5; $i++)
{

	$val = isset($vals[$i]) && !isset($validval[$i]) ? $vals[$i] : 0;
	$params["v".$i] = $val;
}

$q = http_build_query($params);

$graphSrc="graph.php?".$q;

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
				<td><input class="<?php if (isset($validlbl[1])) echo $validlbl[1];?>" type="text" name="label1" tabindex="1" value="<?php if (isset($lbls[1])) echo $lbls[1]; ?>"/></td>
				<td><input class="<?php if (isset($validlbl[2])) echo $validlbl[2];?>" type="text" name="label2" tabindex="3" value="<?php if (isset($lbls[2])) echo $lbls[2]; ?>"/></td>
				<td><input class="<?php if (isset($validlbl[3])) echo $validlbl[3];?>" type="text" name="label3" tabindex="5" value="<?php if (isset($lbls[3])) echo $lbls[3]; ?>"/></td>
				<td><input class="<?php if (isset($validlbl[4])) echo $validlbl[4];?>" type="text" name="label4" tabindex="7" value="<?php if (isset($lbls[4])) echo $lbls[4]; ?>"/></td>
				<td><input class="<?php if (isset($validlbl[5])) echo $validlbl[5];?>" type="text" name="label5" tabindex="9" value="<?php if (isset($lbls[5])) echo $lbls[5]; ?>" /></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input class="<?php if (isset($validval[1])) echo $validval[1];?>" type="text" name="value1" tabindex="2" value="<?php if (isset($vals[1])) echo $vals[1]; ?>"/></td>
				<td><input class="<?php if (isset($validval[2])) echo $validval[2];?>" type="text" name="value2" tabindex="4" value="<?php if (isset($vals[2])) echo $vals[2]; ?>"/></td>
				<td><input class="<?php if (isset($validval[3])) echo $validval[3];?>" type="text" name="value3" tabindex="6" value="<?php if (isset($vals[3])) echo $vals[3]; ?>"/></td>
				<td><input class="<?php if (isset($validval[4])) echo $validval[4];?>" type="text" name="value4" tabindex="7" value="<?php if (isset($vals[4])) echo $vals[4]; ?>"/></td>
				<td><input class="<?php if (isset($validval[5])) echo $validval[5];?>" type="text" name="value5" tabindex="10" value="<?php if (isset($vals[5])) echo $vals[5]; ?>"/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>