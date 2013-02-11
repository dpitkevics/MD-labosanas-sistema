<?php 

if (!empty($_POST)) {
    $success = array_walk($_POST , create_function('&$value,$key',
                    'if(!strstr($value, \'&\') and !strstr($value, \'=\')) $value = $key."=".$value ;
                        else $value = $key."=";'));
    
    if ($success) {
        $graphSrc = "graph.php?".htmlentities(urlencode(implode("&",$_POST)), ENT_QUOTES);
    }
}
else $graphSrc="http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";


function is_error_label ($key) {
    if(!empty($_POST)) {
        if (($pos = strpos($_POST[$key], '=')) !== false) {
            $var = substr($_POST[$key], $pos + 1);
            if(empty($var)) {
                echo("class=\"error\""); 
            }
            else echo ("");
        }
    }
    else echo ("");
}


function is_error ($key) {
    if(!empty($_POST)) {
        if (($pos = strpos($_POST[$key], '=')) !== false) {
                if(!is_numeric(substr($_POST[$key], $pos + 1)) or (substr($_POST[$key], $pos + 1)) < 0) {
                    echo("class=\"error\""); 
                }
                else echo ("");
        }
    }
    else echo ("");
}


function repost($key) {
    if(!empty($_POST)) {
        if (($pos = strpos($_POST[$key], '=')) !== false) {
                echo(substr($_POST[$key], $pos + 1));
        }
    }
    else echo("");
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
		<img src="<?php echo $graphSrc; ?>" id="graph" alt="The graph" width="600" height="400" />
	</section>
	<aside>
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
		<table id="userdata">
			<tr id="titles">
				<th>Legend title</th>
                                <td><input <?php is_error_label('label1'); ?> type="text" name="label1" tabindex="1" value="<?php repost('label1'); ?>"/></td>
				<td><input <?php is_error_label('label2'); ?> type="text" name="label2" tabindex="3" value="<?php repost('label2'); ?>"/></td>
				<td><input <?php is_error_label('label3'); ?> type="text" name="label3" tabindex="5" value="<?php repost('label3'); ?>"/></td>
				<td><input <?php is_error_label('label4'); ?> type="text" name="label4" tabindex="7" value="<?php repost('label4'); ?>"/></td>
				<td><input <?php is_error_label('label5'); ?> type="text" name="label5" tabindex="9" value="<?php repost('label5'); ?>"/></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
                                <td><input <?php is_error('value1'); ?> type="text" name="value1" tabindex="2" value="<?php repost('value1'); ?>"/></td>
				<td><input <?php is_error('value2'); ?> type="text" name="value2" tabindex="4" value="<?php repost('value2'); ?>"/></td>
				<td><input <?php is_error('value3'); ?> type="text" name="value3" tabindex="6" value="<?php repost('value3'); ?>"/></td>
				<td><input <?php is_error('value4'); ?> type="text" name="value4" tabindex="7" value="<?php repost('value4'); ?>"/></td>
				<td><input <?php is_error('value5'); ?> type="text" name="value5" tabindex="10" value="<?php repost('value5'); ?>"/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>