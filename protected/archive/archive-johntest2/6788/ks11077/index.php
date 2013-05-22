<?php 
# This time you are allowed to do scripting and output 
# generation in the same file.

$graphSrc="graph.php";

$n = 5;

$incorrect = Array();

if(!empty($_POST))
{
  $values = Array();
  for($i=1; $i<=$n; $i++)
  {
    $kv = 'label'.$i;
    if(isset($_POST[$kv]) && $_POST[$kv] != '')
    {
      $values['l'.$i] = $_POST[$kv];
    }
    else
    {
      $incorrect[$kv] = true;
    }
  }
  for($i=1; $i<=$n; $i++)
  {
    $kv = 'value'.$i;
    if(isset($_POST[$kv]) && is_numeric($_POST[$kv]) && strlen($_POST[$kv]) < 30 &&
      strpos($_POST[$kv], 'e') === false && strpos($_POST[$kv], 'E')===false)
    {
      $values['v'.$i] = $_POST[$kv];
    }
    else
    {
      $incorrect[$kv] = true;
    }
  }
  $graphSrc = $graphSrc."?".http_build_query($values);
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
				  for($i=1; $i<=$n; $i++)
				  {
				    echo '<td><input type="text" name="label'.$i.'" tabindex="'.(2*$i-1).'"';
				    $kv = 'label'.$i;
				    if(isset($incorrect[$kv])) echo ' class="error"';
				    if(isset($_POST[$kv])) echo ' value="'.htmlspecialchars($_POST[$kv]).'"';
				    echo '/></td>';
          }
				?>
			</tr>
			<tr id="values">
				<th>Value</th>
				<?php
				  for($i=1; $i<=$n; $i++)
				  {
				    echo '<td><input type="text" name="value'.$i.'" tabindex="'.(2*$i).'"';
				    $kv = 'value'.$i;
				    if(isset($incorrect[$kv])) echo ' class="error"';
				    if(isset($_POST[$kv])) echo ' value="'.htmlspecialchars($_POST[$kv]).'"';
				    echo '/></td>';
          }
				?>
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>
