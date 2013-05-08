<?PHP
if (isset($_POST['Submit1'])) {
    for($i = 1; $i < 6; $i++){
        $mas[$i-1] = $_POST['value' . $i];
        if(!is_numeric($mas[$i-1]) || ($mas[$i-1])<0 ) 
            $mas[$i-1]="error";
    }
    for($i = 1; $i < 6; $i++){
        $mas[$i+4] = $_POST['label' . $i];
        if(($mas[$i+4])==="") 
            $mas[$i+4] = "error"; // echo "Parveidots" ." ". $mas[$i+4] . '<br>';
    }
}
else {
    for($i = 0; $i < 10; $i++)
        $mas[$i] = "";
}

for($i = 0; $i < 5; $i++){
        if(!is_numeric($mas[$i]))
            $mas2[$i] = 0;
        else{
            $mas2[$i] = intval($mas[$i]); // echo "Parveidots" . $mas[$i] . '<br>';
        }
}

for($i = 5; $i < 10; $i++){
    if($mas[$i]=="error")
        $mas2[$i] = "NoLabel";
    else 
        $mas2[$i] = $mas[$i];
}


?>
<?php 
# This time you are allowed to do scripting and output 
# generation in the same file.

$graphSrc="graph.php?".http_build_query($mas2, 'mas');
//echo $graphSrc;

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
	    <form method="POST" action ="index.php">
		<table id="userdata">
			<tr id="titles">
				<th>Legend title</th>
				<td><input type="text" value="<?PHP print $mas[5];?>" name="label1" tabindex="1"/></td>
				<td><input type="text" value="<?PHP print $mas[6];?>" name="label2" tabindex="3"/></td>
				<td><input type="text" value="<?PHP print $mas[7];?>" name="label3" tabindex="5"/></td>
				<td><input type="text" value="<?PHP print $mas[8];?>" name="label4" tabindex="7"/></td>
				<td><input type="text" value="<?PHP print $mas[9];?>" name="label5" tabindex="9" /></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" value="<?PHP print $mas[0];?>" name="value1" tabindex="2"/></td>
				<td><input type="text" value="<?PHP print $mas[1];?>" name="value2" tabindex="4"/></td>
				<td><input type="text" value="<?PHP print $mas[2];?>" name="value3" tabindex="6"/></td>
				<td><input type="text" value="<?PHP print $mas[3];?>" name="value4" tabindex="7"/></td>
				<td><input type="text" value="<?PHP print $mas[4];?>" name="value5" tabindex="10"/></td>	
			</tr>
		</table>
		<input type="submit" Name = "Submit1" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>