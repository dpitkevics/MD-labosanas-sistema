<?php

/**
 * Kritēriju apstrādes klase
 *
 * @author danpit134
 */
class CCriteria {
    /**
     * Kritērija ID
     * @var integer 
     */
    private $_id;
    /**
     * Kritērija nosaukums, ko redz lietotājs
     * @var string 
     */
    private $_public_name;
    /** 
     * Kritērija svars rēķinot gala atzīmi
     * @var float 
     */
    private $_weight;
    /**
     * 1 - atrast tekstā vai arī basic funkcija : funkcijas, kas atgriež true vai false : padodamais parametrs ir $context (source code)
     * 2 - izlaist caur validātoru : validātora url
     * 3 - meklēt kļūdas : pārbauda izdotās kļūdas : padot valodu (PHP, Javascript utt)
     * 4 - lietotāju definētās klases : ārējas klases : norādīt klasi : jābūt metodei run, kas palaiž validāciju
     * @var integer
     */
    private $_type;
    /**
     * Satur kritēriju, kas izpildās
     * @var string 
     */
    private $_criteria_sentence;
    /**
     * Satur timestamp
     * @var integer 
     */
    private $_timestamp;
    
    /**
     * Failu atrašanās vieta (folderis ar "/" beigās)
     * @var string 
     */
    private $_source_path;
    /**
     * Satur visus pirmkodus no foldera ($this->_source_path)
     * @var array 
     */
    private $_source_code = array();
    
    private static $_js_c = 0;
    
    /**
     * Konstruktors - sadefinēs mainīgos
     * 
     * @param CActiveRecord $criteria Kritērija dati no datubāzes
     * @param string $sourcePath Failu foldera nosaukums
     */
    public function __construct(CActiveRecord $criteria, $sourcePath) {
        $this->_id = $criteria->id;
        $this->_public_name = $criteria->public_name;
        $this->_weight = $criteria->weight;
        $this->_type = $criteria->type;
        $this->_criteria_sentence = $criteria->criteria_sentence;
        $this->_timestamp = $criteria->timestamp;
        
        $this->_source_path = $sourcePath;
        $this->_source_code = $this->getSources();
    }
    
    /**
     * Izpilda validāciju
     * @return boolean true - validācija ir veiksmīga - vai false - validācija nav veiksmīga
     */
    public function run() {
        return $this->runValidation($this->_type);
    }
    
    /**
     * Iegūst pirmkodus no definētā foldera
     * @return array Masīvs ar pirmkodiem
     */
    private function getSources() {
        $files = glob($this->_source_path."*");
        $source = array();
        foreach ($files as $file) {
            $source[] = file_get_contents($file);
        }
        return $source;
    }
    
    /**
     * Iegūs pirmkodus no definētā foldera ar definētu paplašinājumu
     * @param string $extension Paplašinājums
     * @return array Masīvs ar pirmkodiem
     */
    private function getSourceByExtension($extension) {
        $files = glob($this->_source_path."*.$extension");
        $source = array();
        foreach ($files as $file) {
            chmod($file, '0777');
            $source[] = file_get_contents($file);
        }
        return $source;
    }
    
    /**
     * Sāk pildīt validāciju.
     * Izpilda funkciju, kas atkarīga no kritērija tipa
     * @param integer $type Kritērija tips
     * @return boolean true - validācija ir veiksmīga - vai false - validācija nav veiksmīga
     */
    private function runValidation($type) {
        switch ($type) {
            case 1:
                return $this->validateOccurance();
            case 2:
                return $this->validateOnValidator();
            case 3:
                return $this->validateJs();
            case 4:
                return $this->validateClass();
            default:
                return false;
        }
    }
    
    /**
     * Izpilda 1 tipa validāciju.
     * Izpilda funkciju, kas atrodama tabulā - 
     * visbiežāk lietojama, lai atrastu konkrētu teksta gabalu kodā.
     * @return boolean true - validācija ir veiksmīga - vai false - validācija nav veiksmīga
     * @example return strpos($context, '<title>');
     */
    private function validateOccurance() {
        $result = false;
        foreach ($this->_source_code as $context) {
            ob_start();
            if (eval ($this->_criteria_sentence)) {
                $result = true;
            }
            $errors = ob_get_clean();
            ob_end_clean();
            if ($errors)
                throw new CHttpException(404, "Invalid criteria sentence with public name: " . $this->_public_name . " and sentence: " . $this->_criteria_sentence);
        }
        return $result;
    }
    
    /**
     * Izpilda 2 tipa validāciju.
     * Validē pēc norādītā validātora.
     * @return boolean true - validācija ir veiksmīga - vai false - validācija nav veiksmīga
     * @example html - http://validator.w3.org/check/?fragment=$context&lang=html&method=post&output=json&valid=return empty($result->messages);
     * @example css - http://jigsaw.w3.org/css-validator/validator?text=$context&lang=css&output=json&method=get&valid=return $result->cssvalidation->validity;
     */
    private function validateOnValidator() {
        $parts = explode ('?', $this->_criteria_sentence);
        $url = $parts[0];
        $vars = $parts[1];

        parse_str($vars);
        
        $sources = $this->getSourceByExtension($lang);
        
        foreach ($sources as $source) {
            ob_start();
            $vars = str_replace('$context', urlencode($source), $vars);
            
            $pos = strpos($vars, 'valid');
            $vars = substr($vars, 0, $pos);
            
            if ($method == "get") {
                $url = $url . '?' . $vars;
                $result = file_get_contents($url);
            } else {
                $opts = array('http' => array(
                    'method' => strtoupper($method),
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n" .
                                "User-Agent:Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.152 Safari/537.22",
                    'content' => $vars
                ));

                $context = stream_context_create($opts);

                $result = file_get_contents($url, false, $context);
            }
            
            switch ($output) {
                case 'json':
                    $result = json_decode($result);
                    break;
                case 'html':
                    $result = new stdClass();
                    $result->messages = array();
                    break;
            }
            $evald = eval($valid);
            $errors = ob_get_clean();
            if ($errors)
                throw new CHttpException(404, "Invalid criteria sentence with public name: " . $this->_public_name . " and sentence: " . $this->_criteria_sentence);
            if (!$evald) 
                return false;
            return true;
        }
    }
    
    private function validateJs() {
        //$script = $this->_criteria_sentence;
        $cs = Yii::app()->clientScript->registerScript('js_' . (++self::$_js_c), 'function js_'.self::$_js_c.'() { var $iframe = window.frames["iframe"]; ' . $this->_criteria_sentence . '}', CClientScript::POS_BEGIN);
        return CHtml::link('Run JS', '#', array(
            'onclick' => 'js:js_'.self::$_js_c.'()'
        ));
    }
    
    private function validateClass() {
        $class = $this->_criteria_sentence;
        ob_start();
        eval ($class);
        $className = ucfirst(str_replace(' ', '_', $this->_public_name));
        $object = new $className;
        $object->sources = $this->getSources();
        $errors = ob_get_clean();
        if ($errors)
            throw new CHttpException(404, "Invalid criteria sentence with public name: " . $this->_public_name . " and sentence: " . $this->_criteria_sentence);
        if ($object->run())
            return true;
        else
            return false;
    }
}

