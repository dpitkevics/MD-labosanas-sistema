<?php 
# This time you are allowed to do scripting and output 
# generation in the same file.

if(isset($_POST) && array_key_exists('label1',$_POST) )
{
$labels = Array($_POST['label1'], $_POST['label2'], $_POST['label3'], $_POST['label4'],$_POST['label5']);
$values = Array($_POST['value1'], $_POST['value2'], $_POST['value3'], $_POST['value4'],$_POST['value5']);

$erroneous_labels = Array(0,0,0,0,0);
$erroneous_values = Array(0,0,0,0,0);

for($i=0; $i<5; $i++) 
{
	if(empty($labels[$i])) 
	{	
		$erroneous_labels[$i]=1;
	}
}

for($i=0; $i<5; $i++) 
{ 
	if(!is_numeric($values[$i]) || $values[$i]<0) 
	{
		$erroneous_values[$i]=1;
	}
}

//Label and value array
$info = Array('label1'=>$labels[0], 'value1'=>$values[0], 'label2'=>$labels[1], 'value2'=>$values[1], 'label3'=>$labels[2], 'value3'=>$values[2], 'label4'=>$labels[3], 'value4'=>$values[3], 'label5'=>$labels[4], 'value5'=>$values[4]);

$graphSrc="graph.php?".http_build_query($info)."";

}
else
{
	$graphSrc="http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";
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
				
				<?php 
				for($i=0; $i<5; $i++) 
				{
					$tab_index=(2*$i)+1; //for tabindex
					$namez=$i+1; //for name
					echo '            <td><input type="text" name="label'.$namez.'" tabindex="'. $tab_index .'" ';
					if(isset($labels)) echo 'value="'.htmlspecialchars($labels[$i],ENT_QUOTES).'" ';
					if(isset($erroneous_labels) && $erroneous_labels[$i]) echo 'class="error" ';
					echo '/></td>
					';
				}
				?>    
				
				</tr>
							
					<tr id="values">
					<th>Value</th>
				                    
				<?php
				for($i=0; $i<5; $i++) 
				{
					$tab_index=(2*$i)+2; 
					$namez=$i+1; 
					echo '            <td><input type="text" name="value'.$namez.'" tabindex="'. $tab_index .'" ';
					if(isset($values)) echo 'value="'.htmlspecialchars($values[$i],ENT_QUOTES).'" ';
					if(isset($erroneous_values) && $erroneous_values[$i]) echo 'class="error" ';
					echo '/></td>
					';
				}
				?>
				
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>