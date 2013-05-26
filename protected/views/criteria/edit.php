<?php
/* @var $this CriteriaController */
/* @var $model Criteria */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'criteria-new-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'public_name'); ?>
		<?php echo $form->textField($model,'public_name'); ?>
		<?php echo $form->error($model,'public_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'weight'); ?>
		<?php echo $form->textField($model,'weight'); ?>
		<?php echo $form->error($model,'weight'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type',CHtml::listData(CriteriaType::model()->findAll(), 'criterion_type', 'type_name'), array(
                    'onchange' => 'js:checkStep($(this));',
                )); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>
        <?php echo $form->labelEx($model,'criteria_sentence'); ?>
        <div class="sentence">
            <div class="row">
                    <?php echo $form->textArea($model,'criteria_sentence'); ?>
            </div>
        </div>
        <div class="hint">If using user defined class, there must be public method called "run"</div>
        <?php echo $form->error($model,'criteria_sentence'); ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
    var sentence_content = $(".sentence").html();
    function checkStep(object) {
        if (object.val() === "4")
            <?php echo CHtml::ajax(array(
                'url' => Yii::app()->createUrl('/criteria/class'),
                'success' => 'function (html) { $(".sentence").html(html); }'
            )); ?>
        else {
            $(".sentence").html(sentence_content);
        }
    }
    $(function () {
        checkStep($("#Criteria_type"));
    });
</script>