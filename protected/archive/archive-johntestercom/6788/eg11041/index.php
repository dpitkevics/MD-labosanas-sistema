<?php
/*
Author: Çriks Gopaks, LU DF 2.kurss
ID: eg11041

Comments:
1. In this solution I disallowed negative and hex values for input data.
2. I thought of filtering which POST data should be sent here (because such a method is completely insecure against any kind of JavaScript/HTML injection, i.e. user can actually pass any POST data to the graph.php file). But decided to leave this as is, because the same user can easily see that we are using GET method for passing arguments to our graph.php file (see <img src="graph.php?...">).
If I wanted to make this home task more secure against attackers, I would prefer sending POST data to 'graph.php', putting generated image to a file and then pointing to that image from <img src="generated_image.png">. I guess that would lessen chances for an attacker to 'hack' graph.php script.
However, it does not seem like I should really be concerned about security right now :) Oh well...


Developed this work using Notepad++ (in my opinion, the best for learning programming languages).
Tested on Apache 2.2 web server.
*/
?>
<?php
$graphSrc = "graph.php?".http_build_query($_POST);
// Note: http_build_query function url-encodes its arguments

function validLabel($label)
{
    // Disallowing a bunch of spaces/tabs, so that $label = '   ' is considered invalid.
    return trim($label) != false;
}

function validValue($value)
{
    // Expecting $value to be castable to double
    if (is_numeric($value))
    {
        // Disallowing hexadecimal values
        if (intval($value) === 0 && intval($value, 16) !== 0)
        {
            return false;
        }
        
        if (doubleval($value) >= 0) // Disallowing negative values
        {
            return true;
        }
        return false;
    }
    return false;
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
                            for ($i = 1; $i <= 5; $i++)
                            {
                                // Some decorative tabulation
                                if ($i > 1) for ($j = 0; $j < 6; $j++) echo "    ";
                                $val = trim($_POST["label$i"]);
                                $class = (sizeof($_POST) == 0 || validLabel($val)) ? "" : "error";
                                echo "<td><input type='text' name='label$i' tabindex='".(2 * $i - 1)."' value='$val' class='$class' /></td>\n";
                            }
                        ?>
                    </tr>
                    <tr id="values">
                        <th>Value</th>
                        <?php
                            for ($i = 1; $i <= 5; $i++)
                            {
                                // Some decorative tabulation
                                if ($i > 1) for ($j = 0; $j < 6; $j++) echo "    ";
                                $val = trim($_POST["value$i"]);
                                $class = (sizeof($_POST) === 0 || validValue($val)) ? "" : "error";
                                echo "<td><input type='text' name='value$i' tabindex='".(2 * $i)."' value='$val' class='$class' /></td>\n";
                            }
                        ?>
                    </tr>
                </table>
                <input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
            </form>
        </aside>
    </body>
</html>