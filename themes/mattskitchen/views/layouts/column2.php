<?php $this->beginContent('//layouts/main'); ?>
<div class="span-7">
	<aside id="sidebar">
	<?php
    if (!Yii::app()->user->isGuest) {
      $this->beginWidget('zii.widgets.CPortlet', array(
        'title'=>'Operations',
      ));
      $this->widget('zii.widgets.CMenu', array(
        'items'=>$this->menu,
        'htmlOptions'=>array('class'=>'operations'),
      ));
      $this->endWidget();
    }
	?>
	</aside><!-- sidebar -->
</div>
<div class="span-17 last">
	<section id="content">
		<?php echo $content; ?>
	</section><!-- content -->
</div>
<?php $this->endContent(); ?>
