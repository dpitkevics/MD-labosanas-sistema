<?php 
   if(isset($_POST['label1'])) {
   $title[0] = $_POST['label1']; 
   }
   if(isset($_POST['label2'])){ 
   $title[1] = $_POST['label2'];
   }
   if(isset($_POST['label3'])){ 
   $title[2] = $_POST['label3']; 
   }
   if(isset($_POST['label4'])){ 
   $title[3] = $_POST['label4'];
   }
   if(isset($_POST['label5'])){ 
   $title[4] = $_POST['label5'];
   }
   if(isset($_POST['value1'])){ 
   $value[0] = $_POST['value1'];
   }
   if(isset($_POST['value2'])){
   $value[1] = $_POST['value2'];
   }
   if(isset($_POST['value3'])){
   $value[2] = $_POST['value3'];
   }
   if(isset($_POST['value4'])){
   $value[3] = $_POST['value4'];
   }
   if(isset($_POST['value5'])){
   $value[4] = $_POST['value5'];
   }
 for($i = 0 ; $i < 5 ; $i++)
 {
     if(empty($title[$i]))
     {
         $title[$i]='Label '.($i+1);
     }
     if(empty($value[$i])||!is_numeric($value[$i])||($value[$i]<0))
     {
         $value[$i]=0;
     }
 }
 for($i = 0 ; $i < 5 ; $i++)
 {
     $titleURL[$i] = urlencode($title[$i]);
     $valueURL[$i] = urlencode($value[$i]);
 }
$data = array('label1'=>$titleURL[0],
              'label2'=>$titleURL[1],
              'label3'=>$titleURL[2],
              'label4'=>$titleURL[3],
              'label5'=>$titleURL[4],
              'value1'=>$valueURL[0],
              'value2'=>$valueURL[1],
              'value3'=>$valueURL[2],
              'value4'=>$valueURL[3],
              'value5'=>$valueURL[4] );

if($_POST){
$url =  http_build_query($data);
$graphSrc = 'graph.php?'.$url;
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
				<td><input<?php echo isset($_POST['label1']) && empty($_POST['label1']) ? ' class="error"' : '';?> type="text" name="label1" tabindex="1" value="<?php echo isset($_POST['label1']) ? htmlspecialchars($_POST['label1']) : ''; ?>"/></td>
				<td><input<?php echo isset($_POST['label2']) && empty($_POST['label2']) ? ' class="error"' : '';?> type="text" name="label2" tabindex="3" value="<?php echo isset($_POST['label2']) ? htmlspecialchars($_POST['label2']) : ''; ?>"/></td>
				<td><input<?php echo isset($_POST['label3']) && empty($_POST['label3']) ? ' class="error"' : '';?> type="text" name="label3" tabindex="5" value="<?php echo isset($_POST['label3']) ? htmlspecialchars($_POST['label3']) : ''; ?>"/></td>
				<td><input<?php echo isset($_POST['label4']) && empty($_POST['label4']) ? ' class="error"' : '';?> type="text" name="label4" tabindex="7"value="<?php echo isset($_POST['label4']) ? htmlspecialchars($_POST['label4']) : ''; ?>"/></td>
				<td><input<?php echo isset($_POST['label5']) && empty($_POST['label5']) ? ' class="error"' : '';?> type="text" name="label5" tabindex="9"value="<?php echo isset($_POST['label5']) ? htmlspecialchars($_POST['label5']) : ''; ?>" /></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
                                <td><input<?php echo isset($_POST['value1']) && (empty($_POST['value1']) || !is_numeric($_POST['value1']) || ($_POST['value1']<0)) ? ' class="error"' : '';?> type="text" name="value1" tabindex="2"value="<?php echo isset($_POST['value1']) ? htmlspecialchars($_POST['value1']) : ''; ?>"/></td>
				<td><input<?php echo isset($_POST['value2']) && (empty($_POST['value2']) || !is_numeric($_POST['value2']) || ($_POST['value2']<0))? ' class="error"' : '';?> type="text" name="value2" tabindex="4"value="<?php echo isset($_POST['value2']) ? htmlspecialchars($_POST['value2']) : ''; ?>"/></td>
				<td><input<?php echo isset($_POST['value3']) && (empty($_POST['value3']) || !is_numeric($_POST['value3']) || ($_POST['value3']<0))? ' class="error"' : '';?> type="text" name="value3" tabindex="6"value="<?php echo isset($_POST['value3']) ? htmlspecialchars($_POST['value3']) : ''; ?>"/></td>
				<td><input<?php echo isset($_POST['value4']) && (empty($_POST['value4']) || !is_numeric($_POST['value4']) || ($_POST['value4']<0))? ' class="error"' : '';?> type="text" name="value4" tabindex="7"value="<?php echo isset($_POST['value4']) ? htmlspecialchars($_POST['value4']) : ''; ?>"/></td>
				<td><input<?php echo isset($_POST['value5']) && (empty($_POST['value5']) || !is_numeric($_POST['value5']) || ($_POST['value5']<0))? ' class="error"' : '';?> type="text" name="value5" tabindex="10"value="<?php echo isset($_POST['value5']) ? htmlspecialchars($_POST['value5']) : ''; ?>"/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>