<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CFiler
 *
 * @author danpit134
 */
class CFiler extends CWidget 
{
    private $_clientScript;
    
    public function init() {
        $this->_clientScript = Yii::app()->getClientScript();
        $this->test();
        $this->render('default');
        parent::init();
    }
    public function test() {
        $this->getSource('index.php');
    }
    private function getSource($url) {
        $js = CHtml::ajax(array(
            'url'=>Yii::app()->createUrl('/filer/getSource'),
            'success'=>'function (html) { $("#file-content").text(html); }',
        ));
               
        $this->registerJs($js, 'sourcer');
    }
    private function registerJs($js, $id) {
        $this->_clientScript->registerScript($id, $js, CClientScript::POS_READY);
    }
}
