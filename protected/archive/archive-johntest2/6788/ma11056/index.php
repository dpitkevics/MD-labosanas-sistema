<?php
        $label1 = isset($_POST["label1"]) ? $_POST["label1"] : "";
        $label2 = isset($_POST["label2"]) ? $_POST["label2"] : "";
        $label3 = isset($_POST["label3"]) ? $_POST["label3"] : "";
        $label4 = isset($_POST["label4"]) ? $_POST["label4"] : "";
        $label5 = isset($_POST["label5"]) ? $_POST["label5"] : "";
        $value1 = isset($_POST["value1"]) ? $_POST["value1"] : "";
        $value2 = isset($_POST["value2"]) ? $_POST["value2"] : "";
        $value3 = isset($_POST["value3"]) ? $_POST["value3"] : "";
        $value4 = isset($_POST["value4"]) ? $_POST["value4"] : "";               
        $value5 = isset($_POST["value5"]) ? $_POST["value5"] : "";

        $query_string = "";
        if ($_POST) {
          $kv = array();
          foreach ($_POST as $key => $value) {
            $kv[] = "$key=$value";}
          $query_string = join("&", $kv);}
        else {
          $query_string = $_SERVER['QUERY_STRING'];}
?>
<?php 
# This time you are allowed to do scripting and output 
# generation in the same file.

$graphSrc="graph.php?".$query_string;


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
				<td><input type="text" name="label1" tabindex="1" value="<?php echo $label1 ?>"/></td>
				<td><input type="text" name="label2" tabindex="3" value="<?php echo $label2 ?>"/></td>
				<td><input type="text" name="label3" tabindex="5" value="<?php echo $label3 ?>"/></td>
				<td><input type="text" name="label4" tabindex="7" value="<?php echo $label4 ?>"/></td>
				<td><input type="text" name="label5" tabindex="9" value="<?php echo $label5 ?>"/></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
                                <?php $error_class = (is_numeric($value1) ? "" : (isset($_POST["value1"]) ? 'class="error"' : '' )); ?>
				<td><input <?php echo $error_class ?> type="text" name="value1" tabindex="2" value="<?php echo $value1 ?>"/></td>
                                <?php $error_class = (is_numeric($value2) ? "" : (isset($_POST["value2"]) ? 'class="error"' : '' )); ?>
				<td><input <?php echo $error_class ?> type="text" name="value2" tabindex="4" value="<?php echo $value2 ?>"/></td>
                                <?php $error_class = (is_numeric($value3) ? "" : (isset($_POST["value3"]) ? 'class="error"' : '' )); ?>
				<td><input <?php echo $error_class ?> type="text" name="value3" tabindex="6" value="<?php echo $value3 ?>"/></td>
                                <?php $error_class = (is_numeric($value4) ? "" : (isset($_POST["value4"]) ? 'class="error"' : '' )); ?>
				<td><input <?php echo $error_class ?> type="text" name="value4" tabindex="7" value="<?php echo $value4 ?>"/></td>
                                <?php $error_class = (is_numeric($value5) ? "" : (isset($_POST["value5"]) ? 'class="error"' : '' )); ?>
				<td><input <?php echo $error_class ?> type="text" name="value5" tabindex="10" value="<?php echo $value5 ?>"/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>