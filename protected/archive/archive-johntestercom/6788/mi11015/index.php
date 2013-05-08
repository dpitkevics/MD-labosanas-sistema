<?php 
# This time you are allowed to do scripting and output 
# generation in the same file.

/*
Maza piezīmīte par manu mājas darbu!
Teksta zīmēšanai izmantoju metodi - 
 imagettftext...
Tā kā šai metodei ir jānorāda fonts, tad savā arhīvā pievienoju klāt fonta failu.
Bet neesmu pārliecināts, uz kā tiks pārbaudīti mājas darbi un vai uz citām platformām
ttf fonti tiks atpazīti un strādās.

Gadījumā, ja neiet, tad vietās, kur izmantoju imagettftext motedi, tā ir jāaizkomentē un jāizmanto
  imagestring
 */

// funkcija, kas atgriež prasītā (parametrs) elementa post vērtību.
function get_post_element_value ($post_element) {
    if (isset($_POST[$post_element]))
        return $_POST[$post_element];
    Else
        return;
}

// Funkcija, kas atgriež klases nosaukumu input elementam.
// Mērķis ir atgriezt "error", ja ievadītā vērtība ir nekorekta, vai vispār nav ievadīta
function get_input_element_class_name ($post_element){
    if (sizeof($_POST)>0){  // nosacījums, lai pirmajā lapas atvēršanas reizē nebūtu kļūda
        if (! isset($_POST[$post_element])) // pārbaudam vai ir uzstādīts
            return 'error';
        if (empty($_POST[$post_element])) // ir tukša vērtība
                return 'error';
        if (strpos($post_element,'value') === 0) //ir skaitliskais elements
            if (! is_numeric($_POST[$post_element])) // nav cipars
                return 'error';
            elseif ($_POST[$post_element]<0) // cipars, bet mazāks par 0
                return 'error';
    }
}

// definējam pamat mainīgos, kurus izmantošu
$graphSrc="graph.php?";
$mas = [];     // savs masīvs, kurā būs vajadzīgie POST elementi
$query_str='';
for ($i=1; $i<6; $i++)  // salieku POST elementu vērtības savā masīvā, jau encodētas
{
    $input_name = 'label'.$i;
    if (isset($_POST[$input_name]))
        $mas[$input_name] = urlencode (get_post_element_value($input_name));
    $input_name = 'value'.$i;
    if (isset($_POST[$input_name]))
        $mas[$input_name] = urlencode (get_post_element_value($input_name));
    
}

//print_r($mas);

// izveidoju query stringu
if (sizeof($mas)>0)
    $query_str = http_build_query($mas);

// izveidoju gala url_stringu bildei
$graphSrc .= $query_str;
//unset($mas);
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
	<img src="<?php echo $graphSrc; ?>" id="graph" alt="The graph" width="600" height="400" /> 
	</section>
	<aside>
	    <form method="POST">
		<table id="userdata">
			<tr id="titles">
				<th>Legend title</th>
                                <td><input type="text" name="label1" tabindex="1" value="<?php echo get_post_element_value('label1');?>"
                                                                     class="<?php echo get_input_element_class_name('label1');?>"/></td>
				<td><input type="text" name="label2" tabindex="3" value="<?php echo get_post_element_value('label2');?>"
                                                                     class="<?php echo get_input_element_class_name('label2');?>"/></td>
				<td><input type="text" name="label3" tabindex="5" value="<?php echo get_post_element_value('label3');?>"
                                                                     class="<?php echo get_input_element_class_name('label3');?>"/></td>
				<td><input type="text" name="label4" tabindex="7" value="<?php echo get_post_element_value('label4');?>"
                                                                     class="<?php echo get_input_element_class_name('label4');?>"/></td>
				<td><input type="text" name="label5" tabindex="9" value="<?php echo get_post_element_value('label5');?>"
                                                                     class="<?php echo get_input_element_class_name('label5');?>"/></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" name="value1" tabindex="2" value="<?php echo get_post_element_value('value1');?>"
                                                                     class="<?php echo get_input_element_class_name('value1');?>"/></td>
				<td><input type="text" name="value2" tabindex="4" value="<?php echo get_post_element_value('value2');?>"
                                                                     class="<?php echo get_input_element_class_name('value2');?>"/></td>
				<td><input type="text" name="value3" tabindex="6" value="<?php echo get_post_element_value('value3');?>"
                                                                     class="<?php echo get_input_element_class_name('value3');?>"/></td>
				<td><input type="text" name="value4" tabindex="7" value="<?php echo get_post_element_value('value4');?>"
                                                                     class="<?php echo get_input_element_class_name('value4');?>"/></td>
				<td><input type="text" name="value5" tabindex="10" value="<?php echo get_post_element_value('value5');?>"
                                                                     class="<?php echo get_input_element_class_name('value5');?>"/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>