<?php 
$string='?'; $f=array(); $c=0; $empty=0;
$vals=array('label1','label2','label3','label4','label5','value1','value2','value3','value4','value5');
foreach($vals as $val){
	$$val=''; $c++;
	//Nederīgo/tukšo lauciņu nosaukumus iemet iekš $f
	if($c<6) { if(!isset($_POST[$val]) || $_POST[$val]=='') array_push($f,$val); }
	else if($c>5){ if(!isset($_POST[$val]) || !is_numeric($_POST[$val]) || $_POST[$val]=='') array_push($f,$val);}
	
	if(isset($_POST[$val])) {
		if($_POST[$val]=='') $empty+=1;
		$$val=$_POST[$val];
		$string.=$val.'='.urlencode($_POST[$val]).'&';
	}
}
$string=rtrim($string,'&');
if(sizeof($_POST)==0 || $empty==10) { $f=array(); $string='';} //Reseto datus, ja visi lauciņi bijuši tukši.
$graphSrc="graph.php".$string;
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
				<td><input type="text" name="label1" <?php if(in_array('label1',$f)) echo 'class="error"'; ?> tabindex="1" value="<?php echo $label1; ?>"/></td>
				<td><input type="text" name="label2" <?php if(in_array('label2',$f)) echo 'class="error"'; ?> tabindex="3" value="<?php echo $label2; ?>"/></td>
				<td><input type="text" name="label3" <?php if(in_array('label3',$f)) echo 'class="error"'; ?> tabindex="5" value="<?php echo $label3; ?>"/></td>
				<td><input type="text" name="label4" <?php if(in_array('label4',$f)) echo 'class="error"'; ?> tabindex="7" value="<?php echo $label4; ?>"/></td>
				<td><input type="text" name="label5" <?php if(in_array('label5',$f)) echo 'class="error"'; ?> tabindex="9" value="<?php echo $label5; ?>"/></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" name="value1" <?php if(in_array('value1',$f)) echo 'class="error"'; ?> tabindex="2" value="<?php echo $value1; ?>"/></td>
				<td><input type="text" name="value2" <?php if(in_array('value2',$f)) echo 'class="error"'; ?> tabindex="4" value="<?php echo $value2; ?>"/></td>
				<td><input type="text" name="value3" <?php if(in_array('value3',$f)) echo 'class="error"'; ?> tabindex="6" value="<?php echo $value3; ?>"/></td>
				<td><input type="text" name="value4" <?php if(in_array('value4',$f)) echo 'class="error"'; ?> tabindex="7" value="<?php echo $value4; ?>"/></td>
				<td><input type="text" name="value5" <?php if(in_array('value5',$f)) echo 'class="error"'; ?> tabindex="10" value="<?php echo $value5; ?>"/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>