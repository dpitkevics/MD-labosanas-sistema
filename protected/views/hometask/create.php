<?php
/* @var $this HometaskController */
/* @var $model Hometask */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'hometask-create-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'zipID'); ?>
		<?php echo $form->textField($model,'zipID'); ?>
		<?php echo $form->error($model,'zipID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title'); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'indexFile'); ?>
		<?php echo $form->textField($model,'indexFile'); ?>
		<?php echo $form->error($model,'indexFile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'term'); ?>
		<?php echo $form->dateField($model,'term'); ?>
		<?php echo $form->error($model,'term'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Create'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->