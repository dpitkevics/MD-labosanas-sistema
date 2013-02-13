<?php 
# This time you are allowed to do scripting and output 
# generation in the same file.
$label_array = array(
        1 => "Empty",
        2 => "Empty",
        3 => "Empty",
        4 => "Empty",
        5 => "Empty"
    );

$value_array = array(
    1 => 0,
    2 => 0,
    3 => 0,
    4 => 0,
    5 => 0
    );

$url="graph.php?";
if(!empty($_POST))
{    
    for($i=1; $i<6; $i++)
    {
        if(isset($_POST["label".$i])&& strval($_POST["label".$i]))
        {
            $data=$_POST["label".$i];        
            if(is_string($data))
            {
                $label_array[$i]=$data;
            }
        }
        if(isset($_POST["value".$i]))
        {
            $data=$_POST["value".$i];        
            if(is_numeric($data))
            {
                $value_array[$i]=$data;
            }
        }
    }
    for($i=1; $i<6; $i++)
    {
       $url = $url . "label" . $i . "=" . $label_array[$i] . "&";
    }
    for($i=1; $i<5; $i++)
    {
       $url = $url . "value" . $i . "=" . $value_array[$i] . "&";
    }
    $url = $url . "value" . "5" . "=" . $value_array[5];
    $graphSrc=$url;
}
else
{   
    for($i=1; $i<6; $i++)
    {
       $url = $url . "label" . $i . "=" . $label_array[$i] . "&";
    }
    for($i=1; $i<5; $i++)
    {
       $url = $url . "value" . $i . "=" . $value_array[$i] . "&";
    }
    $url = $url . "value" . "5" . "=" . $value_array[5];
    $graphSrc=$url;
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