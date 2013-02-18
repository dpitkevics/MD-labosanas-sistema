<?php
/* @var $this HometaskController */

$this->breadcrumbs=array(
	'Hometask',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<div class="column">
    <?php echo CHtml::ajaxLink(
            'Run importing', 
            array('/ajax/importHometasks'), 
            array(
                'update'=>'#hometaskTypes',
                'error'=>'function () { $("#hometaskTypes").html("<div class=\"box\">Error happened!</div>"); }',
            ), 
            array('onclick'=>'jQuery("#hometaskTypes").html("<img src=\''.Yii::app()->request->baseUrl.'/images/loading.gif\' alt=\'loading\' />");')); ?>
</div>
<div class="column">
    <?php echo CHtml::ajaxLink(
            'View imported files', 
            array('/ajax/homeworkTypes'), 
            array('update'=>'#hometaskTypes')); ?>
</div>
<div class="column" id="hometaskTypes"></div>
