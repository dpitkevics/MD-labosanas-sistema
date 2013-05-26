<?php
/* @var $this HometaskController */

$this->breadcrumbs=array(
	'Hometask'=>array('/hometask'),
	'Run',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>
<?php $url = Yii::app()->request->baseUrl . "\\protected\\archive\\archive-" . $this->getDirAppendix() . '\\' . $hw->hometask->zipID . '\\' . $hw->studentIDNumber . '\\'; ?>
<div class="box">
    <div class="row">
        <h3>Tests</h3>
    </div>
    <div class="row">
        Nopelnīti <span id="received_pts"><?php echo $sums['user']; ?></span> punkti no <span id="total_pts"><?php echo $sums['weight']; ?></span>.
    </div>
    <div class="row">
        Piedāvātā atzīme: <span id="suggested_mark"><?php echo round(($sums['user'] / ($sums['weight'] / 100)) / 10); ?></span>
    </div>
    <?php foreach ($hw->hometask->hometaskCriterias as $criteria): ?>
    <div class="row">
        <strong><?php echo $criteria->criteria->public_name; ?>:</strong>
        <?php if ((strpos($validation[$criteria->criteria->id], '<a')!==false)): ?>
        <?php echo $validation[$criteria->criteria->id]; ?>
        <?php echo CHtml::checkBox($criteria->criteria->id, false,  array(
            'onclick' => 'js:updatePts($(this), ' . $criteria->criteria->weight . ');'
        )); ?>
        <?php else: ?>
        <span style="color:<?php echo (($validation[$criteria->criteria->id])?"green":"red"); ?>;">
            <?php echo (($validation[$criteria->criteria->id])?"OK":"Not OK"); ?>
        </span>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
<div class="container">
    <iframe src="<?php echo $url; ?>" frameborder="0" marginheight="0" marginwidth="0" width="95%" height="600px" scrolling="auto" id="iframe"></iframe>
</div>
<script>
    function updatePts(object, weight) {
        var $total_pts = parseFloat($("#total_pts").text());
        var $rec_pts = parseFloat($("#received_pts").text());
        
        if (object.is(":checked")) {
            $("#received_pts").text($rec_pts + weight);
            $("#suggested_mark").text(Math.round((($rec_pts + weight) / ($total_pts / 100)) / 10));
        } else {
            $("#received_pts").text($rec_pts - weight);
            $("#suggested_mark").text(Math.round((($rec_pts - weight) / ($total_pts / 100)) / 10));
        }
    }
</script>