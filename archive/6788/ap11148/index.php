<?php 
error_reporting(E_ALL);
# This time you are allowed to do scripting and output 
# generation in the same file.
$graphSrc='';
$data = "";
for ($i=1; $i<=5; $i++) { 
    $label = 'label'.$i;
    $value = 'value'.$i;
    
//GET PREVIOUS LABEL - IF EXISTS;
    if (isset($_POST[$label])) {
        $tmp = $_POST[$label];
        $data[$label] =  $tmp;    
    } else  $data[$label] = '';
    if (isset($_POST[$value])) {
        $tmp = $_POST[$value];
        $data[$value] =  $tmp;    
    } else  $data[$value] = '';
}
$sent_data = '';
foreach ($data as $key => $value) {
    $sent_data[$key] = urlencode($value);
}
$data_string = http_build_query($sent_data);
//$data_string = urlencode( serialize($sent_data));
//	if(isset($_POST['runCommand']))  {
//		//$ser_data = serialize($_POST)
////                $ser_data_raw = $_POST;
//                $ser_data_raw = $data;
//                
//            foreach ($ser_data_raw as $dat) {
//                $dat = urldecode($dat);
//            };
//	$ser_data = http_build_query($ser_data_raw); }
//	else  $ser_data = ""; 
	//$graphSrc="graph.php?values=".serialize($_POST);
        
	$graphSrc="graph.php?".$data_string;
#$graphSrc should point to graph.php with additional GET parameters
function invalid1($arg)
{
    if ($arg=="") return "error";
    else return null;
}
function invalid2($arg)
{
    if (is_numeric($arg)) return null;
    else return "error";
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
    
    <?php
//	// used only to test graph works or not. 
//		echo "<pre>";
//		print_r($_POST);
//		echo "</pre>";
//		echo "<br>request: ";
//		if (isset($data_string)) { print_r($data_string);} else echo "fuck";
//		echo "<br>";
//                echo $graphSrc; "<br>";
//                echo "</pre>";
//	/// End of test graph
?>
	<section>	
		<img src="<?php echo $graphSrc; ?>" id="graph" alt="The graph" width="600" height="400" />
	</section>
	<aside>
	    <form method="POST" >
		<table id="userdata">
			<tr id="titles">
				<th>Legend title</th>
				<?php
				
				for ($i=1; $i<=5; $i++) { 
					$label = 'label'.$i;
					$tmp = $data[$label];
					echo "<td><input type='text' name= \"$label\"  tabindex=$i value=\"$tmp\" class = \"".invalid1($tmp)."\"/></td>";
				}
				
				?>
	
				<!-- <td><input type="text" name="label5" value= <?php //echo $_POST["label5"] ?> tabindex="9" /></td>	 -->
			</tr>
			<tr id="values">
				<th>Value</th>
				<?php
				for ($i=1; $i<=5; $i++) { 
					$label = 'value'.$i;
					$tmp = $data[$label];
					echo "<td><input type='text' name= \"$label\"  tabindex=$i value=\"$tmp\" class = \"".invalid2($tmp)."\"/></td>";
                                        
				}
				?>
			</tr>
		</table>
		<input type="submit" name="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>

</body>
</html>