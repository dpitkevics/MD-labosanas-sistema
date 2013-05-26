<?php
/* @var $this CriteriaController */

$this->breadcrumbs=array(
	'Criteria',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="info">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>

<div class="row">
    <div class="column">
        <?php echo CHtml::link('View Your Criteria', array('/criteria/view')); ?>
    </div>
    <div class="column">
        <?php echo CHtml::link('Create new Criterion', array('/criteria/new')); ?>
    </div>
    <div class="column">
        <?php echo CHtml::link('Set Criterion to hometask', array('/criteria/set')); ?>
    </div>
</div>
