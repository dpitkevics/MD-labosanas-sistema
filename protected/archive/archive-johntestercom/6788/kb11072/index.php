<?php 
# This time you are allowed to do scripting and output 
# generation in the same file.
$graphSrc="http://www.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";

if($_POST){
    $l1=$_POST["label1"];
    $v1=$_POST["value1"];

    $l2=$_POST["label2"];
    $v2=$_POST["value2"];

    $l3=$_POST["label3"];
    $v3=$_POST["value3"];

    $l4=$_POST["label4"];
    $v4=$_POST["value4"];

    $l5=$_POST["label5"];
    $v5=$_POST["value5"];
   
    $label_flag=1;
    if($l1 == '' || $l2 == '' || $l3 == '' || $l4 == '' || $l5 == ''){
        $label_flag=0;
        echo "Please fill in all the label fields! <br />"; 
    }
    
    $value_flag_1=1;
    if($v1 == '' || $v2 == '' || $v3 == '' || $v4 == '' || $v5 == ''){
        $value_flag_1=0;
        echo "Please fill in all the value fields (inputs must be numeric)! <br />"; 
    }
    
    $value_flag_2=1;
    if(!is_numeric($v1)||!is_numeric($v2)||!is_numeric($v3)||!is_numeric($v4)||!is_numeric($v5)){
        $value_flag_2=0;
        echo "All the value fields must be numeric!"; 
    }
    
    if($label_flag && $value_flag_1 && $value_flag_2){
        $l1=urlencode($l1);
        $v1=urlencode($v1);

        $l2=urlencode($l2);
        $v2=urlencode($v2);

        $l3=urlencode($l3);
        $v3=urlencode($v3);

        $l4=urlencode($l4);
        $v4=urlencode($v4);
    
        $l5=urlencode($l5);
        $v5=urlencode($v5);
        
        
        $graphSrc="graph.php?label1=$l1&value1=$v1&label2=$l2&value2=$v2&label3=$l3&value3=$v3&label4=$l4&value4=$v4&label5=$l5&value5=$v5";
    }
}

#$graphSrc="http:// .wikimedia.org/wikipedia/commons/c/c0/Blank.gif";

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
	    <form action="index.php" method="POST">
		<table id="userdata">
			<tr id="titles">
				<th>Legend title</th>
				<td><input type="text" name="label1" tabindex="1" value="<?php if(isset($_POST["label1"])){ echo $_POST["label1"]; } ?>"/></td>
				<td><input type="text" name="label2" tabindex="3" value="<?php if(isset($_POST["label2"])){ echo $_POST["label2"]; } ?>"/></td>
				<td><input type="text" name="label3" tabindex="5" value="<?php if(isset($_POST["label3"])){ echo $_POST["label3"]; } ?>"/></td>
				<td><input type="text" name="label4" tabindex="7" value="<?php if(isset($_POST["label4"])){ echo $_POST["label4"]; } ?>"/></td>
				<td><input type="text" name="label5" tabindex="9" value="<?php if(isset($_POST["label5"])){ echo $_POST["label5"]; } ?>"/></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" name="value1" tabindex="2" value="<?php if(isset($_POST["value1"])){ echo $_POST["value1"]; } ?>"/></td>
				<td><input type="text" name="value2" tabindex="4" value="<?php if(isset($_POST["value2"])){ echo $_POST["value2"]; } ?>"/></td>
				<td><input type="text" name="value3" tabindex="6" value="<?php if(isset($_POST["value3"])){ echo $_POST["value3"]; } ?>"/></td>
				<td><input type="text" name="value4" tabindex="7" value="<?php if(isset($_POST["value4"])){ echo $_POST["value4"]; } ?>"/></td>
				<td><input type="text" name="value5" tabindex="10" value="<?php if(isset($_POST["value5"])){ echo $_POST["value5"]; } ?>"/></td>	
			</tr>
		</table>
		<input type="submit" name="formSubmit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>