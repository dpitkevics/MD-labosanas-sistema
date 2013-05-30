<?php
/* @var $this HometaskController */

$this->breadcrumbs=array(
	'Hometask'=>array('/hometask'),
	'Run',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>
<?php $url = Yii::app()->request->baseUrl . DIRECTORY_SEPARATOR."protected".DIRECTORY_SEPARATOR."archive".DIRECTORY_SEPARATOR."archive-" . $this->getDirAppendix() . DIRECTORY_SEPARATOR . $hw->hometask->zipID . DIRECTORY_SEPARATOR . $hw->studentIDNumber . DIRECTORY_SEPARATOR; ?>
<div class="box">
    <div class="row">
        <h3>Tests</h3>
    </div>
    <?php if (!empty($hw->hometask->hometaskCriterias)): ?>
        <div class="row">
            Received <span id="received_pts"><?php echo $sums['user']; ?></span> points of <span id="total_pts"><?php echo $sums['weight']; ?></span>.
        </div>
        <div class="row">
            <div class="column">
                Suggested mark: <strong><span id="suggested_mark"><?php echo round(($sums['user'] / ($sums['weight'] / 100)) / 10); ?></span></strong>
            </div>
            <div class="column">
                <?php echo CHtml::ajaxLink('Save mark', array('/ajax/saveMark'), array('type' => 'POST', 'data' => array(
                    'hid' => (int)$_GET['hid'], 
                    'mark' => 'js:$("#suggested_mark").text()',
                ),  'success' => 'js:function (html) { alert("Mark saved to database"); }',
                    'error' => 'js:function () { alert("Failed to save mark. Check if mark is correct."); }')); ?>
            </div>
            <div class="column">
                <?php echo CHtml::link('Edit mark', '#', array('onclick' => 'js:promptEdit();')); ?>
            </div>
            <div class="clearfix"></div>
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
    <?php else: ?>
        <div class="row">
            <?php echo CHtml::link('Add new Criterion', array('/criteria/new')); ?>
        </div>
    <?php endif; ?>
</div>
<div class="container">
    <iframe src="<?php echo $url . $hw->hometask->indexFile; ?>" frameborder="0" marginheight="0" marginwidth="0" width="95%" height="600px" scrolling="auto" id="iframe"></iframe>
</div>
<script>
    function promptEdit() {
        var mark=prompt("Enter new mark");
        if (mark != null) {
            if (mark >= 0 && mark <= 10)
                $("#suggested_mark").text(mark);
            else
                alert("Invalid mark");
        }
    }
    function updatePts(object, weight) {
        var $total_pts = parseFloat($("#total_pts").text());
        var $rec_pts = parseFloat($("#received_pts").text());
        
        var rec_size, weight_size;
        if (strpos($("#received_pts").text(), '.')===false)
            rec_size = 0;
        else
            rec_size = $("#received_pts").text().split(".")[1].length;
        
        if (strpos(weight.toString(), '.')===false)
            weight_size = 0;
        else
            weight_size = weight.toString().split(".")[1].length;
        var res;
        if (rec_size > weight_size)
            res = rec_size;
        else
            res = weight_size;
        
        if (object.is(":checked")) {
            var sum = $rec_pts + weight;
            $("#received_pts").text(sum.toFixed(res));
            $("#suggested_mark").text(Math.round((($rec_pts + weight) / ($total_pts / 100)) / 10));
        } else {
            var dis = $rec_pts - weight;
            $("#received_pts").text(dis.toFixed(res));
            $("#suggested_mark").text(Math.round((($rec_pts - weight) / ($total_pts / 100)) / 10));
        }
    }
    function strpos (haystack, needle, offset) {
        var i = (haystack+'').indexOf(needle, (offset || 0));
        return i === -1 ? false : i;
    }
</script>