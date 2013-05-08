

<?php 

function legendas($legenda)
	{
		if (isset($_POST[$legenda]))
			{
				$dati=$_POST[$legenda];
			}
		else 
			{
				$dati='';
			}
		urlencode($dati);
		return $dati;
	};

function vertibas($vertiba)
	{
		if (isset($_POST[$vertiba])&&is_numeric($_POST[$vertiba]))
			{
				$dati=intval($_POST[$vertiba]);
			}
		else
			{
				$dati='';
			}
		urlencode($dati);
		return $dati;
	};


$datumasivs = array();
for($i = 0; $i <5; $i++)
	{
		$vertiba = "vertiba" . $i;
		$legenda = "legenda" . $i;
		$datumasivs[$vertiba] = vertibas($vertiba);
		$datumasivs[$legenda] = legendas($legenda);
	};

$graphSrc = 'graph.php?' . http_build_query($datumasivs);


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
					for ($i = 0; $i < 5; $i++)
					{
						$vards = 'legenda' . $i;
						echo '<td><input type = "text" name = " . $vards . " /></td>';
					}
				?>
			</tr>
			<tr id="values">
				<th>Value</th>
				<?php 
					for ($i = 0; $i < 5; $i++)
					{
						$vards = 'vertiba' . $i;
						echo '<td><input type = "text" name = " . $vards . "  /></td>';
					}
				?>
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>


