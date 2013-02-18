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
        <?php echo CHtml::link(
                $hometask->studentIDNumber, 
                array('/hometask/list', 'category'=>$_GET['category'], 'hid'=>$hometask->id)); ?>
    </div>
    <?php endforeach; ?>
</div>
<div class="column" id="hometaskFiles">
    <?php if ($files !== null): ?>
        <?php foreach ($files as $file): ?>
        <?php $name = explode('\\', $file); ?>
        <p>
            <?php echo CHtml::link(
                    end($name), 
                    array('/hometask/list', 'category'=>$_GET['category'], 'hid'=>$hometask->id, 'file'=>$file)); ?>
        </p>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<div class="column span-19" id="hometaskSource">
    <div class="box">
        <?php echo CHtml::link('See this homework live', '#', array('target'=>'_blank')); ?>
    </div>
    <?php if ($source !== null): ?>
        <?php $this->beginWidget('CTextHighlighter', array(
            'language'=>($extension === null)?'PHP':$extension,
            'lineNumberStyle'=>'table',
            'showLineNumbers'=>true,
        )); ?>
        <?php echo $source; ?>
        <?php $this->endWidget(); ?>
    <?php endif; ?>
</div>
