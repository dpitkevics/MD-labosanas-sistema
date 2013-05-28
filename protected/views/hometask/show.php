<?php
/* @var $this HometaskController */

$this->breadcrumbs=array(
	'Hometask'=>array('/hometask'),
	'Show',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>
<?php $c = 0; ?>
<div class="box">
    <?php foreach ($files as $file): ?>
    <?php $name = explode(DIRECTORY_SEPARATOR, $file); ?>
    <p>
        <?php echo CHtml::ajaxLink(
                end($name), 
                array('/ajax/filecontent'),
                array('success'=>'#hometaskSource'),
                array('id'=>'file-'.$c)); ?>
    </p>
    <?php $c++; ?>
    <?php endforeach; ?>
</div>
