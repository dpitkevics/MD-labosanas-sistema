<?php
# This time you are allowed to do scripting and output
# generation in the same file.
$graphSrc = "graph.php";
#$graphSrc should point to graph.php with additional GET parameters

//*************Data collection***************
function check($one, $two) { //Find if data is Value or Label
    if (strncmp($one, $two, strlen($two)) == 0)
        return TRUE;
    else
        return FALSE;
}
$data = array(); //Stores user inputs
foreach ($_POST as $dat => $val) {//Collect user data
    if (check($dat, "label") || check($dat, "value")) {
        $data[$dat] = urlencode($val);
    }
}
$graphSrc.="?".http_build_query($data);
//*******************************************
//***********Validate data******************
function v_txt($txt){ //Validate txt
    if( is_string($txt) && strlen($txt) > 0) {
        return TRUE;
    }
    else return FALSE;
}
function v_val($value){//Validate value
    if (strlen($value) > 0 && is_numeric($value)){
        return TRUE;
    }
    else return FALSE;
}
//****************************************
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
                        <td><input type="text" name="label1" tabindex="1" value="<?php if (isset($_POST['label1'])) {echo $_POST['label1'];} else echo ""; ?>" class="<?php if (isset($_POST['label1'])) { if (v_txt($_POST['label1'])) echo ""; else echo "error";}?>"/></td>
                        <td><input type="text" name="label2" tabindex="3" value="<?php if (isset($_POST['label2'])) {echo $_POST['label2'];} else echo ""; ?>" class="<?php if (isset($_POST['label2'])) { if (v_txt($_POST['label2'])) echo ""; else echo "error";}?>"/></td>
                        <td><input type="text" name="label3" tabindex="5" value="<?php if (isset($_POST['label3'])) {echo $_POST['label3'];} else echo ""; ?>" class="<?php if (isset($_POST['label3'])) { if (v_txt($_POST['label3'])) echo ""; else echo "error";}?>"/></td>
                        <td><input type="text" name="label4" tabindex="7" value="<?php if (isset($_POST['label4'])) {echo $_POST['label4'];} else echo ""; ?>" class="<?php if (isset($_POST['label4'])) { if (v_txt($_POST['label4'])) echo ""; else echo "error";}?>"/></td>
                        <td><input type="text" name="label5" tabindex="9" value="<?php if (isset($_POST['label5'])) {echo $_POST['label5'];} else echo ""; ?>" class="<?php if (isset($_POST['label5'])) { if (v_txt($_POST['label5'])) echo ""; else echo "error";}?>"/></td>
                    </tr>
                    <tr id="values">
                        <th>Value</th>
                        <td><input type="text" name="value1" tabindex="2" value="<?php if (isset($_POST['value1'])) {echo $_POST['value1'];} else echo ""; ?>" class="<?php if(isset($_POST['label1'])){ if(v_val($_POST['value1'])){ echo "";} else echo "error";} ?>"/></td>
                        <td><input type="text" name="value2" tabindex="4" value="<?php if (isset($_POST['value2'])) {echo $_POST['value2'];} else echo ""; ?>" class="<?php if(isset($_POST['label2'])){ if(v_val($_POST['value2'])){ echo "";} else echo "error";} ?>"/></td>
                        <td><input type="text" name="value3" tabindex="6" value="<?php if (isset($_POST['value3'])) {echo $_POST['value3'];} else echo ""; ?>" class="<?php if(isset($_POST['label3'])){ if(v_val($_POST['value3'])){ echo "";} else echo "error";} ?>"/></td>
                        <td><input type="text" name="value4" tabindex="7" value="<?php if (isset($_POST['value4'])) {echo $_POST['value4'];} else echo ""; ?>" class="<?php if(isset($_POST['label4'])){ if(v_val($_POST['value4'])){ echo "";} else echo "error";} ?>"/></td>
                        <td><input type="text" name="value5" tabindex="10" value="<?php if (isset($_POST['value5'])) {echo $_POST['value5'];} else echo ""; ?>" class="<?php if(isset($_POST['label5'])){ if(v_val($_POST['value5'])){ echo "";} else echo "error";}?>"/></td>
                    </tr>
                </table>
                <input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
            </form>
        </aside>
    </body>
</html>