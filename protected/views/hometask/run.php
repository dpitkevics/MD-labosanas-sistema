<?php
/* @var $this HometaskController */

$this->breadcrumbs=array(
	'Hometask'=>array('/hometask'),
	'Run',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>
<?php $url = "archive\\" . $hw->hometask->zipID . '\\' . $hw->studentIDNumber . '\\'; ?>
<div class="box">
    <div class="row">
        <h3>Tests</h3>
    </div>
    <div class="row">
        <strong>W3 Valid:</strong><span style="color:green;">OK</span>
    </div>
    <div class="row">
        <strong>No error output:</strong><span style="color:red;">Not OK</span>
    </div>
</div>
<div class="container">
    <iframe src="<?php echo $url; ?>" frameborder="0" marginheight="0" marginwidth="0" width="95%" height="600px" scrolling="auto"></iframe>
</div>
