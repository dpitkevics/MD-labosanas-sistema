<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Criteria
 *
 * @author danpit134
 */
class CCriteria {
    private $_id;
    private $_public_name;
    private $_weight;
    /*
     * @param $_type
     * 1 - atrast tekstā vai arī basic funkcija : funkcijas, kas atgriež true vai false : padodamais parametrs ir $context (source code)
     * 2 - izlaist caur validātoru : validātora url
     * 3 - meklēt kļūdas : pārbauda izdotās kļūdas : padot valodu (PHP, Javascript utt)
     * 4 - lietotāju definētās klases : ārējas klases : norādīt klasi : jābūt metodei run, kas palaiž validāciju
     */
    private $_type;
    private $_criteria_sentence;
    private $_timestamp;
    
    private $_source_path;
    private $_source_code = array();
    
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
    
    public function run() {
        return $this->runValidation($this->_type);
    }
    
    private function getSources() {
        $files = glob($this->_source_path."*");
        $source = array();
        foreach ($files as $file) {
            $source[] = file_get_contents($file);
        }
        return $source;
    }
    
    private function getSourceByExtension($extension) {
        $files = glob($this->_source_path."*.$extension");
        $source = array();
        foreach ($files as $file) {
            $source[] = file_get_contents($file);
        }
        return $source;
    }
    
    private function runValidation($type) {
        switch ($type) {
            case 1:
                return $this->validateOccurance();
            case 2:
                return $this->validateOnValidator();
            case 3:
                return $this->validateErrors();
            case 4:
                return $this->validateClass();
            default:
                return false;
        }
    }
    
    private function validateOccurance() {
        $result = false;
        foreach ($this->_source_code as $context) {
            if (eval ($this->_criteria_sentence)) {
                $result = true;
            }
        }
        return $result;
    }
    
    private function validateOnValidator() {
        $parts = explode ('?', $this->_criteria_sentence);
        $url = $parts[0];
        $vars = $parts[1];
        
        parse_str($vars);
        
        $sources = $this->getSourceByExtension($lang);
        
        foreach ($sources as $source) {
            if ($lang == "css") {
                $url = $this->_criteria_sentence;
                $url = str_replace('$context', $source, $url);
                $url = str_replace("\n", '', $url);
                $url = str_replace(" ", '', $url);
                echo $url;exit;
            }
            
            $vars = str_replace('$context', $source, $vars);

            $opts = array('http' => array(
                'method' => 'POST',
                'header' => "Content-type: application/x-www-form-urlencoded\r\n" .
                            "User-Agent:Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.152 Safari/537.22",
                'content' => $vars
            ));
            
            $context = stream_context_create($opts);
            
            $result = file_get_contents($url, false, $context);
            
            switch ($output) {
                case 'json':
                    $result = json_decode($result);
                    break;
            }

            if (count($result->messages)>0) 
                return false;
            return true;
        }
    }
}

