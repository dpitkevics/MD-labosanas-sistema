<?php
/* @var $this HometaskController */

$this->breadcrumbs=array(
	'Hometask',
);
?>
<h1>Hometask</h1>

<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="info">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>

<div class="column">
    <?php echo CHtml::link('Create a new hometask', array('/hometask/create')); ?>
</div>
<div class="colummn">
    <?php echo CHtml::link('My hometasks', array('/hometask/viewHometasks')); ?>
</div>
<div class="column">
    <?php echo CHtml::link('Upload ZIP', array('/hometask/upload')); ?>
</div>
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
