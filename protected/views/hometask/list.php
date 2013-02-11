<?php
/* @var $this HometaskController */

$this->breadcrumbs=array(
	'Hometask'=>array('/hometask'),
	'List',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<div class="column">
    <?php foreach ($hometasks as $hometask): ?>
    <div class="row">
        <?php echo CHtml::ajaxLink(
                $hometask->studentIDNumber, 
                array('/hometask/show', 'hid'=>$hometask->id),
                array(
                    'update'=>'#hometaskFiles',
                    'error'=>'function () { $("#hometaskFiles").html("<div class=\"box\">Error happened!</div>"); }',
                )); ?>
    </div>
    <?php endforeach; ?>
</div>
<div class="column" id="hometaskFiles"></div>
<div class="column" id="hometaskSource"></div>
