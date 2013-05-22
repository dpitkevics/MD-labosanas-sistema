<div class="row properties">
    Property visibility (extra, example, public or public static) / name / value: 
    <div class="row">
        <?php echo CHtml::textField('v[]'); ?>
        <?php echo CHtml::textField('n[]'); ?>
        <?php echo CHtml::textField('p[]'); ?>
    </div>
</div>
<div class="row">
    <?php echo CHtml::link('Add', '#', array('onclick' => 'js:appendProperties()')); ?>
</div>

<div class="row functions">
    Function visibility (extra, example, public or public static) / name / code:
    <div class="row">
        <?php echo CHtml::textField('fv[]'); ?>
        <?php echo CHtml::textField('fn[]'); ?>
    </div>
    <div class="row">
        <?php echo CHtml::textArea('fc[]'); ?>
    </div>
</div>
<div class="row">
    <?php echo CHtml::link('Add', '#', array('onclick' => 'js:appendFunctions()')); ?>
</div>

<script>
    function appendProperties() {
        $('.properties').append('<div class="row"><?php echo CHtml::textField('v[]') . ' ' . CHtml::textField('n[]') . ' ' .  CHtml::textField('p[]'); ?></div>');
    }
    function appendFunctions() {
        $('.functions').append('<div class="row"><?php echo CHtml::textField('fv[]') . ' ' . CHtml::textField('fn[]'); ?></div><div class="row"><?php echo CHtml::textArea('fc[]'); ?></div>')
    }
</script>