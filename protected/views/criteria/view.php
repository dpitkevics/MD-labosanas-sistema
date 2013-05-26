<?php

$this->breadcrumbs=array(
    'Criteria' => array('/criteria/index'),
    'My Criteria'    
);
?>

<h1>My Criteria</h1>

<div class="row">
    <?php foreach ($criteria as $criterion): ?>
    <div class="row">
        <div class="row">
            Public name: <?php echo $criterion->public_name; ?>
        </div>
        <div class="row">
            Weight: <?php echo $criterion->weight; ?>
        </div>
        <div class="row">
            Type: <?php echo $criterion->type0->type_name; ?>
        </div>
        <div class="row">
            Criteria sentence: <?php echo $criterion->criteria_sentence; ?>
        </div>
        <div class="row">
            <?php echo CHtml::link('Edit', array('/criteria/edit', 'id' => $criterion->id)); ?>
        </div>
        <hr />
    </div>
    <?php endforeach; ?>
</div>
