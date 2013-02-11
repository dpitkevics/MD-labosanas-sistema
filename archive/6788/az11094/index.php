<?php 
$graphSrc="http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";


$label1 = '';
$label2 = '';
$label3 = '';
$label4 = '';
$label5 = '';
$value1 = '';
$value2 = '';
$value3 = '';
$value4 = '';
$value5 = '';
// dati tiek sutiti tikai tad, kad tie ir saņemti POST masīvā.
if  ($_POST) 
{   
    $masivs = array(
    'label1' => $_POST["label1"],
    'label2' => $_POST["label2"],
    'label3' => $_POST["label3"],
    'label4' => $_POST["label4"],
    'label5' => $_POST["label5"],
        
    'value1' => $_POST["value1"],
    'value2' => $_POST["value2"],
    'value3' => $_POST["value3"],
    'value4' => $_POST["value4"],
    'value5' => $_POST["value5"]);
    
    if($masivs['label1']==''){ $label1='class="error"'; }
    if($masivs['label2']==''){ $label2='class="error"'; }
    if($masivs['label3']==''){ $label3='class="error"'; }
    if($masivs['label4']==''){ $label4='class="error"'; }
    if($masivs['label5']==''){ $label5='class="error"'; }
    
    if(!is_numeric($masivs['value1']) || $masivs['value1']<0){ $value1='class="error"'; } //pienjemu, ka 0 var rakstit, ja ne, tad <=0
    if(!is_numeric($masivs['value2']) || $masivs['value2']<0){ $value2='class="error"'; }
    if(!is_numeric($masivs['value3']) || $masivs['value3']<0){ $value3='class="error"'; }
    if(!is_numeric($masivs['value4']) || $masivs['value4']<0){ $value4='class="error"'; }
    if(!is_numeric($masivs['value5']) || $masivs['value5']<0){ $value5='class="error"'; }
       
    

$graphSrc = 'graph.php?' . http_build_query($masivs,'','&amp;');
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
	    <form  method="POST">
		<table id="userdata">
			<tr id="titles">
				<th>Legend title</th>
                                <!-- var izmantot htmlentities, lai citi navaretu manipulet ar datiem ievadot piem. "> -->  
				<td><input type="text" name="label1" tabindex="1"      
                                value="<?php if(isset($_POST['label1'])){echo htmlentities($_POST['label1']); }?>" 
                                <?php echo $label1; ?>/></td>
                                
                               <td><input type="text" name="label2" tabindex="3"
                                value="<?php if(isset($_POST['label2'])){echo$_POST['label2']; }?>" 
                                <?php echo $label2; ?>/></td>
                                
				<td><input type="text" name="label3" tabindex="5"
                                value="<?php if(isset($_POST['label3'])){echo$_POST['label3']; }?>" 
                                <?php echo $label3; ?>/></td>
                                
				<td><input type="text" name="label4" tabindex="7"
                                value="<?php if(isset($_POST['label4'])){echo$_POST['label4']; }?>" 
                                <?php echo $label4;  ?>/></td>
                                
				<td><input type="text" name="label5" tabindex="9"
                                value="<?php if(isset($_POST['label5'])){echo$_POST['label5']; }?>" 
                                <?php  echo $label5;  ?>/></td>
                                
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" name="value1" tabindex="2"
                                value="<?php if(isset($_POST['value1'])){echo$_POST['value1']; }?>"
                                <?php  echo $value1;?>/></td>
                                
				<td><input type="text" name="value2" tabindex="4"
                                value="<?php if(isset($_POST['value2'])){echo$_POST['value2']; }?>"
                                <?php  echo $value2 ; ?>/></td>
				<td><input type="text" name="value3" tabindex="6"
                                value="<?php if(isset($_POST['value3'])){echo$_POST['value3']; }?>"
                                <?php  echo $value3; ?>/></td>
				<td><input type="text" name="value4" tabindex="7"
                                value="<?php if(isset($_POST['value4'])){echo$_POST['value4']; }?>"
                                <?php echo $value4; ?>/></td>
				<td><input type="text" name="value5" tabindex="10"
                                value="<?php if(isset($_POST['value5'])){echo$_POST['value5']; }?>"
                                <?php echo $value5;?>/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>