<?php 
# This time you are allowed to do scripting and output 
# generation in the same file.

class HomeWork {
	public static $inst;
	private static $error = array();

	public function getUrl() {
		$url = array();

		for ($i=1; $i<=5; $i++) {
			$url['label'.$i] = isset($_POST['label'.$i]) ? urlencode($_POST['label'.$i]) : '';
			$url['value'.$i] = isset($_POST['value'.$i]) ? urlencode($_POST['value'.$i]) : '';
		}

		return "graph.php?".http_build_query($url);
	}

	public function getContent($nr, $type) {
		$type = $this->typeCheck($type);
		return $this->validateInput($type, $nr);
	}

	public function getError($nr, $type) {
		$type = $this->typeCheck($type);
		return $this->validateError($type, $nr);
	}

	private function typeCheck($t) {
		switch ($t) {
			case 'l': return 'label';
			case 'v': return 'value';
		}
	}

	private function validateError($post_type, $nr) {
		return in_array($post_type.$nr, self::$error) ? 'error' : false;
	}

	private function validateInput($post_type, $nr) {
		$this->checkForError($post_type, $nr);

		return isset($_POST[$post_type.$nr]) 
				? $_POST[$post_type.$nr] 
				: false;
	}

	private function checkForError($post_type, $nr) {
		if ($post_type == 'value')
			if (isset($_POST[$post_type.$nr]) && !is_numeric($_POST[$post_type.$nr]))
				self::$error[] = $post_type.$nr;

		if ($post_type == 'label')
			if (isset($_POST[$post_type.$nr]) && (!is_string($_POST[$post_type.$nr]) || $this->isEmptyStr($_POST[$post_type.$nr])))
				self::$error[] = $post_type.$nr;
	}

	private function isEmptyStr($str) {
		return !str_replace(" ", "", $str);
	}
 
    public static function instance() {
        if (!self::$inst) self::$inst = new self;
        return self::$inst;
    }
}

$hm = HomeWork::instance();

$graphSrc = $hm->getUrl();

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
				<td><input type="text" name="label1" tabindex="1" value="<?php echo $hm->getContent(1, 'l')?>" class="<?php echo $hm->getError(1, 'l')?>"/></td>
				<td><input type="text" name="label2" tabindex="3" value="<?php echo $hm->getContent(2, 'l')?>" class="<?php echo $hm->getError(2, 'l')?>"/></td>
				<td><input type="text" name="label3" tabindex="5" value="<?php echo $hm->getContent(3, 'l')?>" class="<?php echo $hm->getError(3, 'l')?>"/></td>
				<td><input type="text" name="label4" tabindex="7" value="<?php echo $hm->getContent(4, 'l')?>" class="<?php echo $hm->getError(4, 'l')?>"/></td>
				<td><input type="text" name="label5" tabindex="9" value="<?php echo $hm->getContent(5, 'l')?>" class="<?php echo $hm->getError(5, 'l')?>"/></td>	
			</tr>
			<tr id="values">
				<th>Value</th>
				<td><input type="text" name="value1" tabindex="2" value="<?php echo $hm->getContent(1, 'v')?>" class="<?php echo $hm->getError(1, 'v')?>"/></td>
				<td><input type="text" name="value2" tabindex="4" value="<?php echo $hm->getContent(2, 'v')?>" class="<?php echo $hm->getError(2, 'v')?>"/></td>
				<td><input type="text" name="value3" tabindex="6" value="<?php echo $hm->getContent(3, 'v')?>" class="<?php echo $hm->getError(3, 'v')?>"/></td>
				<td><input type="text" name="value4" tabindex="7" value="<?php echo $hm->getContent(4, 'v')?>" class="<?php echo $hm->getError(4, 'v')?>"/></td>
				<td><input type="text" name="value5" tabindex="10" value="<?php echo $hm->getContent(5, 'v')?>" class="<?php echo $hm->getError(5, 'v')?>"/></td>	
			</tr>
		</table>
		<input type="submit" id="runCommand" tabindex="11" value="Draw it!" />
	    </form>
	</aside>
</body>
</html>