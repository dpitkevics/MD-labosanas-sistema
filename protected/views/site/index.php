<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="info">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>

<p>System with purpose on checking student homeworks.</p>
<p>Start out with registration, then create hometask, upload student homeworks, create some validation criterias and thats it.</p>
<p>Just save marks to database</p>
