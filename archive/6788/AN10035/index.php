<?php 
#init
$graphSrc="http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";

$label = array("","","","","");
$value = array(0,0,0,0,0);

if ($_POST != NULL)
{
    $newSrc="graph.php?";
    foreach($_POST as $key=>$val) 
    {
        if ($val != NULL) {
            
            if ("label" == substr_replace($key, "", -1))
            {
                $label[intval(substr ($key, -1))-1] = $val;
                $newSrc .= $key."=".urlencode($val)."&";
            }
            if ("value" == substr_replace($key, "", -1))
            {
                $value[intval(substr ($key, -1))-1] = $val;
                $newSrc .= $key."=".urlencode($val)."&";
            }
        }
    }
    $graphSrc = substr_replace($newSrc, "", -1);
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
		<img src="<?php echo $graphSrc;?>" id="graph" alt="The graph" width="600" height="400" />
	</section>
	<aside>
	    <form method="POST" action="index.php">
		<table id="userdata">
			<tr id="titles">
				<th>Legend title</th>
				<td><input <?php echo "value=\"".$label[0]."\""; ?> type="text" name="label1" tabindex="1"/></td>
				<td><input <?php echo "value=\"".$label[1]."\""; ?> type="text" name="label2" tabindex="3"/></td>
				<td><input <?php echo "value=\"".$label[2]."\""; ?> type="text" name="label3" tabindex="5"/></td>
				<td><input <?php echo "value=\"".$label[3]."\""; ?> type="text" name="label4" tabindex="7"/></td>
				<td><input <?php echo "value=\"".$label[4]."\""; ?> type="text" name="label5" tabindex="9" /></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
                                <td><input <?php echo "value=\"".$value[0]."\""; if(!is_numeric($value[0])) echo " class=\"error\""; ?> type="text" name="value1" tabindex="2"/></td>
                                <td><input <?php echo "value=\"".$value[1]."\""; if(!is_numeric($value[1])) echo " class=\"error\""; ?> type="text" name="value2" tabindex="4"/></td>
                                <td><input <?php echo "value=\"".$value[2]."\""; if(!is_numeric($value[2])) echo " class=\"error\""; ?> type="text" name="value3" tabindex="6"/></td>
                                <td><input <?php echo "value=\"".$value[3]."\""; if(!is_numeric($value[3])) echo " class=\"error\""; ?> type="text" name="value4" tabindex="7"/></td>
                                <td><input <?php echo "value=\"".$value[4]."\""; if(!is_numeric($value[4])) echo " class=\"error\""; ?> type="text" name="value5" tabindex="10"/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>