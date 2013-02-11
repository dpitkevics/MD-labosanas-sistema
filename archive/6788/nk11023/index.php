<?php  
if (array_key_exists ('label1',$_POST)) 
//pārbauda, vai eksistē masīvs ar indeksu "label1" (tā kā sākuma nekāda masīva nav,
//tiks paradīts noklusētais attēls un tikai pēc pogas "Draw It!" nospiešnas saģenerēsies
//jauna attēla URL
{
 for($i=1; $i<6; $i++) //datu vākšana
 {
  if (isset($_POST['label'.$i]) and is_string($_POST['label'.$i]) and $_POST['label'.$i]!="")
    { 
     $labels['label'.$i]=$_POST['label'.$i]; //saglabā pareizo stab. nosauk. masivā
     $user_input_labels['label'.$i]=$_POST['label'.$i]; //saglaba pareizo stab. nosauk., lai atgrieztu to input laukā
     $labels_error[$i]=0; //saglabā masivā info., ka stab. nosauk. ir pareizs
    }
   else
    { 
     $user_input_labels['label'.$i]=$_POST['label'.$i]; //saglaba nekorektu stab. nosauk., lai atgrieztu to input laukā
     $labels['label'.$i]='label'.$i; //labo nekorektu stab. nosauk. uz noklusētu
     $labels_error[$i]=1; //saglabā masivā info., ka stab. nosauk. ir nepareizs
    }
   if (isset($_POST['value'.$i]) and is_numeric($_POST['value'.$i]) and $_POST['value'.$i]>=0)
    { 
     $values['value'.$i]=$_POST['value'.$i]; //saglabā pareizo stab. vert. masivā
     $user_input_values['value'.$i]=$_POST['value'.$i]; //saglaba pareizo stab. vert., lai atgrieztu to input laukā
     $values_error[$i]=0; //saglabā masivā info., ka stab. vert. ir pareizs
    }
   else
    {
     $user_input_values['value'.$i]=$_POST['value'.$i]; //saglaba nekorektu stab. vert., lai atgrieztu to input laukā
     $values['value'.$i]=0; //labo nekorektu stab. vert. uz noklusētu
     $values_error[$i]=1; //saglabā masivā info., ka stab. vert. ir nepareizs
    }
  }
 $graphSrc="graph.php?".http_build_query($labels+$values); //ģēnerē zimējuma URL
 }
else
 $graphSrc="http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";
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
				<td><input type="text" name="label1" tabindex="1" value="<?php if(isset($user_input_labels)) echo $user_input_labels['label1']; ?>" <?php if(isset($labels_error) and $labels_error[1]==1) echo 'class="error"'; ?> /></td>
				<td><input type="text" name="label2" tabindex="3" value="<?php if(isset($user_input_labels)) echo $user_input_labels['label2']; ?>" <?php if(isset($labels_error) and $labels_error[2]==1) echo 'class="error"'; ?> /></td>
				<td><input type="text" name="label3" tabindex="5" value="<?php if(isset($user_input_labels)) echo $user_input_labels['label3']; ?>" <?php if(isset($labels_error) and $labels_error[3]==1) echo 'class="error"'; ?> /></td>
				<td><input type="text" name="label4" tabindex="7" value="<?php if(isset($user_input_labels)) echo $user_input_labels['label4']; ?>" <?php if(isset($labels_error) and $labels_error[4]==1) echo 'class="error"'; ?> /></td>
				<td><input type="text" name="label5" tabindex="9" value="<?php if(isset($user_input_labels)) echo $user_input_labels['label5']; ?>" <?php if(isset($labels_error) and $labels_error[5]==1) echo 'class="error"'; ?> /></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" name="value1" tabindex="2" value="<?php if(isset($user_input_values)) echo $user_input_values['value1']; ?>" <?php if(isset($values_error) and $values_error[1]==1) echo 'class="error"'; ?> /></td>
				<td><input type="text" name="value2" tabindex="4" value="<?php if(isset($user_input_values)) echo $user_input_values['value2']; ?>" <?php if(isset($values_error) and $values_error[2]==1) echo 'class="error"'; ?> /></td>
				<td><input type="text" name="value3" tabindex="6" value="<?php if(isset($user_input_values)) echo $user_input_values['value3']; ?>" <?php if(isset($values_error) and $values_error[3]==1) echo 'class="error"'; ?> /></td>
				<td><input type="text" name="value4" tabindex="7" value="<?php if(isset($user_input_values)) echo $user_input_values['value4']; ?>" <?php if(isset($values_error) and $values_error[4]==1) echo 'class="error"'; ?> /></td>
				<td><input type="text" name="value5" tabindex="10" value="<?php if(isset($user_input_values)) echo $user_input_values['value5']; ?>" <?php if(isset($values_error) and $values_error[5]==1) echo 'class="error"'; ?> /></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>