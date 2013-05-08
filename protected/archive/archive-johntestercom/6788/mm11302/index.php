<?php
// glabā nelabo vērtību ievadlauku indeksus
$errenousValues = array();

// izdrukā ievadlaukus
function echoInputs($name) {
    global $errenousValues;
    for ($i = 1; $i <= 5; $i++) {
        $curName = "$name$i";
        $curTabIndex = ($name === 'label') ? ($i + $i - 1) : ($i * 2);
        $curValue = (isset($_POST[$curName])) ?  $_POST[$curName] : '';
        $isErrenous = in_array($i, $errenousValues, true) && ($name == 'value');
        $errorClass = ($isErrenous === true) ? 'class=\'error\'' : '';
        echo "<td><input type='text' $errorClass name='$curName' value='$curValue' tabindex='$curTabIndex' /></td>\n";
    }
}

// pārbauda saņemtās POST vērtības
function validateValues() {
    global $errenousValues;
    for ($i = 1; $i <= 5; $i++) {
        $curValue = (isset($_POST["value$i"])) ? $_POST["value$i"] : '';
        if ($curValue == '') {
            continue;
        }
        elseif (is_numeric($curValue)) {
            if ($curValue < 0) {
                array_push($errenousValues, $i);
            }
        }
        else {
            array_push($errenousValues, $i);
        }
    }
}

// izdrukā grafika URLi
function echoGraphUrl() {
    $graphSrc = "graph.php";
    $i = 0;
    foreach ($_POST as $key => $value) {
        $graphSrc .= ($i++ === 0) ? '?' : '&';
        $graphSrc .= $key.'='.urlencode($value);
    }
    echo $graphSrc;
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
		<img src="<?php validateValues(); echoGraphUrl(); ?>" id="graph" alt="The graph" width="600" height="400" />
	</section>
	<aside>
	    <form method="POST">
		<table id="userdata">
			<tr id="titles">
				<th>Legend title</th>
                <?php echoInputs('label'); ?>
			</tr>
			<tr id="values">
                <th>Value</th>
                <?php echoInputs('value'); ?>
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>
