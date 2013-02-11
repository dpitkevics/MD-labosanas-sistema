<?php 
    $graphSrc = 'http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif';
    
    # Masîvs kurâ saglabâ iegûtâs input lauka vçrtîbas, kamçr nav saòemti
    //_POST dati, to vçrtîbas ir tukðas.
    $data = array('label1' => '',
                  'label2' => '',
                  'label3' => '',
                  'label4' => '',
                  'label5' => '',
                  'value1' => '',
                  'value2' => '',
                  'value3' => '',
                  'value4' => '',
                  'value5' => '');
    
    # Mainîgie, kas pieliks css klasi input laukam.
    $label1_error = '';
    $label2_error = '';
    $label3_error = '';
    $label4_error = '';
    $label5_error = '';
    $value1_error = '';
    $value2_error = '';
    $value3_error = '';
    $value4_error = '';
    $value5_error = '';
    
    # Ja ir saòemti _POST dati, tos ieliek masîvâ un pârbauda, ja tie nav 
    //nederîgi, tad pievieno error klasi.
    if ($_POST) {  
        $data = array('label1' => $_POST["label1"],
                      'label2' => $_POST["label2"],
                      'label3' => $_POST["label3"],
                      'label4' => $_POST["label4"],
                      'label5' => $_POST["label5"],
                      'value1' => $_POST["value1"],
                      'value2' => $_POST["value2"],
                      'value3' => $_POST["value3"],
                      'value4' => $_POST["value4"],
                      'value5' => $_POST["value5"]);
      
      if ($data['label1'] == '') { 
          $label1_error = 'class="error"';
      }
      if ($data['label2'] == '') { 
          $label2_error = 'class="error"';
      }
      if ($data['label3'] == '') { 
          $label3_error = 'class="error"';
      }
      if ($data['label4'] == '') { 
          $label4_error = 'class="error"';
      }
      if ($data['label5'] == '') { 
          $label5_error = 'class="error"';
      }
      
      if (!is_numeric($data['value1']) or $data['value1'] <= 0) { 
          $value1_error = 'class="error"';
      }
      if (!is_numeric($data['value2']) or $data['value2'] <= 0) { 
          $value2_error = 'class="error"';
      }
      if (!is_numeric($data['value3']) or $data['value3'] <= 0) { 
          $value3_error = 'class="error"';
      }
      if (!is_numeric($data['value4']) or $data['value4'] <= 0) { 
          $value4_error = 'class="error"';
      }
      if (!is_numeric($data['value5']) or $data['value5'] <= 0) { 
          $value5_error = 'class="error"';
      }

        # Deklarç bildes avota adresi ar nokodçtiem parametriem izmatnotojot `http_build_query`
        $graphSrc = 'graph.php?' . http_build_query($data, '', '&amp;');
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
				<td><input type="text" name="label1" tabindex="1" value="<?php echo htmlspecialchars($data['label1'])?>" <?php echo $label1_error?>/></td>
				<td><input type="text" name="label2" tabindex="3" value="<?php echo htmlspecialchars($data['label2'])?>" <?php echo $label2_error?>/></td>
				<td><input type="text" name="label3" tabindex="5" value="<?php echo htmlspecialchars($data['label3'])?>" <?php echo $label3_error?>/></td>
				<td><input type="text" name="label4" tabindex="7" value="<?php echo htmlspecialchars($data['label4'])?>" <?php echo $label4_error?>/></td>
				<td><input type="text" name="label5" tabindex="9" value="<?php echo htmlspecialchars($data['label5'])?>" <?php echo $label5_error?>/></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" name="value1" tabindex="2" value="<?php echo htmlspecialchars($data['value1'])?>" <?php echo $value1_error?>/></td>
				<td><input type="text" name="value2" tabindex="4" value="<?php echo htmlspecialchars($data['value2'])?>" <?php echo $value2_error?>/></td>
				<td><input type="text" name="value3" tabindex="6" value="<?php echo htmlspecialchars($data['value3'])?>" <?php echo $value3_error?>/></td>
				<td><input type="text" name="value4" tabindex="7" value="<?php echo htmlspecialchars($data['value4'])?>" <?php echo $value4_error?>/></td>
				<td><input type="text" name="value5" tabindex="10" value="<?php echo htmlspecialchars($data['value5'])?>" <?php echo $value5_error?>/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>