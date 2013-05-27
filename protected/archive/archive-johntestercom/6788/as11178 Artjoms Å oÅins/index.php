<?php 

$as = array();
$sa = array();

if (!empty($_POST))
for($i=1 ; $i<=5; $i++){
    $as[$i] = $_POST['label'.$i];
    $sa[$i] = $_POST['value'.$i];
}
else 
for($i=1 ; $i<=5; $i++){
    $as[$i] = "";
    $sa[$i] = "";
}

$c_lab = array();
$c_val = array();
for($i=1 ; $i<=5; $i++){
 $c_lab[$i] = '';
 $c_val[$i] = '';

}

if (!empty($_POST))
{
 for($i=1 ; $i<=5; $i++){
    if($as[$i]==""){
        $c_lab[$i]="error";
    } else $c_lab[$i]="";
    if(!is_numeric($sa[$i])){
        $c_val[$i]="error";
    } else $c_val[$i]="";
}
 $graphSrc = "graph.php?".http_build_query($as, 'label')."&".http_build_query($sa, 'value');
} else $graphSrc = "http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";

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

				<td><input class="<?php echo $c_lab[1]; ?>" type="text" value="<?php echo $as[1]; ?>" name="label1" tabindex="1"/></td>

				<td><input class="<?php echo $c_lab[2]; ?>" type="text" value="<?php echo $as[2]; ?>" name="label2" tabindex="3"/></td>

				<td><input class="<?php echo $c_lab[3]; ?>" type="text" value="<?php echo $as[3]; ?>" name="label3" tabindex="5"/></td>

				<td><input class="<?php echo $c_lab[4]; ?>" type="text" value="<?php echo $as[4]; ?>" name="label4" tabindex="7"/></td>

				<td><input class="<?php echo $c_lab[5]; ?>" type="text" value="<?php echo $as[5]; ?>" name="label5" tabindex="9" /></td>
	
			</tr>
		
	<tr id="values">
			
	<th>Value</th>
				
				<td><input class="<?php echo $c_val[1]; ?>" type="text" value="<?php echo $sa[1]; ?>" name="value1" tabindex="2"/></td>

				<td><input class="<?php echo $c_val[2]; ?>" type="text" value="<?php echo $sa[2]; ?>" name="value2" tabindex="4"/></td>

				<td><input class="<?php echo $c_val[3]; ?>" type="text" value="<?php echo $sa[3]; ?>" name="value3" tabindex="6"/></td>

				<td><input class="<?php echo $c_val[4]; ?>" type="text" value="<?php echo $sa[4]; ?>" name="value4" tabindex="7"/></td>

				<td><input class="<?php echo $c_val[5]; ?>" type="text" value="<?php echo $sa[5]; ?>" name="value5" tabindex="10"/></td>
	
			</tr>
	
	</table>
	
	<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	
    </form>
	
</aside>

</body>

</html>