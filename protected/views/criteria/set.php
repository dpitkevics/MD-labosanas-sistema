<?php
/* @var $this CriteriaController */

$this->breadcrumbs=array(
	'Criteria'=>array('/criteria'),        
);
if ($_step === 2) {
    $this->breadcrumbs['Set'] = array('/criteria/set');
    $this->breadcrumbs[] = $criteria->public_name;
} else {
    $this->breadcrumbs[] = 'Set';
}
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<?php if ($_step === 1): ?>
<div class="row">
    <?php foreach ($criteria as $criterion): ?>
    <div class="row">
        <div class="column">
            Criterion: <?php echo $criterion->public_name; ?>
        </div>
        <div class="column">
            <?php echo CHtml::link('Set', array('/criteria/set', 'cid' => $criterion->id)); ?>
        </div>
        <hr />
    </div>
    <?php endforeach; ?>
</div>
<?php elseif ($_step === 2): ?>
<div class="row">
    <div class="column">
        Criterion: <?php echo $criteria->public_name; ?>
    </div>
    <div class="column">
        <?php echo CHtml::beginForm(); ?>
        <?php foreach ($hometasks as $ht): ?>
        <div class="row">
            <?php echo CHtml::checkBox('check[]', (empty($ht->hometask->hometaskCriterias)?false:true), array(
                'value' => $ht->hometask->id,
                'onchange' => 'js:changeCriteriaState($(this), '.(int)$_GET['cid'].', '.$ht->hometask->id.');',
            )); ?>
            <?php echo $ht->hometask->title; ?>
            <hr />
        </div>
        <?php endforeach; ?>
        <div class="row">
            <?php echo CHtml::submitButton('Save', array('disabled' => true)); ?>
        </div>
        <?php echo CHtml::endForm(); ?>
    </div>
</div>
<script>
function changeCriteriaState(object, cid, hid) {
    $("input[type='submit']").val('Saving...');
    if (object.is(":checked")) {
        // pievienojam ierakstu
        $.ajax({
            'url': '<?php echo Yii::app()->createUrl('/ajax/criteriaState'); ?>',
            'type': 'POST',
            'data': {
                'entry':'add',
                'cid':cid,
                'hid':hid
            },
            'success': function (html) {
                $("input[type='submit']").val('Saved');
            }
        });
    } else {
        // dzēšam ierakstu
        $.ajax({
            'url': '<?php echo Yii::app()->createUrl('/ajax/criteriaState'); ?>',
            'type': 'POST',
            'data': {
                'entry':'del',
                'cid':cid,
                'hid':hid
            },
            'success': function (html) {
                $("input[type='submit']").val('Saved');
            }
        });
    }
}
</script>
<?php endif; ?>
