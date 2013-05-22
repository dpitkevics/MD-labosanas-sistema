<?php 
# This time you are allowed to do scripting and output 
# generation in the same file.

$graphSrc = "http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";

#$graphSrc should point to graph.php with additional GET parameters
$formData = array();
$formErrors = array();
for ($i = 1; $i <= 5; $i++) {
    $formData['label' . $i] = '';
    $formData['value' . $i] = '';
    $formErrors['label' . $i] = false;
    $formErrors['value' . $i] = false;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Validate values
    for ($i = 1; $i <= 5; $i++) {
        $key = 'value' . $i;
        if (
            isset($_POST[$key])
            && !empty($_POST[$key]) 
            && is_string($_POST[$key]) 
            && ctype_digit($_POST[$key])
        ) {
            $formData[$key] = intval($_POST[$key]);
        } else {
            $formErrors[$key] = true;
        }
    }

    //Validate labels
    for ($i = 1; $i <= 5; $i++) {
        $key = 'label' . $i;
        if (
            isset($_POST[$key])
            && !empty($_POST[$key])
            && is_string($_POST[$key])
            && strlen($_POST[$key]) > 0
        ) {
            $formData[$key] = $_POST[$key];
        } else {
            $formErrors[$key] = true;
        }
    }

    $graphSrc = 'graph.php?' . htmlspecialchars(http_build_query($formData));
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
	    <form method="POST">
		<table id="userdata">
			<tr id="titles">
				<th>Legend title</th>
                <?php 
                    for ($i = 1; $i <= 5; $i++) {
                        $class = $formErrors['label' . $i] ? ' class="error"' : '';
                        echo '
                            <td>
                                <input type="text" name="label'.$i.'" 
                                    value="'.htmlspecialchars($formData['label' . $i]).'" 
                                    tabindex="'.($i*2 - 1).'" 
                                    '.$class.' />
                            </td>
                        ';
                    }
                ?>
			</tr>
			<tr id="values">
				<th>Value</th>
                <?php 
                    for ($i = 1; $i <= 5; $i++) {
                        $class = $formErrors['value' . $i] ? ' class="error"' : '';
                        echo '
                            <td>
                                <input type="text" name="value'.$i.'" 
                                    value="'.htmlspecialchars($formData['value' . $i]).'" 
                                    tabindex="'.($i*2).'"
                                    '.$class.' />
                            </td>
                        ';
                    }
                ?>
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>
