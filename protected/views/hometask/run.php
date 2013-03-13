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
        Nopelnīti <?php echo $sums['user']; ?> punkti no <?php echo $sums['weight']; ?>.
    </div>
    <div class="row">
        Piedāvātā atzīme: <?php echo round(($sums['user'] / ($sums['weight'] / 100)) / 10); ?>
    </div>
    <?php foreach ($hw->hometask->hometaskCriterias as $criteria): ?>
    <div class="row">
        <strong><?php echo $criteria->criteria->public_name; ?>:</strong>
        <span style="color:<?php echo (($validation[$criteria->criteria->id])?"green":"red"); ?>;">
            <?php echo (($validation[$criteria->criteria->id])?"OK":"Not OK"); ?>
        </span>
    <?php endforeach; ?>
</div>
<div class="container">
    <iframe src="<?php echo $url; ?>" frameborder="0" marginheight="0" marginwidth="0" width="95%" height="600px" scrolling="auto"></iframe>
</div>
