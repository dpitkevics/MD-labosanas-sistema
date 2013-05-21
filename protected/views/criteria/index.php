<?php
/* @var $this CriteriaController */

$this->breadcrumbs=array(
	'Criteria',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<div class="row">
    <div class="column">
        <?php echo CHtml::link('View Your Criteria', array('/criteria/view')); ?>
    </div>
    <div class="column">
        <?php echo CHtml::link('Edit Criteria', array('/criteria/edit')); ?>
    </div>
    <div class="column">
        <?php echo CHtml::link('Create new Criterion', array('/criteria/new')); ?>
    </div>
</div>