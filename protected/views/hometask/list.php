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
        <?php if (isset($_GET['hid']) && $hometask->id==$_GET['hid']) echo '<strong>'; ?>
        <?php echo CHtml::link(
                $hometask->studentIDNumber, 
                array('/hometask/list', 'category'=>$_GET['category'], 'hid'=>$hometask->id)); ?>
        <?php if (isset($_GET['hid']) && $hometask->id==$_GET['hid']) echo '</strong>'; ?>
    </div>
    <?php endforeach; ?>
</div>
<div class="column" id="hometaskFiles">
    <?php if ($files !== null): ?>
        <?php foreach ($files as $file): ?>
        <?php $name = explode('\\', $file); ?>
        <p>
            <?php if (isset($_GET['file']) && base64_encode($file) == $_GET['file']) echo '<strong>'; ?>
            <?php echo CHtml::link(
                    end($name), 
                    array('/hometask/list', 'category'=>$_GET['category'], 'hid'=>$_GET['hid'], 'file'=>  base64_encode($file))); ?>
            <?php if (isset($_GET['file']) && base64_encode($file) == $_GET['file']) echo '</strong>'; ?>
        </p>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<div class="column span-19" id="hometaskSource">
    <?php if ($files !== null): ?>
    <div class="box">
        <?php echo CHtml::link('See this homework live', array('/hometask/run', 'hid'=>$_GET['hid']), array('target'=>'_blank')); ?>
    </div>
    <?php endif; ?>
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
