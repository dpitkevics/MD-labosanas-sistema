<?php 
if(isset($_POST['Submit'])){
    
for ($i=1; $i<6; $i++){
            if (!$_POST['label'. $i]){
                $arr[$i-1]="";         
            } else $arr[$i-1]=$_POST['label'. $i];
        }
for ($i=1; $i<6; $i++){
            if (!$_POST['value'. $i]){
                $arr[$i+4]="";      
            } else $arr[$i+4]=$_POST['value'. $i];
        }
}
else{
    for ($i=0; $i<10; $i++)
    $arr[$i]="";
}          
        
function apstrade($arr){
    
    for ($i=0; $i<5; $i++){
            if ($arr[$i]===""){
                $res[$i]="No Lable";         
            } else $res[$i]=$arr[$i];
        }
    for ($i=5; $i<10; $i++){
        if ($arr[$i]!==""){
            if (is_numeric($arr[$i])){ 
                if  (is_string($arr[$i])){
                    #Ir problçma, ja cilvçki ievada piem. 6,5 tad strâdâ, bet ja ievada 6.5 tad intval() pârveido to pa 6?? Un kamçr ir string tips nevar izmantot is_int().
                    $res[$i]=intval($arr[$i]);
                    if ($res[$i]<0) $res[$i]=0;
                } else if (is_int($arr[i])){
                    $res[$i]=$arr[$i];
                } else $res[$i]=0;
            }
            else $res[$i]=0;
        }
        else {
            $res[$i]=0;
        }
    }
    
return $res;
}

$res=apstrade($arr);

$graphSrc="graph.php?".http_build_query($res, 'arr_');

function error1($dati){
    if(isset($_POST['Submit'])){
        if ($dati==="No Lable")
            return "error";
        else return "";
    } else return"";
}

function error($dati){
    if(isset($_POST['Submit'])){
        if (!$dati or $dati<0 or !is_numeric($dati))
            return "error";
        else return "";
    } else return "";
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
		<img src="<?php echo $graphSrc ?>" id="graph" alt="The graph" width="600" height="400" />
	</section>
	<aside>
	    <form method="POST" action="index.php">
		<table id="userdata">
			<tr id="titles">
				<th>Legend title</th>
				<td><input type="text" name="label1" class="<?php echo error1($res[0])?>" value="<?php echo $arr[0]?>" tabindex="1"/></td>
				<td><input type="text" name="label2" class="<?php echo error1($res[1])?>" value="<?php echo $arr[1]?>" tabindex="3"/></td>
				<td><input type="text" name="label3" class="<?php echo error1($res[2])?>" value="<?php echo $arr[2]?>" tabindex="5"/></td>
				<td><input type="text" name="label4" class="<?php echo error1($res[3])?>" value="<?php echo $arr[3]?>" tabindex="7"/></td>
				<td><input type="text" name="label5" class="<?php echo error1($res[4])?>" value="<?php echo $arr[4]?>" tabindex="9"/></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" name="value1" class="<?php echo error($arr[5])?>" value="<?php echo $arr[5]?>" tabindex="2"/></td>
				<td><input type="text" name="value2" class="<?php echo error($arr[6])?>" value="<?php echo $arr[6]?>" tabindex="4"/></td>
				<td><input type="text" name="value3" class="<?php echo error($arr[7])?>" value="<?php echo $arr[7]?>" tabindex="6"/></td>
				<td><input type="text" name="value4" class="<?php echo error($arr[8])?>" value="<?php echo $arr[8]?>" tabindex="7"/></td>
				<td><input type="text" name="value5" class="<?php echo error($arr[9])?>" value="<?php echo $arr[9]?>" tabindex="10"/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" name="Submit" tabindex="11" value="Draw it!" />
                
	    </form>
	</aside>  
</body>
</html>