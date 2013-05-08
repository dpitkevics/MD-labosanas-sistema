<?php
    
    $values='';
    /**
     * The loop goes through $_POST array and appends the
     * values (if valid) to generated url 
     */
    for($i=1;$i<6;$i++){
        $value = 'value'.$i;
        $label = 'label'.$i;
        if(isset($_POST[$value]) && !empty($_POST[$value])&& is_numeric($_POST[$value])){
            if(strlen($values) > 2) $values .= '&';
            $values .= 'value'.$i.'='.urlencode($_POST[$value]);
        }
        if(isset($_POST[$label]) && !empty($_POST[$label])){
            if(strlen($values) > 2) $values .= '&';
            $values .= 'label'.$i.'='.urlencode($_POST[$label]);
        }
    }
    if(strlen($values)>1){
        $graphSrc = 'graph.php'.'?'.$values;
    } else{
        $graphSrc = 'graph.php';
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
            <img src="<?php if(isset($graphSrc))echo $graphSrc; ?>" id="graph" alt="The graph" width="600" height="400" />
        </section>
        <aside>
            <form method="POST" action="index.php">
                <table id="userdata">
                    <tr id="titles">
                        <th>Legend title</th>
                        <td><input type="text" name="label1" tabindex="1" value="<?php if(isset($_POST['label1'])) echo $_POST['label1']; ?>"></td>
                        <td><input type="text" name="label2" tabindex="3" value="<?php if(isset($_POST['label2'])) echo $_POST['label2']; ?>"></td>
                        <td><input type="text" name="label3" tabindex="5" value="<?php if(isset($_POST['label3'])) echo $_POST['label3']; ?>"></td>
                        <td><input type="text" name="label4" tabindex="7" value="<?php if(isset($_POST['label4'])) echo $_POST['label4']; ?>"></td>
                        <td><input type="text" name="label5" tabindex="9" value="<?php if(isset($_POST['label5'])) echo $_POST['label5']; ?>"></td>	
                    </tr>
                    <tr id="values">
                        <th>Value</th>
                        <td><input type="text" name="value1" tabindex="2" value="<?php if(isset($_POST['value1'])) echo $_POST['value1']; ?>"
                                   class="<?php if(!empty($_POST['value1']) && !is_numeric($_POST['value1'])) echo 'error' ?>"></td>
                        <td><input type="text" name="value2" tabindex="4" value="<?php if(isset($_POST['value2'])) echo $_POST['value2']; ?>"
                                   class="<?php if(!empty($_POST['value2']) && !is_numeric($_POST['value2'])) echo 'error' ?>"></td>
                        <td><input type="text" name="value3" tabindex="6" value="<?php if(isset($_POST['value3'])) echo $_POST['value3']; ?>"
                                   class="<?php if(!empty($_POST['value3']) && !is_numeric($_POST['value3'])) echo 'error' ?>"></td>
                        <td><input type="text" name="value4" tabindex="7" value="<?php if(isset($_POST['value4'])) echo $_POST['value4']; ?>"
                                   class="<?php if(!empty($_POST['value4']) && !is_numeric($_POST['value4'])) echo 'error' ?>"></td>
                        <td><input type="text" name="value5" tabindex="10" value="<?php if(isset($_POST['value5'])) echo $_POST['value5']; ?>"
                                   class="<?php if(!empty($_POST['value5']) && !is_numeric($_POST['value5'])) echo 'error' ?>"></td>	
                    </tr>
                </table>
                <input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
            </form>
        </aside>
    </body>
</html>