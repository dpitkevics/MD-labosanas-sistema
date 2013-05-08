<?php
   function input()
   {     
       for ($i=1; $i<=5; $i++)
       {
            if (isset($_POST["label$i"]) && ($_POST["label$i"])!="")
                {
                $val["label$i"]=$_POST["label$i"];
                }
            else 
                {
                $val["label$i"]="Graph$i";
                }
       
       
       if (isset($_POST["label$i"]) && is_numeric($_POST["value$i"]) && floatval($_POST["value$i"])>0)
       {
	$val["value$i"]=floatval($_POST["value$i"]);
       }
        else 
	{
         $val["value$i"]=0;
	}
       }
	
return $val;   
   };
   
function checkLabel($a)
{
    if (isset($a))
        echo "value=\"" . $a . "\"";
       
    if ($a === "")
    {
        echo "class=\"error\"";
        return;
    }
    
};

function checkValue($a)
{
    echo "value=\"" . $a . "\"";
    if ($a === "" || floatval($a)<0 || !(is_numeric($a)))
    {
        echo "class=\"error\"";
        return;
    }
};

$adress=http_build_query(input());
$graphSrc="graph.php?$adress";
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
	    <form method="POST" action="index.php">
		<table id="userdata">
			<tr id="titles">
				<th>Legend title</th>
				<td><input type="text" name="label1" tabindex="1" <?php if (isset($_POST["label1"])) checkLabel($_POST["label1"]); ?>/></td>
				<td><input type="text" name="label2" tabindex="3" <?php if (isset($_POST["label2"])) checkLabel($_POST["label2"]); ?>/></td>
				<td><input type="text" name="label3" tabindex="5" <?php if (isset($_POST["label3"])) checkLabel($_POST["label3"]); ?>/></td>
				<td><input type="text" name="label4" tabindex="7" <?php if (isset($_POST["label4"])) checkLabel($_POST["label4"]); ?>/></td>
				<td><input type="text" name="label5" tabindex="9" <?php if (isset($_POST["label5"])) checkLabel($_POST["label5"]); ?>/></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" name="value1" tabindex="2" <?php if (isset($_POST["value1"])) checkValue($_POST["value1"]); ?>/></td>
				<td><input type="text" name="value2" tabindex="4" <?php if (isset($_POST["value2"])) checkValue($_POST["value2"]); ?>/></td>
				<td><input type="text" name="value3" tabindex="6" <?php if (isset($_POST["value3"])) checkValue($_POST["value3"]); ?>/></td>
				<td><input type="text" name="value4" tabindex="7" <?php if (isset($_POST["value4"])) checkValue($_POST["value4"]); ?>/></td>
				<td><input type="text" name="value5" tabindex="10"<?php if (isset($_POST["value5"])) checkValue($_POST["value5"]); ?>/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>






