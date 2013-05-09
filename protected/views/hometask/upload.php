<?php
/* @var $this HometaskController */

$this->breadcrumbs=array(
	'Hometask' => array('/hometask/index'),
        'Upload ZIP',
);
?>
<h1>Upload ZIP file with hometask files</h1>
<div class="form">
    <?php echo CHtml::beginForm('', 'POST', array('enctype'=>'multipart/form-data')); ?>
    <div class="row">
        <?php echo CHtml::label('Upload Hometask', 'upload'); ?> 
        <?php echo CHtml::fileField('Hometask[upload]', '', array('id'=>'upload')); ?> 
    </div>
    <div class="row">
        <?php echo CHtml::submitButton('Submit'); ?>
    </div>
    <?php echo CHtml::endForm(); ?>
</div>