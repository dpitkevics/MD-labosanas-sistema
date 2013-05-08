<?php 
# This time you are allowed to do scripting and output 
# generation in the same file.

$query = array();
$isPost = count($_POST) != 0;
if($isPost) {
    foreach($_POST as $key=>$value) {
        $_POST[$key] = trim($value);
        $query[$key] = urlencode($_POST[$key]);
    }
}
$graphSrc="/graph.php?" . http_build_query($query);

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
                                for($i=1; $i<=5; $i++) {
                                    if (!$isPost || !isset($_POST["label".$i])) {
                                        $value = "";
                                    } else {
                                        $value = $_POST["label".$i];
                                    }
                                    $tabindex = $i*2 - 1;
                                    ?>
                                    <td><input type="text" name="label<?php echo $i;?>" value="<?php echo $value;?>" tabindex="<?php echo $tabindex;?>"/></td>
                                    <?php
                                }
                            ?> 
			</tr>
			<tr id="values">
                            <th>Value</th>
                            <?php
                                for($i=1; $i<=5; $i++) {
                                    if (!$isPost || !isset($_POST["value".$i])) {
                                        $value = "";
                                    } else {
                                        $value = $_POST["value".$i];
                                        if (strlen($value) == 0 || !is_numeric($value)|| $value < 0) {
                                            $class = "error";
                                        } else {
                                            $class = "";
                                        }
                                    }
                                    $tabindex = $i*2;
                                    ?>
                                    <td><input type="text" name="value<?php echo $i;?>" value="<?php echo $value;?>" tabindex="<?php echo $tabindex;?>" class="<?php echo $class;?>"/></td>
                                    <?php
                                }
                            ?>
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>