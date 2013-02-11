<?php
//Iļja Gubins, ig11075
if(isset($_POST) && array_key_exists('label1',$_POST) ){ //not necessary label1, could be whatever what could be passed
                                                      //if it wasn't passed this variable will be NULL, but it will set
    $labels = Array($_POST['label1'], $_POST['label2'], $_POST['label3'], $_POST['label4'],$_POST['label5']);
    $values = Array($_POST['value1'], $_POST['value2'], $_POST['value3'], $_POST['value4'],$_POST['value5']);

    $invalid_labels = Array(0,0,0,0,0);
    $invalid_values = Array(0,0,0,0,0);

    for($i=0; $i<5; $i++) { //$invalid_labels will be used to mark inputs as invalid, but empty labels will still
                            //be passed to graph.php as they will be automatically labeled
        if(empty($labels[$i])) $invalid_labels[$i]=1;
    }

    for($i=0; $i<5; $i++) { //$invalid_values will be used to mark inputs as invalid, but invalid values will still
                            //be passed to graph.php as they should according to the h/w syllabus
        if(!is_numeric($values[$i]) || $values[$i]<0) {$invalid_values[$i]=1;}
    }

    //array for http_build_query
    $data = Array('label1'=>$labels[0], 'value1'=>$values[0],
                  'label2'=>$labels[1], 'value2'=>$values[1],
                  'label3'=>$labels[2], 'value3'=>$values[2],
                  'label4'=>$labels[3], 'value4'=>$values[3],
                  'label5'=>$labels[4], 'value5'=>$values[4]);
    $graphSrc="graph.php?".http_build_query($data)."";

}else{
    $graphSrc="http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";
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
                for($i=0; $i<5; $i++) //changed how it's being printed out because that's way prettier
                                      //than appending all this stuff(error and posted values) to html
                {
                    $b=(2*$i)+1; //for tabindex
                    $c=$i+1; //for name
                    echo '            <td><input type="text" name="label'.$c.'" tabindex="'. $b .'" ';
                        if(isset($labels)) echo 'value="'.htmlspecialchars($labels[$i],ENT_QUOTES).'" ';
                        if(isset($invalid_labels) && $invalid_labels[$i]) echo 'class="error" ';
                    echo '/></td>
                    ';
                }
                ?>    </tr>
			<tr id="values">
				<th>Value</th>
                    <?php
                for($i=0; $i<5; $i++) //changed how it's being printed out because that's way prettier
                                      //than appending all this stuff(error and posted values) to html
                {
                    $b=(2*$i)+2; //for tabindex
                    $c=$i+1; //for name
                    echo '            <td><input type="text" name="value'.$c.'" tabindex="'. $b .'" ';
                        if(isset($values)) echo 'value="'.htmlspecialchars($values[$i],ENT_QUOTES).'" ';
                        if(isset($invalid_values) && $invalid_values[$i]) echo 'class="error" ';
                    echo '/></td>
                    ';
                }
                ?>    </tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>