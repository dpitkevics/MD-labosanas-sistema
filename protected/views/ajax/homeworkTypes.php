<?php
/* @var $this AjaxController */

$this->breadcrumbs=array(
	'Ajax'=>array('/ajax'),
	'HomeworkTypes',
);
?>
<div class="box">
    <?php if (!empty($hometasks)): ?>
        <?php foreach ($hometasks as $hometask): ?>
            <div class="row">
                <?php echo CHtml::link($hometask->title, array('/hometask/list', 'category'=>$hometask->id)); ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        No hometasks found
    <?php endif; ?>
</div>
