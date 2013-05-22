<?php 

function datuapstrade(){
$max=1;// pie��ir 1 jo ar 0 dallit nedr�kst

for ($i=1; $i<6; $i++){//izveido mas�vu
#P�rbauda kolonnu nosaukumus
if (isset($_POST["label$i"]) && ($_POST["label$i"])!="") {
	$vertibas["label$i"]=$_POST["label$i"];}
else 
	{$vertibas["label$i"]="label$i"; //Ja nav ievad�ts der�gs nosaukums to pie��ir autom�tiski
	}
#P�rbauda skaitlisk�s v�rt�bas + atrod liel�ko no v�rt�b�m lai viegl�k uzz�m�t grafiku
if (isset($_POST["label$i"]) && is_numeric($_POST["value$i"]) && floatval($_POST["value$i"])>0) {
	$vertibas["value$i"]=floatval($_POST["value$i"]);
#Skaitlisk�s v�rt�bas tiek p�rv�rstas uz float tipu lai p�c tam ar t�m var�tu veikt dal��anas darb�bas
	if ($vertibas["value$i"]>$max) {$max=$vertibas["value$i"];}
	}
else 
	{$vertibas["value$i"]=0;
	}}
	
$vertibas["max"]=$max;
return $vertibas;
	}
$adrese=http_build_query(datuapstrade());
$graphSrc="graph.php?$adrese";
#P�rbauda nosaukumus
function Lparbaude($a)
{
if (isset($a))echo "value=\"" . $a . "\"";
{if ($a === "") {echo "class=\"error\""; return;}
}
}
#P�rbauda skaitlisk�s v�rt�bas
function Vparbaude($a){
echo "value=\"" . $a . "\"";
if ($a === "" || floatval($a)<0 || !(is_numeric($a))) {echo "class=\"error\""; return;}
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
	    <form method="POST" action="index.php">
		<table id="userdata">
			<tr id="titles">
				<th>Legend title</th>
				<td><input type="text" name="label1" tabindex="1" <?php if (isset($_POST["label1"])) Lparbaude($_POST["label1"]); ?>/></td>
				<td><input type="text" name="label2" tabindex="3" <?php if (isset($_POST["label2"])) Lparbaude($_POST["label2"]); ?>/></td>
				<td><input type="text" name="label3" tabindex="5" <?php if (isset($_POST["label3"])) Lparbaude($_POST["label3"]); ?>/></td>
				<td><input type="text" name="label4" tabindex="7" <?php if (isset($_POST["label4"])) Lparbaude($_POST["label4"]); ?>/></td>
				<td><input type="text" name="label5" tabindex="9" <?php if (isset($_POST["label5"])) Lparbaude($_POST["label5"]); ?>/></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" name="value1" tabindex="2" <?php if (isset($_POST["value1"])) Vparbaude($_POST["value1"]); ?>/></td>
				<td><input type="text" name="value2" tabindex="4" <?php if (isset($_POST["value2"])) Vparbaude($_POST["value2"]); ?>/></td>
				<td><input type="text" name="value3" tabindex="6" <?php if (isset($_POST["value3"])) Vparbaude($_POST["value3"]); ?>/></td>
				<td><input type="text" name="value4" tabindex="7" <?php if (isset($_POST["value4"])) Vparbaude($_POST["value4"]); ?>/></td>
				<td><input type="text" name="value5" tabindex="10" <?php if (isset($_POST["value5"])) Vparbaude($_POST["value5"]); ?>/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>